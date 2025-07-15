<?php

use App\Models\Setting;

if (!function_exists('getSetting')) {
    /**
     * Get setting value, return current value or default value if hasn't been set, null if not found
     * @param string $key
     */
    function getSetting($key)
    {
        $setting = Setting::where(['key' => $key])->first();

        if ($setting) {
            return $setting->value ?? $setting->default_value;
        }

        return null;
    }
}
