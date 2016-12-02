<?php

namespace App\Http\Middleware\User;

use App\Services\UserServiceInterface;
use Closure;

class Authenticate
{
    /** @var UserServiceInterface */
    protected $userService;

    /**
     * Create a new filter instance.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->userService->isSignedIn()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                $query = http_build_query([
                    'client_id'     => \Config::get('oauth.client_id'),
                    'redirect_uri'  => \Config::get('oauth.consumer.callback'),
                    'response_type' => 'code',
                    'scope'         => '',
                ]);

                return redirect(\Config::get('oauth.provider.authorize') . '?' . $query);
            }
        }
        view()->share('authUser', $this->userService->getUser());

        return $next($request);
    }
}
