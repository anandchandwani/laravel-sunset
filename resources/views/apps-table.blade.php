<h3>IPs Table</h3>
@if (count($apps))
<table class="table">
    <thead>
        <th>ID</th>
        <th>name</th>
        <th>default_redirect_url</th>
        <th>redirect_override</th>
    </thead>
    <tbody>
        @foreach ($apps as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->default_redirect_url}}</td>
            <!-- <td>
                <a href="#" data-name="is_blacklisted" data-type="select" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-value="{{$item->is_blacklisted ? 1 : 0}}"
                    data-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]" data-title="Blacklist this IP?">
                    <!-- {{$item->is_blacklisted ? "Yes" : "No"}} -->
                </a>
            </td> -->

            <td>
                <a href="#" data-type="text" data-name="redirect_url" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-title="Update redirect_url, change where the ip will be redirected to in the future.">{{$item->redirect_url}}</a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@else
No ip data.
@endif