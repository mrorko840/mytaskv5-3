@extends($activeTemplate.'layouts.master')
@section('content')


<style>
    .custom-select {
        display: inline-block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        vertical-align: middle;
        background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        appearance: none;
    }

    .custom-select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .custom-select:focus::-ms-value {
        color: #495057;
        background-color: #fff;
    }

    .custom-select[multiple],
    .custom-select[size]:not([size="1"]) {
        height: auto;
        padding-right: 0.75rem;
        background-image: none;
    }

    .custom-select:disabled {
        color: #6c757d;
        background-color: #e9ecef;
    }

    .custom-select::-ms-expand {
        display: none;
    }

    .custom-select:-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #495057;
    }

    .custom-select-sm {
        height: calc(1.5em + 0.5rem + 2px);
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        font-size: 0.875rem;
    }

    .custom-select-lg {
        height: calc(1.5em + 1rem + 2px);
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 1rem;
        font-size: 1.25rem;
    }

    .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin-bottom: 0;
    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin: 0;
        opacity: 0;
    }

    .custom-file-input:focus~.custom-file-label {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .custom-file-input[disabled]~.custom-file-label,
    .custom-file-input:disabled~.custom-file-label {
        background-color: #e9ecef;
    }

    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
    }

    .custom-file-input~.custom-file-label[data-browse]::after {
        content: attr(data-browse);
    }

    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .custom-file-label::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        height: calc(1.5em + 0.75rem);
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        content: "Browse";
        background-color: #e9ecef;
        border-left: inherit;
        border-radius: 0 0.25rem 0.25rem 0;
    }
</style>


<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">

    @include(activeTemplate().'includes.side_nav')

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include(activeTemplate().'includes.top_nav')

        <div class="pt-120 pb-120">
            <div class="main-container">
                <div class="row justify-content-center mt-4">
                    <div class="col-md-12">
                        <div class=" px-4">

                            <div class="button-contain-header text-right">
                                <a href="{{ route('ticket') }}" class="btn btn-sm btn-warning border-custom">@lang('My Supports')</a>
                            </div>

                            <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">@lang('Name')</label>
                                        <input class="form-control form--control" name="name" type="text" value="{{ @$user->firstname . ' ' . @$user->lastname }}" required readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">@lang('Email Address')</label>
                                        <input class="form-control form--control" name="email" type="email" value="{{ @$user->email }}" required readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label">@lang('Subject')</label>
                                        <input class="form-control form--control" name="subject" type="text" value="{{ old('subject') }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">@lang('Priority')</label>
                                        <select class="form-control form--control form-select" name="priority" required>
                                            <option value="3">@lang('High')</option>
                                            <option value="2">@lang('Medium')</option>
                                            <option value="1">@lang('Low')</option>
                                        </select>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="form-label">@lang('Message')</label>
                                        <textarea class="form-control form--control" id="inputMessage" name="message" rows="6" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group d-flex my-2 gap-2">
                                    <div class="input-group mb-3">
                                        <div class="custom-file ">
                                            <input type="file" name="attachments[]" id="inputAttachments" class="custom-file-input " aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label mb-0" for="inputAttachments">@lang('Choose file')</label>
                                        </div>
                                    </div>

                                    {{-- <div class="position-relative w-100">
                                        <input class="form-control custom--file-upload" id="inputAttachments" name="attachments[]" type="file" />
                                        <label for="inputAttachments">@lang('Attachments')</label>
                                    </div> --}}
                                    <div class="add-area">
                                        <button class="add-more ml-2 ml-md-4 icon-btn text-white bg-info btn btn-mini border-custom addFile" onclick="extraTicketAttachment()" type="button">
                                            <span class="material-icons">add_circle</span>
                                        </button>
                                    </div>

                                    {{-- <button class="btn btn-primary btn-sm addFile flex-shrink-0" type="button"><i class="las la-plus"></i></button> --}}
                                </div>
                                <div id="fileUploadsContainer"></div>
                                <p class="ticket-attachments-message text-muted">
                                    @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                </p>

                                <button class="btn btn-warning border-custom w-100 mt-3" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- footer-->
    @include($activeTemplate . 'includes.bottom_nav') 

</body>



{{-- <div class="cmn-section">
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="text-end">
                    <a href="{{route('ticket') }}" class="btn btn-sm btn--base mb-2">@lang('My Support Ticket')</a>
                </div>
                <div class="card custom--card">
                    <div class="card-body">
                        <form  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('Name')</label>
                                    <input type="text" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form-control form--control" required readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('Email Address')</label>
                                    <input type="email"  name="email" value="{{@$user->email}}" class="form-control form--control" required readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('Subject')</label>
                                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control form--control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('Priority')</label>
                                    <select name="priority" class="form-select form--select" required>
                                        <option value="3">@lang('High')</option>
                                        <option value="2">@lang('Medium')</option>
                                        <option value="1">@lang('Low')</option>
                                    </select>
                                </div>
                                <div class="col-12 form-group">
                                    <label class="form-label">@lang('Message')</label>
                                    <textarea name="message" id="inputMessage" rows="6" class="form-control form--control" required>{{old('message')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text-end">
                                    <button type="button" class="btn btn--base btn-sm addFile">
                                        <i class="fa fa-plus"></i> @lang('Add New')
                                    </button>
                                </div>
                                <div class="file-upload">
                                    <label class="form-label">@lang('Attachments')</label> <small class="text-danger">@lang('Max 5 files can be uploaded'). @lang('Maximum upload size is') {{ ini_get('upload_max_filesize') }}</small>
                                    <input type="file" name="attachments[]" id="inputAttachments" class="form-control form--control mb-2"/>
                                    <div id="fileUploadsContainer"></div>
                                    <p class="ticket-attachments-message text-muted">
                                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                    </p>
                                </div>

                            </div>

                            <div class="form-group">
                                <button class="btn btn--base w-100" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
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
    <style>
        .input-group-text:focus{
            box-shadow: none !important;
        }
    </style>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click',function(){
                if (fileAdded >= 4) {
                    notify('error','You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                <div class="form-group d-flex gap-2 my-2">

                    <div class="input-group mb-3">
                        <div class="custom-file ">
                            <input type="file" id="inputAttachments" name="attachments[]" class="custom-file-input " required/>
                            <label class="custom-file-label mb-0" for="inputAttachments">@lang('Choose file')</label>
                        </div>
                    </div>

                    <div class="add-area">
                        <button class="add-more ml-2 ml-md-4 icon-btn text-white bg-danger btn btn-mini border-custom remove-btn" onclick="extraTicketAttachment()" type="button">
                            <span class="material-icons">remove_circle</span>
                        </button>
                    </div>

                </div>
                `)
            });
            $(document).on('click','.remove-btn',function(){
                fileAdded--;
                $(this).closest('.form-group').remove();
            });
        })(jQuery);
    </script>
@endpush
