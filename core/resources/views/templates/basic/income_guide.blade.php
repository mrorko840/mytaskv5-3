@extends($activeTemplate .'layouts.frontend')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">

    <style>
        a {
            text-decoration: none !important;
            text-decoration-color: none !important;
        }
    </style>

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.home.top_nav_mini')

        <div class="main-container">

            <!-- page content start -->
            <div class="container mb-3">

                <div class="card">
                    <div class="card-header border-0 bg-none">
                        <div class="row">
                            <div class="col align-self-center">
                                <h6 class="mb-0">Work Income</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">VIP</th>
                                        <th class="text-center" scope="col">{{ $general->cur_text }}</th>
                                        <th class="text-center" scope="col">Daily Task</th>
                                        <th class="text-center" scope="col">Daily Income</th>
                                        <th class="text-center" scope="col">Monthly Income</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($plans as $item)
                                    <tr>
                                        <th scope="row">{{ $item->name }}</th>
                                        <td class="text-center">{{ showAmount($item->price) }}</td>
                                        <td class="text-center">{{ $item->daily_limit }}</td>
                                        <td class="text-center">{{ showAmount($item->daily_limit * $item->ads_rate) }}</td>
                                        <td class="text-center">{{ showAmount(($item->daily_limit * $item->ads_rate) * 30) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- footer-->
    @include($activeTemplate . 'includes.home.bottom_nav')


</body>
@endsection