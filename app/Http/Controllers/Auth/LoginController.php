<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;

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
     *
     */





    protected $redirectTo = '/home/page';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }


    public function findUsername()
    {
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }


    public function username()
    {
        return $this->username;
    }


    protected function authenticated(Request $request, $user)
    {
        $status = Auth::user()->status;
        if($status == '0'){
            session()->flash('error','Account Blocked');
            return view('auth.login');

        }

    }


    protected function login(Request $request)
    {
        session_start();
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/company-admins/login', [
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'password'          => $request->password,
                    'email'             => $request->login,
                ],

            ]);

            $rec =  $result->getBody()->getContents();
            $response = json_decode($rec);

            $accessToken = $response->model->token->access_token;
            $_SESSION["token"] = $accessToken;
            $this->validateLogin($request);
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                return $this->sendLockoutResponse($request);
            }
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);

        }
        catch (\Exception $e){
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return view('auth.login');
            }

            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return view('auth.login');
            }

            if($e->getCode() == 401){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return view('auth.login');
            }



            session()->flash('error','Contact Support:'.$e->getMessage());
            return view('auth.login');
        }
    }


}
