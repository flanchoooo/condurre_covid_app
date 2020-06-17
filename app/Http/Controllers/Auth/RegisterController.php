<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


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
    protected $redirectTo = 'register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string'
           ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
        return User::create([
            'name' => $data['name'].' '.$data['lastname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function register(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->post('http://144.91.64.120:35600/api/company-admins', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => [
                    'Content-type' => 'application/json'
                ],
                'json' => [
                    'company_id'            => 81,
                    'first_name'            => $request->name,
                    'middle_names'          => $request->name,
                    'last_name'             => $request->lastname,
                    'email'                 => $request->email,
                    'password'              => $request->password,
                ],
            ]);
            //$rec =  $result->getBody()->getContents();
           // $response = json_decode($rec);
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
            session()->flash('registration_notification',  'User Account successfuly created.');
            return  redirect('/register');
        }
        catch (\Exception $e){
            session()->flash('registration_notification',  $e->getMessage());
            return  redirect('/register');
        }
    }

}
