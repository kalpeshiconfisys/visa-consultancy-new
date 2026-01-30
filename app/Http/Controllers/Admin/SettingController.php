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
    public function  termsAndConditions()
    {

        $tearms = Setting::where('key', 'terms_conditions')->first();


        return view('admin.settings.terms_conditions', compact('tearms'));
    }
    public function tearmsAndConditionsSubmit(Request $request)
    {

        $privacyPolicyValue  = Setting::where('key','terms_conditions')->first();

        $mainContent = $this->processEditorImages($request->terms_conditions, $request);
        if(empty($privacyPolicyValue)){
            Setting::create([
                'key' => 'terms_conditions',
                'value' => $mainContent
            ]);
        }else{
            Setting::where('key','terms_conditions')->update([
                'value' => $mainContent
            ]);
        }
        return redirect(url('admin/terms-conditions'))->with('success' , 'updated successfully!');
    }

    public function  aboutUs()
    {

        $about = Setting::where('key', 'about_us')->first();


        return view('admin.settings.about_us', compact('about'));
    }
    public function aboutUsSubmit(Request $request)
    {

        $privacyPolicyValue  = Setting::where('key','about_us')->first();

        $mainContent = $this->processEditorImages($request->about_us, $request);
        if(empty($privacyPolicyValue)){
            Setting::create([
                'key' => 'about_us',
                'value' => $mainContent
            ]);
        }else{
            Setting::where('key','about_us')->update([
                'value' => $mainContent
            ]);
        }
        return redirect(url('admin/about_us'))->with('success' , 'updated successfully!');
    }


    function processEditorImages($html, $request)
    {
        $content = html_entity_decode($html ?? '');
        $pattern = '/<img[^>]+src="data:image\/([^;]+);base64,([^"]+)"[^>]*>/i';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $imageFormat = strtolower($match[1]);
            $base64Image = $match[2];
            $allowed = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            if (!in_array($imageFormat, $allowed)) {
                continue;
            }
            $imageData = base64_decode($base64Image);
            if ($imageData === false) {
                continue;
            }
            $filename = 'image_' . uniqid() . '.' . $imageFormat;
            $destinationPath = public_path('uploads/content_img');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            file_put_contents($destinationPath . '/' . $filename, $imageData);
            $publicImageUrl = $request->getSchemeAndHttpHost() . '/uploads/content_img/' . $filename;
            $content = str_replace(
                'data:image/' . $imageFormat . ';base64,' . $base64Image,
                $publicImageUrl,
                $content
            );
        }
        return $content;
    }



}
