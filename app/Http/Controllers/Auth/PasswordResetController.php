<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->broker()->sendResetLink( $request->only('email' ) );

        return response()->json([ 'success' => true ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        if ( $response == Password::PASSWORD_RESET ) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     *
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();

        event(new PasswordReset($user));

        return $user;
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    protected function broker()
    {
        return Password::broker('users');
    }

}
