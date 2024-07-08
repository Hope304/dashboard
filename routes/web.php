<?php

use Illuminate\Support\Facades\Route;

Route::get("/Hotspot", "GetHotspotController@getHotspot");
Route::get("/", "HomeController@getHome");
Route::get("/GioiThieu", "HomeController@getGioiThieu");
Route::get("/CanhBaoChayRung", "HomeController@getCanhBaoChayRung");
Route::get("/CanhBaoChayRung-iframe", "HomeController@getCanhBaoChayRung_iframe");
Route::get("/GiamSatRung", "HomeController@getGiamSatRung");


/* Thống kê, báo cáo */
Route::get("/ThongKeBaoCao", "HomeController@getThongKeBaoCao");
Route::get("/ThongKeBaoCao/bieu1/{region}/{regionCode}", "Bieu1@getData");
Route::get("/ThongKeBaoCao/bieu2/{region}/{regionCode}", "Bieu2@getData");
Route::get("/ThongKeBaoCao/bieu3/{region}/{regionCode}", "Bieu3@getData");
Route::get("/ThongKeBaoCao/bieu4/{region}/{regionCode}", "Bieu4@getData");
Route::get("/ThongKeBaoCao/bieu5/{region}/{regionCode}", "Bieu5@getData");
Route::get("/ThongKeBaoCao/bieu6/{region}/{regionCode}", "Bieu6@getData");
Route::get("/ThongKeBaoCao/bieu7/{region}/{regionCode}", "Bieu7@getData");

/* Get Region */
Route::get("district/{matinh}", "getRegion@getDistrict");
Route::get("commune/{mahuyen}", "getRegion@getCommune");


Route::get("/HDSD/view", "HomeController@getHDSD");
Route::get("/Download/HTR", "HomeController@DownloadHTR");
Route::get("/Download/PluginQGIS", "HomeController@PluginQGIS");
Route::get("/Download/AppMobile", "HomeController@DownloadAppMobile");
Route::get("/LienHe", "HomeController@getLienHe");
Route::post("/LienHe", "HomeController@postLienHe");

/* Quan tri */
Route::get("/Login", "AdminController@getLogin");
Route::post("/Login", "AdminController@postLogin");

/* Forgot Password and Reset */
Route::get("/ForgotPassword", "AdminController@getForgotPassword");
Route::post("/ForgotPassword", "AdminController@postForgotPassword");
Route::get("resets/{token}", "AdminController@getFormReset");
Route::post("resets/{token}", "AdminController@postFormReset");

