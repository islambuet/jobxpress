<div class="row">    
    <div class="col-md-6" style="margin: auto">
        @if ($errorMessage)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! $errorMessage !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" placeholder="email" class="form-control" wire:model="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror 
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" placeholder="password" wire:model="password"/>
        </div>
        <div class="form-group">        
            <button type="button" class="btn btn-success" wire:click="login()">Login</button>
        </div>
    </div>
    
  </div>