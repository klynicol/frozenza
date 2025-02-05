<?php

use App\Http\Controllers\{
    ProfileController,
    PizzaController,
    BrandController,
    StyleController,
    CategoryController,
    ReviewController,
    MessageController,
    BlogPostController
};
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public routes
Route::get('/', [PizzaController::class, 'index'])->name('home');
Route::get('/top-rated', [PizzaController::class, 'topRated'])->name('pizzas.top-rated');

// Pizza routes
Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');
Route::get('/pizzas/{pizza:slug}', [PizzaController::class, 'show'])->name('pizzas.show');
Route::get('/pizzas/list', [PizzaController::class, 'list'])->name('pizzas.list');

// Brand routes
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{brand:slug}', [BrandController::class, 'show'])->name('brands.show');

// Style routes
Route::get('/styles', [StyleController::class, 'index'])->name('styles.index');
Route::get('/styles/{style:slug}', [StyleController::class, 'show'])->name('styles.show');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Blog routes (public)
Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogPostController::class, 'show'])->name('blog.show');

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
    Route::get('/blog/create', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogPostController::class, 'store'])->name('blog.store');
    Route::get('/blog/{post:slug}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{post:slug}', [BlogPostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{post:slug}', [BlogPostController::class, 'destroy'])->name('blog.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
