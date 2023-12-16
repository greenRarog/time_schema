<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class TimeSchemaVisorController extends Controller
{
    public function create()
    {
        return view('time-schema.create');
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        if (isset($admin)) {

            
            return view('time-schema.update');
        }
        return redirect('/');
    }
}
