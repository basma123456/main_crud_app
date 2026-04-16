<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RolePermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//Route::view('/', 'welcome')->name('home');

//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::view('dashboard', 'dashboard')->name('dashboard');


//});

Route::get('test', function () {
    return view('admin/pages/list');
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth', 'verified' ]
    ], function(){ //...

    Route::get('module/{title}', [ModuleController::class, 'show'])->name('module.show');
    Route::get('module/{title}/{status}', [ModuleController::class, 'showByActiveOrDeactive'])->name('module.show.param');


    Route::get('posts_gallery/{module}/{post}', [GalleryController::class, 'index'])->name('posts.gallery');
    Route::get('posts_add_to_gallery/{module}/{post}', [GalleryController::class, 'create'])->name('posts.gallery_add');
    Route::get('delete-image/{gallery}', [GalleryController::class, 'delete'])->name('delete_image.gallery');

//Route::post('/upload' , function (Request $request){
//    $filesData = [];
//
//    if ($request->hasFile('images')) {
//        foreach ($request->file('images') as $file) {
//            $filesData[] = [
//                'name' => $file->getClientOriginalName(),
//                'size' => $file->getSize(),
//                'type' => $file->getMimeType(),
//            ];
//        }
//        dd($request->file('images'));
//    }
//
//    return response()->json($filesData);});


    Route::post('/upload/gallery', [GalleryController::class, 'storeImages']);
    Route::get('posts_edit/{module}/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('posts/show/{module}/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::put('posts_update/{module}/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('posts_add/{module}', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts_store/{module}', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts_order/{module}/{direction}/{post}', [PostController::class, 'changePostOrder'])->name('posts.order');
    Route::get('posts_first_order/{post}', [PostController::class, 'changePostOrderToLastFirst'])->name('post_first_order.post');
    Route::get('delete_post/{post}', [PostController::class, 'delete'])->name('delete_post.post');
    Route::delete('delete/selected/{module_title}', [PostController::class, 'deleteAlSelected'])->name('delete.selected');
    Route::get('change_status/{post}', [PostController::class, 'changeStatus'])->name('change_status.post');

    /******************categories**********/
    Route::get('categories/{module}', [CategoryController::class, 'add'])->name('cats.add');
    Route::get('categories/edit/{module}/{category}', [CategoryController::class, 'edit'])->name('cats.edit');
    Route::post('categories/{module}', [CategoryController::class, 'store'])->name('cats.store');
    Route::put('categories/update/{module}/{category}', [CategoryController::class, 'update'])->name('cats.update');


    /**************roles permissions*********/
        Route::get('roles-permissions', [RolePermissionController::class, 'index'])->name('roles_permissions_index');
    /*****************roles permissions*************/
});
