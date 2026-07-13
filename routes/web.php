<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])->name('home');

Route::get('/watches', [MainController::class, 'watches'])->name('watches');

Route::get('/perfumes', [MainController::class, 'perfumes'])->name('perfumes');

Route::get('/product/{productid}', [MainController::class, 'product'])->name('product');

Route::get('/cart', [MainController::class, 'cart'])->name('cart');

Route::post('/cartadd/{productid}',[MainController::class,'addToCart'])->name('addtocart');

Route::post('/buynow/{product}',[CheckoutController::class,'buyNow'])->name('buynow');

Route::patch('/cartupdate/{id}', [MainController::class, 'updateCart'])->name('cartupdate');

Route::delete('/cartdelete/{id}', [MainController::class, 'deleteCartItem'])->name('cartdelete');

Route::get('/checkout', [CheckoutController::class,'checkout'])->name('checkout');

Route::post('/placeorder', [CheckoutController::class,'placeOrder'])->name('placeorder');

Route::get('/paymob', [PaymentController::class, 'pay'])->name('paymob.pay');

Route::post('/paymob/webhook', [PaymentController::class, 'webhook'])->name('paymob.webhook');

Route::get('/paymob/return', [PaymentController::class, 'returnFromPaymob'])->name('paymob.return');


Route::get('/privacy-policy', function () {
    return view('privacypolicy');
})->name('privacypolicy');

Route::get('/terms-of-service', function () {
    return view('termsofservice');
})->name('terms');

Route::view('/paymentsuccess','ordersuccess')
        ->name('paymentsuccess');

Route::view('/paymentfailed','orderfailed')
        ->name('paymentfailed');

Route::view('/about','about')->name('about');


Route::get('/paymob/success', [PaymentController::class, 'success'])->name('order.success');
Route::get('/paymob/failed', [PaymentController::class, 'failed'])->name('order.failed');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admindashboard');

Route::get('/admin/chart-data', [AdminController::class, 'chartData']);

Route::get('/adminsettings', [AdminController::class, 'adminSettings'])->name('adminsettings');

Route::post('/admingeneralsettings', [AdminController::class, 'generalSettings'])->name('admingeneralsettings');

Route::post('/adminpaymentsettings', [AdminController::class, 'paymentSettings'])->name('adminpaymentsettings');

Route::post('/adminshippingsettings', [AdminController::class, 'shippingSettings'])->name('adminshippingsettings');

Route::post('/adminemailsettings', [AdminController::class, 'emailSettings'])->name('adminemailsettings');

Route::post('/adminaccountsettings', [AdminController::class, 'accountSettings'])->name('adminaccountsettings');

Route::post('/adminseosettings', [AdminController::class, 'seoSettings'])->name('adminseosettings');

Route::get('/adminusers', [AdminController::class, 'adminUsers'])->name('adminusers')->middleware('useractivity');

Route::get('/adminuserprofile/{id}', [AdminController::class, 'adminUserProfile'])->name('adminuserprofile')->middleware('useractivity');

Route::get('/admin/orders', [AdminController::class,'adminOrders'])->name('adminorders');

Route::get('/admin/order/{id}', [AdminController::class,'adminOrderDetails'])->name('adminorderdetails');

Route::post('/admin/order/{id}/status', [AdminController::class,'changeOrderStatus'])->name('adminchangeorderstatus');

Route::get('/admin/order/delete/{id}', [AdminController::class,'deleteOrder'])->name('admindeleteorder');

Route::get('/adminwatches', [AdminController::class, 'adminWatches'])->name('adminwatches');

Route::get('/adminperfumes', [AdminController::class, 'adminPerfumes'])->name('adminperfumes');

Route::get('/adminsubcategories', [AdminController::class, 'adminSubcategories'])->name('adminsubcategories');

Route::get('/adminaddsubcategories', [AdminController::class, 'addSubcategory'])->name('adminaddsubcategory');

Route::post('/adminstoresubcategory', [AdminController::class, 'storeSubcategory'])->name('adminstoresubcategory');

Route::get('/admineditsubcategory/{id}', [AdminController::class, 'editSubcategory'])->name('admineditsubcategory');
Route::post('/adminupdatesubcategory/{id}', [AdminController::class, 'updateSubcategory'])->name('adminupdatesubcategory');
Route::get('/admindeletesubcategory/{id}', [AdminController::class, 'deleteSubcategory'])->name('admindeletesubcategory');

Route::get('/admin/get-subcategories/{categoryId}', [AdminController::class, 'getSubcategoriesByCategory'])->name('admin.getSubcategories');


Route::post('/adminstoreitemImage', [AdminController::class ,'storeItemImage'])->name('adminstoreitemImage');

Route::get('/admindeleteItemPhoto/{id}', [AdminController::class ,'deleteItemPhoto'])->name('deleteitemphoto');

Route::get('/adminaddwatch', [AdminController::class,'addWatch'])->name('adminaddwatch');

Route::get('/adminaddperfume', [AdminController::class,'addPerfume'])->name('adminaddperfume');

Route::get('/adminaddimages/{itemid}', [AdminController::class, 'addImages'])->name('adminaddimages');

Route::get('/adminedititem/{itemid}', [AdminController::class ,'editItem'])->name('adminedititem');

Route::get('/admindeleteitem/{itemid}', [AdminController::class ,'deleteItem'])->name('admindeleteitem');

Route::post('/adminstoreitem', [AdminController::class,'storeItem'])->name('adminstoreitem');

Route::post('/adminstorecategory', [AdminController::class,'storeCategory'])->name('adminstorecategory');



Route::get('/adminaddcategory', [AdminController::class,'addCategory'])->name('adminaddcategory');

Route::get('/admindeletecategory/{categoryid}', [AdminController::class, 'deleteCategory'])->name('admindeletecategory');

Route::get('/admineditcategory/{categoryid}', [AdminController::class, 'editCategory'])->name('admineditcategory');

Route::get('/adminreviews', [AdminController::class, 'reviews'])->name('adminreviews');

Route::get('/adminshowreviews/{productid}', [AdminController::class, 'showReviews'])->name('adminshowreviews');
});

require __DIR__.'/auth.php';
