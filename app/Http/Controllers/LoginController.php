<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendLink;
use App\Mail\LinkVerrify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function verified($id)
    {
       $user = User::where('uuid',$id)->first();
       $user->markEmailAsVerified();
       Auth::login($user);
       if ($user->role === "user") {
        return redirect("home")->withSuccess('You have signed-in');
    } {
        return redirect("admin/users")->withSuccess('You have signed-in');
    }
    }
    public function change_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $link = ResetPassword::where('uuid',$id)->first();

        $user = User::where('id',$link->user_id)->first();
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
        Auth::login($user);

            if ($user->role === "user") {
                return redirect("home")->withSuccess('You have signed-in');
            } {
                return redirect("admin/users")->withSuccess('You have signed-in');
            }

    }
    public function reset_password($id)
    {
        $check = ResetPassword::where('uuid',$id)->first();
        $now = Carbon::now();

        $diff = $check->created_at->diffInMinutes($now);
        if($diff <= 60)
        {

            return view('authentication.reset_password');
        }else{
            Session::flash('expired','true');
            return view('authentication.reset_password');
        }


    }
    public function send_link()
    {
        return view('authentication.send_link');
    }
    public function checkEmail(Request $request)
    {
        $check = User::where('email', $request->email)->first();
        if($check)
        {
            $uuid = ResetPassword::query()->create([
                'uuid'=> Str::uuid(),
                'user_id'=> $check->id,
            ]);
            $data = [
                'link'=>'http://127.0.0.1:8000/reset_password/'.$uuid->uuid,

            ];
            Mail::to($check->email)->send(new SendLink($data));
            return redirect('/send_link');
        }else{
            return back()->with('error','true')->withInput();
        }
    }
    public function forgotPassword()
    {
        return view('authentication.forgot');
    }
    public function index()
    {
        return view('authentication.login');
    }
    public function setting()
    {
        return view('clientview.setting');
    }

    public function settingUpdate(Request $request)
    {
       $user = User::where('id', Auth::user()->id)->first();

       $user->update([
        'lastname' => $request->lastname,
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'address' => $request->address,
        'contactnumber' =>$request->contactnumber,
        'email' =>$request->email,
       ]);
       return redirect('/setting')->with('success','Updated Successfully!');
    }
    public function settingUpdatePassword(Request $request)
    {
        // $request->validate([
        //     'password' => 'min:6',
        //     'password_confirmation' => 'required_with:password|same:password|min:6'
        // ]);
        $validate = Validator::make($request->all(), [
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        if( $validate->fails() ){
                return back()->withErrors($validate)->withInput();
        }
        $user = User::where('id', Auth::user()->id)->update([
            'password'=> Hash::make($request->password),
        ]);
        return back()->with('password_success','Updated Successfully!');
    }

    public function adminsSetting()
    {
        return view('users.setting');
    }

    public function adminSettingUpdate(Request $request)
    {
       $user = User::where('id', Auth::user()->id)->first();

       $user->update([
        // 'lastname' => $request->lastname,
        'firstname' => $request->firstname,
        // 'middlename' => $request->middlename,
        'address' => $request->address,
        'contactnumber' =>$request->contactnumber,
        'email' =>$request->email,
       ]);
       return back()->with('success','Updated Successfully!');
    }
    public function adminSettingUpdatePassword(Request $request)
    {
        // $request->validate([
        //     'password' => 'min:6',
        //     'password_confirmation' => 'required_with:password|same:password|min:6'
        // ]);
        $validate = Validator::make($request->all(), [
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        if( $validate->fails() ){
                return back()->withErrors($validate)->withInput();
        }
        $user = User::where('id', Auth::user()->id)->update([
            'password'=> Hash::make($request->password),
        ]);
        return back()->with('password_success','Updated Successfully!');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->username)->first();

            if(!!$user->email_verified_at)
            {

                $token =  $user->createToken(time())->plainTextToken;
                if ($user->role === "user") {
                    return redirect("home")->withSuccess('You have signed-in');
                } {
                    return redirect("admin/users")->withSuccess('You have signed-in');
                }
            }else{
                Auth::logout();
                return redirect("login")->with('error', 'Your email is not verified.');
            }

        }

        return redirect("login")->with('error', 'Incorrect Username or Password');
    }

    public function register()
    {
        return view('authentication.register');
    }

    public function postRegister(Request $request)
    {
        try {
            $request->validate([
                'lastname' => 'required',
                'firstname' => 'required',
                'middlename' => 'required',
                'address' => 'required',
                'contactnumber' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $data = $request->all();
            $User = new User();
            $User->firstname = $request->firstname;
            $User->lastname = $request->lastname;
            $User->middlename = $request->middlename;
            $User->address = $request->address;
            $User->contactnumber = $request->contactnumber;
            $User->username = $request->username;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);
            $User->role = 'user';
            $User->uuid = Str::uuid();
            $User->save();

            // Auth::login($User);
            $data = [
                'link'=>'http://127.0.0.1:8000/verified/'.$User->uuid,
            ];

            Mail::to($request->email)->send(new LinkVerrify($data));
            return redirect("login")->with('successcreate','Check your email '.$request->email.' for the verification link.');

        } catch (ValidationException $e) {
            return redirect()->back()->withInput($request->all())->withErrors($e->errors());
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
