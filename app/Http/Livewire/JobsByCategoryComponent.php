<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;

use Livewire\Component;
use App\HelperClasses\JobHelper;

class JobsByCategoryComponent extends Component
{
    private $categoryId;
    private $category;
    public function mount($categoryId)
    {
        $this->categoryId=$categoryId; 
        $category=JobHelper::getJobCategory($this->categoryId);  
        if(!$category)
        {
            //session()->flash('alert_message',"You do not have Edit Access");
            //session()->flash('alert_type',"danger");
            //return redirect('/');
            return abort(404);
        }   
        config(['app.name'=>" - ".$category['name']]);
        $this->category=$category;    
    }
    public function render(Request $request)
    {
        $page=$request->page?$request->page:1;
        $perPage=$request->perPage?$request->perPage:20;
        $paginator=JobHelper::getJobsByCagegoryId($this->categoryId,$page,$perPage);
        
        return view('livewire.jobs-by-category-component',['category'=>$this->category,'paginator'=>$paginator])->layout('theme.component');  
    }
}
