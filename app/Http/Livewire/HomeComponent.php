<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.visitor-dashboard')->layout('theme.component');        
    }
}
