@component('base')

<div class="container">
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        Here you can add an IP(s) to the blacklist manually. To add a diapason, substitute each unknown digit with wildcard ('*')
    </div>

    <form class="form-inline" action="" method="post">
        <label>IP:<input type="text" name="ip" class="form-control"></label>
        <button type="submit" class="btn btn-danger">
            Add IPs to Blacklist
        </button>
    </form>

</div>
@if(isset($status) and isset($ip))
    @if($status == 'success')
        <script>alert('IP {{$ip}} was added to blacklist');</script>
    @endif
    @if($status == 'fail')
        <script>alert('Cannot add IP {{$ip}} to blacklist');</script>
    @endif
@endif
@endcomponent