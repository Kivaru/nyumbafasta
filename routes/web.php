<?php

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

//  use App\Jobs\TestQueueJob;
//  use App\Jobs\UpdateSelcomPayment;

//  Route::get('test', function () {
//     $details['region_id'] = '2';
//     $details['name'] = 'Kongwa';

//     dispatch(new TestQueueJob($details));

//     dd('inserted');
// });

// Route::get('payment-test', function () {

//     $orderId = "SELCOM16729843827619";

//     dispatch(new UpdateSelcomPayment($orderId));

//     dd('tested');
// });


//api routes
//landlord routes
Route::get('api/v1/get/landlord/homedata/{id}', 'Api\HousesApiController@homeLandlord');
Route::post('api/v1/landlord/house/upload', 'Api\HousesApiController@store');
Route::get('api/v1/get/agents', 'Api\HousesApiController@getAgents');
Route::get('api/v1/get/locations', 'Api\HousesApiController@getLocations');


//user login and registration
Route::post('api/v1/user/login', 'Api\UserLoginApiController@index');
Route::post('api/v1/user/register', 'Api\UserRegisterApiController@index');
Route::get('api/v1/get/user/profile/{id}', 'Api\UserLoginApiController@getUserProfile');
Route::post('api/v1/profile/update', 'Api\UserLoginApiController@updateUserProfile');

//houses api
Route::get('api/v1/houses', 'Api\HousesApiController@index');
Route::get('api/v1/all-houses', 'Api\HousesApiController@allHouse');
Route::get('api/v1/houses-for-sale', 'Api\HousesApiController@indexHousesForSale');
Route::get('api/v1/cart/{user_id}', 'Api\HousesApiController@housesCart');
Route::get('api/v1/favorite-houses/{user_id}', 'Api\HousesApiController@getFavoriteHouses');
Route::post('api/v1/add-to-favorite', 'Api\HousesApiController@addFavoriteHouse');

Route::get('ajax/district', 'Api\HousesApiController@getDistrict');
Route::get('ajax/area', 'Api\HousesApiController@getArea');

//payment api
Route::post('api/v1/mobilepush/payment', 'Api\PaymentApiController@checkoutPayment');
Route::post('api/v1/card/payment', 'Api\PaymentApiController@checkoutPaymentCard');

Route::post('api/v1/mobilepush/kiwanja-buku', 'Api\PaymentApiController@checkoutPaymentPlot');
Route::post('api/v1/card/payment/kiwanja-buku', 'Api\PaymentApiController@checkoutPaymentCardPlot');


//new routes for new ui renter
Route::get('/login/renter', 'Auth\LoginController@showLogin')->name('renter.login');
Route::get('/register/renter', 'Auth\RegisterController@register_renter')->name('renter.register');
Route::get('houses', 'HomeController@allHouses')->name('renter.allHouses');
Route::get('house/details/{id}', 'Renter\DashboardController@housesDetails')->name('renter.houses.details');
Route::get('property/details/{id}', 'Renter\DashboardController@propertyDetails')->name('renter.property.details');
Route::get('pay/house/details/{id}', 'Renter\DashboardController@payHousesDetails')->name('renter.payhouses.details');
Route::get('login/register/page', 'Auth\LoginController@showLoginRegister')->name('login.register');
Route::any('add/house/wishlist/{id}', 'Renter\DashboardController@addToWishlist')->name('renter.add.wishlist');

//agents routes
Route::get('agents', 'HomeController@agents')->name('agents.names.index');
Route::get('agent/houses/{id}', 'HomeController@agentHouses')->name('agent.houses.show');
// Route::any('agent/houses/filter', 'HomeController@agentFilter')->name('agent.houses.filter');


//routes for password reset
Route::get('forget-password','Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password','Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');


