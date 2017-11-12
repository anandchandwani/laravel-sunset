@component('base')

<!-- To clear the database (besies apps), <a href="/clear">open this link.</a>  Note: Opening the link is enough to cause the db to clear. -->

<div class="container">

    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Warning:</span>
        This will delete all recorded IPs and logged requests. This command is final, there is no way to undo it. Apps will remain
        unaffected.
    </div>

    <button type="button" class="btn btn-danger" id="drop-table">
        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
        Delete IPs and Requests
    </button>
</div>

<script>

    $('#drop-table').click(function () {
        $.get("/clear", function (data) {
            alert("Done");
        });
    });

</script> @endcomponent