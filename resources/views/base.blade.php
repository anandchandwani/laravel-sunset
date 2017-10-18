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
    <link rel="stylesheet" href="sortable/css/sortable-theme-bootstrap.css" />

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

        {{ $slot }}


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