<?php
// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$class = $class . ' header-' . $slug . ' menu';
$user = wp_get_current_user();
$text = '';
if ( is_user_logged_in() && $user ) {
	$avatar = get_avatar_url( $user->ID );
	$text = $user->display_name;
	if ( ! $text ) {
		$text = $user->user_login;
	}
} else {
	$avatar = ONESTORE_IMAGES_URL . '/avatar.jpg';
	$text = esc_html__( 'Account', 'onestore' );
}

OneStore::instance()->add_hidden_canvas( 'account-content', 'canvas-account' );
?>
<div class="<?php echo esc_attr( 'header-' . $slug ); ?> my-account-item show-avatar menu action-toggle-menu">
	<div class="menu-item">
		<button data-target="off-canvas-account" class="my-account-toggle popup-toggle action-toggle" aria-expanded="false">
			<img class="user-avatar" src="<?php echo esc_url( $avatar ); ?>" alt="">
			<span class="item-text"><?php echo $text; // WPCS: XSS ok. ?></span>
		</button>
	</div>
</div>

