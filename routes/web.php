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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/search/fromhome', 'BookingController@searchTrip')->name('search.trips');
Route::get('/search/fromhome/autocomplete', 'BookingController@autocomplete')->name('search.trips.autocomplete');
Route::get('/search/trips/return', 'BookingController@findReturnTrips')->name('search.trips.return.find');

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
  Route::post('/bus/add', 'ClientController@addBus')->name('bus.add');
  Route::post('/special_features/add', 'ClientController@addSpecialFeatures')->name('special.add');
  Route::post('/station/add', 'ClientController@addStation')->name('station.add');

  View::composer(['client', 'components.client.addBus', 'components.client.addFare', 'components.client.addStation', 'components.client.addTrip', 'components.client.addSpecialFeatures'], function ($view) {
             $fares = App\Fare::orderBy('created_at', 'DESC')->paginate(10);
             $ones_fares = App\Fare::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $buses = App\Bus::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $trips = App\Trips::orderBy('created_at', 'DESC')->paginate(10);
             $ones_trips = App\Trips::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $special_features = App\SpecialFeatures::orderBy('created_at', 'DESC')->paginate(10);
             $ones_special_features = App\SpecialFeatures::where('from_client', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
             $stations = App\Station::orderBy('name')->get();
             $ones_stations = App\Station::where('from_client', Auth::user()->id)->orderBy('name')->paginate(10);

             $view->with('fares', $fares)->with('ones_fares', $ones_fares)->with('buses', $buses)->with('trips', $trips)->with('ones_trips', $ones_trips)->with('special_features', $special_features)->with('ones_special_features', $ones_special_features)->with('stations', $stations)->with('ones_stations', $ones_stations);
  });

  Route::post('/logout', 'Auth\ClientLoginController@logout')->name('client.logout');

  //password resets
  Route::get('/password/reset', 'Auth\ClientForgotPasswordController@showLinkRequestForm')->name('client.password.request');
  Route::post('/password/email', 'Auth\ClientForgotPasswordController@sendResetLinkEmail')->name('client.password.email');
	Route::post('/password/reset', 'Auth\ClientResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\ClientResetPasswordController@showResetForm')->name('client.password.reset');
});
