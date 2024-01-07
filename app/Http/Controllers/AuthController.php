<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function loginIndex() {

        return view('auth.login');

    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'required|string|max:50',
            'password' => 'required|string|min:8'
        ]);

        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($input))
        {
            $role = auth()->user()->role;
            if($role == 'admin')
            {
                session(['link' => '/dashboard-admin']);
                return redirect()->route('admin.index');
            }
            else
            {
                session(['link' => '/dashboard-member']);
                return redirect('/dashboard-member');
            }
        }

        return back()->with('error', 'Email or password is incorrect');
    }

    public function registerIndex() {

        return view('auth.register');

    }

    public function register(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:users,email',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:8|max:50',
            'no_hp' => 'required|string|min:10|max:50',
            'jenis_kelamin' => 'required|string',
            'no_ktp' => 'required|string|min:16|max:50',
            'tanggal_lahir' => 'required|date',
            'foto' => 'required|image|max:1028|mimes:jpg,png,jpeg',
        ]);

        $input = $request->all();

        if($request->hasFile('foto'))
        {
            $file = $request->foto;
            $file_name_custom = 'foto'. '_' . $input['username'] . '_' . rand(1000, 9999) . '.' . $file->extension();
            $path_full = 'foto/' . $file_name_custom;

            Storage::disk('public')->put($path_full, $file->get());

            $input['foto'] = $path_full;
        }

        $input['role'] = 'member';
        $input['password'] = Hash::make($request->password); 

        User::create($input);

        // Auth::attempt(['username' => $input['username'], 'password' =>  $input['password']]);

        return redirect('/');
    }

    public function logout() {

        Auth::logout();
        session()->forget('link');
        session()->flush();

        return redirect()->route('login.index');

    }

}
