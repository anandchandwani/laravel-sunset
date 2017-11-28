@component('base')

<!-- To clear the database (besies apps), <a href="/clear">open this link.</a>  Note: Opening the link is enough to cause the db to clear. -->

<div class="container">

    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        Here you can add an IP(s) to the blacklist manually. To add a diapason, substitute each unknown digit with wildcard ('*')
    </div>

    <form action="">
        <label>IP:<input type="text" class="form-control"></label>
    </form>

    <button type="submit" class="btn btn-danger">
        Add IPs to Blacklist
    </button>
</div>

<script>

    $('#drop-table').click(function () {
        $.get("/clear", function (data) {
            alert("Done");
        });
    });

</script> @endcomponent