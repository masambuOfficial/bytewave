<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientServiceController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Legal & Help Pages
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/faqs', 'pages.faqs')->name('faqs');
Route::view('/help', 'pages.help')->name('help');

// Blog routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/all', [BlogController::class, 'all'])->name('all');
    Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{blog:slug}/comments', [BlogController::class, 'storeComment'])->name('comments.store');
});

// Newsletter routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Service routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/audio-visual-production', [ServiceController::class, 'audioVisual'])->name('services.audio-visual');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Portfolio routes
Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
Route::get('/portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('portfolios.show');

// Testimonial submission routes (public)
Route::get('/testimonials/submit', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimonials/submit', [TestimonialController::class, 'store'])->middleware('throttle:5,1')->name('testimonials.store');

// Admin routes
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'admin']);

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Website content (Owner, Content)
    Route::middleware('module:products')->group(function () {
        Route::resource('products', AdminProductController::class);
    });
    Route::middleware('module:services')->group(function () {
        Route::resource('services', AdminServiceController::class);
    });
    Route::middleware('module:posts')->group(function () {
        Route::resource('posts', AdminPostController::class);
    });
    Route::middleware('module:portfolios')->group(function () {
        Route::resource('portfolios', AdminPortfolioController::class);
    });
    Route::middleware('module:testimonials')->group(function () {
        Route::patch('testimonials/{testimonial}/approve', [AdminTestimonialController::class, 'approve'])->name('testimonials.approve');
        Route::patch('testimonials/{testimonial}/reject', [AdminTestimonialController::class, 'reject'])->name('testimonials.reject');
        Route::resource('testimonials', AdminTestimonialController::class);
    });

    // Business management
    Route::middleware('module:clients')->group(function () {
        Route::resource('clients', ClientController::class);
    });
    Route::middleware('module:client-services')->group(function () {
        Route::post('client-services/quick-store', [ClientServiceController::class, 'quickStore'])->name('client-services.quick-store');
        Route::resource('client-services', ClientServiceController::class);
    });
    Route::middleware('module:tasks')->group(function () {
        Route::resource('tasks', TaskController::class);
    });

    // Quotations (Owner, Accounts, Sales)
    Route::middleware('module:quotations')->group(function () {
        Route::get('quotations/{quotation}/print', [QuotationController::class, 'print'])->name('quotations.print');
        Route::get('quotations/{quotation}/pdf', [QuotationController::class, 'pdf'])->name('quotations.pdf');
        Route::get('quotations/{quotation}/items', [QuotationController::class, 'items'])->name('quotations.items');
        Route::post('quotations/{quotation}/send-email', [QuotationController::class, 'sendEmail'])->name('quotations.send-email');
        Route::resource('quotations', QuotationController::class);
    });

    // Invoices, payments and receipts (Owner, Accounts only)
    Route::middleware('module:invoices')->group(function () {
        Route::post('quotations/{quotation}/convert-to-invoice', [QuotationController::class, 'convertToInvoice'])->name('quotations.convert-to-invoice');
        Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
        Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'pdf'])->name('invoices.pdf');
        Route::get('invoices/{invoice}/receipt', [InvoiceController::class, 'receipt'])->name('invoices.receipt');
        Route::get('invoices/{invoice}/receipt-pdf', [InvoiceController::class, 'receiptPdf'])->name('invoices.receipt-pdf');
        Route::post('invoices/{invoice}/send-email', [InvoiceController::class, 'sendEmail'])->name('invoices.send-email');
        Route::post('invoices/{invoice}/send-receipt', [InvoiceController::class, 'sendReceipt'])->name('invoices.send-receipt');
        Route::post('invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('invoices.payments.store');
        Route::delete('invoices/{invoice}/payments/{payment}', [PaymentController::class, 'destroy'])->name('invoices.payments.destroy');
        Route::resource('invoices', InvoiceController::class);
    });

    // Staff and roles (Owner only)
    Route::middleware('module:staff')->group(function () {
        Route::resource('staff', StaffController::class)->except(['show', 'destroy']);
    });
});

require __DIR__.'/auth.php';
