<h3>Apps Table</h3>

<!-- <table class="table sortable-theme-bootstrap" > -->
<table id="appTable" class="table" 
data-url="/darkcloud/api/apps/" 
data-id-field="id"
data-editable-url="/darkcloud/api/apps/">
    <thead>
        <th data-field="id">ID</th>
        <th data-field="name">name</th>
        <th data-field="default_redirect_url">default_redirect_url</th>
        <th data-field="default_blacklist"
            data-editable="true"
            data-editable-type="select"
            data-editable-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]">
            default_blacklist
        </th>
        <th data-field="redirect_override"
            data-editable="true"
            data-editable-type="select"
            data-editable-source="[{value: 'disabled', text: 'disabled'}, {value: 'always_redirect', text: 'always_redirect'}, {value: 'never_redirect', text: 'never_redirect'}]"
            data-editable-title="Override all requests to this app, ignoring IP-based rules. To use the IP based rules, you must *disable* this override.">
            redirect_override
        </th>
    </thead>
</table>

<br>

<button type="button" class="btn btn-default btn-primary" class='js-create-app'>
  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create New App (TODO)
</button>