<div>
    @if ($paginator)
    <div class="row">
        <div class="col-12">            
        </div>        
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                <tr>                    
                    <th style="width: 150px;">Location</th>
                    <th>Position</th>
                    <th>Category</th>
                    <th style="width: 250px;">Company</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($paginator->items() as $job)
                    <tr>                        
                        <td>{{$job->location}}</td>                        
                        <td><a href="{{ url('job/details/'.$job->id) }}" class="text-primary">{{$job->position}}</a></td>
                        <td><a href="{{ url('jobs/'.$job->job_category_id) }}" class="text-primary">{{$job->category_name}}</a></td>                        
                        <td>{{$job->company}}</td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Total <strong>{{$paginator->total()}}</strong> Jobs in this category
        </div>
        <div class="col-8" class="text-right">
            {{ $paginator->links('vendor.pagination.bootstrap-4') }}            
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12">            
            No Result found your search cirteria
        </div>
    </div>
    @endif
    
</div>
