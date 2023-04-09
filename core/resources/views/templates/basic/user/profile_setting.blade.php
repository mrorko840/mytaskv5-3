@extends($activeTemplate.'layouts.master')
@section('content')


<!-- page content start -->
<main class="flex-shrink-0 main">
    @include(activeTemplate() . 'includes.top_nav_mini')

    <div class="main-container">
        <div class="container">

            <div class="card mb-4">
                <div class="row user-profile text-center">
                    <div  class="col-6 profile-thumb-wrapper text-center ms-1 mt-4 mb-3">
                        <div style="width: 7.25rem; height: 7.25rem;" class="profile-thumb">
                            <div class="avatar-preview">
                                <div style="width: 7.25rem; height: 7.25rem; background-image: url( '{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}' );" class="profilePicPreview rounded-circle" style=""></div>
                            </div>
                            @if (request()->path() == 'user/profile-setting')
                            <form action="{{route('user.profile.photo')}}" method="POST" enctype="multipart/form-data" id="imgForm">
                                <div class="avatar-edit">
                                    <input type='file' class="profilePicUpload" id="image" name="image" accept=".png, .jpg, .jpeg" />
                                    <label  class="text-white bg-warning imgEdit" for="image">
                                        <span class="material-icons">photo_camera</span>
                                    </label>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 ">
                        <div class="align-middle pt-5">
                            <h6 class="title align-middle">{{ __($user->fullname) }}</h6>
                            <span class="align-middle">@lang('user id'): {{ __($user->username) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <form id="profileSetting" class="user-profile-form" action="" method="post" enctype="multipart/form-data">
                @csrf
                @if (request()->path() == 'user/profile-setting')
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="subtitle mb-0">
                            <div class="avatar avatar-40 bg-success-light text-success rounded mr-2"><span
                                    class="material-icons vm">account_circle</span></div>
                            User Informations
                        </h6>
                    </div>
                    
                    <div class="card-body">

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="InputFirstname" name="firstname" value="{{$user->firstname}}">
                            <label class="form-control-label">First Name</label>
                        </div>
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user->lastname}}">
                            <label class="form-control-label">Last Name</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="tel" class="form-control" id="phone" name="mobile" value="{{$user->mobile}}">
                            <input type="hidden" name="country" id="country" class="form-control d-none" value="{{@$user->address->country}}">
                            <label class="form-control-label">Mobile Number</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" readonly>
                            <label class="form-control-label">E-Mail</label>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-block btn-default rounded" value="Update Information">
                    </div>
                </div>
                @endif
            </form>

            <form id="addressSetting" class="user-profile-form" action="" method="post" enctype="multipart/form-data">
                @csrf

                @if (request()->path() == 'user/address-setting')
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="subtitle mb-0">
                            <div class="avatar avatar-40 bg-warning-light text-warning rounded mr-2"><span
                                    class="material-icons vm">location_city</span></div>
                            User Address
                        </h6>
                    </div>
                    
                    <div class="card-body">

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="state" name="state" value="{{@$user->address->state}}">
                            <label class="form-control-label">State</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="zip" name="zip" value="{{@$user->address->zip}}">
                            <label class="form-control-label">Zip Code</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="city" name="city" value="{{@$user->address->city}}">
                            <label class="form-control-label">City</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="address" name="address" value="{{@$user->address->address}}">
                            <label class="form-control-label">Address</label>
                        </div>

                        <div class="form-group float-label active">
                            <select class="form-control" id="country" name="country" required>
                                @foreach ($countries as $key => $country)
                                    <option @selected($country->country==$user->address?->country) value="{{ $country->country }}">{{ __($country->country) }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" id="country" name="country" value="{{@$user->address->country}}" readonly> --}}
                            <label class="form-control-label">Country</label>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-block btn-default rounded" value="Update Address">
                    </div>

                </div>
                @endif

            </form>

        </div>
    </div>
</main>


{{-- <div class="cmn-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form class="register" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('First Name')</label>
                                    <input type="text" class="form-control" name="firstname" value="{{$user->firstname}}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('Last Name')</label>
                                    <input type="text" class="form-control" name="lastname" value="{{$user->lastname}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('E-mail Address')</label>
                                    <input class="form-control" value="{{$user->email}}" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('Mobile Number')</label>
                                    <input class="form-control" value="{{$user->mobile}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('Address')</label>
                                    <input type="text" class="form-control" name="address" value="{{@$user->address->address}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('State')</label>
                                    <input type="text" class="form-control" name="state" value="{{@$user->address->state}}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="form-label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control" name="zip" value="{{@$user->address->zip}}">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="form-label">@lang('City')</label>
                                    <input type="text" class="form-control" name="city" value="{{@$user->address->city}}">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="form-label">@lang('Country')</label>
                                    <input class="form-control" value="{{@$user->address->country}}" disabled>
                                </div>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/build/css/intlTelInput.css')}}">
    <style>
        .imgEdit {
            width: 35px !important; 
            height: 35px !important; 
            margin-left: -3.5rem !important; 
            margin-bottom: 1.5rem !important;
        }
    </style>
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100% !important;
        }

        .profile-thumb {
            position: relative;
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: inline-flex;
        }
        .profile-thumb .profilePicPreview {
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: block;
            border: 3px solid #ffffff;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);
            background-size: cover;
            background-position: center;
        }
        .profile-thumb .profilePicUpload {
            font-size: 0;
            opacity: 0;
        }
        .profile-thumb .avatar-edit {
            position: absolute;
            right: -15px;
            bottom: -20px;
        }
        .profile-thumb .avatar-edit input {
            width: 0;
        }
        .profile-thumb .avatar-edit label {
            width: 45px;
            height: 45px;
            background-color: #37ebec;
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            border: 2px solid #ffffff;
            font-size: 18px;
            cursor: pointer;
            color: #000000;
        }
    </style>
@endpush

@push('script')
    <script>

        //--profile Photo--//
        (function($){

            function proPicURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var preview = $(input).parents('.profile-thumb').find('.profilePicPreview');
                        $(preview).css('background-image', 'url(' + e.target.result + ')');
                        $(preview).addClass('has-image');
                        $(preview).hide();
                        $(preview).fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                }
                $(".profilePicUpload").on('change', function(e) {
                    e.preventDefault();
                    $.ajax({
                        method: "POST",
                        url: "{{route('user.profile.photo')}}",
                        data: new FormData($("#imgForm")[0]),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        success: function (res) {
                            console.log(res.msg);
                            notifyMsg(res.msg,res.cls)
                            $('#loadProfilePhoto').attr('style', '');
                            $('#loadProfilePhoto').attr('style', "background-image: url('{{route('home')}}/"+res.img+"');");
                        }
                    });
                    proPicURL(this);

                });

                $(".remove-image").on('click', function(){
                $(".profilePicPreview").css('background-image', 'none');
                $(".profilePicPreview").removeClass('has-image');
                })

        })(jQuery);

        //-- Proile Setting --//
        $(document).on('submit', '#profileSetting', function (e) {
            e.preventDefault();
            let formData = new FormData($("#profileSetting")[0])
            $.ajax({
                type: "POST",
                url: "{{route('user.profile.submit')}}",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notifyMsg(res.msg,res.cls)
                }
            });
        });

        //-- Address Setting --//
        $(document).on('submit', '#addressSetting', function (e) {
            e.preventDefault();
            let formData = new FormData($("#addressSetting")[0])
            $.ajax({
                type: "POST",
                url: "{{route('user.address.submit')}}",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notifyMsg(res.msg,res.cls)
                }
            });
        });
    </script>
@endpush