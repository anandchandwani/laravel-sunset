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
    </thead>
</table>

<br>

<form method="post">
        <!-- <input type="submit" name="upvote" value="Upvote" /> -->

        <button type="submit" name="app" value="create" class="btn btn-default btn-primary" class='js-create-app'>
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create New App
        </button>
</form>

