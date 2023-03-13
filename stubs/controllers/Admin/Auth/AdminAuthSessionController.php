<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthSessionController extends Controller
{

  protected $redirectTo = '/admin/dashboard';

  public function showLoginForm()
  {
    return view('admin.auth.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
      return redirect()->intended(route('admin.dashboard'));
    }

    return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
      'email' => 'These credentials do not match our records.',
    ]);
  }

  /**
   * Destroy an authenticated admin session.
   */
  public function logout(Request $request)
  {
    Auth::guard('admin')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
  }
}
