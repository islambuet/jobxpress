<div class="dropdown float-right ml-1">    
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{ asset('theme/images/avatar-1.jpg') }}" alt="user-image" class="rounded-circle" style="height: 25px;width: 25px;"> 
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="dropdown-item">{{Auth::user()->name}}</div>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{url('admin') }}">Admin Dashboard</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Configurations</a>
        <a class="dropdown-item" href="#">Categories</a>
        <a class="dropdown-item" href="#">Jobs</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{url('user/logout') }}">Logout</a>
    </div>
  </div>