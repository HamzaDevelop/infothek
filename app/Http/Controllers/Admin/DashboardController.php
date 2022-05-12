<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function login($token = null)
    {
        if($token){
            $tokenable = DB::table('personal_access_tokens')->where('token', $token)->first();
            Auth::loginUsingId($tokenable->tokenable_id);
            if (Auth::user()->isAdmin()) {
                return redirect('admin/dashboard');
            }
            if (Auth::user()->isUser()) {
                return redirect('home');
            }
        }
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return redirect('admin/dashboard');
            }
            if (Auth::user()->isUser()) {
                return redirect('home');
            }
        } else {
            return view('auth.login');
        }
    }

    public function register()
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return redirect('admin/dashboard');
            }
            if (Auth::user()->isUser()) {
                return redirect('home');
            }
        } else {
            return view('auth.register');
        }
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'role_id' => 2,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        auth()->login($user);

        return redirect(route('home'))->with('success', 'Welocme Dear ' . $user->name);
    }

    public function index()
    {
        $main_categories = MainCategory::all();
        $sub_categories = SubCategory::all();
        $sub_sub_categories = SubSubCategory::all();

        return view('admin.dashboard', compact('main_categories', 'sub_categories', 'sub_sub_categories'));
    }

    public function update()
    {
        $auth = Auth::user();

        return view('admin.profile.update_profile', compact('auth'));
    }

    public function profileUpdated(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required',Rule::unique('users')->ignore($id)],
            'password' => 'required|confirmed|min:6',
            'old_password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first());
        } else {
            $hashedPassword = Auth::user()->password;
            if (\Hash::check($request->old_password, $hashedPassword)) {
                if (!\Hash::check($request->password, $hashedPassword)) {
                    $user = User::find(Auth::user()->id);
                    $new_password = bcrypt($request->password);
                    $user->update([
                        'email' => $request->email,
                        'password' => $new_password
                    ]);

                    return redirect()->back()->with('success', 'Password updated successfully');
                } else {
                    return redirect()->back()->with('error', 'New password can not be the old password');
                }
            } else {
                return redirect()->back()->with('error', 'Old password does not matched');
            }
        }
    }
}
