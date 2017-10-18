@component('base')
    @include('apps-table', ['apps' => $apps])
    <hr>
    @include('ip-table', ['ips' => $ips])
    <hr>
    @include('requests-table', ['requests' => $requests])
@endcomponent