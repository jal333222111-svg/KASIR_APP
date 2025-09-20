<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResetPassword extends Component
{
    /**
     * The user ID.
     */
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($id = null) // Terima parameter $id
    {
        $this->id = $id; // Assign ke property
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.reset-password');
    }
}
