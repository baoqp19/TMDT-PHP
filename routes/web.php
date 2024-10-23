<?php

use App\Http\Controllers\{
    HomeController,
    UserAuthController,
    OrderController,
    UserController,
    ContactController,
    NewsController,
    MusicController,
    CovidController,
    WeatherController,
    SearchController,
    MailController,
    CartController,
    CheckoutController,
    SocialLoginController,
    ChatController,
    DeviceController,
    RoleController,
    PostProductController,
    StaticController,
    SliderController,
    BrandController,
    CommentController,
    CouponController,
    DeliveryController,
    ProductController,
    ProvinceController
};
use Illuminate\Support\Facades\Route;

// Language Route
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'vi'])) abort(400);
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang');

// Authenticated Routes
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('order/print/{id}', [OrderController::class, 'print_order'])->name('order.print');
// });

// Blocked User Route
Route::get('blocked', [UserController::class, 'blocked'])->name('user.blocked');

// Visitor Middleware Grou
Route::group([
    'middleware' => ['block_user', 'visitor', 'user_online']
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::resource('contact', ContactController::class);
    Route::resource('news', NewsController::class);
    Route::resource('music', MusicController::class);
    Route::resource('covid', CovidController::class);
    Route::resource('weather', WeatherController::class);

    Route::any('search', [SearchController::class, 'search'])->name('search');
    Route::post('search-live', [SearchController::class, 'search_live'])->name('search.live');

    Route::get('product/{id}', [ProductController::class, 'detail'])->name('product.detail');


    Route::group([
        'prefix' => 'user',
        'as'     => 'user.',
    ], function () {
        Route::get('login', [UserAuthController::class, 'login'])->name('login');
        Route::post('handleSignin', [UserAuthController::class, 'handleSignin'])->name('handleSignin');
    });

    Route::group([
        'prefix' => 'user',
        'as'     => 'user.',
    ], function () {
        Route::get('register', [UserAuthController::class, 'register'])->name('register');
        Route::post('handleSignup', [UserAuthController::class, 'handleSignup'])->name('handleSignup');

        Route::get('/', [UserController::class, 'index'])->name('index');
    });

    Route::prefix('signin')->group(function () {
        //     Route::get('google', [SocialLoginController::class, 'redirect_to_google'])->name('social.google');
        //     Route::get('zalo', [SocialLoginController::class, 'redirect_to_zalo'])->name('social.zalo');
        //     Route::get('facebook', [SocialLoginController::class, 'redirect_to_facebook'])->name('social.facebook');
        //     Route::get('zalo-social', [SocialLoginController::class, 'handle_signin_zalo']);
        //     Route::get('google-social', [SocialLoginController::class, 'handle_signin_google']);
        //     Route::get('facebook-social', [SocialLoginController::class, 'handle_signin_facebook']);
    });

    Route::get('forgot-password', [UserController::class, 'forgot_password'])->name('user.forgot_password');
    // Route::get('new-password/{code}', [UserController::class, 'new_password'])->name('user.new_password');
    // Route::post('set-password', [UserController::class, 'set_password'])->name('user.set_password');
    // Route::post('send-mail-password', [MailController::class, 'handle_mail_reset_password'])->name('mail.reset_password');

    // Route::group(['middleware' => ['auth_user']], function () {
    //     Route::prefix('user')->group(function () {
    //         
    //         Route::post('update', [UserController::class, 'update'])->name('user.update');
    // });

    Route::get('signout', [UserAuthController::class, 'signout'])->name('user.signout');


    // SEND MESSAGE
    Route::prefix('comment')->name('comment.')->group(function () {
        Route::post('update', [CommentController::class, 'update'])->name('update');
        Route::post('store', [CommentController::class, 'store'])->name('store');
        Route::post('delete', [CommentController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'cart',
        'as'     => 'cart.',
    ], function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('delete', [CartController::class, 'delete'])->name('delete');
        Route::post('update', [CartController::class, 'update'])->name('update');
        Route::post('store', [CartController::class, 'store'])->name('store');
    });

    Route::group([
        'prefix' => 'checkout',
        'as'     => 'checkout.',
    ], function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('calc-feeship', [CheckoutController::class, 'calc_feeship'])->name('calc_feeship');
    });

    Route::group([
        'prefix' => 'order',
        'as'     => 'order.',
    ], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('detail/{id}', [OrderController::class, 'show'])->name('show');
        Route::get('delete/{id}', [OrderController::class, 'delete'])->name('delete');
        Route::post('order-confirm', [OrderController::class, 'confirm_order'])->name('confirm');
        Route::get('print-order/{id}', [OrderController::class, 'print_order'])->name('print');
    });

    Route::get('/get-villages', [ProvinceController::class, 'getVillages']);



    Route::get('payment_callback', [OrderController::class, 'payment_callback'])->name('payment.callback');

    Route::post('use-coupon', [CouponController::class, 'use_coupon'])->name('coupon.use_coupon');
    Route::post('select-delivery', [DeliveryController::class, 'select_delivery']);

    Route::prefix('chat')->group(function () {
        Route::post('get', [ChatController::class, 'get_user_chat']);
        Route::post('send', [ChatController::class, 'send_user_chat']);
    });
});

// Print Route
// Route::prefix('print')->group(function () {
//     Route::get('order/{code}', [OrderController::class, 'print_order_new']); //middleware admin
// });

// // Admin Routes
// Route::get('admin/signin', [AdminAuthController::class, 'signin'])->name('admin.signin');
// Route::post('admin/signin', [AdminAuthController::class, 'handle_signin'])->name('admin.handle_signin');

