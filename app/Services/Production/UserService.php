<?php

namespace App\Services\Production;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserPasswordResetRepositoryInterface;
use App\Services\UserServiceInterface;

class UserService extends AuthenticatableService implements UserServiceInterface
{
    const ACCESS_TOKEN_SESSION = 'token-session-key';
    const USER_SESSION         = 'user-key';

    /** @var string $resetEmailTitle */
    protected $resetEmailTitle = 'Reset Password';

    /** @var string $resetEmailTemplate */
    protected $resetEmailTemplate = 'emails.user.reset_password';

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordResetRepositoryInterface $userPasswordResetRepository
    ) {
        $this->authenticatableRepository = $userRepository;
        $this->passwordResettableRepository = $userPasswordResetRepository;
    }

    protected function getGuardName()
    {
        return 'users';
    }

    public function getUser() {
        $user  = \Session::get(self::USER_SESSION, NULL);
        return $user;
    }

    public function isSignedIn() {
        $accessToken = \Session::get(self::ACCESS_TOKEN_SESSION, NULL);
        $user        = \Session::get(self::USER_SESSION, NULL);
        return (!is_null($accessToken) && !is_null($user));
    }

    public function signInByOauth($accessToken) {
        \Session::put(self::ACCESS_TOKEN_SESSION, $accessToken);

        $http = new \GuzzleHttp\Client;

        $response = $http->get(\Config::get('oauth.provider.api_user'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken['access_token'],
            ],
        ]);
        $user = json_decode((string) $response->getBody());
        \Session::put(self::USER_SESSION, $user);
        return $user;
    }
}
