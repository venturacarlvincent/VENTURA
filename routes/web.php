<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Response;


Route::get('/', function (Request $request) {
    // greet the user with a name passed via query string (e.g. /?name=Alice)
    $name = $request->input('name', 'Guest');
    return view('welcome', compact('name'));
    #return "Hello World";
});


Route::get('/show-users', [UserController::class, 'show']);


//Service Container
Route::get('/test-container', function (Request $request) {
    $input = $request->input('key');
    return $input;
});


//Service Provider
Route::get('/test-provider', function (UserService $userService) {
    return $userService->listUsers();
});


Route::get('/test-users', [UserController::class, 'index']);


//Facades
Route::get('/test-facade', function (UserService $userService) {
    return Response::json($userService->listUsers());
});

//exercise 3

//routing -> parameters
route::get('/post/{post}/comment/{comment}', function (string $postId, string $comment) {
    return "Post ID: " . $postId . " - Comment: ". $comment;
});

route::get('/post/{id}', function (string $id) {
    return $id;
})-> where('id', '[0-9]+');

route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*');

//named route or route alias
route::get('/test/route/sample', function () {
    return route('test-route');
})->name('test-route');

//route -> middleware group
route::middleware(['user-middleware'])->group(function () {
    route::get('route-middleware-group/first', function (request $request) {
        echo 'first';
    });
    route::get('route-middleware-group/second', function (request $request) {
        echo 'second';
    });
});

//route -> Controller Group
route::controller(UserController::class)->group(function () {
    route::get('/users', 'index');
    route::get('/users/first', 'first');
    route::get('/users/{id}', 'get');
});

//csrf
route::get('/token', function (request $request) {
    return view('token');
});

route::post('/token', function (Request $request) { 
    return $request->all(); 
});

//middleware
route::get('/users', [UserController::class, 'index'])->middleware('user-middleware');

//resourse
route::resource('products', ProductController::class);

//view with data
route::get('/product-list', function (ProductService $productService) {
    $data['products'] = $productService->listProducts();
    return view('product-list', $data);
});