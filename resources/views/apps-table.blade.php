<h3>Apps Table</h3>

@if (count($apps))

<table class="table">
    <thead>
        <th>ID</th>
        <th>name</th>
        <th>default_redirect_url</th>
        <th>default_blacklist</th>
        <th>redirect_override</th>
    </thead>
    <tbody>
        @foreach ($apps as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->default_redirect_url}}</td>
            <td>{{$item->default_blacklist}}</td>
            <td>

                 <a
                  href="#" data-name="redirect_override" data-type="select" data-pk="{{$item->id}}" 
                  data-url="/darkcloud/api/apps/" 
                  data-value="{{ $item->redirect_override }}"
                  data-source="[{value: 'disabled', text: 'disabled'}, {value: 'always_redirect', text: 'always_redirect'}, {value: 'never_redirect', text: 'never_redirect'}]" data-title="Override all requests to this app, ignoring IP-based rules.?">
                </a>
            </td>



        </tr>
        @endforeach
    </tbody>

</table>

<p>TODO - Need button to create new app.</p>

@else
No apps data.
@endif