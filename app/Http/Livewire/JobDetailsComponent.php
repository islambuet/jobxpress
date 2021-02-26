<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\HelperClasses\JobHelper;

class JobDetailsComponent extends Component
{
    
    public $logo_url='';
    public $company='';
    public $position='';
    public $location='';
    public $description='';
    
    public $temporary_image=null;
    public function mount($id)
    {
        $job=JobHelper::getJobById($id);  
        if(!$job)
        {
            return abort(404);
        }
        $this->logo_url=$job->logo_url;
        $this->company=$job->company;
        $this->position=$job->position;
        $this->location=$job->location;
        $this->description=$job->description;
    }
    public function render()
    {
        return view('livewire.job-details-component')->layout('theme.component');   ;
    }
}
