<?php

use App\Http\Controllers\admin\authController;
use App\Http\Controllers\admin\busController;
use App\Http\Controllers\admin\customerController;
use App\Http\Controllers\admin\filterAdminController;
use App\Http\Controllers\admin\routeController;
use App\Http\Controllers\admin\statisticController;
use App\Http\Controllers\admin\tripController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\admin\ticketController;
use App\Models\routeModel;
use App\Models\tripModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\scheduleController;
use App\Http\Controllers\client\userClientController;
use App\Http\Controllers\client\ticketClientController;
use App\Http\Controllers\client\historyClientController;
use App\Http\Controllers\client\homeClientController;
use App\Http\Controllers\client\momo\momoController;
use App\Http\Controllers\client\paypal\paypalController;

use App\Models\busModel;

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

Auth::routes();
// Route::get('admin/login', [authController::class, 'show'])->name('login');
// Route::post('admin/login', [authController::class, 'store']);
// Route::get('admin/logout', [authController::class, 'logout']);
// Route::prefix('/admin')->middleware(['auth', 'CheckLogin'])->name('admin.')->group(function () {

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('login', [authController::class, 'show'])->name('login');
        Route::post('login', [authController::class, 'store']);
    });
    Route::middleware(['auth:admin'])->get('logout', [authController::class, 'logout'])->name('logout');
    Route::middleware(['auth:admin'])->get('/', function () {
        return view('admin.home');
        // Route::get('/user', [userController::class, 'showUser']);
    })->name('index');
    Route::prefix('user')->middleware(['auth:admin'])->group(function () {
        Route::get('/', [userController::class, 'showUser']);
        Route::get('/addUser', [userController::class, 'showFormAddUser']);
        // ajax
        Route::post('/addUser', [userController::class, 'addUser']);
        // endajax
        Route::get('/editUser/{id}', [userController::class, 'showFormEdit']);
        Route::post('/editUser/{id}', [userController::class, 'editUser']);
        Route::get('/deleteUser/{id}', [userController::class, 'deleteUser']);
        Route::get('/operateUser/{id}', [userController::class, 'operateUser']);

        Route::post('/add', [userController::class, 'add']);
    });
    Route::prefix('route')->middleware(['auth:admin'])->group(function () {
        Route::get('/', [routeController::class, 'showRoute']);
        Route::get('/addRoute', [routeController::class, 'showFormAddRoute']);
        Route::post('/addRoute', [routeController::class, 'addRoute']);
        Route::get('/editRoute/{id}', [routeController::class, 'showFormEdit']);
        Route::post('/editRoute/{id}', [routeController::class, 'editRoute']);
        Route::get('/deleteRoute/{id}', [routeController::class, 'deleteRoute']);
    });
    Route::prefix('bus')->middleware(['auth:admin'])->group(function () {
        Route::get('/', [busController::class, 'showBus']);
        Route::get('/addBus', [busController::class, 'showFormAddBus']);
        Route::post('/addBus', [busController::class, 'addBus']);
        Route::get('/editBus/{id}', [busController::class, 'showFormEdit']);
        Route::post('/editBus/{id}', [busController::class, 'editBus']);
        Route::get('/deleteBus/{id}', [busController::class, 'deleteBus']);
        Route::get('/chairBus/{id}', [busController::class, 'chairBus']);
        Route::post('/chairBus/{id}', [busController::class, 'chair']);
    });
    Route::prefix('trip')->middleware(['auth:admin'])->group(function () {
        Route::get('/', [tripController::class, 'showTrip']);
        Route::get('/addTrip', [tripController::class, 'showFormAddTrip']);
        Route::get('/showBusRunAdd', [tripController::class, 'showBusRunAdd']);
        Route::get('/showBusRunEdit', [tripController::class, 'showBusRunEdit']);
        Route::post('/addTrip', [tripController::class, 'addTrip']);
        Route::get('/addTripAuto', [tripController::class, 'addTripAuto']);
        Route::get('/editTrip/{id}', [tripController::class, 'showFormEdit']);
        Route::post('/editTrip/{id}', [tripController::class, 'editTrip']);
        Route::get('/deleteTrip/{id}', [tripController::class, 'deleteTrip']);
        Route::get('/viewRate/{idtuyen?}/{idxe?}/{idngay?}', [tripController::class, 'viewRate']);

        Route::post('/countBus', [tripController::class, 'countBus']);
    });
    Route::prefix('ticket')->middleware(['auth:admin'])->group(function () {
        Route::get('/show/{idttv?}', [ticketController::class, 'showTicket']);
        Route::get('/addTicket', [ticketController::class, 'addTicket']);

        Route::get('/detailTicket/{id}', [ticketController::class, 'detailTicket']);
        Route::get('/browseTicket/{id}', [ticketController::class, 'browseTicket']);
        Route::get('/deleteTicket/{id}', [ticketController::class, 'deleteTicket']);
        Route::get('/invoice/{id}', [ticketController::class, 'invoice']);
        // Route::post('/editTrip/{id}', [ticketController::class, 'editTrip']);
        // Route::get('/deleteTrip/{id}', [ticketController::class, 'deleteTrip']);

        Route::post('/findRoute', [ticketController::class, 'findRoute']);
        Route::get('/findBus', [ticketController::class, 'findBus']);
        Route::post('/findBus', [ticketController::class, 'booking']);
        Route::post('/seat', [ticketController::class, 'seat']);
        Route::post('/check_seat', [ticketController::class, 'check_seat']);
    });

    Route::prefix('statistic')->middleware(['auth:admin'])->group(function () {
        Route::get('/', [statisticController::class, 'statistic']);
        Route::get('/thongke', [statisticController::class, 'thongke']);
        Route::get('/sortStatistic', [statisticController::class, 'sortStatistic']);
        Route::get('/profit', [statisticController::class, 'profit']);
    });
    Route::prefix('customer')->middleware(['auth:admin'])->group(function () {
        Route::get('/', [customerController::class, 'showCustomer']);
        Route::get('delete/{idkh}', [customerController::class, 'delete']);
        Route::get('active/{idkh}', [customerController::class, 'active']);
    });
    // filter
    Route::get('filterTrip', [filterAdminController::class, 'filterTrip']);
    Route::get('searchTrip', [filterAdminController::class, 'searchTrip']);
});

