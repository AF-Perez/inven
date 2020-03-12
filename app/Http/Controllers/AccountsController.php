<?php

namespace App\Http\Controllers;

use App\Mail\PasswordSetupNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|confirmed'
        ]);

        //check if input is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->latest($column = 'created_at')->first();
       
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
        $user->password = \Hash::make($password);
        $user->ha_establecido_contrasenia = 1;
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        return redirect()->route('home');
        //Send Email Reset Success Email
        // if ($this->sendSuccessEmail($tokenData->email)) {
        //     return view('index');
        // } else {
        //     return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        // }
    }

    public function validatePasswordRequest(Request $request)
    {
        //You can add validation login here
        $user = DB::table('users')->where('email', '=', $request->email)
            ->first();

        //Check if the user exists
        if ($user === null) {
            return redirect()->back()->withErrors(['email' => trans('El usuario no existe')]);
        }

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->latest($column = 'created_at')->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('email', 'nombres', 'apellidos', 'cedula')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = url('password/reset/' . $token . '?email=' . urlencode($user->email));

        try {
            //Here send the link with CURL with an external email API 
            Mail::to( $user->email )
            ->send(new PasswordSetupNotification(
                $user->email,
                $user->nombres,
                $user->apellidos,
                $user->cedula,
                $link,
            ));
            // return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
