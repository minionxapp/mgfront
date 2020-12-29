<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
 public function profile()
 {
      $user = Auth::user();
      // dd($user);
      // ['users'=>$users,'divisis'=>$divisi,'roles'=>$roles]
     return view('profile',['user'=>$user]);
   //  return 'ProfileController';
 }
}
