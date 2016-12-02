<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignUpRequest;
use App\Services\UserServiceInterface;
use App\Http\Requests\User\SignInRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /** @var \App\Services\UserServiceInterface UserService */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function getSignIn()
    {
        return view('pages.user.auth.signin', [
        ]);
    }

    public function postSignIn(SignInRequest $request)
    {
        $user = $this->userService->signIn($request->all());
        if (empty($user)) {
            return redirect()->action('User\AuthController@getSignIn');
        }

        return redirect()->intended(action('User\IndexController@index'));
    }

    public function getSignUp()
    {
        return view('pages.user.auth.signup', [
        ]);
    }

    public function postSignUp(SignUpRequest $request)
    {
        $user = $this->userService->signUp($request->all());
        if (empty($user)) {
            return redirect()->action('User\AuthController@getSignUp');
        }

        return redirect()->intended(action('User\IndexController@index'));
    }

    public function index() {
        return view('pages.user.auth.index', [
        ]);
    }

    public function oauthCallback(Request $request) {
        $http = new \GuzzleHttp\Client;

        $response = $http->post(\Config::get('oauth.provider.token'), [
            'form_params' => [
                'client_id'     => \Config::get('oauth.client_id'),
                'client_secret' => \Config::get('oauth.client_secret'),
                'grant_type'    => \Config::get('oauth.grant_type'),
                'redirect_uri'  => \Config::get('oauth.consumer.callback'),
                'code'          => $request->code,
            ],
        ]);
        $accessToken = json_decode((string) $response->getBody(), true);

        if (is_null($accessToken)) {
            return redirect()->action('User\AuthController@getSignIn');
        }
        $this->userService->signInByOauth($accessToken);
        return redirect()->action('User\AuthController@index');
    }
}
