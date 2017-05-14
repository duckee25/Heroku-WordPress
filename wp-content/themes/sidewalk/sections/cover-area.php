<?php $cover = sdw_get_cover_data(); ?>

<?php if ( $cover['img'] ): ?>
	<div id="cover-area" class="sdw-cover-area">
		<div class="sdw-cover-content">
			<?php if ( $cover['title'] ): ?>
				<h1><?php echo $cover['title']; ?></h1>
			<?php endif; ?>
			<?php if ( $cover['content'] ): ?>
				<div class="sdw-description"><?php echo $cover['content']; ?></div>
			<?php endif; ?>
		</div>
		<div class="sdw-cover-image">
			<?php echo  $cover['img']; ?>
		</div>
		<div class="sdw-cover-overlay"></div>
	</div>

<?php elseif ( $cover['title'] ||  $cover['content'] ): ?>
	
		<div id="title-area" class="sdw-title-area container">
			<?php if ( $cover['title'] ): ?>
				<h1><?php echo $cover['title']; ?></h1>
			<?php endif; ?>
			<?php if ( $cover['content'] ): ?>
				<div class="sdw-description"><?php echo $cover['content']; ?></div>
			<?php endif; ?>
			<div class="sdw-post-separator sdw-post-separator-1"></div>
		</div>

<?php endif; ?>