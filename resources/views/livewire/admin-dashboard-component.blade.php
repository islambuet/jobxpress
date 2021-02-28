<div>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <strong><a href="#">TOTAL JOBS</a></strong>
                                <div>100</div>
                        </div>
                        <div class="col-2">
                            <i style="vertical-align: -.5em" class="fe-gift"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <strong><a href="#">TOTAL APPLIED</a></strong>
                                <div>100</div>
                        </div>
                        <div class="col-2">
                            <i style="vertical-align: -.5em" class="fe-link"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <strong><a href="#">TOTAL VIEWS</a></strong>
                                <div>100</div>
                        </div>
                        <div class="col-2">
                            <i style="vertical-align: -.5em" class="fe-tv"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-body">
                    <strong>JOB POSTING TREND</strong>
                    <div style="height:200px">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-body">
                    <strong>TOP CATEGORIES</strong>
                    <div style="height:200px">

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-12">
            <div><strong>RECENT JOBS</strong></div>
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                <tr>                    
                    <th style="width: 150px;">Location</th>
                    <th>Position</th>
                    <th style="width: 250px;">Company</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>                        
                        <td>{{$job->location}}</td>
                        <td><a href="{{ url('job/details/'.$job->id) }}" class="text-primary">{{$job->position}}</a></td>
                        <td>{{$job->company}}</td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>
</div>