//new routes for new ui landlord
Route::get('/login/landlord', 'Auth\LoginController@showLandLordLogin')->name('landlord.login');
Route::get('/register/landlord', 'Auth\RegisterController@register_landlord')->name('landlord.register');
Route::get('/register/dalali', 'Auth\RegisterController@register_dalali')->name('dalali.register');


Route::get('/', 'HomeController@indexLanding')->name('welcome');
Route::get('/properties-for-rent', 'HomeController@index')->name('houses.rent.welcome');
Route::get('/properties-for-sale', 'HomeController@indexHousesForSale')->name('houses.sale.welcome');


Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::get('/descending-order-houses-price', 'HomeController@highToLow')->name('highToLow');
Route::get('/ascending-order-houses-price', 'HomeController@lowToHigh')->name('lowToHigh');

Route::any('/filter-result', 'HomeController@filter')->name('filter');
Route::any('/search-result-home', 'HomeController@searchResults')->name('searchResults');
Route::any('/search-result-by-range', 'HomeController@searchByRange')->name('searchByRange');

Route::post('/house-booking/id/{id}', 'HomeController@booking')->name('booking');

Auth::routes(['verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');

Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('auth/redirect/{provider}', 'Auth\SocialController@redirect');
Route::get('callback/{provider}', 'Auth\SocialController@callback');

Route::get('pesapal/callback', 'PesaPalPaymentController@index');

Route::get('auth/redirect/twitter', 'SocialAuthTwitterController@redirect');
Route::get('auth/callback/twitter', 'SocialAuthTwitterController@callback');

//admin

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin', 'verified', 'optimizeImages']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('area', 'AreaController');
        Route::resource('house', 'HouseController');
        Route::resource('agent', 'AgentController');

        Route::get('area-houses/{id}', 'AreaController@show')->name('area.show');

        Route::get('manage-landlord', 'HouseController@manageLandlord')->name('manage.landlord');
        Route::get('manage-unverified-landlord', 'HouseController@indexUnverified')->name('manage.unverified.landlord');
        Route::get('manage-verified-landlord', 'HouseController@indexVerified')->name('manage.verified.landlord');
        Route::get('verify-landlord/{id}', 'HouseController@verifyLandlord')->name('landlord.verify');
        Route::get('conform-dialing/{id}', 'HouseController@dialLandlord')->name('landlord.dialed');
        Route::delete('manage-landlord/destroy/{id}', 'HouseController@removeLandlord')->name('remove.landlord');
        Route::get('filter', 'HouseController@filter')->name('filter');

        Route::get('manage-agent', 'AgentController@index')->name('manage.agent');
        Route::post('agent/store', 'AgentController@store')->name('agent.post');
        Route::get('agent/houses/{id}', 'AgentController@show')->name('agent.houses');
        Route::post('agent/houses/filter', 'AgentController@agentFilter')->name('agent.filter');

        Route::get('manage-properties-for-sale', 'PropertyController@index')->name('property.index');
        Route::get('create-property', 'PropertyController@create')->name('property.create');
        Route::post('store-property', 'PropertyController@store')->name('property.store');
        Route::get('edit-property/{id}', 'PropertyController@edit')->name('property.edit');
        Route::get('show-property/{id}', 'PropertyController@show')->name('property.show');
        Route::get('status-property/{id}', 'PropertyController@switch')->name('property.status');
        Route::post('update-property', 'PropertyController@update')->name('property.update');
        Route::delete('delete-property/{id}', 'PropertyController@destroy')->name('property.destroy');

        Route::get('ajax/district', 'PropertyController@getDistrict');
        Route::get('ajax/area', 'PropertyController@getArea');

        Route::get('manage-renter', 'HouseController@manageRenter')->name('manage.renter');
        Route::delete('manage-renter/destroy/{id}', 'HouseController@removeRenter')->name('remove.renter');

        Route::get('manage-dalali', 'HouseController@manageDalali')->name('manage.dalali');
        Route::get('verify-dalali/{id}', 'HouseController@verifyDalali')->name('dalali.verify');
        Route::get('conform-dalali-dialing/{id}', 'HouseController@dialDalali')->name('dalali.dialed');
        Route::delete('manage-dalali/destroy/{id}', 'HouseController@removeDalali')->name('remove.dalali');

        Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
        Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
        Route::get('profile-landlord/edit/{id}', 'SettingsController@editProfileLandlord')->name('landlord.profile.edit');
        Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');

        Route::post('profile-landlord-info/update/', 'SettingsController@updateLandlordProfile')->name('landlord.profile.update');

        Route::get('booked-houses-list', 'BookingController@bookedList')->name('booked.list');
        Route::get('booked-houses-history', 'BookingController@historyList')->name('history.list');
        Route::get('house/available-status/{id}', 'HouseController@switchAvailable')->name('house.status1');
        Route::get('house/unavailable-status/{id}', 'HouseController@switchUnavailable')->name('house.status0');

        Route::get('search/', 'SearchController@search')->name('search');
        Route::get('search/landlord', 'SearchController@searchLandlord')->name('search.landlord');

        Route::get('completed/transactions', 'PaymentController@indexCompletedTransactions')->name('transactions.completed');
        Route::get('pending/transactions/pending_even', 'PaymentController@indexPendingTransactionseven')->name('transactions.pending_even');
        Route::get('pending/transactions/pending_odd', 'PaymentController@indexPendingTransactionsodd')->name('transactions.pending_odd');

        Route::post('send/payment/sms', 'PaymentController@sendMesageToRenter')->name('renter.sms');


    });

