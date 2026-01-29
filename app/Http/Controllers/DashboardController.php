<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Blog;
use App\Models\Coaching;
use App\Models\CompanyAdvantage;
use App\Models\ConsultationMethod;
use App\Models\Country;
use App\Models\Enquiry;
use App\Models\PreferredTime;
use App\Models\VisaCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $totalVisaCategory  = VisaCategory::count();
        $blog  = Blog::count();
        $country  = Country::count();
        $coaching  = Coaching::count();
        $enquiries = \App\Models\Enquiry::latest()->take(5)->get();
        $appointments = \App\Models\AppointmentRequest::with(['preferredtime', 'consultationmethod'])
            ->latest()
            ->take(5)
            ->get();
        $data = [
            'total_visa_count' => $totalVisaCategory,
            'total_blog' => $blog,
            'total_country' => $country,
            'total_coaching' => $coaching,
            'total_enquiry' => $enquiries,
            'total_appointment' => $appointments
        ];

        return view('dashboard', compact('data'));
    }


    public function enquiryList()
    {
        $enquiry = Enquiry::with('visa_category')->latest()->paginate(10);
        return view('admin.enquiry-list', compact('enquiry'));
    }

    public function appointmentlist()
    {
        $appointmentlist = AppointmentRequest::with(['preferredtime', 'consultationmethod'])->latest()->paginate(10);
        return view('admin.appointment-list', compact('appointmentlist'));
    }
}
