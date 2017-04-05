<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Repositories\Contracts\UserRepositoryInterface;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->userRepository = $userRepository;
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }

        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);

        return redirect()->route('home');
    }

    public function findOrCreateUser($facebookUser)
    {
        $authUser = $this->userRepository->findUser($facebookUser->id)->first();

        if ($authUser) {
            return $authUser;
        }

        try {
            return $this->userRepository->create([
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' => $facebookUser->id,
                'avatar' => $facebookUser->avatar,
                'password' => '',
            ]);
        } catch (Exception $e) { 
            return redirect('auth/facebook');
        }
    } 
}
