<?php

namespace App\Http\Livewire;
use App\HelperClasses\JobHelper;

use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $latest_jobs=JobHelper::getLastestJobs();
        return view('livewire.admin-dashboard-component',['jobs'=>$latest_jobs])->layout('theme.component');
    }
}
