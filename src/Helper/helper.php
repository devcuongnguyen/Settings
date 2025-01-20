<?php

use Backpack\Settings\app\Models\Setting;

if (!function_exists('setting')) {
    function setting($key, $fallback = null)
    {
        try {

            $setting = Setting::find($key)->withCacheCooldownSeconds(config('cache.ttl'))->first();

            if (is_null($setting)) return $fallback;

            return $setting->value;
        } catch (\Exception $e) {
            return $fallback;
        }
    }
}