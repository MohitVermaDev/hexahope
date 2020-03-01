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
Route::GET('/cron_addin_pool','MoneyController@cron_addin_pool')->name('cron_addin_pool');

Auth::routes();
Route::POST('/add_enquiries','HomeController@add_enquiries')->name('add_enquiries');
Route::get('/', 'HomeController@homepage')->name('homepage');
Route::get('/fetch_countries', 'Auth\RegisterController@countries')->name('countries');
Route::get('/fetch_states', 'Auth\RegisterController@states')->name('states');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tree', 'HomeController@tree')->name('tree');
Route::get('/tree/{memberid}', 'HomeController@tree')->name('newtree');
Route::get('/royal', function () {
    return redirect('royal/login');
});
Route::get('/report/direct', 'HomeController@get_directes')->name('get_directes');
Route::get('/report/partners', 'HomeController@downline')->name('downline');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/edit_profile', 'HomeController@edit_profile')->name('edit_profile');
Route::PUT('/update_profile', 'HomeController@update_profile')->name('update_profile');
Route::PUT('/update_accounts', 'HomeController@update_accounts')->name('update_accounts');
Route::PUT('/update_password', 'HomeController@update_password')->name('update_password');
Route::PUT('/upload_profile', 'HomeController@upload_profile')->name('upload_profile');
//Get update_accounts
Route::post('/getSpon','HomeController@getSpon');

Route::POST('/send_otp','WalletController@send_otp')->name('send_otp');
Route::POST('/check_otp','WalletController@check_otp')->name('check_otp');

Route::middleware('user')->group(function () {
    Route::POST('check_first_balance','WalletController@check_first_balance')->name('check_first_balance');
    Route::get('/dashboard', 'HomeController@userDashboard')->name('dashboard');
    Route::get('/levelchart', 'HomeController@levelchart')->name('levelchart');
    Route::POST('/activation','WalletController@activation')->name('activation');
    Route::GET('/upgrade','WalletController@upgrade_level')->name('upgrade_level');
    Route::get('/allincomes', 'MoneyController@index')->name('money.index');
    Route::get('/flush_income', 'MoneyController@flush_income')->name('flush_income');
    Route::get('/poolincome', 'MoneyController@pool')->name('money.pool');
    
    Route::GET('/wallet','WalletController@wallet')->name('wallet');
    Route::GET('/withdrawal','WalletController@withdrawal')->name('withdrawal');
   
    
    Route::GET('/topupwallet','WalletController@topupwallet')->name('topupwallet');
    Route::GET('/fundtransfer','WalletController@fundtransfer')->name('fundtransfer');
    Route::GET('/trasnfer_fund','WalletController@trasnfer_fund')->name('trasnfer_fund');
    
    Route::GET('/member_activation','WalletController@member_activation')->name('member_activation');
    Route::POST('/user_check','WalletController@activate_downline_user_info')->name('activate_downline_user_info');
    Route::POST('/check_my_balance','WalletController@check_my_balance')->name('check_my_balance');
    Route::POST('/activate_downline_now','WalletController@activate_downline_now')->name('activate_downline_now');
    Route::POST('/withdrawbalance','WalletController@withdrawbalance')->name('checkmybalance');
    Route::POST('/withdrawsucced','WalletController@withdrawsucced')->name('withdrawsucced');
    Route::POST('/transferstart','WalletController@transferstart')->name('transferstart');
    Route::POST('/check_downline_user', 'WalletController@check_downline_user')->name('check_downline_user');
    Route::POST('/transfertouser', 'WalletController@transfertouser')->name('transfertouser');
    Route::GET('/send_fund_requests','WalletController@send_fund_requests')->name('send_fund_requests');
    Route::POST('/newsend_fund_requests','WalletController@newsend_fund_requests')->name('newsend_fund_requests');
    Route::get('/support', 'HomeController@support')->name('support');
    Route::POST('/add_support', 'HomeController@add_support')->name('add_support');
    Route::get('/myloyality', 'HomeController@myloyality')->name('myloyality');
    
    Route::get('/income/all', 'HomeController@all_income')->name('all_income');
    Route::get('/income/income_ledger/{gettitl}', 'HomeController@income_ledger')->name('income_ledger');
    Route::POST('/income/level/report/{gettitle}', 'HomeController@income_ledger_report')->name('get_current_ledger');
    Route::GET('/income/search/','HomeController@income_report_search')->name('income_search');
    
    
    Route::get('/topup/all', 'HomeController@all_topup')->name('all_topup');
    
    
});
Route::POST('/get_support_status', 'HomeController@get_support_status')->name('get_support_status');


Route::get('royal/login','Auth\LoginController@showadminLoginForm')->name('adminlogin');
Route::POST('royal/login','Auth\LoginController@adminlogin')->name('adminlogin.post');
Route::prefix('royal')->middleware('admin')->group(function () {
    Route::get('/support', 'HomeController@admin_suppots')->name('admin_suppots');
    Route::GET('/wallet_requests','WalletController@wallet_requests')->name('wallet_requests');
    Route::GET('/member_fund_requests','WalletController@member_fund_requests')->name('member_fund_requests');
    Route::get('/dashboard', 'HomeController@adminDashboard');
    Route::get('/topup', 'WalletController@topup_wallet')->name('topup_wallet');
    Route::POST('/topup', 'WalletController@topup_wallet_now')->name('topup_wallet_now');
    Route::POST('/check_user', 'HomeController@check_user')->name('check_user');
    Route::get('users', 'HomeController@users')->name('users.index');
    Route::GET('fundinfo', 'WalletController@fundinfo')->name('fundinfo');
    Route::PUT('fundinfo_data/{id}', 'WalletController@fundinfo_data')->name('fundinfo_data');
    Route::GET('withdawinfo', 'WalletController@withdawinfo')->name('withdawinfo');
    Route::PUT('withdawinfo_update/{id}', 'WalletController@withdawinfo_data')->name('withdawinfo_data');
    Route::PUT('update_support/{id}', 'HomeController@update_support')->name('update_support');
    Route::GET('check_pool','MoneyController@check_pool')->name('check_pool');
    Route::GET('settings','AdminSettingsController@index')->name('settings');
    Route::PUT('save/settings','AdminSettingsController@savesettings')->name('savesettings');
    
    Route::get('/admin_enquiries', 'HomeController@admin_enquiries')->name('admin_enquiries');
    Route::PUT('update_enquiries/{id}', 'HomeController@update_enquiries')->name('update_enquiries');
    Route::POST('/get_enquiries_status', 'HomeController@get_enquiries_status')->name('get_enquiries_status');
    
    
    
    Route::POST('/send_loyality', 'HomeController@send_loyality')->name('send_loyality');
    Route::get('/admin_loyality', 'HomeController@admin_loyality')->name('admin_loyality');
});

