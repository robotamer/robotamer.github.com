<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<script>!window.jQuery && document.write('<script src="http://code.jquery.com/jquery-1.4.2.min.js"><\/script>');</script>
	<script language="javascript" type="text/javascript">
		<!--
		function url() {
			var url = 'http://' + document.domain + '/';
		}
		// -->
	</script>
		<?= S::V()->title()->get()?>
		<?= S::V()->metas()->get()?>
		<?= S::V()->styles()->get()?>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
		<header>
	<p>
		<a href="/html" title="RoboTamer">Lobby</a>
		<a href="/index.html" title="Blog">News</a>
		<a href="/html/PHPTamer" title="PHP Tamer">PHP Tamer</a>
		<a href="/html/md2static" title="Markdown to Static">md2static</a>
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
                <footer><hr />Copyright &copy; 2012 RoboTamer</footer>
            </div>
            <sidebar>
				<?= $this->__raw()->sidebar ?>
            </sidebar>
        </content>
		<?= S::V()->scripts()->get()?>
    <script language="javascript" type="text/javascript" src="/assets/js/bitbucket_embed.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33624274-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    </body>
</html>
