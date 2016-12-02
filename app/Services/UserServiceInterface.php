<?php

namespace App\Services;

interface UserServiceInterface extends AuthenticatableServiceInterface
{
    /**
     * [signInByOauth sigin by using an OAuth Provider server
     * @param  [array] $accessToken [get from OAuth Provider]
     * @return [\App\Models\User] $user
     */
    public function signInByOauth($accessToken);
}
