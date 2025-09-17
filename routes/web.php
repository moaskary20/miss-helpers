<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaidController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerReviewController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\ChatController as PublicChatController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController as PublicAuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserProfileController;

Route::redirect('/', '/'.app()->getLocale());

// Language switching routes
Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');
Route::get('/language/current', [LanguageController::class, 'getCurrentLanguage'])->name('language.current');

// Working maid routes (outside localized group to avoid conflicts)
Route::get('/en/maid/{id}', [MaidController::class, 'show'])->name('maid.profile.en')->where('id', '[0-9]+');
Route::get('/ar/maid/{id}', [MaidController::class, 'show'])->name('maid.profile.ar')->where('id', '[0-9]+');
Route::get('/en/maids', [MaidController::class, 'index'])->name('maids.all.en');
Route::get('/ar/maids', [MaidController::class, 'index'])->name('maids.all.ar');

// Localized routes: /ar/... and /en/...
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ar|en']], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
    Route::get('/maids/search', [App\Http\Controllers\MaidController::class, 'search'])->name('maids.search');
    Route::get('/maids/category/{category}', [App\Http\Controllers\MaidController::class, 'byCategory'])->name('maids.byCategory');
    Route::get('/maids/nationality/{nationality}', [App\Http\Controllers\MaidController::class, 'byNationality'])->name('maids.byNationality');
    Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/category/{slug}', [App\Http\Controllers\BlogController::class, 'category'])->name('blog.category');
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
    Route::get('/service', [App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
    Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about.index');
});

// Route for serving storage files
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    $mimeType = mime_content_type($filePath);
    $fileSize = filesize($filePath);
    
    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'Content-Length' => $fileSize,
    ]);
})->where('path', '.*');

