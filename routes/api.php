<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\TokenMiddleware;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(LoginController::class)
    ->group(function () {
        Route::get('/logout',  'logout');
        Route::post('/login',  'login');
        Route::post('/change-password', 'changePassword');
        Route::post('/reset-password', 'resetPassword');
        Route::post('/refresh-token', 'refresh');
    });


Route::middleware(TokenMiddleware::class)->group(function () {

    Route::resource('users' , UserController::class);
    Route::resource('roles' , RoleController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('industries', IndustryController::class);
    Route::resource('organizations', OrganizationController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::resource('permissions', PermissionController::class);
    Route::resource('categories', CategoryController::class);



    Route::get('all-roles' ,[ RoleController::class , 'allRoles']);
    Route::get('all-permissions' ,[ PermissionController::class , 'allPermissions']);
    Route::get('all-plans' ,[ PlanController::class , 'allPlans']);
    Route::get('all-industries' ,[ IndustryController::class , 'allIndustries']);

});

Route::get('/shop' , function(){
    // sleep(3);
    $products = Product::with('attributes' , 'galleries' , 'category' , 'organization')-> paginate();
     $products->data = $products->makeHidden('cost');
     return $products;
});


Route::any('/{any?}', function () {
    sleep(500);
    return [
        'products' => [],
        'topProducts' => [],
        'blogs' => [],
        'blogs' => [],
    ];
})->where('any', '.*');

