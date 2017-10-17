<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Darkcloud</title>
    <base href="/">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/editable/bootstrap3-editable/css/bootstrap-editable.css">
    <script src="/editable/bootstrap3-editable/js/bootstrap-editable.js"></script>

    <!-- <link rel="stylesheet" href="http://brobin.github.io/hacker-bootstrap/css/hacker.css"> -->

</head>

<body>

    <div class="container">

        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active">
                        <a href="darkcloud/">Dashboard</a>
                    </li>
                    <li role="presentation">
                        <a href="darkcloud/options">Options - TODO</a>
                    </li>
                    <li>
                        <a onclick="toggleDarkmode()">Toggle Darkmode</a>
                    </li>
                    <!-- <li role="presentation">
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
            </nav>
            <h1>Dark Cloud</h1>
        </div>

        <h3>IPs Table</h3>

        <table class="table">
            <thead>
                <th>ID</th>
                <th>IP</th>
                <th>is_blacklisted</th>
                <th>redirect_url</th>
            </thead>
            <tbody>
                @foreach ($ips as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->ip}}</td>
                    <td>
                        <a href="#" data-name="is_blacklisted" data-type="select" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-value="{{$item->is_blacklisted ? 1 : 0}}"
                            data-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]" data-title="Blacklist this IP?">
                            <!-- {{$item->is_blacklisted ? "Yes" : "No"}} -->
                        </a>
                    </td>

                    <td>
                        <a href="#" data-type="text" data-name="redirect_url" data-pk="{{$item->id}}" data-url="/darkcloud/api/ip/" data-title="Update redirect_url, change where the ip will be redirected to in the future.">{{$item->redirect_url}}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <hr> @if (count($requests))
        <div>
            <h1>Requests Table</h1>

            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>IP ID</th>
                    <th>redirected_to</th>
                </thead>
                <tbody>
                    @foreach ($requests as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <!-- <td>{{$item->ip_id}}</td> -->
                        <td>
                            <a href="/darkcloud/ips/{{$item->ip_id}}">{{$item->ip_id}}</a>
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
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        @endif

        <link id='hackercss' disabled rel="stylesheet" href="http://brobin.github.io/hacker-bootstrap/css/hacker.css">

        <script>
            $('a[data-pk').editable();

            $(document).ready(function(){
                $('#hackercss')[0].disabled = window.localStorage['darkmode'];
            });


            function toggleDarkmode(){
                $('#hackercss')[0].disabled = !$('#hackercss')[0].disabled;
                window.localStorage['darkmode'] = $('#hackercss')[0].disabled;
            }
        </script>

    </div>
</body>

</html>