// Sitemap route
Route::get('/sitemap.xml', function () {
    $sitemap = \App\Helpers\SeoHelper::generateSitemap();
    return response($sitemap, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

// These routes are now handled within the localized group above

// routes للخادمات (للمستخدمين العاديين)
// Route::resource('maids', MaidController::class); // تم التعليق لتجنب التضارب

// Auth routes (Public)
Route::get('/register', [PublicAuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [PublicAuthController::class, 'register'])->name('auth.register.store');
Route::get('/login', [PublicAuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [PublicAuthController::class, 'login'])->name('auth.login.store');
Route::post('/logout', [PublicAuthController::class, 'logout'])->name('auth.logout');

// User Profile routes
Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile')->middleware('auth');
Route::post('/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update')->middleware('auth');
Route::post('/profile/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password')->middleware('auth');

// User Reviews routes
Route::post('/reviews', [UserProfileController::class, 'storeReview'])->name('user.reviews.store')->middleware('auth');
Route::get('/reviews/{id}/edit', [UserProfileController::class, 'editReview'])->name('user.reviews.edit')->middleware('auth');
Route::put('/reviews/{id}', [UserProfileController::class, 'updateReview'])->name('user.reviews.update')->middleware('auth');
Route::delete('/reviews/{id}', [UserProfileController::class, 'deleteReview'])->name('user.reviews.delete')->middleware('auth');

// routes الشات
Route::get('/chat', [PublicChatController::class, 'start'])->name('chat.start');
Route::post('/chat/start', [PublicChatController::class, 'startChat'])->name('chat.startChat');
Route::post('/chat/send-message', [PublicChatController::class, 'sendMessage'])->name('chat.sendMessage');
Route::get('/chat/messages/{chatRoomId}', [PublicChatController::class, 'getMessages'])->name('chat.getMessages');
Route::get('/chat/{sessionId}', [PublicChatController::class, 'show'])->name('chat.show');
Route::get('/debug', function () { return view('debug'); })->name('debug');

// Auth routes (Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('doLogin')->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/test-login', function () { return view('admin.test-login'); })->name('testLogin');
    Route::get('/simple-login', function () { return view('admin.simple-login'); })->name('simpleLogin');
    Route::get('/quick-login', function () { return view('admin.quick-login'); })->name('quickLogin');
});

// routes لوحة الإدارة
Route::prefix('admin')->name('admin.')->middleware(['admin', 'activity.log'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/test', function () { return view('admin.test'); })->name('test');
    Route::get('/maids', [AdminController::class, 'maidsIndex'])->name('maids.index');
    Route::get('/maids/create', [AdminController::class, 'maidsCreate'])->name('maids.create');
    Route::post('/maids', [AdminController::class, 'maidsStore'])->name('maids.store');
    Route::get('/maids/{id}', [AdminController::class, 'maidsShow'])->name('maids.show');
    Route::get('/maids/{id}/edit', [AdminController::class, 'maidsEdit'])->name('maids.edit');
    Route::put('/maids/{id}', [AdminController::class, 'maidsUpdate'])->name('maids.update');
    Route::delete('/maids/{id}', [AdminController::class, 'maidsDestroy'])->name('maids.destroy');
    Route::resource('blog', AdminBlogController::class)->names(['index'=>'blog.index','create'=>'blog.create','store'=>'blog.store','show'=>'blog.show','edit'=>'blog.edit','update'=>'blog.update','destroy'=>'blog.destroy',]);
    Route::resource('categories', CategoryController::class)->names(['index'=>'categories.index','create'=>'categories.create','store'=>'categories.store','show'=>'categories.show','edit'=>'categories.edit','update'=>'categories.update','destroy'=>'categories.destroy',]);
    Route::resource('customer-reviews', CustomerReviewController::class)->names(['index'=>'customer-reviews.index','create'=>'customer-reviews.create','store'=>'customer-reviews.store','show'=>'customer-reviews.show','edit'=>'customer-reviews.edit','update'=>'customer-reviews.update','destroy'=>'customer-reviews.destroy',]);
    Route::resource('service-requests', ServiceRequestController::class)->names(['index'=>'service-requests.index','create'=>'service-requests.create','store'=>'service-requests.store','show'=>'service-requests.show','edit'=>'service-requests.edit','update'=>'service-requests.update','destroy'=>'service-requests.destroy',]);
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}/send-message', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
    Route::post('/chat/{id}/close', [ChatController::class, 'closeChat'])->name('chat.close');
    Route::post('/chat/{id}/reopen', [ChatController::class, 'reopenChat'])->name('chat.reopen');
    Route::delete('/chat/{id}', [ChatController::class, 'destroy'])->name('chat.destroy');
    Route::post('/chat/{id}/mark-read', [ChatController::class, 'markAsRead'])->name('chat.markRead');
    Route::get('/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('chat.unreadCount');
    Route::get('/chat/test', function () { return view('admin.chat.test'); })->name('chat.test');
    Route::get('/chat/simple', function () { return view('admin.chat.simple'); })->name('chat.simple');
    Route::resource('users', UserController::class)->names(['index'=>'users.index','create'=>'users.create','store'=>'users.store','show'=>'users.show','edit'=>'users.edit','update'=>'users.update','destroy'=>'users.destroy',]);
    Route::post('/users/{id}/status', [UserController::class, 'changeStatus'])->name('users.changeStatus');
    Route::get('/users/{id}/activities', [UserController::class, 'activities'])->name('users.activities');
    
    // SEO Management Routes
    Route::get('/seo/generate-sitemap', [\App\Http\Controllers\Admin\SeoController::class, 'generateSitemap'])->name('seo.generate-sitemap');
    Route::get('/seo/download-sitemap', [\App\Http\Controllers\Admin\SeoController::class, 'downloadSitemap'])->name('seo.download-sitemap');
    Route::get('/seo/preview/{pageType}/{locale?}', [\App\Http\Controllers\Admin\SeoController::class, 'preview'])->name('seo.preview');
    Route::resource('seo', \App\Http\Controllers\Admin\SeoController::class)->names(['index'=>'seo.index','create'=>'seo.create','store'=>'seo.store','show'=>'seo.show','edit'=>'seo.edit','update'=>'seo.update','destroy'=>'seo.destroy',]);
});
