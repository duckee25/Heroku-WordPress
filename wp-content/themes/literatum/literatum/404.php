<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */
?>

<html>

	<head>
		<title><?php _e('Error 404: Page not found', THEME_TEXTDOMAIN);?></title>
		<?php wp_head();?>
		<style scoped>

		.not-found-page {
			text-align:center;
		}

		.not-found-div-ext {
			 display: table;
    		position: absolute;
    		height: 100%;
    		width: 100%;
		}

		.not-found-div {
			display: table-cell;
    		vertical-align: middle;
		}

		.not-found-text {
			font-family:'helvetica neue', helvetica,arial, sans-serif;
			font-size:90px;
			color:#909090;
			font-weight:100;
			display:block;
			text-decoration:none;
		}

		.not-found-goback-link {
			color:#888;
			font-weight:200;
			font-family:'helvetica neue', helvetica,arial, sans-serif;
			margin-top:50px;
			display:inline-block;
			text-decoration:none;
		}

		</style>
	</head>

	<body class="not-found-page">

		<div class="not-found-div-ext">

			<div class="not-found-div">

				<a href="<?php echo home_url();?>" class="not-found-text"><?php _e('Page not found.',THEME_TEXTDOMAIN);?></a>

				<a href="<?php echo home_url();?>" class="not-found-goback-link">&#8592; <?php echo sprintf(__('Back to %s',THEME_TEXTDOMAIN), get_bloginfo('name'));?></a>

			</div>

		</div>

	</body>

</html>