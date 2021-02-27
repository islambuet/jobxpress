<header id="system_top_bar" class="d-print-none">
    <!-- LOGO -->
    <h3><a href="{{ url('/') }}">JobXpress</a></h3>    
    <div class="row">
        <form action="{{ url('/jobs/search') }}" method="GET" class="col-md-6 col-7">                    
            <div class="input-group">
                <input type="text" name="searchKey" class="form-control" placeholder="Search..">
                <div class="input-group-append">
                  <button class="input-group-text" type="submit">Go!</button>
                </div>
              </div>
        </form>
        <div class="col-md-6 col-5">
            <a href="{{ url('job/new') }}" class="btn btn-primary float-right">Post a Job</a>
        </div>
        
    </div>
</header>