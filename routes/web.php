<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
 
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // College Profile
Route::get('college-profile','CollegeProfileController@index')->name('college-profiles.index');

Route::post('college-profile/update','CollegeProfileController@update')->name('college-profiles.update');

// Principal Message
Route::get('principal-message','PrincipalMessageController@index')->name('principal-messages.index');

Route::post('principal-message/update','PrincipalMessageController@update')->name('principal-messages.update');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});


Route::get('/about',[\App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('frontend.about');
Route::get('/mission',[\App\Http\Controllers\Frontend\AboutController::class, 'mission'])->name('frontend.mission');
Route::get('/principal',[\App\Http\Controllers\Frontend\AboutController::class, 'principal'])->name('frontend.principal');
Route::get('/college',[\App\Http\Controllers\Frontend\AboutController::class, 'college'])->name('frontend.college');