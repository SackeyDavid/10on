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

Route::get('/', function () {
    
        return view('welcome', ['msg' => "Hello, you're welcome!"]);
    })->name('welcome');

Auth::routes();

Route::get('/primary', function () {
    
        return view('primary');
    })->name('primary');
Route::get('/secondary', function () {
    
        return view('secondary');
    })->name('secondary');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/terms', function () {
        return view('terms');
})->name('terms');
Route::get('/privacy', function () {
        return view('privacy');
})->name('privacy');

Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/search/from', 'BookingController@searchTrip')->name('search.trips');
Route::get('/search/fromhome/autocomplete', 'BookingController@autocomplete')->name('search.trips.autocomplete');



Route::get('/search/trips/return', 'BookingController@findReturnTrips')->name('search.trips.return.find');

Route::post('/trip/from/{lpos}/{lpis}/{passenger_num}', 'BookingController@tripFound')->name('trip.search.found');

Route::get('/trip/book/personal/{booking_id}/{lpos}/{lpis}/{passenger_num}', 'BookingController@personalDetails')->name('book.personal.details');

Route::post('/passenger/details/add/{booking_id}/{lpos}/{lpis}/{passenger_num}', 'BookingController@addPassengerDetails')->name('passenger.details.add');

Route::post('/passenger/details/add/{booking_id}/{passenger_num}', 'SearchController@addPassengerDetails')->name('ow.passenger.details.add');

Route::get('/trip/book/payment/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}', 'BookingController@paymentDetails')->name('book.payment.details');

Route::get('/trip/book/payment/{booking_id}/{passenger_num}/{traveler_id}', 'SearchController@paymentDetails')->name('oneway.book.payment.details');

Route::post('/payment/details/add/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}/{option}', 'BookingController@addPaymentDetails')->name('payment.details.add');

Route::post('/payment/details/add/{booking_id}/{passenger_num}/{traveler_id}/{option}', 'SearchController@addPaymentDetails')->name('oneway.payment.details.add');




Route::post('/payment/success/edit/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}/{payment_id}/{option}', 'BookingController@editPaymentSuccess')->name('payment.success.edit');

Route::get('/search/trips/oneway', 'SearchController@search')->name('trips.search');

Route::get('/history/trips/search', 'SearchController@searchHistory')->name('search.history');

Route::get('/drive/status/', 'SearchController@driveStatusShow')->name('oneway.drive.status');

// Route::get('/oneway/return/trips/my/', 'SearchController@showMyTrips')->name('my.trips.oneway');

Route::get('/return/drive/status/10120120020010', 'BookingController@driveStatusShow')->name('return.drive.status');

Route::post('/found/trips/oneway/{trip_id}/{passenger_num}', 'SearchController@tripFound')->name('oneway.trip.found');

Route::get('/oneway/payment/success/{booking_id}/{passenger_num}/{traveler_id}/{payment_id}/{option}', 'SearchController@showPaymentSuccess')->name('one_way.payment.success.show');



