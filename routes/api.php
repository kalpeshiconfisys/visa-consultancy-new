    <?php

    use Illuminate\Http\Request;
    use App\Http\Controllers\Api;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\VisaController;


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/visa-category-list', [VisaController::class, 'visa_category_list']);
    Route::get('/visa-category-details/{id}', [VisaController::class, 'visa_category_details']);
    Route::get('/visa-sub-category-details/{sub_category_id}', [VisaController::class, 'visa_sub_category_details']);
    Route::post('/enquiry-add', [VisaController::class, 'enquiryAdd']);
    Route::get('/preferred-time', [VisaController::class, 'preferredTime']);
    Route::get('/consultation-method', [VisaController::class, 'consultationMethod']);
    Route::post('/appointment-request', [VisaController::class, 'appointmentRequest']);
    Route::get('/company-advantages', [VisaController::class, 'companyAdvantages']);
