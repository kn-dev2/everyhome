@extends('layouts.frontend')

@section('content')

<div class="container">
    <div class="columns">
        <h3 class="heading">Book <span>Now</span></h3>
        <!-- <img class="loading" src="{{ asset('frontend/img/loading-buffering.gif') }}" alt=""> -->
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>

    {{ Form::open(['route' => 'ajax.book.order.now', 'method' => 'post','id' => 'Boooking-form','name'=>'booking_form','class'=>"form-horizontal",'enctype'=>"multipart/form-data"]) }}
    <div class="row booking-form">
        <div class="col-md-8">
            <h3 class="card-title" style="text-align:center">Complete your booking.</h3>
            <p style="text-align:center">Great! Few details and we can complete your booking.</p>
            <div class="form-group row @error('service_id') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">What type of service would you like?</label>
                <div class="col-sm-6">
                    {{ Form::select('service_id',$services,$service_id,['class' => 'form-control']) }}
                    @error('service_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row @error('home_type') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">STEP 2: TELL US ABOUT YOUR HOME</label>
                <p>Home Type</p>
                <div class="col-sm-3">
                    {{ Form::select('home_type',$home_types,null,['class' => 'form-control']) }}
                    @error('home_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @if(isset($home_sub_type_details->title))
                <div class="col-sm-3 home_sub_type">
                @else
                <div class="col-sm-3 home_sub_type" style="display:none;">
                @endif
                {{ Form::select('home_sub_type',$home_sub_type_dropdown,null,['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">STEP 3: CONTACT INFORMATION</label>
                <div class="col-sm-3 is-invalid">
                    @php 
                        if(isset(Auth::user()->name)) {
                            $name = explode(' ',Auth::user()->name);
                            $first_name = $name[0];
                            $last_name  = isset($name[1]) ? $name[1] : '';     
                         } else {
                             $first_name = '';
                             $last_name  = '';
                         }
                    @endphp
                    {{ Form::text('first_name',$first_name,['class' => 'form-control', 'placeholder' =>'Enter First Name*','id'=>'first_name']) }}
                    <span class="invalid-feedback" role="alert" id="first_name_error">
                    </span>
                   
                </div>
                <div class="col-sm-3 @error('last_name') is-invalid @enderror">
                    {{ Form::text('last_name',$last_name,['class' => 'form-control', 'placeholder' =>'Enter Last Name*','id'=>'last_name']) }}
                    <span class="invalid-feedback" role="alert" id="last_name_error">
                    </span>
                   
                </div>
                <div class="col-sm-3 @error('email') is-invalid @enderror">
                    {{ Form::text('email',isset(Auth::user()->email) ? Auth::user()->email : '',['class' => 'form-control', 'placeholder' =>'Enter Email*','id'=>'email']) }}
                    <span class="invalid-feedback" role="alert" id="email_error">
                    </span>
                </div>
                <div class="col-sm-3 @error('phone') is-invalid @enderror">
                    {{ Form::text('phone',isset(Auth::user()->phone) ? Auth::user()->phone : '',['class' => 'form-control', 'placeholder' =>'Enter Phone*','id'=>'phone']) }}
                    <span class="invalid-feedback" role="alert" id="phone_error">
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">STEP 4: ADDRESS INFORMATION</label>
                <div class="col-sm-3 @error('address') is-invalid @enderror">
                    {{ Form::text('address',isset(Auth::user()->address) ? Auth::user()->address : '',['class' => 'form-control', 'placeholder' =>'Enter Address*','id'=>'address']) }}
                    <span class="invalid-feedback" role="alert" id="address_error">
                    </span>
                </div>
                <div class="col-sm-3 @error('suite') is-invalid @enderror">
                    {{ Form::text('suite',isset(Auth::user()->suite) ? Auth::user()->suite : '',['class' => 'form-control', 'placeholder' =>'Enter Apt/Suite #','id'=>'suite']) }}
                    <span class="invalid-feedback" role="alert" id="suite_error">
                    </span>
                </div>
                <div class="col-sm-3 @error('city') is-invalid @enderror">
                    {{ Form::text('city',isset(Auth::user()->city) ? Auth::user()->city : '',['class' => 'form-control', 'placeholder' =>'Enter City*','id'=>'city']) }}
                    <span class="invalid-feedback" role="alert" id="city_error">
                    </span>
                </div>
                <div class="col-sm-3 @error('state') is-invalid @enderror">
                    {{ Form::select('state',$states,isset(Auth::user()->state) ? Auth::user()->state : null,['class' => 'form-control', 'placeholder' =>'Select State*','id'=>'state']) }}
                    <span class="invalid-feedback" role="alert" id="state_error">
                    </span>
                </div>
                <div class="col-sm-3 @error('zipcode') is-invalid @enderror">
                    {{ Form::text('zipcode',isset(Auth::user()->zipcode) ? Auth::user()->zipcode : null,['class' => 'form-control', 'placeholder' =>'Enter Zipcode*','id'=>'zipcode']) }}
                    <span class="invalid-feedback" role="alert" id="zipcode_error">
                    </span>
                </div>
            </div>
            <div class="form-group row select_extras">
                <label class="col-sm-4 col-form-label">STEP 4: SELECT EXTRAS</label>
                <p>Adds extra time</p>
                <ul>
                    @foreach($extra_services as $singleExtraService)
                    <li>
                        {{ Form::checkbox('extra_service[]',$singleExtraService->id,null,['placeholder' =>$singleExtraService->title,'id'=>"extra_service".$singleExtraService->id,'class'=>'check_options']) }}
                        <label for="extra_service{{$singleExtraService->id}}"><img src="{{asset('frontend/img/extra_services/').'/'.$singleExtraService->icon}}" />
                            <p data-price="{{$singleExtraService->price}}">{{$singleExtraService->title}}</p>
                        </label>
                        @if($singleExtraService->type==1)
                        <div class="qty_{{$singleExtraService->id}}" style="display:none;margin-left: 17px;">
                            {{ Form::number('extra_service_qty['.$singleExtraService->id.']',1,['min'=>1,'max'=>10000,'placeholder' =>'Quantity','id'=>"extra_service_qty".$singleExtraService->id,'class'=>'qty_extra_service']) }}
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group row">
                <div class="col-sm-3 @error('discount_code') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Discount Code</label>
                    {{ Form::text('discount_code',old('discount_code'),['class' => 'form-control', 'placeholder' =>'Enter Discount Code*']) }}
                    <span class="invalid-feedback" role="alert">
                    </span>
                </div>
                <div class="col-sm-3">
                    {{ Form::button('Apply', ['class' => 'btn btn-lg btn-primary','id'=>'discount_code_apply']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">When would you like us to come?</label>
                <br>
                <div class="col-sm-3 @error('date') is-invalid @enderror">
                    {{ Form::text('date',null,['class' => 'form-control', 'placeholder' =>'Click to choose a date','id'=>'date','readyonly'=>'readonly']) }}
                    <span class="invalid-feedback" role="alert" id="date_error">
                    </span>
                </div>

                <div class="col-sm-3 @error('time_slot') is-invalid @enderror">
                <!-- <SELECT ID="my_select" class="select_time_slot"></SELECT> -->
                    {{ Form::select('time_slot_select',array(),null,['class' => 'form-control select_time_slot', 'placeholder' =>'--','id'=>'time_slot']) }}
                    {{ Form::hidden('time_slot',null,['class' => 'form-control']) }}
                    <span class="invalid-feedback" role="alert" id="time_slot_error">
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">How often?
                    <p>It's all about matching you with the perfect clean for your home. Scheduling is flexible. Cancel or reschedule anytime.</p>
                </label>
                <ul class="schedule_types @error('schedule_type') is-invalid @enderror">
                    <li>
                    {{ Form::radio('schedule_type','Weekly',null,['class' => 'form-control', 'placeholder' =>'Weekly','id'=>'Weekly']) }}
                        <label for="Weekly">Weekly</label>
                    </li>
                    <li>
                    {{ Form::radio('schedule_type','Biweekly',null,['class' => 'form-control', 'placeholder' =>'Biweekly','id'=>'Biweekly']) }}
                        <label for="Biweekly">Biweekly</label>
                    </li>
                    <li>
                    {{ Form::radio('schedule_type','Monthly',null,['class' => 'form-control', 'placeholder' =>'Monthly','id'=>'Monthly']) }}
                        <label for="Monthly">Monthly</label>
                    </li>
                    <li>
                    {{ Form::radio('schedule_type','One Time',1,['class' => 'form-control', 'placeholder' =>'One Time','id'=>'One_Time']) }}
                        <label for="One_Time">One Time</label>
                    </li>
                </ul>
                @error('schedule_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

            <div class="alert_message alert alert-danger" style="display:none"></div>
            <div class="alert_success_message alert alert-success" style="display:none"></div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8">
                    <input type="hidden" id="stripeToken" name="stripeToken" />
                    <input type="hidden" id="stripeEmail" name="stripeEmail" />
                    <input type="hidden" id="amountInCents" name="amountInCents" />
                    {{ Form::button('Book Now', ['class' => 'btn btn-lg btn-primary','id'=>'booking_form_submit']) }}
                    {{ Form::button('<i class="fa fa-refresh fa-spin"></i> Loading', ['class' => 'btn btn-lg btn-primary','id'=>'booking_form_loader']) }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-section shadow-border text-center editable can-be-hidden content-panel ng-binding" ng-class="{hidden: !ctrl.contentArea.show}" ng-bind-html="ctrl.trustedHtmlContent" data-code="content_area" data-id="120" data-type="content_area">
                <div class="form_section text-center" id="content_panel" style="box-sizing: border-box; text-align: center; padding: 30px 0px 0px; border-radius: 2px; color: rgb(171, 171, 171); font-family: proxima, arial; font-size: 16px; line-height: 22.8571434020996px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">
                    <div class="icon-sidebar">
                        <svg role="img" class="clock" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 281.965 281.965" enable-background="new 0 0 281.965 281.965" xml:space="preserve">
                            <use xlink:href="https://everyhomecleaningservice.launch27.com/images/tenant/form/icons.svg#clock"></use>
                        </svg>
                    </div>
                    <h4 style="box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(55, 62, 74); margin-top: 8.5px; margin-bottom: 8.5px; padding: 0px 20px;">SAVES YOU TIME</h4>
                    <p style="box-sizing: border-box; margin: 0px 0px 8.5px; padding: 0px 20px 40px; font-weight: lighter;color: #6d6e73;font-size: 16px;">Our service helps you live smarter, giving you time to focus on what's most important.</p>
                    <div class="icon-sidebar">
                        <svg role="img" class="shield" x="0px" y="0px" width="28px" height="31px" viewBox="0 0 212.59 296.004" enable-background="new 0 0 212.59 296.004" xml:space="preserve">
                            <use xlink:href="https://everyhomecleaningservice.launch27.com/images/tenant/form/icons.svg#shield"></use>
                        </svg>
                    </div>
                    <h4 style="box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(55, 62, 74); margin-top: 8.5px; margin-bottom: 8.5px; padding: 0px 20px;">SAFETY FIRST</h4>
                    <p style="box-sizing: border-box; margin: 0px 0px 8.5px; padding: 0px 20px 40px; font-weight: lighter;color: #6d6e73;font-size: 16px;">We rigorously vet all of our Cleaners, who undergo identity checks as well as in-person interviews.</p>
                    <div class="icon-sidebar">
                        <svg role="img" fill="currentColor" class="thumb-up" x="0px" y="0px" width="28px" height="25px" viewBox="0 0 286.198 266.346" enable-background="new 0 0 286.198 266.346" xml:space="preserve">
                            <use xlink:href="https://everyhomecleaningservice.launch27.com/images/tenant/form/icons.svg#thumb-up"></use>
                        </svg>
                    </div>
                    <h4 style="box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(55, 62, 74); margin-top: 8.5px; margin-bottom: 8.5px; padding: 0px 20px;">ONLY THE BEST QUALITY</h4>
                    <p style="box-sizing: border-box; margin: 0px 0px 8.5px; padding: 0px 20px 40px; font-weight: lighter;color: #6d6e73;font-size: 16px;">Our skilled professionals go above and beyond on every job. Cleaners are rated and reviewed after each task.</p>
                    <div class="icon-sidebar">
                        <svg role="img" fill="currentColor" class="cleaning-bottle" x="0px" y="0px" width="23px" height="39px" viewBox="0 0 165.503 284.223" enable-background="new 0 0 165.503 284.223" xml:space="preserve">
                            <use xlink:href="https://everyhomecleaningservice.launch27.com/images/tenant/form/icons.svg#cleaning-bottle"></use>
                        </svg>
                    </div>
                    <h4 style="box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(55, 62, 74); margin-top: 8.5px; margin-bottom: 8.5px; padding: 0px 20px;">EASY TO GET HELP</h4>
                    <p style="box-sizing: border-box; margin: 0px 0px 8.5px; padding: 0px 20px 40px; font-weight: lighter;color: #6d6e73;font-size: 16px;">Select your ZIP code, number of bedrooms and bathrooms, date and relax while we take care of your home.</p>
                    <div class="icon-sidebar">
                        <svg role="img" fill="currentColor" class="bubble" x="0px" y="0px" width="33px" height="29px" viewBox="0 0 309.063 268" enable-background="new 0 0 309.063 268" xml:space="preserve">
                            <use xlink:href="https://everyhomecleaningservice.launch27.com/images/tenant/form/icons.svg#bubble"></use>
                        </svg>
                    </div>
                    <h4 style="box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(55, 62, 74); margin-top: 8.5px; margin-bottom: 8.5px; padding: 0px 20px;">SEAMLESS COMMUNICATION</h4>
                    <p style="box-sizing: border-box; margin: 0px 0px 8.5px; padding: 0px 20px 40px; font-weight: lighter;color: #6d6e73;font-size: 16px;">Online communication makes it easy for you to stay in touch with your Cleaners.</p>
                    <div class="icon-sidebar">
                        <svg role="img" fill="currentColor" class="visa" x="0px" y="0px" width="31px" height="21px" viewBox="0 0 378 235" enable-background="new 0 0 378 235" xml:space="preserve">
                            <use xlink:href="https://everyhomecleaningservice.launch27.com/images/tenant/form/icons.svg#visa"></use>
                        </svg>
                    </div>
                    <h4 style="box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(55, 62, 74); margin-top: 8.5px; margin-bottom: 8.5px; padding: 0px 20px;">CASH FREE PAYMENT</h4>
                    <p style="box-sizing: border-box; margin: 0px 0px 8.5px; padding: 0px 20px 40px; font-weight: lighter;color: #6d6e73;font-size: 16px;">Pay securely online only when the cleaning is complete.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-top: 10px;">
            <div class="form-section shadow-border summary-panel" style="width: 605.857px; top: 0px;">
                <h3 class="text-center booking-summary editable can-be-hidden">
                    <span class="ng-binding">
                        BOOKING SUMMARY
                    </span>
                </h3>

                <fieldset>
                    <ul class="fa-ul">
                        <li>
                        <i class="fa fa-home fa-li fa-2x" aria-hidden="true"></i>
                            <div class="editable">
                                <div class="summary">
                                    <div class="service-summary">
                                        <div class="service-summary-title home_type_class">
                                            {{isset($single_home_type->title) ? $single_home_type->title : 'No home type selected' }}
                                        </div>
                                        <div class="service-summary-total home_type_class_price">
                                        ${{isset($single_home_type->price) ? $single_home_type->price : 0}}
                                        
                                        </div>
                                    </div>
                                    <ul class="summary-items home_sub_type_class">
                                        @if(isset($home_sub_type_details->title))
                                        <li class="home_sub_type_added">
                                        @else
                                        <li class="home_sub_type_added" style="display:none">
                                        @endif
                                        <span>{{isset($home_sub_type_details->title) ? $home_sub_type_details->title : ''}}</span> - <b class="home_sub_type_price">${{isset($home_sub_type_details->price) ? $home_sub_type_details->price : ''}}</b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-calendar fa-li fa-2x">
                            </i>
                            <p class="summary service_date_summary">
                                Choose service date...
                            </p>
                        </li>
                        <li class="booking-summary-duration editable can-be-hidden" style="display: list-item;">
                            <i class="fa fa-clock-o fa-li fa-2x">
                            </i>
                            <p class="summary service_duration">    
                            {{$hours}} Hours {{$minutes}} Minutes
                            </p>
                        </li>
                        <li class="select-frequency">
                            <i class="fa fa-refresh fa-li fa-2x">
                            </i>
                            <p class="summary frequency_summary editable editable-placeholder">
                                One Time
                            </p>
                        </li>
                    </ul>
                </fieldset>

                <fieldset>
                    <div class="form-group sub-total-row col-sm-12 summary-row editable can-be-hidden">
                        <div class="col-sm-6 text-left">
                            <div class="sub-total">
                                <span>
                                    SUB-TOTAL
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right sub-total-value">
                        ${{$total_price}}
                        </div>
                    </div>

                    <div class="form-group tip-row col-sm-12 summary-row editable can-be-hidden">
                        <div class="col-sm-6 text-left">
                            <div class="discount">
                                <span>
                                    TIP
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right tip-value">
                            $0.00
                        </div>
                    </div>

                    <div class="form-group discount-row col-sm-12 summary-row editable can-be-hidden">
                        <div class="col-sm-6 text-left">
                            <div class="discount">
                                <span>
                                    DISCOUNT
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right discount-value">
                            $0.00
                        </div>
                    </div>
                    <div class="form-group total-row col-sm-12 summary-row editable">
                        <div class="col-sm-4 text-left total-price">
                            <strong>
                                <span>
                                    TOTAL
                                </span>
                            </strong>
                        </div>
                        <div class="col-sm-8 text-right amount final-price-value">
                        ${{$total_price}}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
</div>

<!-- <form action="/your-server-side-code" method="POST">
            
        </form> -->

<section class="service-area clearfix" data-equalizer>
    <div class="medium-6 large-7 columns google-map" data-equalizer-watch>
        <a href="https://www.google.com/maps/d/edit?mid=1Lt2_qR6qn-fAhIWt6crIhsMvf-0eVsU6&usp=sharing" target="_blank"></a>
    </div>

    <div class="medium-6 large-5 columns cities" data-equalizer-watch>
        <h4 class="sub-heading">Our Service Area Includes:</h4>
        <div class="clearfix">
            <div class="small-6 columns">
                <ul>
                    <li><span>Aliso Viejo, CA</span></li>
                    <li><span>Corona Del Mar, CA</span></li>
                    <li><span>Costa Mesa, CA</span></li>
                    <li><span>Coto de Caza, CA</span></li>
                    <li><span>Dana Point, CA</span></li>
                    <li><span>Foothill Ranch, CA</span></li>
                    <li><span>Irvine, CA</span></li>
                    <li><span>Ladera Ranch, CA</span></li>
                    <li><span>Laguna Beach, CA</span></li>
                    <li><span>Laguna Hills, CA</span></li>
                </ul>
            </div>

            <div class="small-6 columns">
                <ul>
                    <li><span>Laguna Niguel, CA</span></li>
                    <li><span>Laguna Woods, CA</span></li>
                    <li><span>Lake Forest, CA</span></li>
                    <li><span>Mission Viejo, CA</span></li>
                    <li><span>Newport Beach, CA</span></li>
                    <li><span>Rancho Santa Margarita</span></li>
                    <li><span>San Clemente, CA</span></li>
                    <li><span>San Juan Capistrano, CA</span></li>
                    <li><span>Trabuco Canyon, CA</span></li>
                    <li><span>Tustin, CA</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--class service-area clearfix ends-->

@endsection

<style>

    .select_extras ul {
        list-style-type: none;
    }

    ul li label p {
        font-size: 11px;
        margin-bottom: 5px !important;

    }

    .select_extras li {
        display: inline-block;
        width: 24%;
        height: 200px;
        vertical-align: middle;
    }

    .select_extras input[type="checkbox"][id^="extra_service"] {
        display: none;
    }

    .select_extras label {
        padding: 10px;
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .select_extras label::before {
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid grey;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
    }

    .select_extras label img {
        height: 100px;
        width: 100px;
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
    }

    .select_extras :checked+label {
        border-color: #ddd;
        margin: 10px 10px 0px 10px !important;
        padding-bottom:0px;
    }

    .select_extras :checked+label::before {
        content: "???";
        background-color: grey;
        transform: scale(1);
    }

    .select_extras :checked+label img {
        transform: scale(0.9);
        box-shadow: 0 0 5px #333;
        z-index: -1;
        padding: 8px;
    }
    .qty_extra_service {
        width: 100px !important;
        height: 30px !important;
        font-size:16px !important;
    }
    .schedule_types {
  list-style-type: none;
  margin: 25px 0 0 0;
  padding: 0;
}

.schedule_types li {
    float: left;
    margin: 1px 9px 11px 0;
    width: 200px;
    height: 40px;
    position: relative;
    text-align: center;
    border: 1px solid black;
}

.schedule_types label,
.schedule_types input {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.schedule_types input[type="radio"] {
  opacity: 0.01;
  z-index: 100;
}

.schedule_types input[type="radio"]:checked+label,
.Checked+label {
    background: #3a3c41;
    color: white;
    width: 100%;
    left: -8px;
}

.alert_message {
    color: red;
    background: wheat;
    padding: 15px;
    margin: 10px;
}

.alert_success_message {
    color: green;
    background: wheat;
    padding: 15px;
    margin: 10px;
}

.invalid-feedback {
    top: -16px;
    position: relative;
    color: red;
    font-size: 15px;
    padding: 10px;
}
option[disabled] {
  color: red;
}
</style>