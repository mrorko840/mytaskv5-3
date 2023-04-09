@php
    $yourLinks = getContent('links.content', true);
@endphp

<!-- App Download Modal -->
<div class="modal fade" id="appDownloadModal" tabindex="-1" role="dialog" aria-labelledby="appDownloadModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-custom">
            <div style="justify-content: center;" class="modal-header py-1">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Install Software</h5>
                {{-- <button type="button" class="close bg-danger rounded-circle" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center">

                    <div class="col-auto text-center">
                        <a class="text-white" href="{{ $yourLinks->data_values->AppleApps }}">
                            <div class="stat-box bg-info border-custom shadow">
                                <i style="font-size: 70px;" class="lab la-app-store"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto text-center">
                        <a class="text-white" href="{{ $yourLinks->data_values->AndroidApps }}">
                            <div class="stat-box bg-success border-custom shadow">
                                <i style="font-size: 70px;" class="lab la-android"></i>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-sm btn-danger border-custom" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
