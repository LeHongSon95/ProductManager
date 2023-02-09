<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Models\Password_reset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class UsersAuthController extends Controller
{

    /**
     * Write code on Method
     * 
     * @param
     * 
     * @return view()
     */
    public function index()
    {
        return view('users.auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {


        $credentials = $request->only('user_name', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return view('users.auth.dashboard');
        }
        return redirect()->route("user.login")->withSuccess(trans('Oppes! You have entered invalid credentials'));
    }


    /**
     * Write code on Method
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return view()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect()->route("user.dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {


        return view('users.auth.dashboard');
    }

    /**
     * Write code on Method
     * 
     * @param array $data
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     * 
     * 
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect()->route('user.login');
    }

    /**
     * Write code on Method
     * 
     * @param
     * 
     * @return view()
     */
    public function forgotForm()
    {
        return view('users.auth.forgot');
    }

    /**
     * Write code on Method
     * 
     * @param undefined undefined
     * @param \Illuminate\Http\Request $request
     * 
     * @return view()
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = \Str::random(64);
        Password_reset::insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $action_link = route('reset.password.form', ['token' => $token, 'email' => $request->email]);
        $body = "We are received a request to reset the password  for <b> Your app name </b> account associated with" . $request->email .
            ". You can reset your password by clicking the link";

        Mail::send('users.auth.email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('lehongson22051995@gmail.com', 'Your app name');
            $message->to($request->email, "Your name")->subject('Reset password');
        });
        return back()->with('success', trans('We have email your password reset link!'));
    }

    /**
     * Write code on Method
     * 

     * @param \Illuminate\Http\Request $request
     * @param mixed $token
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('users.auth.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    /**
     * Write code on Method
     * 

     * @param \Illuminate\Http\Request $request
     * @param mixed $token
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function resetPassword(ForgotRequest $request)
    {
        $check_token = Password_reset::where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
        if (!empty($check_token)) {
            if(Carbon::parse($check_token->created_at)->addHours(3)->isPast()) {
                return back()->with('error', trans('Tokens expire. Please re-enter your email for the link to change the password'));
            }
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);
            Password_reset::where([
                'email' => $request->email
            ])->delete();
            return redirect()->route('user.login')->with('success', trans('Your password has been changed! You can login with new password'))
                ->with('verifiedEmail', $request->email);
        }
         return redirect()->route('password.forgot')->with('error', trans('Token does not work, please re-enter email'));
    }
}
