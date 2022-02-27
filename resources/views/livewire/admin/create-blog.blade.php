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
                    <div class="form-row">
                          <h4>{{__('lang.createblog')}}</h4>
        
                        <div class="form-group col-md-12">
                            <label >{{__('lang.titleblog')}}</label>
                            <input type="text" wire:model="title" class="form-control"  placeholder="{{__('lang.titleblog')}}">
                            <p class="text-danger">@error('title') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div class="form-group col-md-12">
                            <label >{{__('lang.selectcategory')}}</label>
                            <select wire:model="category_id" class="form-control custom-select">
                                 @if(count($categories) > 0)
                                      @foreach($categories as $category)
                                          <option value="{{$category->id}}">{{$category->category}}</option> 
                                      @endforeach
                                 @endif
                            </select>
                            <p class="text-danger">@error('category_id') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div class="form-group col-md-12">
                            <label >{{__('lang.blogphoto')}}</label>
                            <input type="file" wire:model="photo" class="form-control"  placeholder="{{__('lang.blogphoto')}}">
                            <p class="text-danger">@error('photo') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div class="form-group col-md-12">
                            <label >{{__('lang.blogexcerpt')}}</label>
                            <textarea wire:model="excerpt" class="form-control"></textarea>
                            <p class="text-danger">@error('excerpt') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div wire:ignore class="form-group col-md-12">
                            <label >{{__('lang.blogcontent')}}</label>
                            <input type="hidden"  id="content" value="{{ $content }}" />
                            <trix-editor  
                            class="trix-content"
                            input="content"  
                            ></trix-editor>
                        </div>
                        <p class="text-danger">@error('content') <span class="error">{{ $message }}</span> @enderror</p>
                        <div class="form-group col-md-12">
                            <label >{{__('lang.metatitle')}}</label>
                            <textarea wire:model="meta_title" class="form-control"></textarea>
                            <p class="text-danger">@error('meta_title') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div class="form-group col-md-12">
                            <label >{{__('lang.metacontent')}}</label>
                            <textarea wire:model="meta_description" class="form-control"></textarea>
                            <p class="text-danger">@error('meta_description') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div class="form-group col-md-12">
                            <label >{{__('lang.metakeyword')}}</label>
                            <textarea wire:model="meta_keyword" class="form-control" placeholder="{{__('lang.example')}}{{__('lang.exmpletag')}}"></textarea>
                            <p class="text-danger">@error('meta_keyword') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div class="form-group col-md-12">
                            <label>{{__('lang.selectstatus')}}</label>
                            <select wire:model="statue" class="form-control custom-select">
                               <option value="pending">{{__('lang.pending')}}</option>
                                <option value="publiched">{{__('lang.published')}}</option>
                            </select>
                            <p class="text-danger">@error('statue') <span class="error">{{ $message }}</span> @enderror</p>
                        </div>
                        <div  class="form-group col-md-12">
                            <label>{{__('lang.tag')}}</label>
                            <input type="text" class="form-control" wire:model="tag"  value="{{$tag}}" placeholder="{{__('lang.example')}}{{__('lang.exmpletag')}}">
                        </div>
                        <p class="text-danger">@error('tag') <span class="error">{{ $message }}</span> @enderror</p>
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
        console.log(content);
        @this.set('content', content.getAttribute('value'))
    });

</script>



