<h3>IPs Table</h3>
@if (count($ips))
<!-- <table class="table sortable-theme-bootstrap" data-sortable> -->
<table id="ipTable" class="table" 
data-url="/darkcloud/api/ip" 
data-id-field="id"
data-editable-url="/darkcloud/api/ip/">
    <thead>
        <!-- <th data-field="checked" data-checkbox="true"></th> -->
        <th data-field="id">ID</th>
        <th data-field="ip">IP</th>
        <th data-field="os">os</th>
        <th data-field="country">country</th>
        <th data-field="time">time</th>
        <th data-field="campaign_id">campaign_id</th>
        <th
        data-field="is_blacklisted" 
        data-editable="true"
        data-editable-type="select"
        
        data-editable-title="Blacklist this IP? The IP will NEVER be redirected."
        data-editable-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]"
        >is_blacklisted</th>
        <th data-field="redirect_url" data-editable="true">redirect_url</th>
    </thead>
    <tbody>
        @foreach ($ips as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->ip}}</td>
            <td>
                <a href="#" data-name="is_blacklisted" data-type="select" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-value="{{$item->is_blacklisted ? 1 : 0}}"
                    data-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]">
                </a>
            </td>

            <td>
                <a href="#" data-type="text" data-name="redirect_url" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-title="Update redirect_url, change where the ip will be redirected to in the future.">{{$item->redirect_url}}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else No ip data. @endif