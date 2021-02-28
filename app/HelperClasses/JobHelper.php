<?php
    namespace App\HelperClasses;
    use App\Models\Configuration;
    use App\Models\JobCategory;
    use App\Models\JobType;
    use App\Models\Job;
    use App\Models\JobApply;
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
    class JobHelper
    {
        public static function getJobCategory($id)
        {
            $query=JobCategory::select('id','name')                           
            ->where('status','!=','Deleted')
            ->where('id',$id)  ;
            
            $category=$query->first();
            if($category)
            {
                return $category->toArray();
            }
            return array();
            
        }
        
        public static function getJobCategories($status='Active')
        {
            $query=JobCategory::select('id','name')                
            ->orderBy('ordering', 'ASC')     
            ->orderBy('id', 'ASC')     
            ->where('status','!=','Deleted');  
            if($status!='All')
            {
                $query->where('status','=',$status);                                    
            }  
            $categories=$query->get();
            if($categories)
            {
                return $categories->toArray();
            }
            return array();
            
        }
        public static function getJobTypes($status='Active')
        {
            $query=JobType::select('id','name')                
            ->orderBy('ordering', 'ASC')     
            ->orderBy('id', 'ASC')     
            ->where('status','!=','Deleted');  
            if($status!='All')
            {
                $query->where('status','=',$status);                                    
            }  
            $types=$query->get();
            if($types)
            {
                return $types->toArray();
            }
            return array();
            
        }
        public static function getLastestJobs($total=10)
        {
            $query=DB::table('jobs')
            ->select('jobs.id','jobs.job_category_id','jobs.job_type_id','jobs.company','jobs.position','jobs.location')
            ->where('jobs.status','=','Active') 
            ->join('job_categories as jc', 'jc.id', '=', 'jobs.job_category_id')
            ->addSelect('jc.name as category_name')
            ->join('job_types as jt', 'jt.id', '=', 'jobs.job_type_id')
            ->addSelect('jt.name as type_name')
            ->orderBy('jobs.id', 'desc')
            ->where('jobs.expired_at','>' ,Carbon::now())            
            ->limit($total);
            $jobs=$query->get();
            if($jobs)
            {
                return $jobs->toArray();
            }
            return array();
            
        }
        public static function getJobsByCagegoryId($categoryId,$page=1,$per_page=20)
        {
            $query=DB::table('jobs')
            ->select('jobs.id','jobs.job_category_id','jobs.job_type_id','jobs.company','jobs.position','jobs.location')
            ->where('jobs.status','=','Active') 
            ->join('job_categories as jc', 'jc.id', '=', 'jobs.job_category_id')
            ->addSelect('jc.name as category_name')
            ->join('job_types as jt', 'jt.id', '=', 'jobs.job_type_id')
            ->addSelect('jt.name as type_name')
            ->orderBy('jobs.id', 'desc')
            ->where('jobs.job_category_id', '=',$categoryId)
            ->where('jobs.expired_at','>' ,Carbon::now());                     
            $jobs=$query->paginate($per_page,['*'],'page',$page);
            if($jobs)
            {
                return $jobs;
            }
            return array();
            
        }
        public static function createJob($data)
        {
            $expireDays=ConfigurationHelper::getJobExpireDays();
            $data['token']=EncryptDecryptHelper::getJobToken();
            $data['expired_at']=Carbon::now()->addDays($expireDays);
            $job=Job::create($data);
            return $job;
        }
        //optional token
        public static function getJobById($id,$token='')
        {
            $query=DB::table('jobs')
            ->select('jobs.id','jobs.job_category_id','jobs.job_type_id','jobs.company','jobs.position','jobs.location','jobs.logo_url','jobs.description','jobs.email')
            ->where('jobs.status','!=','Deleted') 
            ->join('job_categories as jc', 'jc.id', '=', 'jobs.job_category_id')
            ->addSelect('jc.name as category_name')
            ->join('job_types as jt', 'jt.id', '=', 'jobs.job_type_id')
            ->addSelect('jt.name as type_name')
            ->orderBy('jobs.id', 'desc')
            ->where('jobs.id','=' ,$id);
            if($token)
            {
                $query->where('jobs.token','=',$token);
            }
            
            $job=$query->first();
            if($job)
            {
                return $job;
            }
            return array();
            
        }
        public static function updateJob($id,$data)
        {
            $expireDays=ConfigurationHelper::getJobExpireDays();
            $data['token']=EncryptDecryptHelper::getJobToken();
            //$data['expired_at']=Carbon::now()->addDays($expireDays);
            //$job=Job::create($data);
            $job=Job::find($id);
            $job->update($data);
            return $job;
        }
        public static function getJobsBySearch($searchKey,$page=1,$per_page=20)
        {
            $query=DB::table('jobs')
            ->select('jobs.id','jobs.job_category_id','jobs.job_type_id','jobs.company','jobs.position','jobs.location')
            ->where('jobs.status','=','Active') 
            ->join('job_categories as jc', 'jc.id', '=', 'jobs.job_category_id')
            ->addSelect('jc.name as category_name')
            ->join('job_types as jt', 'jt.id', '=', 'jobs.job_type_id')
            ->addSelect('jt.name as type_name')
            ->orderBy('jobs.id', 'desc')
            ->where(function($q) use ($searchKey) {
                $q->where('jobs.location','like','%'.$searchKey.'%')
                ->orWhere('jobs.position','like','%'.$searchKey.'%')
                ->orWhere('jobs.company','like','%'.$searchKey.'%')
                ->orWhere('jc.name','like','%'.$searchKey.'%');
            })
            ->where('jobs.expired_at','>' ,Carbon::now());                     
            $jobs=$query->paginate($per_page,['*'],'page',$page);
            if($jobs)
            {
                return $jobs;
            }
            return array();
            
        }
        public static function getTopCategories()
        {
            $query=DB::table('jobs')
            ->select('jobs.job_category_id')
            ->where('jobs.status','=','Active') 
            ->join('job_categories as jc', 'jc.id', '=', 'jobs.job_category_id')
            ->addSelect('jc.name as category_name')
            ->addSelect(DB::raw('count(jobs.id) num_jobs'))
            ->groupBy('jobs.job_category_id')
            ->groupBy('jc.name')
            ->orderBy('num_jobs', 'desc')            
            ->where('jobs.expired_at','>' ,Carbon::now())                     
            ->limit(3);
            $jobs=$query->get();
            
            if($jobs)
            {
                return $jobs;
            }
            return array();
            
        }
        public static function getTotalJobs()
        {
            $query=DB::table('jobs')
            ->where('jobs.status','=','Active') 
            ->addSelect(DB::raw('count(jobs.id) total_jobs'))
            ->addSelect(DB::raw('SUM(jobs.visit_count) total_visit'))
            ->where('jobs.expired_at','>' ,Carbon::now());
            
            $jobs=$query->first();
            
            if($jobs)
            {
                return $jobs;
            }
            return array();
            
        }
        public static function updateJobVisit($id,$count=1)
        {
            DB::table('jobs')
            ->where('jobs.id','=' ,$id)
            ->increment('visit_count',$count);
        }
        public static function createJobApply($data)
        {
            $expireMinutes=ConfigurationHelper::getJobApplyExpireMinutes();
            $data['token']=EncryptDecryptHelper::getJobApplyToken($data['job_id']);
            $data['token_expired_at']=Carbon::now()->addMinutes($expireMinutes);            
            $jobApply=JobApply::create($data);
            return $jobApply;
        }
        public static function getJobApplyByToken($token)
        {
            $query=DB::table('job_applies')
            ->select('job_applies.id','job_applies.applied','job_applies.token_expired_at')
            ->where('job_applies.token','=',$token);
            //may be join with job to check expires
            
            
            $result=$query->first();
            if($result)
            {
                return $result;
            }
            return array();
        }
        public static function updateJobApply($id,$data)
        {
            $result=JobApply::find($id);
            $result->update($data);
            return $result;
        }

        
    }
    