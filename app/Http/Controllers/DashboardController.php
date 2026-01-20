<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Enquiry;
use App\Models\VisaCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $totalVisaCategory  = VisaCategory::count();
        $enquiries = \App\Models\Enquiry::latest()->take(5)->get();
        $appointments = \App\Models\AppointmentRequest::with(['preferredtime', 'consultationmethod'])
            ->latest()
            ->take(5)
            ->get();
        $data = [
            'total_visa_count' => $totalVisaCategory,
            'total_enquiry' => $enquiries,
            'total_appointment' => $appointments
        ];

        return view('dashboard', compact('data'));
    }

    public function dashboardNew()
    {
        $totalVisaCategory = VisaCategory::count();
        $enquiry = Enquiry::letest()->take(5)
        ->get();
        $appointmentlist = AppointmentRequest::with('prederredtime', 'consultationmethod')->letest()->take(5)->get();
        $data = [
            'total_visa_count'  => $totalVisaCategory,
            'total_enquiry' => $enquiry,
            'total_appointment' => $appointmentlist,
        ];
        return view('admin.appointment-list',compact('data'));
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