//landlord

Route::group(['as' => 'landlord.', 'prefix' => 'landlord', 'namespace' => 'Landlord', 'middleware' => ['auth', 'landlord', 'verified', 'optimizeImages']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('area', 'AreaController');
        Route::resource('house', 'HouseController');
        Route::get('house/switch-status/{id}', 'HouseController@switch')->name('house.status');

        Route::get('booking-request-list', 'BookingController@bookingRequestListForLandlord')->name('bookingRequestList');
        Route::post('booking-request/accept/{id}', 'BookingController@bookingRequestAccept')->name('request.accept');
        Route::post('booking-request/reject/{id}', 'BookingController@bookingRequestReject')->name('request.reject');
        Route::get('booking/history', 'BookingController@bookingHistory')->name('history');
        Route::get('booked/currently/renter', 'BookingController@currentlyStaying')->name('currently.staying');
        Route::post('renter/leave/{id}', 'BookingController@leaveRenter')->name('leave.renter');

        Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
        Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
        Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');

        Route::get('ajax/district', 'HouseController@getDistrict')->name('districts');
        Route::get('ajax/area', 'HouseController@getArea')->name('areadropdowns');

    });


    //dalali

Route::group(['as' => 'dalali.', 'prefix' => 'dalali', 'namespace' => 'Dalali', 'middleware' => ['auth', 'dalali', 'verified', 'optimizeImages']],
function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('area', 'AreaController');
    Route::resource('house', 'HouseController');
    Route::get('house/switch-status/{id}', 'HouseController@switch')->name('house.status');

    Route::get('booking-request-list', 'BookingController@bookingRequestListForLandlord')->name('bookingRequestList');
    Route::post('booking-request/accept/{id}', 'BookingController@bookingRequestAccept')->name('request.accept');
    Route::post('booking-request/reject/{id}', 'BookingController@bookingRequestReject')->name('request.reject');
    Route::get('booking/history', 'BookingController@bookingHistory')->name('history');
    Route::get('booked/currently/renter', 'BookingController@currentlyStaying')->name('currently.staying');
    Route::post('renter/leave/{id}', 'BookingController@leaveRenter')->name('leave.renter');

    Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
    Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
    Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');

    Route::get('ajax/district', 'HouseController@getDistrict')->name('districts');
    Route::get('ajax/area', 'HouseController@getArea')->name('areadropdowns');
});