Route::prefix('/client')->name('client.')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::post('address', [userClientController::class, 'address']);
        Route::get('register', [userClientController::class, 'showFormRegister']);
        Route::post('register', [userClientController::class, 'register']);
        Route::get('login', [userClientController::class, 'showFormLogin'])->name('login');
        Route::post('login', [userClientController::class, 'login']);
        Route::get('logout', [userClientController::class, 'logout']);
        Route::get('/login/google/redirect', [userClientController::class, 'loginGoogleRedirect']);
        Route::get('/login/google/callback', [userClientController::class, 'loginGoogleCallback'])->name('loginGoogleCallback');
    });
    Route::prefix('index')->group(function () {
        Route::get('/', [homeClientController::class, 'index'])->name('index');
    });
    // Route::get('index', function () {
        // $diemKHs = routeModel::distinct()->get('diemKH');
    // })->name('index');
    Route::get('introduce', function () {
        return view('client.introduce');
    });
    // Route::get('/schedule', [scheduleController::class, 'schedule']);
    Route::prefix('schedule')->group(function () {
        Route::get('/', [scheduleController::class, 'schedule']);
        Route::get('/timeSchedule/{id}', [scheduleController::class, 'timeSchedule']);
        Route::post('/searchSchedule', [scheduleController::class, 'searchSchedule']);
    });
    Route::prefix('ticket')->group(function () {
        Route::get('/', [ticketClientController::class, 'showTicket']);
        Route::get('/findBus/{idtuyen?}/{idgio?}/{idngay?}', [ticketClientController::class, 'findBus']);
        Route::post('/findBus', [ticketClientController::class, 'booking']);
        Route::post('/findRoute', [ticketClientController::class, 'findRoute']);
        Route::post('/seat', [ticketClientController::class, 'seat']);
        Route::post('/check_seat', [ticketClientController::class, 'check_seat']);
        // Route::get('/history', [historyClientController::class, 'showHistory']);
    });
    Route::prefix('history')->group(function () {
        Route::get('/{id}', [historyClientController::class, 'showHistory']);
        Route::get('/deleteSeat/{id}', [historyClientController::class, 'deleteSeat']);
        Route::get('/deleteTicket/{id}', [historyClientController::class, 'deleteTicket']);
        Route::get('/deleteTicketDes/{id}', [historyClientController::class, 'deleteTicketDes']);
        Route::get('/deleteTicketRe/{id}', [historyClientController::class, 'deleteTicketRe']);
        // Route::get('/finishTicket/{id}', [historyClientController::class, 'finishTicket']);
        Route::post('/rating', [historyClientController::class, 'rating']);
    });
    // Route::get('/ticket/{id?}', [ticketController::class, 'showTicket']);
});

// paypal
Route::get('process-transaction', [paypalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [paypalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [paypalController::class, 'cancelTransaction'])->name('cancelTransaction');
//Route::get('create-Transaction', [paypalController::class, 'createTransaction'])->name('createTransaction');
// momo
Route::get('momoPay', [momoController::class, 'momoPay'])->name('momoPay');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
