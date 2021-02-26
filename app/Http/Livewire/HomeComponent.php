<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;

use Livewire\Component;
use App\HelperClasses\JobHelper;

class HomeComponent extends Component
{
    public function mount()
    {
        config(['app.name'=>'']);
    }
    public function render(Request $request)
    {
        
        $results=JobHelper::getJobCategories('Active');
        $categories=array();
        foreach($results as $result)
        {
            $result['jobs']=array();
            $categories[$result['id']]=$result;
        }
        
        $latest_jobs=JobHelper::getLastestJobs();
        
        foreach($latest_jobs as $job)
        {
            $categories[$job->job_category_id]['jobs'][]=$job;           
        }
        return view('livewire.visitor-dashboard',['categories'=>$categories])->layout('theme.component');        
    }
}
