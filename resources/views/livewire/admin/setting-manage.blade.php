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
                      <h4>{{__('lang.setting')}} @if ($errors->any())<span class="text-danger"> - {{__('lang.valdtionerrorform')}}</span>@endif</h4>
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item mt-2" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">{{__('lang.home')}}</a>
                        </li>
                        <li class="nav-item mt-2" role="presentation">
                          <a class="nav-link" id="footer-tab" data-toggle="tab" href="#footer" role="tab" aria-controls="footer" aria-selected="false">{{__('lang.footer')}}</a>
                        </li>
                        <li class="nav-item mt-2" role="presentation">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{__('lang.contact')}}</a>
                        </li>
                        <li class="nav-item mt-2" role="presentation">
                            <a class="nav-link" id="website-tab" data-toggle="tab" href="#website" role="tab" aria-controls="website" aria-selected="false">{{__('lang.website')}}</a>
                        </li>
                        <li class="nav-item mt-2" role="presentation">
                            <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false">{{__('lang.seo')}}</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div  wire:ignore.self  class="tab-pane fade active show"   id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h6 class="text-center mt-1">{{__('lang.contenthomepage')}}</h6>
                            <div class="submit-page">
                                 <div class="submit-section mt-1">
                                    <div class="form-group">
                                       <label>{{__('lang.homebuttonsearch')}}</label>
                                       <input type="text" wire:model="button_search_form" class="form-control" placeholder="{{__('lang.homebuttonsearch')}}">
                                       @error('button_search_form') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                       <label>{{__('lang.herotitle')}}</label>
                                       <input type="text" wire:model="hero_title" class="form-control" placeholder="{{__('lang.herotitle')}}">
                                       @error('hero_title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                       <label>{{__('lang.herocontent')}}</label>
                                       <textarea type="text" wire:model="hero_content" class="form-control" placeholder="{{__('lang.herocontent')}}"></textarea>
                                       @error('hero_content') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                       <button class="btn btn-primary text-white" wire:click="savehome()">{{__('lang.send')}}</button>
                                    </div>
                                 </div>
                            </div>
                        </div>
                        <div wire:ignore.self  class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                           <h6 class="text-center mt-1">{{__('lang.footer')}}</h6>
                           <div class="submit-page">
                                <div   class="submit-section mt-1">
                                   <div class="form-group">
                                      <label>{{__('lang.footertitle')}}</label>
                                      <input type="text" wire:model="footer_title" class="form-control" placeholder="{{__('lang.footertitle')}}">
                                      @error('footer_title') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <label>{{__('lang.footercontent')}}</label>
                                      <textarea type="text" wire:model="footer_content" class="form-control" placeholder="{{__('lang.footercontent')}}"></textarea>
                                      @error('footer_content') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <label>{{__('lang.andriodapp')}}</label>
                                      <input type="text" wire:model="andriod_app" class="form-control" placeholder="{{__('lang.andriodapp')}}"/>
                                      @error('andriod_app') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                    <label>{{__('lang.fallowtitle')}}</label>
                                    <input type="text" wire:model="follow_title" class="form-control" placeholder="{{__('lang.fallowtitle')}}"/>
                                    @error('follow_title') <span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                                   <div class="form-group">
                                      <button class="btn btn-primary text-white" wire:click="savefooter()">{{__('lang.send')}}</button>
                                   </div>
                                </div>
                           </div>
                        </div>
                        <div wire:ignore.self class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                           <h6 class="text-center mt-1">{{__('lang.contact')}}</h6>
                           <div class="submit-page">
                                <div   class="submit-section mt-1">
                                   <div class="form-group">
                                      <label>{{__('lang.email')}}</label>
                                      <input type="text" wire:model="email" class="form-control" placeholder="{{__('lang.email')}}">
                                      @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <label>{{__('lang.phone')}}</label>
                                      <input type="text" wire:model="phone" class="form-control" placeholder="{{__('lang.phone')}}" />
                                      @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <label>{{__('lang.address')}}</label>
                                      <input type="text" wire:model="adress" class="form-control" placeholder="{{__('lang.andriodapp')}}"/>
                                      @error('adress') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                    <label>{{__('lang.website')}}</label>
                                    <input type="text" wire:model="website" class="form-control" placeholder="{{__('lang.website')}}"/>
                                    @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                                   <div class="form-group">
                                    <label>{{__('lang.contacttitle')}}</label>
                                    <input type="text" wire:model="contact_title" class="form-control" placeholder="{{__('lang.fallowtitle')}}"/>
                                    @error('contact_title') <span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                                 <div class="form-group">
                                    <label>{{__('lang.contactcontent')}}</label>
                                    <input type="text" wire:model="contact_content" class="form-control" placeholder="{{__('lang.contactcontent')}}"/>
                                    @error('contact_content') <span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                                   <div class="form-group">
                                      <button class="btn btn-primary text-white" wire:click="savecontact()">{{__('lang.send')}}</button>
                                   </div>
                                </div>
                           </div>
                        </div>
                        <div wire:ignore.self  class="tab-pane fade" id="website" role="tabpanel" aria-labelledby="website-tab">
                           <h6 class="text-center mt-1">{{__('lang.website')}}</h6>
                           <div class="submit-page">
                                <div   class="submit-section mt-1">
                                   <div class="form-group">
                                      <label>{{__('lang.logo')}}</label>
                                      <input type="file" wire:model="logo" class="form-control" placeholder="{{__('lang.logo')}}">
                                      @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <label>{{__('lang.facebook')}}</label>
                                      <input type="text" wire:model="facebook" class="form-control" placeholder="{{__('lang.facebook')}}"/>
                                      @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                    <label>{{__('lang.instagram')}}</label>
                                    <input type="text" wire:model="instagram" class="form-control" placeholder="{{__('lang.instagram')}}"/>
                                    @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                                 <div class="form-group">
                                    <label>{{__('lang.twitter')}}</label>
                                    <input type="text" wire:model="twitter" class="form-control" placeholder="{{__('lang.twitter')}}"/>
                                    @error('twitter') <span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                                 <div class="form-group">
                                    <label>{{__('lang.linkedin')}}</label>
                                    <input type="text" wire:model="linkedin" class="form-control" placeholder="{{__('lang.linkedin')}}"/>
                                    @error('linkedin') <span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                               
                                 <div class="form-group">
                                      <button class="btn btn-primary text-white" wire:click="savewebsite()">{{__('lang.send')}}</button>
                                 </div>
                                </div>
                           </div>
                        </div>
                        <div wire:ignore.self class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                           <h6 class="text-center mt-1">{{__('lang.seo')}}</h6>
                           <div class="submit-page">
                                <div class="submit-section mt-1">
                                   <div class="form-group">
                                      <label>{{__('lang.metatitle')}}</label>
                                      <input type="text" wire:model="meta_title" class="form-control" placeholder="{{__('lang.metatitle')}}">
                                      @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <label>{{__('lang.metacontent')}}</label>
                                      <textarea type="text" wire:model="meta_description" class="form-control" placeholder="{{__('lang.metacontent')}}"></textarea>
                                      @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <label>{{__('lang.metakeyword')}}</label>
                                      <textarea type="text" wire:model="meta_keyword" class="form-control" placeholder="{{__('lang.metakeyword')}}"></textarea>
                                      @error('meta_keyword') <span class="text-danger">{{ $message }}</span> @enderror
                                   </div>
                                   <div class="form-group">
                                      <button class="btn btn-primary text-white" wire:click="saveseo()">{{__('lang.send')}}</button>
                                   </div>
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
 
 