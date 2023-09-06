<?php

use App\Http\Controllers\CustomerConfirmablePasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerNewPasswordController;
use App\Http\Controllers\CustomerPasswordController;
use App\Http\Controllers\CustomerPasswordResetLinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MediaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/services/{service_id}', [SiteController::class, 'singleService'])->name('services.single');
Route::get('/products', [SiteController::class, 'products'])->name('products');
Route::get('/products/{product_id}', [SiteController::class, 'product'])->name('product');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/design_requests', [SiteController::class, 'saveDesignRequest'])->name('design_requests.store');
Route::post('/store_media', [MediaController::class, 'savePublicMedia'])->name('media.store.public');
Route::get('/design-request', [SiteController::class, 'designRequest'])->name('design_request');
Route::get('/track-design-request', [SiteController::class, 'trackDesignRequest'])->name('design_request.track');
Route::get('/cart', [SiteController::class, 'cart'])->name('cart');
Route::get('/projects', [SiteController::class, 'projects'])->name('projects');
Route::get('/projects/{project_id}', [SiteController::class, 'singleProject'])->name('projects.single');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/checkout', [SiteController::class, 'checkout'])->name('checkout');
Route::post('save-order',[OrderController::class,'saveOrders']);
Route::get('/order_response/{order_id}', [OrderController::class, 'order_response'])->name('order_response');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//customer auth
Route::prefix('customer')->group(function () {
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [CustomerLoginController::class, 'showCustomerLoginForm'])->name('customers.login-view');
        Route::Post('/login', [CustomerLoginController::class, 'customerLogin'])->name('customers.login');
        Route::get('/register', [CustomerLoginController::class, 'showCustomerRegisterForm'])->name('customers.register-view');
        Route::Post('/register', [CustomerLoginController::class, 'store'])->name('customers.register');
        Route::get('/forgot-password', [CustomerPasswordResetLinkController::class, 'create'])
            ->name('customers.password.request');

        Route::post('/forgot-password', [CustomerPasswordResetLinkController::class, 'store'])
            ->name('customers.password.email');

        Route::get('/reset-password/{token}', [CustomerNewPasswordController::class, 'create'])
            ->name('customers.password.reset');

        Route::post('/reset-password', [CustomerNewPasswordController::class, 'store'])
            ->name('customers.password.store');
    });
    Route::middleware('auth.customer')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'index'])->name('customers.dashboard');
        Route::get('confirm-password', [CustomerConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [CustomerConfirmablePasswordController::class, 'store']);

        Route::put('password', [CustomerPasswordController::class, 'update'])->name('customers.password.update');

        Route::post('logout', [CustomerLoginController::class, 'logout'])->name('customers.logout');
    });
});
//customer auth
//payment

Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');

Route::get('payment_complete',[App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);
//payment end
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'saveSettings'])->name('admin.saveSettings');
    //products
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::post('/products', [AdminController::class, 'saveProducts'])->name('admin.saveProducts');
    Route::get('/product_categories', [AdminController::class, 'productCategories'])->name('admin.product_categories');
    Route::post('/product_categories', [AdminController::class, 'saveProductCategories'])->name('admin.saveProductCategories');
    Route::get('/tag_search', [AdminController::class, 'tagSearch']);
    Route::post('/store_media', [MediaController::class, 'saveMedia'])->name('media.store');
    Route::get('/edit_product/{product_id}', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/update_products', [AdminController::class, 'updateProducts'])->name('admin.updateProducts');
    Route::get('/delete_product/{product_id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    //projects
    Route::get('/project_categories', [AdminController::class, 'projectCategories'])->name('admin.project_categories');
    Route::post('/project_categories', [AdminController::class, 'saveProjectCategories'])->name('admin.saveProjectCategories');
    Route::post('/projects', [AdminController::class, 'saveProjects'])->name('admin.saveProjects');
    Route::get('/delete_project/{project_id}', [AdminController::class, 'deleteProject'])->name('admin.projects.delete');
    Route::get('/edit_project/{project_id}', [AdminController::class, 'editProject'])->name('admin.projects.edit');
    Route::post('/update_projects', [AdminController::class, 'updateProjects'])->name('admin.updateProjects');
    Route::get('/projects', [AdminController::class, 'projects'])->name('admin.projects');
    //services
    Route::post('/services', [AdminController::class, 'saveServices'])->name('admin.saveServices');
    Route::get('/delete_service/{service_id}', [AdminController::class, 'deleteService'])->name('admin.services.delete');
    Route::get('/edit_service/{service_id}', [AdminController::class, 'editService'])->name('admin.services.edit');
    Route::post('/update_services', [AdminController::class, 'updateServices'])->name('admin.updateServices');
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
    //clients
    Route::post('/clients', [AdminController::class, 'saveClients'])->name('admin.saveClients');
    Route::get('/delete_client/{client_id}', [AdminController::class, 'deleteClient'])->name('admin.clients.delete');
    Route::get('/edit_client/{client_id}', [AdminController::class, 'editClient'])->name('admin.clients.edit');
    Route::post('/update_clients', [AdminController::class, 'updateClients'])->name('admin.updateClients');
    Route::get('/clients', [AdminController::class, 'clients'])->name('admin.clients');
    //design request
    Route::get('/design_requests/{design_request_id}', [AdminController::class, 'viewDesignRequest'])->name('design_requests.single');
    Route::get('/design_requests', [AdminController::class, 'designRequests'])->name('admin.design_requests');
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::post('/design_requests', [AdminController::class, 'saveDesignRequests'])->name('admin.design_requests.store');
    //team members
    Route::post('/team_members', [AdminController::class, 'saveTeamMembers'])->name('admin.saveTeamMembers');
    Route::get('/delete_team_member/{team_member_id}', [AdminController::class, 'deleteTeamMember'])->name('admin.team_members.delete');
    Route::get('/edit_team_member/{team_member_id}', [AdminController::class, 'editTeamMember'])->name('admin.team_members.edit');
    Route::post('/update_team_members', [AdminController::class, 'updateTeamMembers'])->name('admin.updateTeamMembers');
    Route::get('/team_members', [AdminController::class, 'team_members'])->name('admin.team_members');
//orders
    Route::get('/orders', [OrderController::class, 'orders'])->name('admin.orders');
    Route::get('/order_details/{order_id}', [OrderController::class, 'order_details'])->name('admin.order_details');
});
require __DIR__.'/auth.php';
