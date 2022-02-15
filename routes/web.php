<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'show_home']);
Route::get('/category/{categoryId}', [UserController::class, 'show_home']);
Route::get('/profile', [UserController::class, 'show_profile']);
Route::get('/tenders/{tenderId}', [TenderController::class, 'account_show_tender']);

/*==User Login / Registration===*/
Route::post('/user-actions/login', [UserController::class, 'user_login']);
Route::get('/user-actions/logout', [UserController::class, 'user_logout']);
Route::post('/user-actions/register', [UserController::class, 'user_registration']);
Route::post('/user-actions/profile/update', [UserController::class, 'user_update_profile']);
Route::post('/user-actions/profile/change-password', [UserController::class, 'user_change_password']);

Route::get('/login', function () {
    return view('login.login');
})->middleware('user.session.validate');

Route::get('/register', function () {
    return view('registration.register');
})->middleware('user.session.validate');

/*=== Account   ===*/

Route::prefix('account')->group(function () {
    Route::get('/', [AccountController::class, 'account_show_dashboard']);
    Route::prefix('tender')->group(function () {
        Route::get('/new', [TenderController::class, 'account_show_create_tender'])->middleware('user.permission.validate:1001');
        Route::prefix('categorries')->group(function () {
            Route::get('/', [TenderController::class, 'account_show_categorries'])->middleware('user.permission.validate:1000');
            Route::get('/new', [TenderController::class, 'account_show_create_category'])->middleware('user.permission.validate:1000');
            Route::get('/edit/{categoryId}', [TenderController::class, 'account_show_edit_category'])->middleware('user.permission.validate:1000');
        });
        Route::prefix('drafts')->group(function () {
            Route::get('/', [TenderController::class, 'account_show_draft_tenders'])->middleware('user.permission.validate:1001');
            Route::get('/edit/{tenderId}', [TenderController::class, 'account_show_edit_draft_tenders'])->middleware('user.permission.validate:1001');
        });
        Route::get('/bids', [TenderController::class, 'account_show_Offer_avilable_tenders'])->middleware('user.permission.validate:1001');
        Route::get('/bids/{tenderId}', [OfferController::class, 'account_show_tender_offers'])->middleware('user.permission.validate:1001');
    });
    Route::prefix('user-management')->group(function () {
        Route::get('/', [UserController::class, 'show_UserManagement'])->middleware('user.permission.validate:1004');
        Route::get('/change-status/{userID}', [UserController::class, 'user_active_deactive'])->middleware('user.permission.validate:1004');

    });

    Route::prefix('my-account')->group(function () {
        Route::get('/bids', [OfferController::class, 'account_show_all_my_offers'])->middleware('user.permission.validate:2000');
        Route::get('/approved-bids', [OfferController::class, 'account_show_all_my_approved_offers'])->middleware('user.permission.validate:2001');
    });

});

/*==Tender create/update/List===*/
Route::post('/tender-actions/create', [TenderController::class, 'createTender']);
Route::post('/tender-actions/update', [TenderController::class, 'updateTender']);
Route::post('/tender-actions/category/create', [TenderController::class, 'createTenderCategory']);
Route::get('/tender-actions/category/delete/{id}', [TenderController::class, 'deleteTenderCategory']);
Route::post('/tender-actions/category/update', [TenderController::class, 'updateTenderCategory']);

/*===Offer ==*/

Route::prefix('offer')->group(function () {
    Route::get('/create/{tenderId}', [OfferController::class, 'show_offer_create']);
    Route::get('/{OfferId}', [OfferController::class, 'show_offer']);
});

//Offer actions
Route::post('/offer-actions/create', [OfferController::class, 'createOffer'])->middleware('user.permission.validate:2001');
Route::post('/offer-actions/update-state', [OfferController::class, 'updateOfferStatus'])->middleware('user.permission.validate:1001');
