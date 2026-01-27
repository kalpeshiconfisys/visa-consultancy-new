<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Show form
    public function privacyPolicy()
    {

        $privacy = Setting::where('key', 'privacy_policy')->first();


        return view('admin.settings.privacy-policy', compact('privacy'));
    }
    public function privacyPolicySubmit(Request $request)
    {

        $privacyPolicyValue  = Setting::where('key','privacy_policy')->first();

        if(empty($privacyPolicyValue)){
            Setting::create([
                'key' => 'privacy_policy',
                'value' => $request->privacy_policy
            ]);
        }else{
            Setting::where('key','privacy_policy')->update([
                'value' => $request->privacy_policy
            ]);
        }
        return redirect(url('admin/privacy-policy'))->with('success' , 'updated successfully!');
    }


}
