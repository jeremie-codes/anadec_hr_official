<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('can')) {
    function can(string $permission): bool
    {
        return Auth::check() && Auth::user()->hasPermission($permission);
    }
}
