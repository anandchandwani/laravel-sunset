@component('base')

<div class="container">
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        Here you can add an IP(s) to the blacklist manually. To add a diapason, substitute each unknown digit with wildcard ('*')
    </div>

    <form action="" method="post">
        <label>IP:<input type="text" name="ip" class="form-control"></label>
        <button type="submit" class="btn btn-danger">
            Add IPs to Blacklist
        </button>
    </form>

</div>

<script>

</script>
@endcomponent