<h3>IPs Table</h3>
@if (count($ips))
<!-- <table class="table sortable-theme-bootstrap" data-sortable> -->

<div class="btn-group" role="group">
    <label for="ip-filter-control">IP:</label>
    <input type="text" class="form-control filter-input" name="ip" id="ip-filter-control">
    <label for="os-filter-control">os:</label>
    <input type="text" class="form-control filter-input" name="os" id="os-filter-control">
    <label for="country-filter-control">country:</label>
    <input type="text" class="form-control filter-input" name="country" id="country-filter-control">
    <label for="app_id-filter-control">app_id:</label>
    <select name="app_id" id="app_id-filter-control" class="filter-input form-control">
        @foreach ($apps as $app)
        <option value="{{$app->id}}">{{$app->app_name}}</option>
        @endforeach
    </select>
    <label for="is_blacklisted-filter-control">is_blacklisted:</label>
    <select name="is_blacklisted" id="is_blacklisted-filter-control" class="filter-input form-control">
        <option value="0">Yes</option>
        <option value="1">No</option>
    </select>
    <label for="redirect_url-filter-control">redirect_url:</label>
    <input type="text" class="form-control filter-input" name="redirect_url" id="redirect_url-filter-control">
</div>

<table id="ipTable" class="table"
data-url="/darkcloud/api/ip" 
data-id-field="id"
data-editable-url="/darkcloud/api/ip/"
data-filter-control="true"
data-filter-show-clear="true">
    <thead>
        <tr>
            <th data-field="id">ID<br><br><br></th>
            <th data-field="ip">IP</th>
            <th data-field="os">os</th>
            <th data-field="country">country</th>
            <th data-field="time">time<br><br><br></th>
            <th data-field="app_id">app_id</th>
            <th
            data-field="is_blacklisted"
            data-editable="true"
            data-editable-type="select"
            data-editable-title="Blacklist this IP? The IP will NEVER be redirected."
            data-editable-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]">
                is_blacklisted
            </th>
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
        console.log('checked');
        function handleDeleteIpBtn(){
            const disable = !$('#ipTable').bootstrapTable('getSelections').length;
            $('.delete-ips').attr('disabled', disable);
        }
        handleDeleteIpBtn();

        function collectFilterParams() {
            params = {};
            $('.filterControls input').each(function (item) {
                params[item.attr('name')] = item.val()
            });
            console.log(params);
            return params;
        }

        var ipsFilterParams = Object.create(null);
        $('.filter-input').on('change', function() {
            ipsFilterParams[$(this).attr('name')] = $(this).val();
            for (var param in ipsFilterParams) {
                if (ipsFilterParams[param] == '')
                    delete ipsFilterParams[param];
            }
            $('#ipTable').bootstrapTable('refresh', {query:ipsFilterParams});
        })
    });



</script>