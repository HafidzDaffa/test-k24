<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('role', '=', 'member')
        ->where(function ($query) use ($search) {
            if ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            }
        })
        ->orderBy('nama', 'asc')->paginate(10);
        
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return view('user.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:50',
                'string',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'username' => [
                'required',
                'max:50',
                'string',
                Rule::unique('users', 'username')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|max:50',
            'no_hp' => 'required|string|min:10|max:50',
            'jenis_kelamin' => 'required|string',
            'no_ktp' => 'required|string|min:16|max:50',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|max:1028|mimes:jpg,png,jpeg',
        ]);

        $user = User::find($id);

        $input = [
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ktp' => $request->no_ktp
        ];

        if($request->hasFile('foto'))
        {
            if($user->foto)
            {
                Storage::disk('public')->delete($user->foto);
            }

            $file = $request->foto;
            $file_name_custom = 'foto'. '_' . $input['username'] . '_' . rand(1000, 9999) . '.' . $file->extension();
            $path_full = 'foto/' . $file_name_custom;

            Storage::disk('public')->put($path_full, $file->get());

            $input['foto'] = $path_full;

        }

        $user->update($input);

        if(auth()->user()->role == 'admin')
        {
            return redirect()->route('user.index');
        }
        else
        {
            return redirect()->route('member.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if($user->foto)
        {
            Storage::disk('public')->delete($user->foto);
        }
        $user->delete();

        return redirect()->route('user.index');
    }
}
