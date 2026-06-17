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

// Courses
Route::delete(
    'courses/destroy',
    'CoursesController@massDestroy'
)->name('courses.massDestroy');

Route::resource('courses', 'CoursesController');    

// Subjects
Route::delete('subjects/destroy','SubjectsController@massDestroy')->name('subjects.massDestroy');

Route::resource('subjects','SubjectsController');

// Faculty Members
Route::delete('faculty-members/destroy','FacultyMembersController@massDestroy')->name('faculty-members.massDestroy');

Route::resource('faculty-members','FacultyMembersController');

// Student Activities
Route::delete('student-activities/destroy','StudentActivitiesController@massDestroy')->name('student-activities.massDestroy');

Route::resource('student-activities','StudentActivitiesController');

// Academic Calendars
Route::delete('academic-calendars/destroy','AcademicCalendarsController@massDestroy')->name('academic-calendars.massDestroy');

Route::resource('academic-calendars','AcademicCalendarsController');

// Syllabus Documents
Route::delete('syllabus-documents/destroy','SyllabusDocumentsController@massDestroy')->name('syllabus-documents.massDestroy');

Route::resource('syllabus-documents','SyllabusDocumentsController');
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
Route::get('/courses', [\App\Http\Controllers\Frontend\AcademicController::class, 'courses'])->name('frontend.courses');
Route::get('/departments', [\App\Http\Controllers\Frontend\AcademicController::class, 'departments'])->name('frontend.departments');
Route::get('/departments/{subject:slug}', [\App\Http\Controllers\Frontend\AcademicController::class, 'departmentDetail'])->name('frontend.departments.show');



Route::get('/faculty/{slug}', [\App\Http\Controllers\Frontend\FacultyController::class, 'show'])
    ->name('frontend.faculty.show');

Route::get('/activities', [\App\Http\Controllers\Frontend\StudentActivityController::class, 'index'])
    ->name('frontend.activities.index');

Route::get('/activities/{slug}', [\App\Http\Controllers\Frontend\StudentActivityController::class, 'show'])
    ->name('frontend.activities.show');

Route::get('/academic-calendar', [\App\Http\Controllers\Frontend\AcademicCalendarController::class, 'index'])
    ->name('frontend.academic-calendar.index');

Route::get('/syllabus', [\App\Http\Controllers\Frontend\SyllabusController::class, 'index'])
    ->name('frontend.syllabus.index');

Route::get('/syllabus/{slug}', [\App\Http\Controllers\Frontend\SyllabusController::class, 'show'])
    ->name('frontend.syllabus.show');
