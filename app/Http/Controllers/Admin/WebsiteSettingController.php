<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateWebsiteSettingRequest;
use App\Http\Requests\Admin\UpdateWebsiteSettingRequest;
use App\Models\WebsiteSetting;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        return view('admin.website-settings.index');
    }

    public function detail(WebsiteSetting $websiteSetting)
    {
        return view('admin.website-settings.detail')
            ->with('websiteSetting', $websiteSetting);
    }

    public function createPage()
    {
        return view('admin.website-settings.create');
    }

    public function create(CreateWebsiteSettingRequest $request)
    {
        $setting = new WebsiteSetting;
        $setting->key = $request->get('key');
        $setting->value = $request->get('value');
        $setting->save();

        return redirect()->route('administration.websiteSetting.detail', $setting->id);
    }

    public function update(WebsiteSetting $websiteSetting, UpdateWebsiteSettingRequest $request)
    {
        $websiteSetting->key = $request->get('key');
        $websiteSetting->value = $request->get('value');
        $websiteSetting->save();

        return redirect()->route('administration.websiteSetting.detail', $websiteSetting->id);
    }
}