// Route::group(['prefix' => 'admin',  'middleware' => ['auth:admin', 'auth_admin']], function () {
//     Route::get('/', [AdminController::class, 'index'])->name('admin.index');
//     Route::get('signout', [AdminAuthController::class, 'signout'])->name('admin.signout');

//     Route::post('send-coupon', [MailController::class, 'send_coupon']);

//     // Role Management
//     Route::middleware('can:' . config('role.ROLE'))->group(function () {
//         Route::resource('role', RoleController::class);
//     });

//     // Post Management
//     Route::middleware('can:' . config('role.POST'))->group(function () {
//         Route::resource('post', PostProductController::class);
//     });

//     // Statistic Management
//     Route::middleware('can:' . config('role.STATISTIC'))->group(function () {
//         Route::get('static', [StaticController::class, 'index'])->name('static.index');
//     });

//     // Slider Management
//     Route::middleware('can:' . config('role.SLIDER'))->group(function () {
//         Route::resource('slider', SliderController::class);
//     });

//     // Information Management
//     Route::middleware('can:' . config('role.INFO'))->group(function () {
//         Route::get('device', [DeviceController::class, 'admin_device'])->name('device.admin');
//         Route::resource('visitor', VisitorController::class);
//     });

//     // Admin Management
//     Route::middleware('can:' . config('role.ADMIN'))->group(function () {
//         Route::get('list', [AdminController::class, 'list'])->name('admin.list');
//         Route::get('add', [AdminController::class, 'add'])->name('admin.add');
//         Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
//         Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
//         Route::post('store', [AdminController::class, 'store'])->name('admin.store');
//         Route::get('delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
//     });

//     // Brand Management
//     Route::middleware('can:' . config('role.BRAND'))->group(function () {
//         Route::post('brand/sort', [BrandController::class, 'sort']);
//         Route::resource('brand', BrandController::class);
//     });

//     // Coupon Management
//     Route::middleware('can:' . config('role.COUPON'))->group(function () {
//         Route::post('coupon/send', [CouponController::class, 'send']);
//         Route::resource('coupon', CouponController::class);
//     });

//     // Comment Management
Route::middleware('can:' . config('role.COMMENT'))->group(function () {
    Route::prefix('comment')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('comment.index');
        Route::get('not-confirm', [CommentController::class, 'get_not_confirm'])->name('comment.not_confirm');
        Route::get('confirm/{id}', [CommentController::class, 'set_confirm'])->name('comment.confirm');
        Route::post('delete', [CommentController::class, 'delete'])->name('comment.delete');
    });
});

//     // Order Management
//     Route::middleware('can:' . config('role.ORDER'))->group(function () {
//         Route::prefix('order')->group(function () {
//             Route::get('/', [OrderController::class, 'manage'])->name('order.manage');
//             Route::get('/{id}', [OrderController::class, 'admin_detail'])->name('order.admin_detail');
//             Route::get('print-order/{id}', [OrderController::class, 'print_order'])->name('order.admin_print');
//             Route::get('order-delete/{id}', [OrderController::class, 'admin_delete'])->name('order.admin_delete');
//             Route::get('order-delivery/{id}', [OrderController::class, 'delivery'])->name('order.delivery');
//         });
//     });

//     // Delivery Management
//     Route::middleware('can:' . config('role.FEESHIP'))->group(function () {
//         Route::prefix('delivery')->group(function () {
//             Route::post('select', [DeliveryController::class, 'select_delivery'])->name('delivery.select');
//             Route::get('/', [DeliveryController::class, 'index'])->name('delivery.index');
//             Route::post('store', [DeliveryController::class, 'store'])->name('delivery.store');
//             Route::post('show', [DeliveryController::class, 'show'])->name('delivery.show');
//             Route::post('delete', [DeliveryController::class, 'delete'])->name('delivery.delete');
//         });
//     });

//     // Product Management
//     Route::middleware('can:' . config('role.PRODUCT'))->group(function () {
//         Route::prefix('product')->group(function () {
//             Route::get('reference', [ProductController::class, 'reference'])->name('product.reference');
//             Route::get('gallery/{id}', [ProductController::class, 'product_gallery'])->name('product.gallery');
//             Route::get('delete-gallery/{id}', [ProductController::class, 'delete_gallery'])->name('product.gallery.delete');
//             Route::post('gallery-store/{id}', [ProductController::class, 'product_gallery_store'])->name('product.gallery.store');
//             Route::post('get-product-crawl', [ProductController::class, 'get_product_crawl'])->name('product.get_product_crawl');
//             Route::post('add-product-crawl', [ProductController::class, 'add_product_crawl'])->name('product.add_product_crawl');
//         });
//         Route::resource('product', ProductController::class);
//     });

//     // User Management
//     Route::middleware('can:' . config('role.USER'))->group(function () {
//         Route::prefix('user')->group(function () {
//             Route::get('/', [UserController::class, 'all_user'])->name('user.list');
//             Route::get('more/{id}', [UserController::class, 'more_feature'])->name('user.more');
//             Route::post('unblock', [UserController::class, 'unblock'])->name('user.unblock');
//             Route::post('block', [UserController::class, 'block'])->name('user.block');
//             Route::post('delete', [UserController::class, 'delete'])->name('user.delete');
//             Route::match(['get', 'post'], 'online', [UserController::class, 'online_user'])->name('user.online');
//         });
        
//         Route::get('device/{id}', [DeviceController::class, 'user_device'])->name('device.user');

//         Route::prefix('chat')->group(function () {
//             Route::post('get', [ChatController::class, 'get_admin_chat']);
//             Route::post('send', [ChatController::class, 'send_admin_chat']);
//         });
//     });
// });
