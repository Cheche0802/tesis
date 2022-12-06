<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPostsController;
use App\Http\Controllers\Admin\PhotosController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PublishedController;

use App\Http\Controllers\TagsController;
//use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [PagesController::class, 'home'])->name('pages.home');

Route::get('nosotros', [PagesController::class, 'about'])->name('pages.about');
Route::get('archivo', [PagesController::class,'archive'])->name('pages.archive');
Route::get('contacto', [PagesController::class,'contact'])->name('pages.contact');

Route::get('blog/{post}', [PublishedController::class,'show'])->name('posts.show');
Route::get('categorias/{category}', [CategoriesController::class,'show'])->name('categories.show');
Route::get('tags/{tag}', [TagsController::class, 'show'])->name('tags.show');

Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => 'auth'],
function(){
	Route::get('/', [AdminController::class,'index'])->name('dashboard');

	Route::resource('posts', 'App\Http\Controllers\Admin\AdminPostsController', ['except' => 'show']);
	/* Route::resource('posts', AdminPostsController::class)->except('show'); */
    // Route::resource('users', 'UsersController', ['as' => 'admin']);
    Route::resource('users', UsersController::class, [
        'as' => 'admin'
    ]);
    // Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('roles', RolesController::class, [
        'except' => 'show',
        'as' => 'admin'
    ]);
    // Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);
    Route::resource('permissions', PermissionsController::class, [
        'only' => ['index', 'edit', 'update'],
        'as' => 'admin'
    ]);

    Route::middleware('role:Admin')
    	->put('users/{user}/roles', 'UsersRolesController@update')
    	->name('admin.users.roles.update');

    Route::middleware('role:Admin')
        ->put('users/{user}/permissions', 'UsersPermissionsController@update')
        ->name('admin.users.permissions.update');

	// Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
	Route::post('posts/{post}/photos', [PhotosController::class, 'store'])->name('admin.posts.photos.store');
	// Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
	Route::delete('photos/{photo}', [PhotosController::class, 'destroy'])->name('admin.photos.destroy');

	// rutas de administracion
});

// Authentication Routes...
/* Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); */
Route::get('login', [LoginController::class , 'showLoginForm '])->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

/* // Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset'); */

/* Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

require __DIR__.'/auth.php';
