<?php

use App\Http\Controllers\{
    ProfileController,
    PizzaController,
    BrandController,
    ReviewController,
    MessageController,
    BlogPostController,
    ContactController,
    Auth\SocialAuthController,
    Admin\AffiliateLinkController,
    Admin\BlogPostController as AdminBlogPostController,
    Admin\DashboardController,
    Admin\UserRoleController,
    BrandSubmissionController,
};
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models;
use Illuminate\Support\Facades\Auth;

Route::get('/local-login/{user_email}', function ($user_email) {
    if (config('app.env') !== 'local') {
        return redirect()->route('login');
    }
    $user = Models\User::where('email', $user_email)->first();
    if (!$user) {
        return redirect()->route('login')->with('message', 'User not found');
    }
    Auth::login($user);
    return redirect()->route('home');
})->name('local-login');

// Public routes
Route::get('/', [PizzaController::class, 'index'])->name('home');
Route::get('/top-rated', [PizzaController::class, 'topRated'])->name('pizzas.top-rated');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/privacy', function () {
    Inertia::share('meta', [
        'title' => 'Privacy Policy | Pizza Kraken',
        'description' => 'Read the Pizza Kraken privacy policy and learn how we collect, use, and protect your information.',
        'keywords' => 'pizza kraken privacy policy, data privacy, frozen pizza website privacy',
        'canonicalUrl' => '/privacy',
    ]);

    return Inertia::render('Privacy');
})->name('privacy');

Route::get('/about', function () {
    Inertia::share('meta', [
        'title' => 'About Pizza Kraken | Frozen Pizza Reviews',
        'description' => 'Learn about Pizza Kraken, our mission, and how we review and compare frozen pizzas.',
        'keywords' => 'about pizza kraken, frozen pizza reviews, pizza kraken mission',
        'canonicalUrl' => '/about',
    ]);

    return Inertia::render('About');
})->name('about');

Route::get('/giveaway', function () {
    Inertia::share('meta', [
        'title' => 'Frozen Pizza Giveaway | Pizza Kraken',
        'description' => 'Enter the Pizza Kraken frozen pizza giveaway and check official rules and eligibility details.',
        'keywords' => 'frozen pizza giveaway, pizza kraken giveaway, pizza contest',
        'canonicalUrl' => '/giveaway',
    ]);

    return Inertia::render('Giveaway');
})->name('giveaway');

Route::get('/users/delete-data-instructions', function () {
    Inertia::share('meta', [
        'title' => 'Delete Data Instructions | Pizza Kraken',
        'description' => 'Follow these instructions to request deletion of your account data from Pizza Kraken.',
        'keywords' => 'delete account data, privacy request, pizza kraken data deletion',
        'canonicalUrl' => '/users/delete-data-instructions',
    ]);

    return Inertia::render('Auth/DeleteDataInstructions');
})->name('users.delete-data-instructions');

// Pizza routes
Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');
Route::get('/lowest-calorie-frozen-pizza', [PizzaController::class, 'lowestCalorie'])->name('pizzas.lowest-calorie');
Route::get('/pizzas/{brand:slug}/{pizza:slug}', [PizzaController::class, 'show'])->name('pizzas.show');
Route::get('/pizzas/list', [PizzaController::class, 'list'])->name('pizzas.list');

// Brand routes
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{brand:slug}/pizzas', function (\App\Models\Brand $brand) {
    return redirect()->route('brands.show', ['brand' => $brand->slug], 301);
})->name('brands.pizzas.show');
Route::get('/brands/{brand:slug}', [BrandController::class, 'show'])->name('brands.show');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Reviews
    Route::post('/pizzas/{pizza}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');

    // Blog management
    Route::middleware(['role:admin,blog-writer'])->group(function () {
        Route::get('/blogs/create', [BlogPostController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogPostController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{post:slug}/edit', [BlogPostController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{post:slug}', [BlogPostController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{post:slug}', [BlogPostController::class, 'destroy'])->name('blogs.destroy');
    });

    // Pizza Ambassador
    Route::middleware(['role:admin,pizza-ambassador, brand-ambassador'])->group(function () {
        Route::get('/pizza-ambassador/dashboard', function () {
            return Inertia::render('PizzaAmbassador/Dashboard');
        })->name('pizza-ambassador.dashboard');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::name('admin.')->prefix('admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('blogs', [AdminBlogPostController::class, 'index'])->name('blogs.index');
            Route::resource('affiliate-links', AffiliateLinkController::class);
            Route::post('affiliate-links/update-order', [AffiliateLinkController::class, 'updateOrder'])->name('affiliate-links.update-order');
            Route::resource('user-roles', UserRoleController::class);
            Route::get('brands', [BrandController::class, 'adminIndex'])->name('brands.index');
            Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
            Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
            Route::get('brands/{brand}', [BrandController::class, 'adminShow'])->name('brands.show');
            Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
            Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
            Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
        });
    });
});

// Blog routes (public)
Route::get('/blogs', [BlogPostController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{post:slug}', [BlogPostController::class, 'show'])->name('blogs.show');

require __DIR__ . '/auth.php';
