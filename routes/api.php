    <?php

    use Illuminate\Http\Request;
    use App\Http\Controllers\Api;

    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

 
use App\Http\Controllers\Api\VisaController;

Route::get('/visa-category-list', [VisaController::class, 'visa_category_list']);
Route::get('/visa-category-details/{id}', [VisaController::class, 'visa_category_details']);
Route::get('/visa-sub-category-details/{sub_category_id}', [VisaController::class, 'visa_sub_category_details']);


