<div>    
    <div style="display: {{$preview?'none':''}}" class="row">
        <div class="col-md-8">
            <div class="row mb-2">
                <div class="col-4">
                    Email
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" wire:model="email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror   
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    Category
                </div>
                <div class="col-8">
                    <select wire:model="job_category_id" class="form-control">
                        <option value="" >Choose Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    @error('job_category_id') <span class="text-danger">{{ $message }}</span> @enderror   
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    Type
                </div>
                <div class="col-8">
                    <select wire:model="job_type_id" class="form-control">
                        <option value="" >Choose Type</option>
                        @foreach($types as $type)
                            <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                        @endforeach
                    </select>
                    @error('job_type_id') <span class="text-danger">{{ $message }}</span> @enderror   
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-4">
                    Company
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" wire:model="company">
                    @error('company') <span class="text-danger">{{ $message }}</span> @enderror   
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    Position
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" wire:model="position">
                    @error('position') <span class="text-danger">{{ $message }}</span> @enderror   
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    Location
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" wire:model="location">
                    @error('location') <span class="text-danger">{{ $message }}</span> @enderror   
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    
                    Description
                </div>
                <div class="col-8">
                    <textarea class="form-control" rows="3" wire:model="description"></textarea>                    
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror   
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div style="border: 2px solid black;height:200px;width:200px;margin:auto">
                @if ($temporary_image)
                <img src="{{ $picture->temporaryUrl() }}" style="max-width:200px;max-height:200px;">
                @endif
            </div>
            <input type="file" class="form-control mt-2" wire:model="picture">
                  @error('picture') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12">
            <button type="button" class="btn btn-primary" wire:click="showPreview()">Show Preview</button>
        </div>
        
    </div>
    <div style="display: {{$preview?'':'none'}}" class="row">
        <div class="col-12 pb-2 mb-2" style="border-bottom: 1px solid black">
            <div class="row">
                <div class="col-md-6">
                    <div class="font-weight-bold" style="font-size: 1.5em">{{$position}}</div>
                    <div>{{$location}}</div>
                </div>
                <div class="col-md-6">                    
                    <span class="float-right" style="font-size: 2em">{{$company}}</span>     
                    @if ($temporary_image)
                    <img class="float-right rounded-circle" src="{{ $picture->temporaryUrl() }}" style="max-width:80px;max-height:80px;" alt="logo">
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
        <div class="col-12">
            <button type="button" class="btn btn-primary" wire:click="hidePreview()">Edit</button>
            <button type="button" class="btn btn-primary float-right" wire:click="saveJob()">Save</button>
            
        </div>
    </div>
    
    
</div>
