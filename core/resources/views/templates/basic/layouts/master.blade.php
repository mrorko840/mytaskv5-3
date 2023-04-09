@extends($activeTemplate.'layouts.app')
@section('panel')
    <div class="page-wrapper">
        {{-- @include($activeTemplate.'partials.user_header')
        @include($activeTemplate.'partials.breadcrumb') --}}
        @yield('content')

        <!-- Deposit Modal -->
        @include(activeTemplate() . 'modals.deposit_modal')
        <!-- Withdraw Modal -->
        @include(activeTemplate() . 'modals.withdraw_modal')
        <!-- Transfer Modal -->
        @include(activeTemplate() . 'modals.transfer_modal')
    </div>
@endsection
