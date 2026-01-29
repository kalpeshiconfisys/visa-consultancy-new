    <?php

    use Illuminate\Http\Request;
    use App\Http\Controllers\Api;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\FrontController;


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/visa-category-list', [FrontController::class, 'visa_category_list']);
    Route::get('/visa-category-details/{id}', [FrontController::class, 'visa_category_details']);
    Route::get('/visa-sub-category-details/{sub_category_id}', [FrontController::class, 'visa_sub_category_details']);
    Route::post('/enquiry-add', [FrontController::class, 'enquiryAdd']);
    Route::get('/preferred-time', [FrontController::class, 'preferredTime']);
    Route::get('/consultation-method', [FrontController::class, 'consultationMethod']);
    Route::post('/appointment-request', [FrontController::class, 'appointmentRequest']);
    Route::get('/company-advantages', [FrontController::class, 'companyAdvantages']);
    Route::get('/our-teams', [FrontController::class, 'ourTeams']);
    Route::get('/privacy-policy', [FrontController::class, 'privacyPolicy']);
    Route::get('/blogs', [FrontController::class, 'blogs']);
    Route::get('/faq', [FrontController::class, 'faq']);
    Route::get('/country', [FrontController::class, 'country']);
    Route::get('/coaching', [FrontController::class, 'coaching']);

