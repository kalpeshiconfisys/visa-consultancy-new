<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\CompanyAdvantage;
use App\Models\ConsultationMethod;
use App\Models\Enquiry;
use App\Models\PreferredTime;
use App\Models\VisaCategory;
use App\Models\VisaSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class VisaController extends Controller
{
    public function visa_category_list()
    {
        $visaCategories  = VisaCategory::with('sub_category')->where('publish_is', 2)->latest()->get();
        return $this->success(true, 'Visa Category Data retrieved successfully!', $visaCategories);
    }

    public function visa_category_details($randomId)
    {
        // $decoded = base64_decode($randomId);
        // if (!str_contains($decoded, '|')) {
        //     return $this->error('Invalid ID');
        // }
        // [$id, $salt] = explode('|', $decoded);
        $visaCategory = VisaCategory::with([
            'main_table_of_content',
            'sub_category.table_of_content'
        ])->where('publish_is', 2)->where('id', $randomId)->first();

        if (empty($visaCategory)) {
            return $this->error('Data Not found');
        }

        return $this->success(true, 'Visa Category Details Data retrieved successfully!', $visaCategory);
    }

    public function visa_sub_category_details($randomId)
    {
        // $decoded = base64_decode($randomId);
        // if (!str_contains($decoded, '|')) {
        //     return $this->error('Invalid ID');
        // }
        // [$id, $salt] = explode('|', $decoded);

        $visaSubCategories  = VisaSubCategory::with('table_of_content')
            ->where('id', $randomId)
            ->where('publish_is', 2)
            ->first();

        if (empty($visaSubCategories)) {
            return $this->error('Data Not found');
        }
        return $this->success(true, 'Visa Sub Category Data retrieved successfully!', $visaSubCategories);
    }

    public function enquiryAdd(Request $request)
    {
        $validator =   Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'visa_type' => 'required|string|max:255',
            'message'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }


        $visaCheck = VisaCategory::where('id',$request->visa_type)->first();

        if(!$visaCheck){
            return $this->error('Visa Category id invalid !');
        }
        $input = [
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'visa_id' => $request->visa_type,
            'message'   => $request->message
        ];

        Enquiry::create($input);
        return $this->success(true, 'Enquiry submitted successfully!', []);
    }

    public function preferredTime(Request $request)
    {
         $preferredTime = PreferredTime::all();
        return $this->success(true, 'Enquiry submitted successfully!', $preferredTime);
    }
    public function consultationMethod(Request $request)
    {
         $consultationMethod = ConsultationMethod::all();
        return $this->success(true, ' Consultation Method successfully!', $consultationMethod);
    }

    public function appointmentRequest(Request $request)
    {
        $validator =   Validator::make($request->all(), [
           'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // 'phone' => 'nullable|string|max:20',
            'preferred_date' => 'nullable|date_format:Y-m-d',
            'preferred_time_id' => 'nullable|exists:preferred_time,id',
            'consultation_method_id' => 'nullable|exists:consultation_methods,id',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }


        $input = [
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'preferred_date' => $request->preferred_date
            ? Carbon::createFromFormat('Y-m-d', $request->preferred_date)->format('Y-m-d')
            : null,
            'preferred_time_id'   => $request->preferred_time_id,
            'consultation_method_id'   => $request->consultation_method_id,
            'message'   => $request->message,
        ];

        AppointmentRequest::create($input);

        return $this->success(true, 'Appointment Request submitted successfully!', []);
    }

    public function companyAdvantages(Request $request)
    {
         $data = CompanyAdvantage::all();
        return $this->success(true, 'Data successfully!', $data);
    }
    
}
