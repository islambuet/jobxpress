<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\HelperClasses\JobHelper;

use Livewire\Component;

class JobSearchComponent extends Component
{
    public function mount(Request $request)
    {
        config(['app.name'=>" -Job Search Result"]);
        
    }
    public function render(Request $request)
    {
        $searchKey=$request->searchKey?$request->searchKey:'';
        
        $validator = Validator::make($request->all(), [
            
            // 'searchKey' => ['required', 'regex:/^[a-zA-Z0-9\s_-]*$/', 'max:255','min:3'],
            'searchKey' => ['required', 'max:255','min:2'],
        ]);
        if ($validator->fails()) {         
            $paginator=array();
        }
        else
        {
            
            $page=$request->page?$request->page:1;
            $perPage=$request->perPage?$request->perPage:20;
            $paginator=JobHelper::getJobsBySearch($searchKey,$page,$perPage);
            $paginator->appends(request()->query());
        }
        return view('livewire.job-search-component',['searchKey'=>$searchKey,'paginator'=>$paginator])->layout('theme.component');  
        
    }
}
