<div id="list_feedback" class="mt-3"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>
    $(document).ready(function(){
        $("#list_feedback").load("views/quanli/admin/feedback/list.php");
    });

    Pusher.logToConsole = true;

    var pusher = new Pusher('d35330d6cf9f6fa10fcd', {
    cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // alert(JSON.stringify(data));
        $("#list_feedback").load("views/quanli/admin/feedback/list.php");
    });
</script>