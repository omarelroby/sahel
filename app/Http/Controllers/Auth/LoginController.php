<?php
namespace App\Http\Controllers\Auth;
 use App\Http\Controllers\Controller;
 use App\Models\User;
 use Illuminate\Http\Request;

 class LoginController extends Controller
{
    public function get() {
        return view('auth.login');
    }
    public function register() {
        return view('auth.register');
    }
    public function register_save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email', // Optional, but ensure it's a string
            'password' => 'required|required_with:password_confirm|min:6',
            'password_confirm' => 'required|required_with:password|min:6|same:password',
        ], [
            'password.required_with' => 'The password field is required when old password is provided.',
            'password_confirm.required_with' => 'The password confirmation is required when old password is provided.',
            'password_confirm.same' => 'The password confirmation does not match.',
        ]);
        $user=new User();
        $user->name=trim($request->input('name'));
        $user->email=trim($request->input('email'));
        $user->password=trim(bcrypt($request->input('password')));
        $user->save();
        return redirect('login')->with('success', 'You have been registered successfully.');
    }

    public function post() {
        $this->validate(request(),[
            'email' => 'required|email|max:225',
            'password' => 'required|string|max:191',
        ]);
        $user = User::getSingle();
        if (empty($user)) {
            return back()->with('error','المستخدم غير موجود');
        }
        $checkLogin=User::CheckLogin();
        if (empty($checkLogin)){
            session()->flash('error','البيانات غير صحيحة');
            return redirect('login');
        }
        return redirect('/home');
    }

    public function logout ()
    {
        auth()->guard('web')->logout();
        return redirect('login');
    }
}
