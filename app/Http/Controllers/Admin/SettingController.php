<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        return view('admin.settings.index');
    }

    public function store(Request $request) {
        $settings = AdminSetting::first();

        if ($settings) {
            $settings->update([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'page_title' => $request->page_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
            ]);
            return redirect()->back()->with('message', 'Setting updated');
        } else {
            AdminSetting::create([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'page_title' => $request->page_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
            ]);
            return redirect()->back()->with('message', 'Setting created');
        }
    }
}
