<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Role-based access to the admin panel. Uses DatabaseTransactions (not RefreshDatabase) because the
 * test suite points at the real MySQL database: every user created here is rolled back.
 */
class StaffRolesTest extends TestCase
{
    use DatabaseTransactions;

    private function staff(string $role, bool $active = true): User
    {
        return User::create([
            'name'      => ucfirst($role) . ' Tester',
            'email'     => $role . '.' . uniqid() . '@test.invalid',
            'password'  => bcrypt('password'),
            'role'      => $role,
            'is_admin'  => true,
            'is_active' => $active,
        ]);
    }

    public static function access(): array
    {
        // role => [route => expected to open (true) or bounce to the dashboard (false)]
        return [
            'owner'    => ['owner',    ['admin.invoices.index' => true,  'admin.quotations.index' => true,  'admin.posts.index' => true,  'admin.staff.index' => true]],
            'accounts' => ['accounts', ['admin.invoices.index' => true,  'admin.quotations.index' => true,  'admin.posts.index' => false, 'admin.staff.index' => false]],
            'sales'    => ['sales',    ['admin.invoices.index' => false, 'admin.quotations.index' => true,  'admin.posts.index' => false, 'admin.staff.index' => false]],
            'content'  => ['content',  ['admin.invoices.index' => false, 'admin.quotations.index' => false, 'admin.posts.index' => true,  'admin.staff.index' => false]],
        ];
    }

    /** @dataProvider access */
    public function test_each_role_only_opens_its_own_sections(string $role, array $routes): void
    {
        $user = $this->staff($role);

        foreach ($routes as $name => $allowed) {
            $response = $this->actingAs($user)->get(route($name));

            if ($allowed) {
                $response->assertOk();
            } else {
                $response->assertRedirect(route('admin.dashboard'));
            }
        }
    }

    public function test_dashboard_opens_for_every_role(): void
    {
        foreach (['owner', 'accounts', 'sales', 'content'] as $role) {
            $this->actingAs($this->staff($role))->get(route('admin.dashboard'))->assertOk();
        }
    }

    public function test_sales_cannot_convert_a_quotation_to_an_invoice(): void
    {
        // Route-model binding runs before the role check, so the quotation has to exist.
        $quotation = \App\Models\Quotation::first();
        if (! $quotation) {
            $this->markTestSkipped('No quotation in the database to test with.');
        }

        $this->actingAs($this->staff('sales'))
            ->post(route('admin.quotations.convert-to-invoice', $quotation))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_deactivated_staff_are_locked_out(): void
    {
        $user = $this->staff('owner', active: false);

        $this->actingAs($user)->get(route('admin.dashboard'))->assertRedirect(route('home'));
    }

    public function test_deactivated_staff_cannot_sign_in(): void
    {
        $user = $this->staff('accounts', active: false);

        $this->post(route('login'), ['email' => $user->email, 'password' => 'password'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_public_registration_and_password_reset_pages_are_gone(): void
    {
        $this->get('/register')->assertNotFound();
        $this->get('/forgot-password')->assertNotFound();
    }

    public function test_owner_can_add_staff_and_the_last_owner_cannot_be_demoted(): void
    {
        $owner = $this->staff('owner');

        $this->actingAs($owner)->post(route('admin.staff.store'), [
            'name' => 'New Accountant', 'email' => 'new.accountant@test.invalid', 'role' => 'accounts',
            'password' => 'a-strong-pass-1', 'password_confirmation' => 'a-strong-pass-1',
        ])->assertRedirect(route('admin.staff.index'));

        $this->assertDatabaseHas('users', ['email' => 'new.accountant@test.invalid', 'role' => 'accounts', 'is_admin' => true]);

        // Demote every other owner so $owner is the last one, then try to change their own role.
        User::where('role', 'owner')->where('id', '!=', $owner->id)->update(['is_active' => false]);
        $this->actingAs($owner)->put(route('admin.staff.update', $owner), [
            'name' => $owner->name, 'email' => $owner->email, 'role' => 'sales', 'is_active' => 1,
        ])->assertSessionHas('error');
        $this->assertSame('owner', $owner->fresh()->role);
    }
}
