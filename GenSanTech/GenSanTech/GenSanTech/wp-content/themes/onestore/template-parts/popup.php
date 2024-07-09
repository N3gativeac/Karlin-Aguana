<div id="<?php echo esc_attr( $popup_id ); ?>" class="popup popup-position-<?php echo esc_attr( $popup_position ); ?>" itemscope>
	
	<div class="popup-background popup-close">
		<?php if ( 'center' !== $popup_position ) { ?>
		<button class="popup-close-icon popup-close action-toggle"><?php onestore_icon( 'x' ); ?></button>
		<?php } ?>
	</div>

	<div class="popup-content">
		<?php if ( $popup_heading ) : ?>
			<div class="popup-heading">
				<h2><?php echo $popup_heading; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
				<button class="popup-close action-toggle"><?php onestore_icon( 'x' ); ?></button>
			</div>
		<?php else : ?>
			<div class="popup-noh-close">
				<button class=" popup-close action-toggle"><?php onestore_icon( 'x' ); ?></button>
			</div>
		<?php endif; ?>
		<div class="popup-inner">
			<div class="popup-entry">
				<?php echo $popup_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	</div>


</div>

