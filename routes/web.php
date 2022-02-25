<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\CarsVoteController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MpesaAmountController;
use App\Http\Controllers\DealersVoteController;
use App\Http\Controllers\CarReservationController;
use App\Http\Controllers\CarReservationVoteController;


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


//ADMIN ROUTES
//Admin middleware --> can only be acccessed by users with the role of Admin
Route::group(['middleware' => 'admin'], function()
{
   Route::get('/autoshowadmin', [TransactionController::class,'getTransactions']);
   Route::get('/admin-cars', [CarController::class,'getCars']);
   Route::get('/admin-dealers',[DealerController::class,'adminDealers']);
   Route::get('/admin-psv', [CarController::class,'getPSVs']);
   Route::get('/admin-car-for-auction', [CarController::class,'adminAuctionCars']);
   Route::get('/admin-transactions', [TransactionController::class,'getTransactions']);
   Route::get('/admin-subscribers', [SubscriberController::class,'getSubscribers']);
   Route::get('/admin-mpesa', [MpesaAmountController::class,'show']);
   Route::post('/admin-mpesa-amount', [MpesaAmountController::class,'create']);
   Route::get('/admin-delete-car/{car}', [CarController::class,'deleteCar']);
   Route::get('/admin-delete-psv/{car}', [CarController::class,'deletePSV']);
   Route::get('/admin-delete-dealer/{dealer}', [DealerController::class,'deleteDealer']);
   Route::get('/admin-delete-auction-car/{car}', [CarController::class,'deleteAuctionCar']);
   Route::get('/admin-publish-car/{car}', [CarController::class,'publishCar']);
   Route::get('/admin-publish-psv/{car}', [CarController::class,'publishPSV']);
   Route::get('/admin-publish-dealer/{dealer}', [DealerController::class,'publishDealer']);
   Route::get('/admin-publish-auction-car/{car}', [CarController::class,'publishAuctionCar']);
   Route::get('/admin-unpublish-car/{car}', [CarController::class,'unpublishCar']);
   Route::get('/admin-unpublish-psv/{car}', [CarController::class,'unpublishPSV']);
   Route::get('/admin-unpublish-dealer/{dealer}', [DealerController::class,'unpublishDealer']);
   Route::get('/admin-unpublish-auction-car/{car}', [CarController::class,'unpublishAuctionCar']);
      



   //detail routes
   Route::get('/admin-car-details/{car}', [CarController::class,'getAdminCarDetails']);
   Route::get('/admin-psv-details/{car}', [CarController::class,'getAdminPSVDetails']);
   Route::get('/admin-car-auction-details/{car}', [CarController::class,'getAdminCarAuctionDetails']);
   Route::get('/admin-dealer-details/{dealer}', [DealerController::class,'getAdminDealerDetails']);


});


