<?php 
$user = Auth::user(); 
$noticeCaption = getContent('notice.content',true);
?>

<!-- Fixed navbar -->
<header class="header">
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
        <div class="ml-auto col-auto">
            <a href="{{ route('user.display_profile') }}" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                <figure id="loadProfilePhoto" class="m-0 background">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="">
                </figure>
            </a>
        </div>
    </div>
</header>