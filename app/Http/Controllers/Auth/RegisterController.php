<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'language' => $data['language']
        ]);
    }

    protected function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->passes()) {
            $data = $this->create($input)->toArray();
            $data['token_confirm'] = str_random(25);
            $user = $this->userRepository->find($data['id']);
            $user->token_confirm = $data['token_confirm'];
            $user->save();

            try {
                Mail::send('mails.confirm', $data, function ($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject('Registration confirm');
                });

                return redirect(route('login'))->with('status', trans('auth.confirm'));
            } catch (Exception $e) {
                return redirect(route('login'));
            }
        }

        return redirect(route('login'))->with('status', $validator->errors());
    }

    public function confirmation($tokenConfirm)
    {
        $user = $this->userRepository->confirmation($tokenConfirm)->first();

        if (!is_null($user)) {
            $user->confirmed = $this->userRepository->confirmed();
            $user->token_confirm = '';
            $user->save();
            
            return redirect(route('login'))->with('status', trans('auth.completed'));
        }

        return redirect(route('login'))->with('status', trans('auth.wrong'));
    }
}
