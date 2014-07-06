<!-- Greenbox.id -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $title ?></title>
<link href="./asset/styles-demo.css" rel="stylesheet" media="all">   
<link href="./asset/css" rel="stylesheet" type="text/css">
<script src="./asset/jquery.min.js"></script>        
<body quick-markup_injected="true">
	<div id="switcher">
		<div class="inner-switcher">
			<div id="theme_list">
				<a href="#">
				<img class="switcher-logo" src="./asset/gb.png" alt="logo">
				</a>
				<div class="clear"></div>
			</div>	
			<div id="command_button">
				<div class="purchase">
					<a href="#">Purchase</a>
				</div>		
				<div class="remove_frame">
					<a href="#">Remove Frame</a>
				</div>	
				<div class="clear"></div>				
			</div>
			<div class="clear"></div>
		</div>
	</div>
    <iframe id="iframe" src="<?php echo esc_html( get_post_meta( get_the_ID(), 'website', true ) ); ?>" frameborder="0" width="100%" height="635px"></iframe>
</body>
</html>