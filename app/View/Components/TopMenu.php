<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\User;

class TopMenu extends Component
{    
    /**
     * Create a new component instance.
     */
    public $id;
    private $urlPath;

    public function __construct(Request $request, $id = 0)
    {
        $this->id = $id;        
        $this->urlPath = $request->path();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->id) {
            $user = User::find($this->id);
            $name = $user->name;            
            return view('components.template.top-menu', [
                'name' => $name,
            ]);
        }
        $uri = '/' . $this->urlPath;
        return view('components.template.top-menu-not-auth', [
                'uri' => $uri,
            ]);        
    }
}
