<?php
    namespace App\HelperClasses;
    use App\Models\Configuration;
    use App\Models\JobCategory;
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
    class JobHelper
    {
        
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
        
    }
    