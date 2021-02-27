<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;

class AdminLoginComponent extends Component
{
    public $email="";
    public $password="";
    public $errorMessage="";
    public function mount()
    {
        if((Auth::user())&&(Auth::user()->user_group_id==1))
        {
            return redirect('/admin'); 
        }
    }
    public function login()
    {   
        if(Auth::attempt(['email' => $this->email, 'password' => $this->password,'status'=>'Active','user_group_id'=>1]))        
        {
            return redirect('/admin');            
        } 
        else
        { 
            $this->errorMessage="Wrong Email,password or not admin";
        } 

    }
    public function render()
    {
        return view('livewire.admin-login-component')->layout('theme.component');
    }
}
