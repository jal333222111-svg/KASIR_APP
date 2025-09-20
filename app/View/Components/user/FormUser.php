<?php

namespace App\View\Components\User;

use Closure;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormUser extends Component
{
    public $id,$name,$email;

    /**
     * Create a new component instance.
     */
    public function __construct($id = null)
    {
        if ($id) {
            $user = User::find($id);

            if ($user) {
                $this->id = $user->id;
                $this->name = $user->name;
                $this->email = $user->email;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.form-user');
    }
}
