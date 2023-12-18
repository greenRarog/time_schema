<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeSchemaUserController extends Controller
{
    public function create()
    {
        return view('timeschema.admin.create-new-user', [
            'id' => '1',
        ]);
    }

    public function createUser(Request $request)
    {
        dd($request);
    }
}
