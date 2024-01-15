<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\EventModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeSchemaVisorController extends Controller
{
    public function create()
    {
        return view('timeschema.create');
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        if (isset($admin)) {

            
            return view('timeschema.update');
        }
        return redirect('/');
    }

}
