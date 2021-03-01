<?php

namespace App\Http\Livewire;
use App\HelperClasses\JobHelper;

use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        
        $jobsCount=JobHelper::getTotalJobs(); 
        $applyCount=JobHelper::getTotalApply();
        $topCategories=JobHelper::getTopCategories();
        $latest_jobs=JobHelper::getLastestJobs();
        return view('livewire.admin-dashboard-component',['jobs'=>$latest_jobs,'topCategories'=>$topCategories,'jobsCount'=>$jobsCount,'applyCount'=>$applyCount])->layout('theme.component');
    }
}
