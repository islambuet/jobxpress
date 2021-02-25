<div>
    @foreach ($categories as $category)
    <div class="row">
        <div class="col-12">
            <span  class="font-weight-bold">{{$category['name']}}</span>
            <span class="float-right"><i class="fe-rss"></i></span>
        </div>
        @if (count($category['jobs'])>0)
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                <tr>                    
                    <th style="width: 150px;">Location</th>
                    <th>Position</th>
                    <th style="width: 250px;">Company</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($category['jobs'] as $job)
                    <tr>                        
                        <td>{{$job->location}}</td>
                        <td><a href="{{ url('job/'.$job->id) }}" class="text-primary">{{$job->position}}</a></td>
                        <td>{{$job->company}}</td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
        @endif
        <div class="col-12">
            <a href="{{url('jobs/'.$category['id'])}}" class="text-primary" style="text-decoration: underline;">more</a>
        </div>
    </div>
    @endforeach
</div>
