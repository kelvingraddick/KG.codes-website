<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.timeago.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/main.js"></script>
<script>
    $(document).ready(function() { });

    particlesJS.load('particles', 'http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/particles.configuration.json', function() {
        //console.log('callback - particles.js config loaded');
    });

    jQuery(document).ready(function() {
		jQuery("time.timeago").timeago();
	});
</script>