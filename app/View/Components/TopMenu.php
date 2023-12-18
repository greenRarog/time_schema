<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class TopMenu extends Component
{    
    /**
     * Create a new component instance.
     */
    public $id;

    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->id) {
            $user = User::find($this->id);
            $name = $user->name;

            return view('components.timeschema.top-menu', [
                'name' => $name,
            ]);
        }
        return view('components.timeschema.top-menu-not-auth');        
    }
}
