<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Fetch the current user
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function currentProfile(Request $request)
    {
        return $request->user();
    }

    /**
     * Update the current user profile
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCurrentProfile(Request $request)
    {
        $this->validate($request, $this->rules());

        $user = $request->user();
        $user->update($request->only('first_name', 'last_name', 'email'));

        return $user;
    }

    /**
     * Update the current user password
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current'  => 'required|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user     = $request->user();
        $current  = $request->input('current');
        $password = $request->input('password');

        if ( Hash::check( $current, $user->password ) ) {
            $user->update([
                'password'  => Hash::make( $password ),
                'api_token' => str_random(32),
            ]);
        } else {
            return response()->json(['password' => ['Current password does not match']], 422);
        }

        return $user;
    }

    /**
     * Get a validator for an incoming profile update request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:80',
            'last_name'  => 'required|string|max:80',
        ];
    }

}
