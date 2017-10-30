<h3>Apps Table</h3>

<!-- <table class="table sortable-theme-bootstrap" > -->
<table id="appTable" class="table" 
data-url="/darkcloud/api/apps/" 
data-id-field="id"
data-editable-url="/darkcloud/api/apps/">
    <thead>
        <th data-field="id">ID</th>
        <th data-field="name"
            data-editable="true"
            data-editable-title="Each app should make a GET request to the darkcloud URL with an 'appName' field, which corresponds to this name field to determine which app it is.  If 'appName' is omitted then 'default' is used. Example: `http://darkcloud.com/?appName=test`">
            name</th>
        <th data-field="default_redirect_url"
            data-editable="true">
            default_redirect_url</th>
        <th data-field="default_blacklist"
            data-editable="true"
            data-editable-type="select"
            data-editable-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]"
            data-editable-title="Should new IPs coming in for this app have is_blacklist set to true?">
            default_blacklist
        </th>
        <th data-field="redirect_override"
            data-editable="true"
            data-editable-type="select"
            data-editable-source="[{value: 'disabled', text: null}, {value: 'always_redirect', text: 'redirect'}, {value: 'never_redirect', text: 'no redirect'}]"
            data-editable-title="Redirect requests coming in from this app. This value will be overridden by any IP blacklists.">
            redirect app
        </th>
        <th data-field="state" data-checkbox="true"></th>
    </thead>
</table>

<br>


<div class="row">
    <div class="col-md-3">
        <!-- <form method="post"> -->
            <button type="submit" name="app" value="create" class="btn btn-default btn-primary create-apps">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create New App
            </button>
        <!-- </form> -->
    </div>
    <div class="col-md-3">
        <button type="submit" name="app" value="create" class="btn btn-default btn-danger delete-apps">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
            Delete Selected Apps
        </button>
    </div>
</div>



<script>
    $(document).on('ready', function(){

        $('.create-apps').click(function(e){
            $.ajax({
                url: '/darkcloud/api/apps/create',
                type: 'POST',
                data: {app: 'create'},
                success: function(res){
                    $('#appTable').bootstrapTable('refresh');
                }
            })
        })

        $('.delete-apps').click(function(e){
            let ids = $('#appTable').bootstrapTable('getSelections').map(x => x.id);
            $.ajax({
                url: '/darkcloud/api/apps',
                type: 'DELETE',
                data: {ids: ids},
                success: function(res){
                    $('#appTable').bootstrapTable('refresh');
                }
            });
        });

        // $('#appTable').bootstrapTable({
        //     onCheck: function (arg1, arg2) {
        //         console.log('onCheck', arg1, arg2);
        //     },
        //     onUncheck: function (arg1, arg2) {
        //         console.log('onUncheck', arg1, arg2);
        //     }
        // });
    });
</script>
