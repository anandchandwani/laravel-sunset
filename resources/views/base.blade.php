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


    <script src="/sortable/js/sortable.js"></script>
    <link rel="stylesheet" href="/sortable/css/sortable-theme-bootstrap.css" />


    <script src="/bootstrap-table-master/dist/bootstrap-table.js"></script>
    <script src="/bootstrap-table-master/dist/extensions/editable/bootstrap-table-editable.js"></script>
    {{--<script src="/bootstrap-table-master/dist/extensions/filter/bootstrap-table-filter.js"></script>--}}
    <script src="/bootstrap-table-master/dist/extensions/filter-control/bootstrap-table-filter-control.js"></script>
    <script src="/bootstrap-table-master/dist/locale/bootstrap-table-en-US.js"></script>
    <link rel="stylesheet" href="/bootstrap-table-master/dist/bootstrap-table.css" />
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
                        <a href="darkcloud/options">Options</a>
                    </li>
                    <li>
                        <a onclick="toggleDarkmode()">Toggle Darkmode</a>
                    </li>
                </ul>
            </nav>
            <h1>Dark Cloud</h1>
        </div>

        {{ $slot }}


        <link id='hackercss' disabled rel="stylesheet" href="http://brobin.github.io/hacker-bootstrap/css/hacker.css">

        <script>
            $('table').bootstrapTable({
                search: true,
                showColumns: true,
                showToggle: true,
                editable: true,

                onAll: function(ev, data){
                    // $('a[data-pk').editable();
                    // console.log('onAll', ev);
                },
                onLoadSuccess: function(ev, data){
                    // console.log('onLoad success');
                    $('a[data-pk').editable();
                },
                // responseHandler: function(res){
                //     // console.log('resHandler', res);
                //     return res;
                // },
                showRefresh: true,
            });            
            // $('a[data-pk').editable();


            $(document).ready(function(){
                $('#hackercss')[0].disabled = (window.localStorage['darkModeCSSDisabled'] == 'true');
            });

            function toggleDarkmode(){
                $('#hackercss')[0].disabled = !$('#hackercss')[0].disabled;
                window.localStorage['darkModeCSSDisabled'] = $('#hackercss')[0].disabled
            }
        </script>

    </div>
</body>

</html>