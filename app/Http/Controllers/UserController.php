<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',  // password confirmation
        ]);

        if ($validator->fails()) {
            return redirect()->route('signupForm')->with(['errors' => $validator->errors()]);
        }

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // return User::create($request->all());
        return redirect()->route('users.index');
    }

    public function renderLogin()
    {
        if (Auth::user()) return redirect()->route('products.index');
        return view('login');
    }
    public function renderSignup()
    {
        if (Auth::user()) return redirect()->route('products.index');
        return view('signup');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate login credentials
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->isadmin) {
                return redirect()->route('users.index'); // Redirect admin to users management
            }

            return redirect()->route('products.index');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function create() {
        return view('users.create');
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        if ($request->password) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('user', 'email')->ignore($id),
                ],
                'address' => 'required|string|max:255',
                'password' => 'string|min:8|confirmed',  // password confirmation
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('user', 'email')->ignore($id),
                ],
                'address' => 'required|string|max:255',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->with(['errors' => $validator->errors()]);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->isadmin = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(int $id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm')->with('status', 'Logged out successfully.');
    }
}
