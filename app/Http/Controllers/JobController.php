<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\HelperClasses\ConfigurationHelper;
use App\HelperClasses\EncryptDecryptHelper;

use App\Models\Job;

use Carbon\Carbon;
class JobController extends Controller
{
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
            'description' => ['required', 'string', 'max:255','min:5'],
            
        ]);
        if ($validator->fails()) {         
            return response()->json(['errorStr' => 'VALIDATION_FAILED','errors' => $validator->errors()], 400);                 
        }
        $expireDays=ConfigurationHelper::getJobExpireDays();
        $data=array();
        $data['job_category_id']=$request->job_category_id;
        $data['job_type_id']=$request->job_type_id;
        $data['email']=$request->email;
        $data['company']=$request->company;
        $data['position']=$request->position;
        $data['location']=$request->location;
        $data['description']=$request->description;
        $data['token']=EncryptDecryptHelper::getJobToken();
        $data['expired_at']=Carbon::now()->addDays($expireDays);

        $job=Job::create($data);

        response()->json([
            'errorStr'=>'',
            'job' => $job->toArray()],201)->send();
        
    }
}
