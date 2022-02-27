<div class="agent-widget">
    <div class="agent-title">
        @if($prop->user)
        <div class="agent-photo"><img src="{{($prop->user->avatar) ?asset($prop->user->avatar) : asset('images/avatar/default.jpg')}}" alt="{{$prop->user->fullname}}"></div>
        @else
        <div class="agent-photo"><img src="{{asset('images/avatar/default.jpg')}}" alt=""></div> 
        @endif
        <div  class="agent-details">
            <h4 wire:ignore><span>{{$prop->name}}</span></h4>
           
            @if(!$show)
            <button wire:click="$set('show',true)" class="btn btn-success btn-sm"><i class="lni-phone-handset"></i>
                {{__('lang.phone')}}
            </button>
            @else
                <span><i class="lni-phone-handset"></i>{{$phone}}</span>
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
   <div>
    <div class="form-group">
        <input type="text" wire:model.defer="email" class="form-control" placeholder="{{__('lang.email')}}">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <input type="text" wire:model.defer="phoneclient" class="form-control" placeholder="{{__('lang.phone')}}">
        @error('phoneclient') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <textarea wire:model.defer="messageproperty" class="form-control"></textarea>
        @error('messageproperty') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <button wire:click="send()" class="btn btn-theme full-width">{{__('lang.send')}}</button>
   </div>
    
</div>
