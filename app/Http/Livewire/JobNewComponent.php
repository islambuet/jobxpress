<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\HelperClasses\JobHelper;
use Livewire\WithFileUploads;


class JobNewComponent extends Component
{
    use WithFileUploads;
    public $preview=false;
    public $company='';
    public $categories=array();
    public $types=array();
    public $job_category_id='';
    public $job_type_id='';
    public $email='';
    public $logo_url='';
    public $position='';
    public $location='';
    public $description='';
    public $picture=null;
    public $temporary_image=null;
    public $jobId=0;
    protected $rules = [
        'job_category_id' => 'required',        
        'job_type_id' => 'required',        
        'email' => 'required|email',        
        'company' => 'required|min:3|max:255',        
        'position' => 'required|min:3|max:255',        
        'location' => 'required|min:3|max:255',        
        'description' => 'required|min:5',        
    ];
    public function mount($id=0,$token='')
    {
        $this->jobId=$id;
        if($id>0)
        {
            if(!$token)
            {
                return abort(404);                
            }            $job=JobHelper::getJobById($id,urldecode($token));
            if(!$job)
            {
                return abort(404);                
            }
            else
            {
                $this->job_category_id=$job->job_category_id;
                $this->job_type_id=$job->job_type_id;
                $this->email=$job->email;
                $this->company=$job->company;
                $this->position=$job->position;
                $this->location=$job->location;
                $this->description=$job->description;                
            }
            config(['app.name'=>" - Update JOb"]);
        }
        else
        {
            config(['app.name'=>" - Post New JOb"]);
        }
        $this->categories=JobHelper::getJobCategories('Active');
        $this->types=JobHelper::getJobTypes('Active');
    }
    public function showPreview()
    {
        $validatedData =$this->validate();
        $this->preview=true;
    }
    public function hidePreview()
    {
        $this->preview=false;
    }
    public function updatedPicture()
    {
        $this->temporary_image=null;
        $this->logo_url=null;
        $this->validate([
            'picture' => 'image|max:10240', // 1MB Max
        ]);
        $this->temporary_image=$this->picture->temporaryUrl();
    }
    public function saveJob()
    {
        $validatedData =$this->validate();
        if($this->picture)
        {
            $this->validate([
                'picture' => 'image|max:10240', // 10MB Max
            ]);
            $this->logo_url=asset('storage/'.$this->picture->store('images/jobs','public'));
        }
        $data['job_category_id']=$this->job_category_id;
        $data['job_type_id']=$this->job_type_id;
        $data['email']=$this->email;
        $data['company']=$this->company;
        if($this->logo_url)
        {
            $data['logo_url']=$this->logo_url;
        }
        $data['position']=$this->position;
        $data['location']=$this->location;
        $data['description']=$this->description;
        if($this->jobId > 0)
        {
            $jobUpdated=JobHelper::updateJob($this->jobId,$data);            
            $update_url=url('/job/update/'.$jobUpdated->id.'/'.urlencode($jobUpdated->token));
            $message='Job Updated Succssfully.<br>';
            $message.='Job Id :'.$jobUpdated->id.'<br>';
            $message.='New Update Url :'.' <a href="'.$update_url.'" target="_blank">'.$update_url.'</a> ';
            session()->flash('alert_message',$message);
            session()->flash('alert_type',"success");
            return redirect('/job/details/'.$jobUpdated->id);
        }
        else
        {
            $job=JobHelper::createJob($data);
            $update_url=url('/job/update/'.$job->id.'/'.urlencode($job->token));
            $message='Job Created Succssfully.<br>';
            $message.='Job Id :'.$job->id.'<br>';
            $message.='Update Url :'.' <a href="'.$update_url.'" target="_blank">'.$update_url.'</a> ';
            session()->flash('alert_message',$message);
            session()->flash('alert_type',"success");
            return redirect('/job/details/'.$job->id);
        }
        
        
        //print_r($validatedData);
    }
    public function render()
    {
        return view('livewire.job-new-component')->layout('theme.component');   ;
    }
}
