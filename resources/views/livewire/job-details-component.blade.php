<div>
    <div class="row">
        <div class="col-12 pb-2 mb-2" style="border-bottom: 1px solid black">
            <div class="row">
                <div class="col-md-6">
                    <div class="font-weight-bold" style="font-size: 1.5em">{{$position}}</div>
                    <div>{{$location}}</div>
                </div>
                <div class="col-md-6">                    
                    <span class="float-right" style="font-size: 2em">{{$company}}</span>     
                    @if ($logo_url)
                    <img class="float-right rounded-circle" src="{{ $logo_url }}" style="max-width:80px;max-height:80px;" alt="Logo">
                    @endif
                                   
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div><?php echo nl2br($description)?></div>
        </div>
        <div class="col-md-6 pr-0">
            <img class="float-right" src="{{ asset('theme/images/how-to-apply.png') }}" style="max-width:100%">
        </div>
        
    </div>
    
    
</div>
