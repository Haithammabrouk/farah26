<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Display settings page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::all()->groupBy('group');

        return view('adminPanel.settings.index', compact('settings'));
    }

    /**
     * Update settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            if ($setting) {
                // Handle boolean values
                if ($setting->type === 'boolean') {
                    $value = $request->has($key) ? '1' : '0';
                }

                $setting->update(['value' => $value]);

                // Clear cache for this setting
                Cache::forget("setting_{$key}");
            } else {
                // Create new setting if it doesn't exist
                Setting::create([
                    'key' => $key,
                    'value' => $value,
                    'label' => ucwords(str_replace('_', ' ', $key)),
                    'type' => 'text',
                    'group' => 'general'
                ]);
            }
        }

        return redirect()->route('adminPanel.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}
