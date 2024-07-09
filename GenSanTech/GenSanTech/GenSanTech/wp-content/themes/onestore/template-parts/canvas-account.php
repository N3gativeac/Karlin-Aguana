<?php

if ( ! function_exists( 'wc' ) ) {
	return;
}

ob_start();

$heading = '';
if ( is_user_logged_in() ) {
	$heading = __( 'Your Account', 'onestore' );
	?>
	<nav class="my-account-navigation">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo esc_attr( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
	</nav>
	<?php
} else {
	$heading = __( 'Login or Register', 'onestore' );
	?>
	<?php
	woocommerce_login_form();
	?>
	<?php
}


$content = ob_get_clean();
onestore_popup( 'off-canvas-account', $heading, $content, 'right' );

