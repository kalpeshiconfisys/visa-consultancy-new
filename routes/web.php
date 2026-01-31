<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Session;
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

Route::get('/admin', function () {
    if (Session::has('admin_id')) {
        return redirect(url('admin/dashboard'));
    }
    return redirect(route('admin.login'));
});


Route::get('/', function () {
    if (Session::has('admin_id')) {
        return redirect(url('admin/dashboard'));
    }
       return redirect(route('admin.login'));
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [Admin\Auth\AuthController::class, 'login'])->name('login');
    Route::post('login', [Admin\Auth\AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/register', [Admin\Auth\AuthController::class, 'register']);
    Route::post('register', [Admin\Auth\AuthController::class, 'registerSubmit'])->name('register.submit');
    Route::get('/logout', [Admin\Auth\AuthController::class, 'logout']);

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class , 'dashboard']);
        Route::resource('visa-category', Admin\VisaCategory\VisaCategoryController::class);
        Route::prefix('visa-category')->group(function () {
            Route::get('list', [Admin\VisaCategory\VisaCategoryController::class, 'index']);
            Route::get('show/{id}',[Admin\VisaCategory\VisaCategoryController::class, 'show']);
            Route::get('create', [Admin\VisaCategory\VisaCategoryController::class, 'create']);
            Route::post('add', [Admin\VisaCategory\VisaCategoryController::class, 'store']);
            Route::get('edit/{id}', [Admin\VisaCategory\VisaCategoryController::class, 'edit']);
            Route::post('update/{id}', [Admin\VisaCategory\VisaCategoryController::class, 'update']);
            Route::delete('delete/{id}', [Admin\VisaCategory\VisaCategoryController::class, 'destroy']);
        });
        Route::resource('visa-sub-category', Admin\VisaCategory\VisaSubCategoryController::class);
        Route::get('/enquiry-list', [DashboardController::class, 'enquiryList']);
        Route::get('/appointment-list', [DashboardController::class, 'appointmentlist']);
        Route::resource('preferred-time', Admin\Appointment\PreferredTimeController::class);
        Route::resource('consultation-method', Admin\Appointment\ConsultationMethodController::class);
        Route::resource('legal-assistance', Admin\LegalAssistance\LegalAssistanceController::class);
        Route::resource('testimonials', Admin\LegalAssistance\TestimonialsController::class);


        Route::get('privacy-policy', [Admin\SettingController::class , 'privacyPolicy']);
        Route::post('privacy-policy-submit', [Admin\SettingController::class , 'privacyPolicySubmit']);

        Route::get('terms-conditions', [Admin\SettingController::class , 'termsAndConditions']);
        Route::post('terms-conditions-submit', [Admin\SettingController::class , 'tearmsAndConditionsSubmit']);

        Route::get('about-us', [Admin\SettingController::class , 'aboutUs']);
        Route::post('about-us-submit', [Admin\SettingController::class , 'aboutUsSubmit']);

        Route::resource('blogs', Admin\Blog\BlogController::class);
        Route::resource('faq', Admin\Faq\FaqController::class);
        Route::resource('country', Admin\Country\CountryController::class);
        Route::resource('coaching', Admin\Coaching\CoachingController::class);
    });

});


Route::get('/admin/forgot-password', function () {
    return view('admin.auth.forgot-password');
});


Route::fallback(function () {
    return response()->view('admin.404', [], 404);
});
