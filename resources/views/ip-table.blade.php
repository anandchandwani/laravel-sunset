<h3>IPs Table</h3>
@if (count($ips))
<!-- <table class="table sortable-theme-bootstrap" data-sortable> -->

<form class="form-inline">
    <label>app_id:
        <select name="app_id" id="app_id-filter-control" class="filter-input form-control">
            <option value="">All</option>
            @foreach ($apps as $app)
{{--            <option value="{{$app->id}}">{{$app->app_name}}</option>--}}
            <option value="{{$app->id}}">{{$app->id}}</option>
            @endforeach
        </select>
    </label>
    <label>is_blacklisted:
        <select name="is_blacklisted" id="is_blacklisted-filter-control" class="filter-input form-control">
            <option value="">All</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </label>
</form>

<table id="ipTable" class="table"
data-url="/darkcloud/api/ip" 
data-id-field="id"
data-pagination="true"
data-page-size="20"
data-side-pagination="server"
data-show-export="true"
data-editable-url="/darkcloud/api/ip/"
data-filter-control="true"
data-filter-show-clear="true">
    <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="ip">IP</th>
            <th data-field="os">os</th>
            <th data-field="country">country</th>
            <th data-field="time">time</th>
            <th data-field="app_id">app_id</th>
            <th
            data-field="is_blacklisted"
            data-editable="true"
            data-editable-type="select"
            data-editable-title="Blacklist this IP? The IP will NEVER be redirected."
            data-editable-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]">is_blacklisted</th>
            <th data-field="redirect_url" data-editable="true">redirect_url</th>
            <th data-field="state" data-checkbox="true"></th>
        </tr>
    </thead>
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

        $('#ipTable').on('check.bs.table check-all.bs.table uncheck-all.bs.table uncheck.bs.table', handleDeleteIpBtn);
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
        });

        // Re-trigger the filtration after search in order to send filtration params besides the search query
        $('#ipTable').on('search.bs.table', function(e, text){
            $('.filter-input').trigger('change');
        });
    });



</script>