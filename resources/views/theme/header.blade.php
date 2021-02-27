<header id="system_top_bar" class="d-print-none">
    <!-- LOGO -->
    <h3><a href="{{ url('/') }}">JobXpress</a></h3>  
    <div class="row">
        @if (str_contains(url()->current(),'/admin'))
        <div class="col-12">
            @if((Auth::user())&&(Auth::user()->user_group_id==1))
                @include('theme.admin-menu')
            @endif
        </div>
        @else
        <form action="{{ url('/jobs/search') }}" method="GET" class="col-md-6 col-6">                    
            <div class="input-group">
                <input type="text" name="searchKey" class="form-control" placeholder="Search..">
                <div class="input-group-append">
                  <button class="input-group-text" type="submit">Go!</button>
                  
                </div>
              </div>
        </form>
        <div class="col-md-6 col-6">
            
            @if((Auth::user())&&(Auth::user()->user_group_id==1))
                @include('theme.admin-menu')
            @endif
            <a href="{{ url('job/new') }}" class="btn btn-primary float-right">Post a Job</a>
            
        </div>
        @endif  
        
        
    </div>
</header>