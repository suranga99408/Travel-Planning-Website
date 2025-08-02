<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

// 👇 Add this trait manually if needed
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirect after login
    protected $redirectTo = '/admin/dashboard';

    // Show admin login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Login logic
    public function login(Request $request)
    {
        // ✅ Use Validator Facade instead of $this->validate()
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Or if validate() still not working, you can do this:
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Also check if user is admin
        $credentials['is_admin'] = true;

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials or not an admin']);
    }

    // Logout admin
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/admin/login');
    }
}