Route::group(['middleware'=>['auth']],function(){
    Route::get('/trip/book/personal/auth/{booking_id}/{lpos}/{lpis}/{passenger_num}', 'BookingController@personalDetails')->name('book.personal.details.auth');

    Route::get('oneway/trip/book/personal/auth/{booking_id}/{passenger_num}', 'SearchController@onewayPersonalDetails')->name('oneway.book.personal.details.auth');

    Route::get('/trip/book/payment/auth/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}', 'BookingController@paymentDetails')->name('book.payment.details.auth');

    Route::get('/trip/book/payment/auth/{booking_id}/{passenger_num}/{traveler_id}', 'SearchController@paymentDetails')->name('oneway.book.payment.details.auth');

    Route::get('/payment/details/register/', 'HomeController@showPaymentDetailsForm')->name('payment.details.register');

    Route::post('/payment/details/register/', 'HomeController@registerPaymentDetails')->name('payment.register');

    Route::get('/payment/mobile/register/', 'HomeController@showRegisterMobileDetails')->name('payment.mobile.register');

    Route::post('/details/mobile/register/', 'HomeController@registerMobileDetails')->name('mobile.details.register');

    Route::post('/payment/details/add/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}/{option}', 'BookingController@addPaymentDetails')->name('payment.details.add');

    

    Route::get('/auth/oneway/payment/success/{booking_id}/{passenger_num}/{traveler_id}/{payment_id}/{option}', 'SearchController@showPaymentSuccess')->name('one_way.payment.success.show.auth');

    Route::get('/auth/return/payment/success/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}/{payment_id}/{option}', 'BookingController@showPaymentSuccess')->name('return.payment.success.auth');

    Route::get('/auth/return/drive/status/10120{booking_id}120020010', 'BookingController@driveStatusShow')->name('auth.return.drive.status');

    Route::get('/auth/oneway/trips/my/{booking_id}', 'SearchController@showMyTrips')->name('user.trips.oneway');

    Route::get('/auth/manage/booking', 'SearchController@manageBooking')->name('manage.auth.booking');

    Route::post('/edit/booking/', 'SearchController@editBooking')->name('edit.booking');

    Route::get('/traveler/bus/', 'SearchController@showBus')->name('bus.info');

    Route::get('/trips/my/', 'SearchController@showMyTrips')->name('my.trips.oneway');

    Route::put('/checkin/oneway/', 'SearchController@onewayCheckin')->name('checkin.oneway');

    Route::put('/depart/checkin/rt/', 'BookingController@departCheckin')->name('depart.checkin.rt');

    Route::put('/return/checkin/rt/', 'BookingController@returnCheckin')->name('return.checkin.rt');

});

Route::post('/payment/details/add/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}/{option}', 'BookingController@addPaymentDetails')->name('payment.details.add');

Route::get('/return/payment/success/{booking_id}/{lpos}/{lpis}/{passenger_num}/{traveler_id}/{payment_id}/{option}', 'BookingController@showPaymentSuccess')->name('return.payment.success.show');

Route::delete('/history/delete', 'SearchController@deleteHistory')->name('history.delete');

Route::delete('/returnbooking/delete', 'SearchController@deleteReturnBooking')->name('return.booking.delete');

Route::get('/manage/booking', 'SearchController@manageBooking')->name('manage.booking');

Route::get('/sms/send/{to}', function(\Nexmo\Client $nexmo, $to){
    $message = $nexmo->message()->send([
        'to' => $to,
        'from' => '@leggetter',
        'text' => 'Sending SMS from Laravel. Woohoo!'
    ]);
    Log::info('sent message: ' . $message['message-id']);
});

View::composer(['book.components.returnTab', 'book.components.onewayTab', 'book.components.multicityTab', 'book.search-trip'], function ($view) {
             $fares = App\Fare::orderBy('created_at', 'DESC')->paginate(10);
             $buses = App\Bus::orderBy('created_at', 'DESC')->paginate(10);
             $trips = App\Trips::orderBy('created_at', 'DESC')->paginate(10);
             $special_features = App\SpecialFeatures::orderBy('created_at', 'DESC')->paginate(10);
             $stations = App\Station::orderBy('name')->get();

             $view->with('fares', $fares)->with('buses', $buses)->with('trips', $trips)->with('special_features', $special_features)->with('stations', $stations);
  });




