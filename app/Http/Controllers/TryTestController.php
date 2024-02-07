<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class TryTestController extends Controller
{
    public function index()
    {
        $user = User::find(2);
        dump($user->isAdmin);
        dd();
        

        return view('template.index');
    }
}
