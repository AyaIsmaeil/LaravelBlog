<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function makeAdmin(User $user){
    $user->assignRole('admin');  

    return redirect()->route('users.index')
        ->with('success',$user->name.' is now an admin');
    }
    
}
