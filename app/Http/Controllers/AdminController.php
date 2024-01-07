<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

        $user_count = User::where('role', '=', 'member')->count();

        return view('admin.dashboard', compact('user_count'));
    }

    public function userList() {

        $users = User::where('role', 'member')->get();

        $user_json = json_encode($users, JSON_PRETTY_PRINT);
        
        return view('admin.user-list', compact('user_json'));
    }
}
