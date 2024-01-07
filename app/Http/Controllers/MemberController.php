<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
   public function index() {
    
    $user = User::where('id', '=', auth()->user()->id)->first();

    return view('member.dashboard', compact('user'));
   }
}
