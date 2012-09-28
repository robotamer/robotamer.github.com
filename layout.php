<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<?= S::V()->title()->get()?>
		<?= S::V()->metas()->get()?>
		<?= S::V()->styles()->get()?>
    </head>
    <body>
		<header>
	<p>
		<a href="http://www.robotamer.com/html" title="RoboTamer">Lobby</a>
		<a href="http://www.robotamer.com/index.html" title="Blog">News</a>
		<a href="http://www.robotamer.com/forum.html" title="Forum">Forum</a>
		<a href="http://www.robotamer.com/html/Linux" title="Linux">Linux</a>
		<a href="http://www.robotamer.com/html/GoTamer" title="GoTamer">GoTamer</a>
		<a href="http://www.robotamer.com/html/PHPTamer" title="PHP Tamer">PHPTamer</a>
		<a href="http://www.robotamer.com/html/md2static" title="Markdown to Static">md2static</a>
	</p>
		</header>

        <content>
            <div style="padding-right: 25em">
				<?php
				if (isset($this->raw)) {
					echo $this->__raw()->raw;
				} elseif (isset($this->content)) {
					echo $this->content;
				}
				?>

<!-- START: Livefyre Embed -->
<script type='text/javascript' src='http://zor.livefyre.com/wjs/v1.0/javascripts/livefyre_init.js'></script>
<script type='text/javascript'>
    var fyre = LF({
        site_id: 312331
    });
</script>
<!-- END: Livefyre Embed -->


            </div>
            <sidebar>
				<div style="text-align: center; ">
                    <img width="90" height="110" border="0" src="/assets/img/robotamer.gif"/>
                    <hr />
                </div>
			
			
				<?= $this->__raw()->sidebar ?>
			<footer><hr />Copyright &copy; 2012 RoboTamer</footer>
            <hr />
			<div style="text-align: center; ">
				<script language="JavaScript1.1" src="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=22279&bid=1216050" type="text/javascript"></script>
            </div>
            </sidebar>
        </content>
		<?= S::V()->scripts()->get()?>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-27513756-1']);
		  _gaq.push(['_setDomainName', 'robotamer.com']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
    </body>
</html>