// USER ROUTES 
//User must login to access
Route::group(['middleware' => 'auth'], function()
{
   
   // CAR ROUTES
   Route::get('/mycars',[CarController::class,'getCarsOfTheYear']);
   Route::get('/create-car',[CarController::class,'getCarMakesandModels']);
   Route::get('/edit-vehicle/{car}',[CarController::class,'getCarMakesandModelsforEdit']);
   Route::post('/upload-car',[CarController::class,'uploadCar']);
   Route::get('/vote-for-car/{car}',[CarsVoteController::class,'voteForCarOnPublic']);
   Route::get('/vote-for-mycar/{car}',[CarsVoteController::class,'voteForCarOnPrivate']);
   Route::get('/vote-for-car-on-display/{car}',[CarsVoteController::class,'voteForCarOnDisplay']);
   Route::get('/publish-car/{car}',[CarController::class,'getCartoPublish']);
   Route::get('/unpublish-car/{car}', [CarController::class,'unpublishMyCar']);
   Route::get('/delete-car/{car}', [CarController::class,'deleteMyCar']);
   Route::post('/update-vehicle/{car}', [CarController::class,'editCar']);
   

   
   //PSV ROUTES
   Route::get('/mypsvs', [CarController::class,'getPSVSOfTheYear']);
   Route::get('/vote-for-psv/{car}',[CarsVoteController::class,'voteForPSVOnPublic']);
   Route::get('/vote-for-mypsv/{car}',[CarsVoteController::class,'voteForPSVOnPrivate']);
   Route::get('/vote-for-psv-on-display/{car}',[CarsVoteController::class,'voteForPSVOnDisplay']);
   Route::get('/unpublish-psv/{car}', [CarController::class,'unpublishMyPSV']);
   Route::get('/delete-psv/{car}', [CarController::class,'deleteMyPSV']);

   
   //DEALER ROUTES
   Route::get('/create-dealer', function () { return view('create-dealer'); });
   Route::post('/upload-dealer',[DealerController::class,'uploadDealer']);
   Route::get('/mydealers',[DealerController::class,'getDealers']);
   Route::get('/vote-for-dealer/{dealer}',[DealersVoteController::class,'voteForDealerOnPublic']);
   Route::get('/vote-for-mydealer/{dealer}',[DealersVoteController::class,'voteForDealerOnPrivate']);
   Route::get('/vote-for-dealer-on-display/{dealer}',[DealersVoteController::class,'voteForDealerOnDisplay']);
   Route::get('/publish-dealer/{dealer}',[DealerController::class,'getDealertoPublish']);
   Route::get('/unpublish-dealer/{dealer}', [DealerController::class,'unpublishDealer']);
   Route::get('/delete-dealer/{dealer}', [DealerController::class,'deleteDealer']);
   Route::get('/edit-dealer/{dealer}', [DealerController::class,'editDealer']);
   Route::post('/update-dealer/{dealer}', [DealerController::class,'updateDealer']);



   //AUCTION ROUTES
   Route::get('/auction-cars',[CarController::class,'getAuctionCars']);
   Route::get('/reserve-car/{car}', [CarReservationController::class,'reserveCar']);
   Route::get('/reserve-mycar/{car}', [CarReservationController::class,'privatereserveCar']);
   Route::get('/unpublish-auction-car/{car}', [CarController::class,'unpublishMyAuctionCar']);
   Route::get('/delete-auction-car/{car}', [CarController::class,'deleteMyAuctionCar']);


   //USER ROUTES
   Route::get('/myprofile', function () { return view('myprofile'); });
   Route::get('/checkout', function () { return view('checkout'); });
   Route::post('/updateuser/{user}',[UserController::class,'editUser']);

   //PAYMENT ROUTES
   Route::post('/car-payment-status/{car}',[MpesaController::class,'checkcarPaymentStatus']);
   Route::post('/dealer-payment-status/{dealer}',[MpesaController::class,'checkdealerPaymentStatus']);
   Route::get('/register-urls',[MpesaController::class,'mpesaRegisterUrls']);



});

//User must not login to access
Route::get('/',[CarController::class,'getVotesSummation']);
Route::get('/about', function () { return view('about'); });
Route::get('/index', [CarController::class,'getVotesSummation']);
Route::get('/sponsors', function () { return view('sponsors'); });
Route::get('/exhibitors', function () { return view('exhibitors'); });
Route::get('/vendors', function () { return view('vendors'); });
Route::get('/know-before-go', function () { return view('know-before-go'); });
Route::get('/events', function () { return view('know-before-go'); });
Route::get('/contactus', function () { return view('contactus'); });
Route::get('/faqs', function () { return view('faqs'); });
Route::get('/location', function () { return view('location'); });
Route::get('/psv-awards', [CarController::class,'getPSVSOfTheYearToVoteFor']);
Route::get('/car-awards', [CarController::class,'getCarsOfTheYearToVoteFor']);
Route::get('/dealer-awards', [DealerController::class,'getDealersOfTheYearToVoteFor']);
Route::get('/auction',[CarController::class,'getAuctionCarsForReservation']);
Route::post('/search-dealer',[DealerController::class,'searchDealer']);
Route::post('/search-car',[CarController::class,'searchCar']);
Route::post('/search-psv',[CarController::class,'searchPSV']);
Route::post('/search-auction-car',[CarController::class,'searchCarForAuction']);
Route::get('/get-car-image/{car}',[CarController::class,'getcarImageOnSearch']);
Route::post('/get-models',[CarController::class,'getModels']);
Route::post('/get-car-models',[CarController::class,'getCarModels']);
Route::post('/get-psv-models',[CarController::class,'getPSVModels']);
Route::post('/filter-cars',[CarController::class,'filterCars']);
Route::post('/filter-psvs',[CarController::class,'filterPSVs']);
Route::post('/filter-auction-cars',[CarController::class,'filterAuctionCars']);
Route::get('/store-car-details',[CarController::class,'storeCarDetails']);
Route::post('/subscribe',[SubscriberController::class,'create']);
Route::get('/car-details/{car}', [CarController::class,'getCarDetails']);
Route::get('/psv-details/{car}',[CarController::class,'getPSVDetails']);
Route::get('/dealer-details/{dealer}', [DealerController::class,'getDealer']);
Route::get('/auction-cardetails/{car}', [CarController::class,'getAuctionCarDetails']);