/* Main Page Admin */
Route::group(['prefix' => 'admin', 'middleware' => 'Login'], function () {

    /* Home */
    Route::get("/home", "AdminController@getHome");
    //Điều chỉnh cấp cháy
    Route::get('/dieuchinhcapchay', "AdminController@getDieuchinhcapchay");
    Route::post('/dieuchinhcapchay', "AdminController@postDieuchinhcapchay");

    /* Contac */
    Route::get('contact/list', 'ContactController@getList')->middleware('isAdmin');
    Route::get('contact/add', 'ContactController@getAdd')->middleware('isAdmin');
    Route::post('contact/add', 'ContactController@postAdd')->middleware('isAdmin');
    Route::get('contact/edit/{id}', 'ContactController@getEdit')->middleware('isAdmin');
    Route::post('contact/edit/{id}', 'ContactController@postEdit')->middleware('isAdmin');
    Route::get('contact/delete/{id}', 'ContactController@getDelete')->middleware('isAdmin');

    /* Profile */
    Route::get('logout', 'AdminController@getLogout');
    Route::get('profile/{id}', 'AdminController@getProfile');
    Route::get('profile/edit/{id}', 'AdminController@getEditProfile');
    Route::post('profile/edit/{id}', 'AdminController@postEditProfile');
    Route::get('profile/changepass/{id}', 'AdminController@getEditPass');
    Route::post('profile/changepass/{id}', 'AdminController@postEditPass');

    /* Management Users */
    Route::get('users/list', 'UserController@getList')->middleware('isAdmin');
    Route::get('users/addUser', 'UserController@getAdd')->middleware('isAdmin');
    Route::post('users/addUser', 'UserController@postAdd')->middleware('isAdmin');
    Route::get('users/editUser/{id}', 'UserController@getEdit')->middleware('isAdmin');
    Route::post('users/editUser/{id}', 'UserController@postEdit')->middleware('isAdmin');
    Route::get('users/deleteUser/{id}', 'UserController@getDelete')->middleware('isAdmin');

    /* Management info and receive email */
    Route::get('receiveEmail/list', 'receiveEmailController@getList');
    Route::get('receiveEmail/add', 'receiveEmailController@getAdd');
    Route::post('receiveEmail/add', 'receiveEmailController@postAdd');
    Route::get('receiveEmail/edit/{id}', 'receiveEmailController@getEdit');
    Route::post('receiveEmail/edit/{id}', 'receiveEmailController@postEdit');
    Route::get('receiveEmail/delete/{id}', 'receiveEmailController@getDelete');

    /* Management fire point */
    Route::get('hotspot/list', 'HotspotController@getList');
    Route::get('hotspot/view/{id}', 'HotspotController@getView');
    Route::get('hotspot/delete/{id}', 'HotspotController@getDelete');

    /* Management verify fire point */
    Route::get('notification/list', 'verifyFirePointController@getList');
    Route::get('notification/view/{id}', 'verifyFirePointController@getView');
    Route::get('notification/verify/{id}', 'verifyFirePointController@getVerify');
    Route::get('notification/delete/{id}', 'verifyFirePointController@getDelete');

    /* export data */
    Route::get("exportData/", "ExportController@getExport");
    Route::get("Weather/export", "ExportController@exportWeather");
    Route::get("Hotspot/export", "ExportController@exportHotspot");

    /* Quản lý Shapefile */
    Route::get('shp/', 'ShapefileController@getDanhSach')->middleware('isAdmin');
    Route::get('shp/create', 'ShapefileController@getUpload')->middleware('isAdmin');
    Route::get('shp/bando/{id}', 'ShapefileController@getBando')->middleware('isAdmin');
    Route::post('shp/store', 'ShapefileController@postUpload')->middleware('isAdmin');
    Route::get('shp/use/{id}', 'ShapefileController@getSuDung')->middleware('isAdmin');
    Route::get('shp/download/{id}', 'ShapefileController@getDownload')->middleware('isAdmin');
    Route::post('shp/destroy/{id}', 'ShapefileController@getXoa')->middleware('isAdmin');
    Route::get('shp/approve/{id}', 'ShapefileController@getApprove')->middleware('isAdmin');
    Route::post('shp/refuse/{id}', 'ShapefileController@getRefuse')->middleware('isAdmin');

    /* Backup */
    Route::get('backup/', 'BackUpController@getDanhSach');
    Route::get('backup/restore/{id}', 'BackUpController@getKhoiPhuc')->middleware('isAdmin');
    Route::post('backup/destroy/{id}', 'BackUpController@getXoa')->middleware('isAdmin');

    /*DashBoard*/
    Route::get('dashboard','DashBoardController@getDashBoard');
    Route::get("dashboard/bieu1/{region}/{regionCode}", "Bieu1@getDashBoard");
});

/* AJAX */
Route::get('ajax/getCommune', 'AjaxController@getCommune');
Route::get('ajax/getWeather/{maxa}', 'AjaxController@getWeatherCommune');
Route::get('ajax/getHotspot24h', 'AjaxController@getHotspot24h');
Route::get('ajax/getHistoryHotspot', 'AjaxController@getHistoryHotspot');
Route::post('ajax/verifyHotspot/{id}', 'AjaxController@postVerifyHotspot');

//Route::get('testAPI', 'AjaxController@testAPI');

Route::get("/getWeather", "WeatherController@getIndex");
Route::get("/updateDaily", "WeatherController@updateDaily");
Route::get("/sendEmail", "WeatherController@sendEmail");
Route::get("/updateDBR", "WeatherController@updateDBR");
