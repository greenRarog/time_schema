<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Worktime;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public function adminPanel()
    {
        $id =  Auth::id();
        $worktime = Worktime::where('admin_id', '=', $id)->first();        
        
        return view('timeschema.admin.panel', [
            'id' => $id,
            'worktime' => $worktime,
        ]);
    }
}
