<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
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
		<a href="/html" title="Blog">Lobby</a>
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
    </body>
</html>
