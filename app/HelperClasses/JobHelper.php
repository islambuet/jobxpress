<?php
    namespace App\HelperClasses;
    use App\Models\Configuration;
    use App\Models\JobCategory;
    class JobHelper
    {
        
        public static function getJobCategories($status='All')
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
        
    }
    