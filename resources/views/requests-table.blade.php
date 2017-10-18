<h1>Request Redirects Table</h1>
@if (count($requests))
<!-- <table class="table" data-toggle="table"> -->
<table ip="requestsTable" class="table">
    <thead>
        <!-- <th data-field="checked" data-checkbox="true"></th> -->
        <th>ID</th>
        <th>IP ID</th>
        <th>redirected_to</th>
        <th>created_at</th>
    </thead>
    <tbody>
        @foreach ($requests as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>
                <!-- <a href="/darkcloud/ips/{{$item->ip_id}}">{{$item->ip_id}}</a> -->
                {{$item->ip_id}}
            </td>
            <td>
                <!-- <a href="#" 
                            data-name="redirected_to"
                            data-type="text" 
                            data-pk="{{$item->id}}" 
                            data-url="/darkcloud/api/requests/" 
                            data-title="A log of previous redirects.">{{$item->redirected_to}}</a> -->
                {{$item->redirected_to}}
            </td>
            <td>{{$item->created_at}}</td>
        </tr>
        @endforeach
    </tbody>

</table>
@else
No requests data.
@endif