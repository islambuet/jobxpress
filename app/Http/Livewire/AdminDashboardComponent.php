<?php

namespace App\Http\Livewire;
use App\HelperClasses\JobHelper;

use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        
        $jobsCount=JobHelper::getTotalJobs();        
        $topCategories=JobHelper::getTopCategories();
        $latest_jobs=JobHelper::getLastestJobs();
        return view('livewire.admin-dashboard-component',['jobs'=>$latest_jobs,'topCategories'=>$topCategories,'jobsCount'=>$jobsCount])->layout('theme.component');
    }
}
