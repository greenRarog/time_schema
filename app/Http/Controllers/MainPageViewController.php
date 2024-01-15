<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\InfoPage;
use App\Models\User;

class MainPageViewController extends Controller
{
    public function view($admin_name = '') {
        $user = User::where('name', '=', $admin_name)->first();
        if(isset($user)) {            
            $infoPage = $user->infoPage;
        } else {
            $infoPage = InfoPage::where('admin_id', "=", 0)->first();
        }        
        if (Auth::check()) {
            $id =  Auth::id();                
        } else {
            $id = '';                
        }        
        return view('template.info-page', [
            'id' => $id,
            'infoPage' => $infoPage,
        ]);
    }
}
