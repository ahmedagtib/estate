<!DOCTYPE html>
<html>

<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		
    	
</head>
<body> 
<div class="container">
    <p class="text-danger">
        {{Date('Y/M/D')}}
    </p>   
    <p class="text-bold text-center">
        {{Config('app.name')}}
    </p>
    <div>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">{{__('lang.property')}} : {{$data->title}}</li>
            <li class="list-group-item">{{__('lang.propertytype')}} : 
                @if($data->propertytype == 'houses')  {{__('lang.houses')}}  @endif
                @if($data->propertytype == 'apartment')  {{__('lang.apartment')}}  @endif
                @if($data->propertytype == 'villas')  {{__('lang.villas')}}  @endif
                @if($data->propertytype == 'commercial')  {{__('lang.commercial')}}  @endif
                @if($data->propertytype == 'offices')  {{__('lang.offices')}}  @endif
                @if($data->propertytype == 'garage')  {{__('lang.garage')}}  @endif
                @if($data->propertytype == 'ground')  {{__('lang.ground')}}  @endif
            </li>
            <li class="list-group-item">{{__('lang.status')}} :
                @if($data->status == 'sale')   {{{__('lang.forsale')}}} @endif
                @if($data->status == 'rent')   {{{__('lang.forrent')}}}  @endif
            </li>
            <li class="list-group-item">{{__('lang.price')}} : {{config('helper.coin')}} {{$data->price}}</li>
            <li class="list-group-item">{{__('lang.energyclass')}} : {{$data->energy}}</li>
            <li class="list-group-item">{{__('lang.ges')}} : {{$data->ges}}</li>
            <li class="list-group-item">{{__('lang.area')}} : {{$data->area}}</li>
            <li class="list-group-item">{{__('lang.zipcode')}} : {{$data->zipcode}}</li>
            <li class="list-group-item">{{__('lang.address')}} : {{$data->address}}</li>
            <li class="list-group-item">{{__('lang.buildon')}} : {{$data->buildon}}</li>
            <li class="list-group-item">{{__('lang.bedrooms')}} : {{$data->bedrooms}}</li>
            <li class="list-group-item">{{__('lang.bathrooms')}} : {{$data->bathrooms}}</li>
            <li class="list-group-item">{{__('lang.rooms')}} :  {{$data->rooms}}</li>
            <li class="list-group-item">{{__('lang.name')}} : {{$data->name}}</li>
            <li class="list-group-item">{{__('lang.email')}} : {{$data->email}}</li>
            <li class="list-group-item">{{__('lang.phone')}} : {{$data->phone}}</li>
            <li class="list-group-item">{{__('lang.region')}} : {{$data->city->state->state}}</li>
            <li class="list-group-item">{{__('lang.city')}} : {{$data->city->city}}</li>
          </ul>
    </div>
    <div>
        <h4 class="block-title">{{__('lang.amenities')}}</h4>
        <ul>
            @if($data->features != null && count($data->features) > 0)
            @foreach($data->features as $features)
              @if($features == 'equippedkitchen')   <li>{{__('lang.equippedkitchen')}}</li> @endif
              @if($features == 'americankitchen')   <li>{{__('lang.americankitchen')}}</li> @endif
              @if($features == 'separatetoilet')   <li>{{__('lang.separatetoilet')}}</li> @endif
              @if($features == 'bathtub')   <li>{{__('lang.bathtub')}}</li> @endif
              @if($features == 'fireplace')   <li>{{__('lang.fireplace')}}</li> @endif
              @if($features == 'airconditioner')   <li>{{__('lang.airconditioner')}}</li> @endif
              @if($features == 'cupboards')   <li>{{__('lang.cupboards')}}</li> @endif
              @if($features == 'parquet')   <li>{{__('lang.parquet')}}</li> @endif
              @if($features == 'alarm')   <li>{{__('lang.alarm')}}</li> @endif
              @if($features == 'attic')   <li>{{__('lang.attic')}}</li> @endif
              @if($features == 'balcony')   <li>{{__('lang.balcony')}}</li> @endif
              @if($features == 'terrace')   <li>{{__('lang.terrace')}}</li> @endif
              @if($features == 'garden')   <li>{{__('lang.garden')}}</li> @endif
              @if($features == 'garageparking')   <li>{{__('lang.garageparking')}}</li> @endif
              @if($features == 'cellar')   <li>{{__('lang.cellar')}}</li> @endif
              @if($features == 'swimmingpool')   <li>{{__('lang.swimmingpool')}}</li> @endif
              @if($features == 'tennis')   <li>{{__('lang.tennis')}}</li> @endif
              @if($features == 'elevator')   <li>{{__('lang.elevator')}}</li> @endif
              @if($features == 'guardian')   <li>{{__('lang.guardian')}}</li> @endif
              @if($features == 'digicode')   <li>{{__('lang.digicode')}}</li> @endif
              @if($features == 'intercom')   <li>{{__('lang.intercom')}}</li> @endif
              @if($features == 'calm')   <li>{{__('lang.calm')}}</li> @endif
              @if($features == 'heater')   <li>{{__('lang.heater')}}</li> @endif
              @if($features == 'luminous')   <li>{{__('lang.luminous')}}</li> @endif
            @endforeach
        @endif
        </ul>
    </div>
    <div class="row">
        @if(count($data->photos) > 0)
        @foreach($data->photos as $photo)
       <div class="col-md-6">
          <img width="600" height="400" src="{{asset($photo)}}" />
       </div>
       @endforeach
       @endif
    </div>
</div>
</body>
</html>