Route::get(env('SSL_VERIFICATION_CODE') . '.txt', function () {
    return env('SSL_VERIFICATION_CODE');
});


//renter

Route::post('house/payment', 'Renter\DashboardController@paymentForHouseNumber')->name('renter.payment.house');
Route::post('house/card/payment', 'Renter\DashboardController@cardPaymentForHouse')->name('renter.cardpayment.house');

Route::get('renter/dashboard', 'Renter\DashboardController@index');
Route::get('welcome', 'Renter\DashboardController@welcome')->name('renter.welcome');

    //cart
Route::get('cart', 'Renter\DashboardController@cart')->name('renter.cart');

//wishlist
Route::get('my-wishlist', 'Renter\DashboardController@wishlist')->name('renter.wishlist');

Route::get('ajax/district', 'HomeController@getDistrict')->name('renter.districts');
Route::get('ajax/area', 'HomeController@getArea')->name('renter.areadropdowns');


Route::get('apartments', 'HomeController@apartments')->name('renter.apartments');
Route::get('standalone-houses', 'HomeController@standaloneHouses')->name('renter.standalonehouses');
Route::get('sitting-room-with-master-bedrooms', 'HomeController@sittingRoomWithMasterBedrooms')->name('renter.sittingroomwithmasterbedrooms');
Route::get('sitting-room-with-bedrooms', 'HomeController@sittingRoomWithBedrooms')->name('renter.sittingroomwithbedrooms');
Route::get('master-bedrooms', 'HomeController@masterBedrooms')->name('renter.masterbedrooms');
Route::get('single-rooms', 'HomeController@singleRooms')->name('renter.singlerooms');
Route::get('privacy-policy', 'HomeController@privacyPage')->name('privacy');
Route::get('about-us', 'HomeController@aboutUs')->name('about.us');
Route::get('contact-us', 'HomeController@contactUs')->name('contact.us');
Route::get('faqs', 'HomeController@faqs')->name('faqs');
Route::get('search-by-id', 'HomeController@searchById')->name('search.by.id');
Route::get('general-search', 'HomeController@generalSearch')->name('general.search');


Route::group(['as' => 'renter.', 'prefix' => 'renter', 'namespace' => 'Renter', 'middleware' => ['auth', 'renter', 'verified']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('welcome/ajax/district', 'DashboardController@getDistrict');
        Route::get('welcome/ajax/area', 'DashboardController@getArea');

        Route::get('delete-wishlist/{id}', 'DashboardController@deleteWishlist')->name('delete.wishlist');

        Route::get('areas', 'DashboardController@areas')->name('areas');

        Route::get('landlord/number/{id}', 'DashboardController@getLandlordNumber')->name('landlord.number');

        Route::get('available-houses/area/{id}', 'HomeController@areaWiseShow')->name('available.area.house');
        Route::get('renter/houses', 'DashboardController@allHouses')->name('allHouses.renter');


        Route::get('profile-info', 'SettingsController@showProfile')->name('profile.show');
        Route::get('profile-info/edit/{id}', 'SettingsController@editProfile')->name('profile.edit');
        Route::post('profile-info/update/', 'SettingsController@updateProfile')->name('profile.update');

        Route::get('booking/history', 'DashboardController@bookingHistory')->name('booking.history');
        Route::get('pending/booking', 'DashboardController@bookingPending')->name('booking.pending');
        Route::post('pending/booking/cancel/{id}', 'DashboardController@cancelBookingRequest')->name('cancel.booking.request');

        Route::post('review', 'DashboardController@review')->name('review');
        Route::get('review-edit/{id}', 'DashboardController@reviewEdit')->name('review.edit');
        Route::post('review-update/{id}', 'DashboardController@reviewUpdate')->name('review.update');

        Route::post('house-request', 'DashboardController@sendHouseRequest')->name('house.request');

        Route::get('house/filter-result', 'DashboardController@filter')->name('house.filter');

    });
