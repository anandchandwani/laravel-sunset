@component('base')
    @include('apps-table', ['apps' => $apps])
    @include('ip-table', ['ips' => $ips])
    @include('requests-table', ['requests' => $requests])
@endcomponent