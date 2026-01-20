<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function enquiryList(){
        $enquiry = Enquiry::with('visa_category')->latest()->paginate(10);
        return view('admin.enquiry-list',compact('enquiry'));
    }
    public function appointmentlist(){
        $appointmentlist = AppointmentRequest::with(['preferredtime','consultationmethod'])->latest()->paginate(10);
        return view('admin.appointment-list',compact('appointmentlist'));
    }
}
