<h3>IPs Table</h3>
@if (count($ips))
<!-- <table class="table sortable-theme-bootstrap" data-sortable> -->
<table id="ipTable" class="table"
data-url="/darkcloud/api/ip" 
data-id-field="id"
data-editable-url="/darkcloud/api/ip/"
data-filter-control="true"
data-filter-show-clear="true">
    <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="ip">
                <label for="ip-filter-control">IP</label>
                <br>
                <input type="text" class="form-control filter-input" name="ip" id="ip-filter-control">
            </th>
            <th data-field="os">
                <label for="os-filter-control">os</label>
                <br>
                <input type="text" class="form-control filter-input" name="os" id="os-filter-control">
            </th>
            <th data-field="country">
                <label for="country-filter-control">country</label>
                <br>
                <input type="text" class="form-control filter-input" name="country" id="country-filter-control">
            </th>
            <th data-field="time">time<br><br></th>
            <th data-field="campaign_id">
                <label for="campaign_id-filter-control">campaign_id</label>
                <br>
                <select name="campaign_id" id="campaign_id-filter-control" class="filter-input form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </th>
            <th
            data-field="is_blacklisted"
            data-editable="true"
            data-editable-type="select"
            data-editable-title="Blacklist this IP? The IP will NEVER be redirected."
            data-editable-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]">
                <label for="is_blacklisted-filter-control">is_blacklisted</label>
                <br>
                <select name="is_blacklisted" id="is_blacklisted-filter-control" class="filter-input form-control">
                    <option value="0">Yes</option>
                    <option value="1">No</option>
                </select>
            </th>
            <th data-field="redirect_url" data-editable="true">
                <label for="redirect_url-filter-control">redirect_url</label>
                <input type="text" class="form-control filter-input" name="redirect_url" id="redirect_url-filter-control">
            </th>
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
        $('input.filter-input').on('change', function() {
            ipsFilterParams[$(this).attr('name')] = $(this).val();
            for (var param in ipsFilterParams) {
                if (ipsFilterParams[param] == '')
                    delete ipsFilterParams[param];
            }
            $('#ipTable').bootstrapTable('refresh', {query:ipsFilterParams});
        })
    });



</script>