Route::prefix('admin')->group(function(){

	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');

  Route::post('/clients/add', 'Auth\TransportCompanyController@addClient')->name('client.add');
  
  Route::post('/transport_company/add', 'Auth\TransportCompanyController@addTransportCompany')->name('transport.company.add');
  
  Route::post('/kilometer/add/{id}', 'Auth\TransportCompanyController@addKilometer')->name('kilometer.add');

  Route::post('/kilometer/delete/{id}/{for_trip}', 'Auth\TransportCompanyController@deleteKilometer')->name('kilometer.delete');
  
  // Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
  View::composer(['admin', 'components.addTransportCompany', 'components.addClient', 'components.addKilometer'], function ($view) {
             $transport_companies = App\TransportCompany::orderBy('created_at', 'DESC')->paginate(10);
             $trips = App\Trips::orderBy('created_at', 'DESC')->paginate(10);
             $trips_without_kilometers = App\Trips::where('kilometers', null)->orderBy('created_at', 'DESC')->paginate(10);
             $kilometers = App\Kilometers::orderBy('created_at', 'DESC')->paginate(10);

             $view->with('transport_companies', $transport_companies)->with('trips', $trips)->with('trips_without_kilometers', $trips_without_kilometers)->with('kilometers', $kilometers);
  });

  Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

  //password resets
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::prefix('client')->group(function(){

	Route::get('/login', 'Auth\ClientLoginController@showLoginForm')->name('client.login');
  Route::post('/login', 'Auth\ClientLoginController@login')->name('client.login.submit');
  Route::get('/', 'ClientController@index')->name('client.dashboard');

  Route::post('/trip/add', 'ClientController@addTrip')->name('trip.add');
  Route::post('/fare/add', 'ClientController@addFare')->name('fare.add');

  Route::post('/fare/delete/{id}/{for_trip}', 'ClientController@deleteFare')->name('fare.delete');
  Route::post('/tax/delete/{id}/{for_trip}', 'ClientController@deleteTax')->name('tax.delete');
  Route::post('/trip/delete/{id}', 'ClientController@deleteTrip')->name('trip.delete');
  Route::post('/bus/add', 'ClientController@addBus')->name('bus.add');
  Route::post('/special_features/add', 'ClientController@addSpecialFeatures')->name('special.add');
  Route::post('/station/add', 'ClientController@addStation')->name('station.add');

  Route::post('/tax/add', 'ClientController@addTax')->name('tax.add');

  View::composer(['client', 'components.client.addBus', 'components.client.addFare', 'components.client.addStation', 'components.client.addTax','components.client.addTrip', 'components.client.addSpecialFeatures', 'layouts.client-app'], function ($view) {
             $fares = App\Fare::orderBy('created_at', 'DESC')->paginate(10);
             $ones_fares = '';
             $buses = '';
             $ones_taxes = '';
             $trips = '';
             $ones_trips = '';
             $special_features = '';
             $ones_special_features = '';
             $stations = '';
             $ones_stations = '';

             if (!Auth::user()) {
               $ones_fares = App\Fare::all();

             }else
             {
              $ones_fares = App\Fare::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
              $buses = App\Bus::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $ones_taxes = App\Tax::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $trips = App\Trips::orderBy('created_at', 'DESC')->paginate(10);
             $ones_trips = App\Trips::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $special_features = App\SpecialFeatures::orderBy('created_at', 'DESC')->paginate(10);
             $ones_special_features = App\SpecialFeatures::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $stations = App\Station::orderBy('name')->get();
             $ones_stations = App\Station::where('from_client', Auth::user()->id)->orderBy('name')->paginate(10);
             }
             
             

             
             

             $view->with('fares', $fares)->with('ones_fares', $ones_fares)->with('buses', $buses)->with('trips', $trips)->with('ones_trips', $ones_trips)->with('special_features', $special_features)->with('ones_special_features', $ones_special_features)->with('stations', $stations)->with('ones_stations', $ones_stations)->with('ones_taxes', $ones_taxes);
  });

  Route::post('/logout', 'Auth\ClientLoginController@logout')->name('client.logout');

  //password resets
  Route::get('/password/reset', 'Auth\ClientForgotPasswordController@showLinkRequestForm')->name('client.password.request');
  Route::post('/password/email', 'Auth\ClientForgotPasswordController@sendResetLinkEmail')->name('client.password.email');
	Route::post('/password/reset', 'Auth\ClientResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\ClientResetPasswordController@showResetForm')->name('client.password.reset');
});



