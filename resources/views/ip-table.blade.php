<h3>IPs Table</h3>
@if (count($ips))
<!-- <table class="table sortable-theme-bootstrap" data-sortable> -->
<script>
    var blacklistedOptions = {
        '0': 'No',
        '1': 'Yes'
    };
    var campaignOptions = {
        129: '129',
        130: '130'
    }
</script>

<table id="ipTable" class="table"
data-url="/darkcloud/api/ip" 
data-id-field="id"
data-editable-url="/darkcloud/api/ip/"
data-filter-control="true"
data-filter-show-clear="true">
    <thead>
        <tr>
            <!-- <th data-field="checked" data-checkbox="true"></th> -->
            <th data-field="id"
            data-filter-control="select"
            data-filter-data="var:campaignOptions"
            >ID</th>
            <th data-field="ip">IP</th>
            <th data-field="os">os</th>
            <th data-field="country">country</th>
            <th data-field="time">time</th>
            <th data-field="campaign_id">campaign_id</th>
            <th
            data-field="is_blacklisted"
            data-editable="true"
            data-filter-control="select"
            data-filter-data="var:blacklistedOptions"
            data-editable-type="select"
            data-editable-title="Blacklist this IP? The IP will NEVER be redirected."
            data-editable-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]"
            >is_blacklisted</th>
            <th data-field="redirect_url" data-editable="true">redirect_url</th>
            <th data-field="state" data-checkbox="true"></th>
        </tr>
    </thead>
    {{--<tbody>--}}
        {{--@foreach ($ips as $item)--}}
        {{--<tr>--}}
            {{--<td>{{$item->id}}</td>--}}
            {{--<td>{{$item->ip}}</td>--}}
            {{--<td>--}}
                {{--<a href="#" data-name="is_blacklisted" data-type="select" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-value="{{$item->is_blacklisted ? 1 : 0}}"--}}
                    {{--data-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]">--}}
                {{--</a>--}}
            {{--</td>--}}

            {{--<td>--}}
                {{--<a href="#" data-type="text" data-name="redirect_url" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-title="Update redirect_url, change where the ip will be redirected to in the future.">{{$item->redirect_url}}</a>--}}
            {{--</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
    {{--</tbody>--}}
</table>

<br>

<div class="btn-group" role="group" aria-label="...">
    <button type="submit" name="app" value="create" class="btn btn-default btn-danger delete-ips">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        Delete Selected IPs
    </button>
</div>
@else No ip data. @endif

<script>
    $(document).on('ready', function(){
        $('.delete-ips').click(function(e){
            let ids = $('#ipTable').bootstrapTable('getSelections').map(x => x.id);
            $.ajax({
                url: '/darkcloud/api/ip',
                type: 'DELETE',
                data: {ids: ids},
                success: function(res){
                    $('#ipTable').bootstrapTable('refresh');
                    $('.delete-ips').attr('disabled', true);
                }
            });
        });

        $('#ipTable').on('check.bs.table uncheck.bs.table', handleDeleteIpBtn);
        function handleDeleteIpBtn(){
            const disable = !$('#ipTable').bootstrapTable('getSelections').length;
            $('.delete-ips').attr('disabled', disable);
        }
        handleDeleteIpBtn();
    });
</script>