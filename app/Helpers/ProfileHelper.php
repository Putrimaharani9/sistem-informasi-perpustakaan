<?php

if (!function_exists('getProfilePicture')) {
    /**
     * Get user profile picture, return default value if has't been set
     */
    function getProfilePicture()
    {
        $user = auth()->user();
        return $user->profile_picture ? '/storage/' . $user->profile_picture : '/img/undraw_profile.svg';
    }
}
