@component('mail::message')
# New testimonial awaiting approval

**From:** {{ $testimonial->name }}@if($testimonial->title), {{ $testimonial->title }}@endif @if($testimonial->company) at {{ $testimonial->company }}@endif
**Rating:** {{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }} ({{ $testimonial->rating }}/5)

**Testimonial:**
{{ $testimonial->testimonial }}

@component('mail::button', ['url' => route('admin.testimonials.index', ['status' => 'pending'])])
Review in admin
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
