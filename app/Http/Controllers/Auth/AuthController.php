<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Đăng nhập
    public function showFormLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $user = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($user)) {
            // Kiểm tra nếu là admin thì chuyển hướng tới trang admin
            if (Auth::user()->role === User::ROLE_ADMIN) {
                return redirect()->intended('/admin');
            }

            if (Auth::attempt($user)) {
                // Kiểm tra URL chuyển hướng trong session
                $redirectUrl = $request->input('redirect_url') ?? session()->pull('redirect_url', '/');
                return redirect()->intended($redirectUrl);
            }

            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Thông tin người dùng không đúng'
        ]);
    }

    // Đằng ký
    public function showFormRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ['required', 'string', 'min:8'],
            're_enter_password' => ['required', 'string', 'min:8', 'same:password'],
        ]);

        $user = User::query()->create($data);

        Auth::login($user);

        return redirect()->intended('/');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng
        $request->session()->invalidate(); // Hủy phiên hiện tại
        $request->session()->regenerateToken(); // Tạo lại token CSRF mới

        return redirect('/login'); // Chuyển hướng người dùng đến trang đăng nhập
    }


    //qmk
    public function showForgotPasswordForm()
    {
        return view('auth.passwords.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $user = User::whereEmail($request->input('email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We cannot find a user with that email address.']);
        }

        Password::sendResetLink($user);

        return back()->with('status', 'We have sent a password reset link to your email address.');
    }

    //reset mk
    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::whereEmail($request->input('email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We cannot find a user with that email address.']);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('login')->with('status', 'Your password has been reset!');
    }


    //facebock
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // Bạn có thể sử dụng đối tượng $user để xác thực người dùng
        // Ví dụ, bạn có thể tạo một người dùng mới hoặc đăng nhập một người dùng hiện có
        // ...

        return redirect()->route('home');
    }

}
