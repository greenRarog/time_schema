<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Worktime;
use App\Models\InfoPage;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public function adminPanel()
    {
        $id =  Auth::id();
        $worktime = Worktime::where('admin_id', '=', $id)->first();        
        $infoPage = InfoPage::where('admin_id', '=', $id)->first();
        

        return view('template.admin-panel', [
            'id' => $id,
            'worktime' => $worktime,
            'infopage' => $infoPage,
        ]);
    }
}
