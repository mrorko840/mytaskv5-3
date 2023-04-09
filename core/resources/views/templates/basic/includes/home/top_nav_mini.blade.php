<?php 
$user = Auth::user(); 
$noticeCaption = getContent('notice.content',true);
?>

<!-- Fixed navbar -->
<header  class="header">
    <div class="row">

        <div class="col-auto px-0">
            <button class="menu-btn btn btn-40 btn-link back-btn" type="button">
                <span class="material-icons">keyboard_arrow_left</span>
            </button>
        </div>

        <div class="text-left col align-self-center">
            <a class="navbar-brand" href="#">
                <h5 class="mb-0">{{ @$pageTitle }}</h5>
            </a>
        </div>
        <div class="ml-auto col-auto pl-0">

            {{-- <button type="button" class="btn btn-link btn-40 colorsettings">
                <span class="material-icons">color_lens</span>
            </button> --}}

            <div class="row">
                <div class="custom-control custom-switch pt-2">
                    <input type="checkbox" class="custom-control-input switch-info text-align-center" id="darklayout" >
                    <label class="custom-control-label" for="darklayout">
                        <span class="material-icons">
                            mode_night
                        </span>
                    </label>
                </div>
    
                <a href="notification.html" class=" btn btn-40 btn-link" data-toggle="modal" data-target="#noticeModal">
                    <span class="material-icons">notifications_none</span>
                    <span class="counter"></span>
                </a>

                {{-- <div style="padding-right: 0.5rem !important;" class="mt-1">
                    <a href="{{ route('user.display_profile') }}" class="avatar avatar-30 shadow-sm rounded-circle ml-2 mt-1">
                        <figure class="m-0 background">
                          <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="">
                        </figure>
                    </a>
                </div> --}}
                
            </div>
        </div>
    </div>
    
</header>


@include(activeTemplate() . 'includes.color_change')
@include(activeTemplate() . 'includes.notice_modal')


