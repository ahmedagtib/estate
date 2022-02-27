<div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <h2 class="ipt-title">{{__('lang.contactus')}}</h2>
                    <span class="ipn-subtitle">{{__('lang.descriptioncontactus')}}</span>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->
    
    <!-- ============================ Agency List Start ================================== -->
    <section>
    
        <div class="container">
        
            <!-- row Start -->
            <div class="row">
            
                <div class="col-lg-7 col-md-7">
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.fullname')}}</label>
                                <input wire:model="name" type="text" class="form-control simple">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.email')}}</label>
                                <input wire:model="email" type="email" class="form-control simple">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>{{__('lang.subject')}}</label>
                        <input wire:model="subject" type="text" class="form-control simple">
                        @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>{{__('lang.message')}}</label>
                        <textarea wire:model="message" class="form-control simple"></textarea>
                        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <button  wire:click="sendmail" class="btn btn-theme" type="submit">{{__('lang.send')}}</button>
                    </div>
                                    
                </div>
                
                <div class="col-lg-5 col-md-5">
                    <div class="contact-info">
                        
                        @if(isset($settingcontact->contact_title))<h2>{{$settingcontact->contact_title}}</h2>@endif
                        @if(isset($settingcontact->contact_content))
                        <p>{{$settingcontact->contact_content}}</p>
                        @endif
                        
                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-home"></i>
                            </div>
                            <div class="cn-info-content">
                                @if(isset($settingcontact->adress))
                                <h4 class="cn-info-title">{{__('lang.reachus')}}</h4>
                                {{$settingcontact->adress}}
                                @endif
                            </div>
                        </div>
                        
                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="cn-info-content">
                                @if(isset($settingcontact->email))
                                <h4 class="cn-info-title">{{__('lang.dropamail')}}</h4>
                                  {{$settingcontact->email}}
                                @endif
                            </div>
                        </div>
                        
                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="cn-info-content">
                                @if(isset($settingcontact->phone))
                                <h4 class="cn-info-title">{{__('lang.callus')}}</h4>
                                {{$settingcontact->phone}}
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <!-- /row -->		
            
        </div>
                
    </section>
</div>
