<?php

namespace App\Http\Controllers;
use App\Models\InfoPage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfoPageRequest;

class InfoPageStoreController extends Controller
{
    public function store(StoreInfoPageRequest $request)
    {                
        $infopage = InfoPage::find($request->infopage_id);         
        foreach ($request->request as $key => $value) {
            if ($value != null 
                && $key !== '_token' 
                && $key !== 'infopage_id') 
            {
                $keyAttribute = str_replace('infopage_', '', $key);
                $infopage->$keyAttribute = $value;
            }            
        }        
        dd($infopage);
        $infopage->save();
        return redirect(route('adminPanel'));
    }
}
