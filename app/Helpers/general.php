<?php

use App\User;
use App\Profile;

function _specialisations()
{
    $users = User::where('role', 'Doctor')->pluck('id');

    return Profile::whereIn('user_id', $users)->pluck('specialisation');
}

function activeUrlClass($route, $class = 'active')
{
    return strpos(Route::currentRouteName(), $route) === 0 ? $class : '';
}