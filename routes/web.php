<?php

use Illuminate\Support\Facades\Route;
use App\DataTables\CommentDataTable;
use App\Models\Comment;
use App\Models\Post;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');
Route::put('/post/comment',[App\Http\Controllers\CommentController::class,'store'])->name('post.comment');


// Route::get('/employee',[App\Http\Controllers\EmployeeController::class,'index']);

Route::get('/users',[App\Http\Controllers\CommentController::class,'show_datatables'])->name('users');

// Route::get('users', function() {
//     $model = App\Models\Comment::with('post');

//     return DataTables::eloquent($model)
//                 ->addColumn('post', function (Comment $comment) {
//                     return $comment->post->title;
//                 })
//                 ->toJson();
// });

Route::middleware('auth')->group(function(){
   
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/admin/post/index',[App\Http\Controllers\PostController::class,'index'])->name('post.index');
    // Route::delete('/admin/post/{post}/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');
    Route::put('/admin/users/{user}/update',[App\Http\Controllers\UserController::class,'update'])->name('user.profile.update');
    Route::patch('/admin/post/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::delete('/admin/users/{user}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    Route::put('/admin/user/{user}/attach',[App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/admin/user/{user}/detach',[App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');
    
    Route::get('/roles',[App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles',[App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{role}/delete',[App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');
    Route::get('/roles/{role}/edit',[App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');    
    Route::put('/roles/{role}/update',[App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');    
    
    Route::put('/admin/roles/{roles}/attach',[App\Http\Controllers\RoleController::class, 'permission_attach'])->name('role.permission.attach');
    Route::put('/admin/roles/{roles}/detach',[App\Http\Controllers\RoleController::class, 'permission_detach'])->name('role.permission.detach');

    
    Route::get('/permission',[App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permission',[App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permission/{permission}/edit',[App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('/permission/{permission}/delete',[App\Http\Controllers\PermissionController::class, 'delete'])->name('permissions.delete');
    Route::put('/permission/{permission}/update',[App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');








    Route::get('/admin/comment',[App\Http\Controllers\CommentController::class, 'index'])->name('admin.comments.index');
    Route::get('/admin/comment/{id}',[App\Http\Controllers\CommentController::class, 'show'])->name('admin.comments.show');
    Route::put('/admin/comment/{comment}/update',[App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
    Route::delete('/admin/comment/{comment}/delete',[App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.delete');

    Route::get('/admin/reply',[App\Http\Controllers\ReplyController::class, 'index'])->name('reply.index');






});

Route::delete('/admin/post/{post}/delete', [App\Http\Controllers\PostController::class, 'delete'])->middleware('can:view,post')->name('post.delete');

Route::middleware('role:admin','auth')->group(function(){
      
        Route::get('/admin/post/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');
        Route::get('admin/users',[App\Http\Controllers\UserController::class,'index'])->name('users.index');

});

Route::middleware('auth','can:view,user')->group(function(){

    Route::get('/admin/users/{user}/profile',[App\Http\Controllers\UserController::class,'show'])->name('user.profile.show');

});