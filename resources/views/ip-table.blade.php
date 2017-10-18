<h3>IPs Table</h3>
@if (count($ips))
<!-- <table class="table sortable-theme-bootstrap" data-sortable> -->
<table id="ipTable" class="table" data-url="/darkcloud/api/ip">
    <!-- <table id="ipTable" class="table"> -->
    <!-- <table class="table" data-toggle="table"> -->
    <thead>
        <!-- <th data-field="checked" data-checkbox="true"></th> -->
        <th>ID</th>
        <th>IP</th>
        <th>is_blacklisted</th>
        <th>redirect_url</th>
    </thead>
    <tbody>
        @foreach ($ips as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->ip}}</td>
            <td>
                <a href="#" data-name="is_blacklisted" data-type="select" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-value="{{$item->is_blacklisted ? 1 : 0}}"
                    data-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]" data-title="Blacklist this IP?">
                    <!-- {{$item->is_blacklisted ? "Yes" : "No"}} -->
                </a>
            </td>

            <td>
                <a href="#" data-type="text" data-name="redirect_url" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-title="Update redirect_url, change where the ip will be redirected to in the future.">{{$item->redirect_url}}</a>
            </td>
        </tr>
        @endforeach
    </tbody>


    <script>

        $('#ipTable').bootstrapTable({
            search: true,
            showColumns: true,
            showToggle: true,
            editable: true,

            onAll: function (ev, data) {
                // $('a[data-pk').editable();
            },
            responseHandler: function (res) {
                console.log('resHandler', res);

                // return [
                //     {
                //         0: "0",
                //         1: "12341.43141",
                //         2: "<h2>I'm an h2</h2>",
                //         3: '<a href="#" data-type="text" data-name="redirect_url" data-pk="3" data-url="/darkcloud/api/ip/" data-title="Update redirect_url, change where the ip will be redirected to in the future." class="editable editable-click">https://google.comasdf</a>'
                //     }
                // ]
                return res;
            },
            showRefresh: true,
        });


    </script>

</table>
@else No ip data. @endif