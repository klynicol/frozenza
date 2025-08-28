<?php

use App\Http\Controllers\{
    ProfileController,
    PizzaController,
    BrandController,
    StyleController,
    CategoryController,
    ReviewController,
    MessageController,
    BlogPostController,
    ContactController,
    Auth\SocialAuthController,
    Admin\AffiliateLinkController,
    Admin\DashboardController
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
    return Inertia::render('Privacy');
})->name('privacy');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/giveaway', function () {
    return Inertia::render('Giveaway');
})->name('giveaway');

Route::get('/users/delete-data-instructions', function () {
    return Inertia::render('Auth/DeleteDataInstructions');
})->name('users.delete-data-instructions');

// Pizza routes
Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');
Route::get('/pizzas/{brand:slug}/{pizza:slug}', [PizzaController::class, 'show'])->name('pizzas.show');
Route::get('/pizzas/list', [PizzaController::class, 'list'])->name('pizzas.list');

// Brand routes
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{brand:slug}/pizzas', [BrandController::class, 'show'])->name('brands.show');

// Style routes
Route::get('/styles', [StyleController::class, 'index'])->name('styles.index');
Route::get('/styles/{style:slug}', [StyleController::class, 'show'])->name('styles.show');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');


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

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::name('admin.')->prefix('admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('affiliate-links', AffiliateLinkController::class);
            Route::post('affiliate-links/update-order', [AffiliateLinkController::class, 'updateOrder'])->name('affiliate-links.update-order');
        });
    });
});

// Blog routes (public)
Route::get('/blogs', [BlogPostController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{post:slug}', [BlogPostController::class, 'show'])->name('blogs.show');

require __DIR__ . '/auth.php';
