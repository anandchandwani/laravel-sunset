@component('base')
    @include('apps-table', ['apps' => $apps])
    <hr>
    @include('ip-table', ['ips' => $ips, 'apps' => $apps])
    <hr>
    @include('requests-table', ['requests' => $requests])
@endcomponent