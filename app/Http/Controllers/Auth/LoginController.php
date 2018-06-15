<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;

class LoginController extends Controller
{

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, $this->rules());

        $user = $this->attemptLogin( $request );

        if ( false !== $user ) {

            event( new Login( $user, false ) );

            return $user;
        }

        event( new Failed( null, $request->only('email', 'password') ) );

        return response('Unauthorized.', 401);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->input('email') )->first();

        if ( ! $user ) {
            return false;
        }

        if ( Hash::check( $request->input('password'), $user->password ) ) {
            return $user;
        }

        return false;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'email'      => 'required|string|email',
            'password'   => 'required|string',
        ];
    }

}
