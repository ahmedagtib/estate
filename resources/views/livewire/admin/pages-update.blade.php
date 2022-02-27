<div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <h2 class="ipt-title">{{__('lang.welcome')}}</h2>
                    <span class="ipn-subtitle">{{__('lang.welcome_to_your_account')}}</span>
                    @if(Auth::user()->email_verified_at == null)
                         <div class="alert alert-warning mt-4">
                                {{__('lang.account_not_verified')}} - <a class="text-warning" href="{{route('email.verify')}}">{{__('lang.click')}}</a>
                         </div>
                    @endif                    
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row">
                 @include('account.sidebar')
                <div class="col-lg-8 col-md-12">
                    <div class="dashboard-wraper">
                        <div class="form-submit">	
                            <h4>{{__('lang.updatepage')}}</h4>
                            <div class="submit-section">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>{{__('lang.pagetitle')}}</label>
                                        <input wire:model="title" type="text" class="form-control">
                                        <p class="text-danger">@error('title') <span class="error">{{ $message }}</span> @enderror</p>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{__('lang.pagephoto')}}</label> : <img src="{{asset($oldimage)}}" width="40" height="40"/>
                                        <input type="file"  wire:model="image" class="form-control mt-1">
                                        <p class="text-danger">@error('image') <span class="error">{{ $message }}</span> @enderror</p>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{__('lang.excerpt')}}</label>
                                        <textarea wire:model="excerpt" class="form-control"></textarea>
                                    </div>
                                    <div wire:ignore class="form-group col-md-12">
                                        <label>{{__('lang.pagecontent')}}</label>
                                        <input type="hidden"  id="content" value="{{ $content }}" />
                                        <trix-editor  
                                           class="trix-content"
                                           input="content"  
                                           ></trix-editor>
                                    </div>
                                    <p class="text-danger">@error('content') <span class="error">{{ $message }}</span> @enderror</p>
                                    <div class="form-group col-md-12">
                                        <label>{{__('lang.metatitle')}}</label>
                                        <input type="text" wire:model="meta_title" class="form-control">
                                        <p class="text-danger">@error('meta_title') <span class="error">{{ $message }}</span> @enderror</p>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{__('lang.metacontent')}}</label>
                                        <textarea wire:model="meta_content" class="form-control"></textarea>
                                        <p class="text-danger">@error('meta_content') <span class="error">{{ $message }}</span> @enderror</p>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{__('lang.metakeyword')}}</label>
                                        <input type="text" class="form-control" wire:model="meta_keyword" data-role="tagsinput" value="{{$meta_keyword}}">
                                        <p class="text-danger">@error('meta_keyword') <span class="error">{{ $message }}</span> @enderror</p>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button wire:click="save" class="btn btn-theme" type="submit">{{__('lang.send')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="{{asset('js/trix.js')}}"></script>

<script>
    var content = document.getElementById("content")

    addEventListener("trix-change", function(event) {
        console.log(content.getAttribute('value'));
        @this.set('content', content.getAttribute('value'))
    });
</script>
