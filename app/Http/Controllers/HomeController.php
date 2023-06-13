<?php

namespace App\Http\Controllers;

use App\Models\GeneralInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index(){
        return redirect()->route('dashboard');
    }
    public function login_admin(){
        return view('dashboard.auth.login');
    }
    public function post_login_admin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }
        return redirect()->back()->with(['error'=>'البريد الاكتروني او كلمة المرور غير صحيحة']);

    }
    public function profile(){
        $user = auth()->user();
        return view('dashboard.auth.profile')->with('user',$user);
    }
    public function update_profile(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email'
        ]);
        if($request->password != null){
            $request->validate([
                'password'=>'required',
                'confirm-password'=>'required|same:password'
            ]);
        }
        $admin = User::first();
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password != null){
            $admin->password =bcrypt( $request->password);
        }
        $admin->save();
        return redirect()->back()->with(['success'=>'تم التعديل بنجاح']);

    }
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
    public function dashboard(){
        return view('dashboard.index');
    }
    public function setting(){
        return view('dashboard.setting');
    }
    public function add_general(Request $request)
    {
        if ($request->hasFile('general_file')) {
            foreach ($request->file('general_file') as $name => $value) {
                if ($value == null) {
                    continue;
                }
                GeneralInfo::setValue($name, $value->store('general'));
            }
        }
        if ($request->has('general')) {
            foreach ($request->input('general') as $name => $value) {
                if ($value == null) {
                    continue;
                }
                GeneralInfo::setValue($name, $value);
            }
        }
        return redirect()->back()->with(['success' => 'تم تعديل البيانات بنجاح']);
    }
}
