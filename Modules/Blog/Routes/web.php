<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('blog')->group(function () {
    // Route::get('/', 'BlogController@index')->name('blog::index');
    // Route::get('/{category}', 'CategoryController@show')->name('blog::category');
    // Route::get('/{title}', 'PostsController@show')->name('blog::post');

    Route::resource('posts', PostsController::class)
        ->only([
            'show',
        ])
        ->names([
            'show' => 'blog::posts.show'
        ]);
});

/**
 * 
 * 
 ** Admin Routes
 * 
 * 
 */
Route::prefix('admin/blog')->middleware(['auth:sanctum', 'verified'])
->namespace('Admin')
->group(function () {
    Route::get('/', 'AdminBlogController@index')->name('blog::admin.index');
    
    Route::resource('posts', AdminPostController::class)
        ->names([
            'index' => 'blog::admin.posts.index',
            'show' => 'blog::admin.posts.show',
            'create' => 'blog::admin.posts.create',
            'edit' => 'blog::admin.posts.edit',
            'update' => 'blog::admin.posts.update',
            'store' => 'blog::admin.posts.store',
            'delete' => 'blog::admin.posts.delete'
        ]);
});
