<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\HelperClasses\ConfigurationHelper;
use App\HelperClasses\EncryptDecryptHelper;
use App\HelperClasses\JobHelper;

use App\Models\Job;

use Carbon\Carbon;
class JobController extends Controller
{    
    //status==[Active,All,In-Active]
    public function getJobsCategories(Request $request)
    {
        $status=$request->status?$request->status:"Active";        
        response()->json([
            'errorStr'=>'',
            'datas' => JobHelper::getJobCategories($status)],201)->send();
    }
    //total==number of latest jobs
    public function getLastestJobs(Request $request)
    {
        $total=$request->total?$request->total:10;    
        response()->json([
            'errorStr'=>'',
            'datas' => JobHelper::getLastestJobs($total)],201)->send();    
    }
    //additional perpage,page no
    public function getJobsByCagegoryId($categoryId,Request $request)
    {
        $page=$request->page?$request->page:1;
        $perPage=$request->perPage?$request->perPage:20;
        $paginator=JobHelper::getJobsByCagegoryId($categoryId,$page,$perPage);
        response()->json([
            'errorStr'=>'',
            'data' => ['total'=>$paginator->total(),'currentPage'=>$paginator->currentPage(),'perPage'=>$paginator->perPage(),'jobs'=>$paginator->items()]],201)->send();
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_category_id' => ['required', 'exists:job_categories,id'],
            'job_type_id' => ['required', 'exists:job_types,id'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'company' => ['required', 'string', 'max:255','min:3'],
            'logo_url' => ['string', 'max:500','url'],
            'position' => ['required', 'string', 'max:255','min:3'],
            'location' => ['required', 'string', 'max:255','min:3'],
            'description' => ['required', 'string', 'min:5'],
            
        ]);
        if ($validator->fails()) {         
            return response()->json(['errorStr' => 'VALIDATION_FAILED','errors' => $validator->errors()], 400);                 
        }
        
        $data=array();
        $data['job_category_id']=$request->job_category_id;
        $data['job_type_id']=$request->job_type_id;
        $data['email']=$request->email;
        $data['company']=$request->company;
        $data['position']=$request->position;
        if($request->logo_url)
        {
            $data['logo_url']=$request->logo_url;            
        }
        $data['location']=$request->location;
        $data['description']=$request->description;
        $job=JobHelper::createJob($data);
        $job->update_url=url('/job/update/'.$job->id.'/'.urlencode($job->token));

        response()->json([
            'errorStr'=>'',
            'job' => $job->toArray()],201)->send();
        
    }
    public function getJobById($id,Request $request)
    {
        $job=JobHelper::getJobById($id);
        if($job)
        {
            response()->json([
                'errorStr'=>'',
                'data' => ['data'=>$job]],201)->send();
        }
        else
        {
            response()->json([
                'errorStr'=>'NOT_FOUND',
                'data' => ['data'=>$job]],404)->send();
        }
        
    }
    public function getJobByIdToken($id,$token,Request $request)
    {
        if(!$token)
        {
            response()->json([
                'errorStr'=>'NOT_FOUND',
                'data' => ['data'=>$job]],404)->send();
        }
        $job=JobHelper::getJobById($id,$token);
        if($job)
        {
            response()->json([
                'errorStr'=>'',
                'data' => ['data'=>$job]],201)->send();
        }
        else
        {
            response()->json([
                'errorStr'=>'NOT_FOUND',
                'data' => ['data'=>$job]],404)->send();
        }
        
    }
    public function updateJobByIdToken($id,$token,Request $request)
    {
        if(!$token)
        {
            response()->json([
                'errorStr'=>'NOT_FOUND',
                'data' => ['data'=>$job]],404)->send();
        }
        $job=JobHelper::getJobById($id,$token);
        if($job)
        {
            $validator = Validator::make($request->all(), [
                'job_category_id' => ['required', 'exists:job_categories,id'],
                'job_type_id' => ['required', 'exists:job_types,id'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'company' => ['required', 'string', 'max:255','min:3'],
                'logo_url' => ['string', 'max:500','url'],
                'position' => ['required', 'string', 'max:255','min:3'],
                'location' => ['required', 'string', 'max:255','min:3'],
                'description' => ['required', 'string', 'min:5'],
                
            ]);
            if ($validator->fails()) {         
                return response()->json(['errorStr' => 'VALIDATION_FAILED','errors' => $validator->errors()], 400);                 
            }
            
            $data=array();
            $data['job_category_id']=$request->job_category_id;
            $data['job_type_id']=$request->job_type_id;
            $data['email']=$request->email;
            $data['company']=$request->company;
            $data['position']=$request->position;
            if($request->logo_url)
            {
                $data['logo_url']=$request->logo_url;            
            }
            $data['location']=$request->location;
            $data['description']=$request->description;
            $jobUpdated=JobHelper::updateJob($id,$data);
            $jobUpdated->update_url=url('/job/update/'.$jobUpdated->id.'/'.urlencode($jobUpdated->token));

            response()->json([
                'errorStr'=>'',
                'job' => $jobUpdated->toArray()],201)->send();
            
        }
        else
        {
            response()->json([
                'errorStr'=>'NOT_FOUND',
                'data' => ['data'=>$job]],404)->send();
        }
        
    }
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            //'searchKey' => ['required', 'regex:/^[a-zA-Z0-9\s_-]*$/', 'max:255','min:3'],
            'searchKey' => ['required', 'max:255','min:2'],
        ]);
        if ($validator->fails()) {         
            return response()->json(['errorStr' => 'INVALID_SEARCH','errors' => $validator->errors()], 400);                 
        }

        $page=$request->page?$request->page:1;
        $perPage=$request->perPage?$request->perPage:20;
        $searchKey=$request->searchKey?$request->searchKey:'';

        $paginator=JobHelper::getJobsBySearch($searchKey,$page,$perPage);
        response()->json([
            'errorStr'=>'',
            'data' => ['total'=>$paginator->total(),'currentPage'=>$paginator->currentPage(),'perPage'=>$paginator->perPage(),'jobs'=>$paginator->items()]],201)->send();
            
    }
    
}
