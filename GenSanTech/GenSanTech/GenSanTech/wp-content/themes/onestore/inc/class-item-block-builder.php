<?php

class OneStore_Item_Block_Builder {
	public $items = [];
	private $data = [];
	private $item_thumb_id = 'thumb';
	private $positions = [
		'top'    => [],
		'thumb_left'  => [],
		'thumb'  => [],
		'thumb_right'  => [],
		'thumb_bottom'  => [],
		'body_left'  => [],
		'body'  => [],
		'body_right'  => [],
		'bottom'   => [],
	];

	public function __construct() {

	}

	private function render_item( $item_id ) {
		ob_start();
		$cb = 'onestore_item_block_' . $item_id;
		if ( is_callable( $cb ) ) {
			call_user_func_array( $cb, array( $this ) );
		}
		return ob_get_clean();
	}

	private function render_items( $position, $items, $wrapper_if_empty = false ) {
		$n = count( $items );
		if ( $n < 1 && ! $wrapper_if_empty ) {
			return;
		}

		$classes = 'item-builder--' . $position;
		if ( 1 == $classes ) {
			$classes .= ' has-one';
		} else {
			$classes .= ' has-more ni-' . $n;
		}

		echo '<div class="' . esc_attr( $classes ) . '">';
		foreach ( $items as $k ) {
			$item_content = $this->render_item( $k );
			if ( $item_content ) {
				$item_id = 'item-' . str_replace( '_', '-', $k );
				echo '<div class="item-builder--el ' . esc_attr( $item_id ) . '">' . $item_content . '</div>'; // WPCS: XSS ok.
			}
		}
		echo '</div>';
	}

	private function get_items( $position ) {
		if ( isset( $this->data[ $position ] ) ) {
			return $this->data[ $position ];
		}
		return array();
	}

	public function get_data( $setting = 'woocommerce_index_item_elements' ) {
		$this->data = array();
		foreach ( $this->positions as $key => $default_items ) {
			$items = onestore_get_theme_mod( $setting . '_' . $key );
			if ( ! is_array( $items ) ) {
				$items  = array();
			}
			$this->data[ $key ] = $items;
		}
		return $this->data;
	}

	public function set_thumb_id( $item_id ) {
		$this->item_thumb_id = $item_id;
	}

	public function render() {
		$this->get_data();
		$body_items = $this->get_items( 'body' );
		$body_left_items = $this->get_items( 'body_left' );
		$body_right_items = $this->get_items( 'body_right' );
		$has_body_center = ! empty( $body_items );

		$count = 0;
		$body_class = [ 'item-builder--body' ];
		if ( $has_body_center ) {
			$body_class['center'] = 'has-center';
			$count ++;
		}

		if ( ! empty( $body_left_items ) ) {
			$body_class['left'] = 'has-left';
			$count ++;
		}

		if ( ! empty( $body_right_items ) ) {
			$body_class['right'] = 'has-right';
			$count ++;
		}

		if ( 1 == $count ) {
			unset( $body_class['center'] );
			unset( $body_class['left'] );
			unset( $body_class['right'] );
			$body_class[] = 'has-one';
		}

		do_action( 'onestore/item_builder/start' );
		?>
		<div class="item-builder">
			<?php $this->render_items( 'top', $this->get_items( 'top' ) ); ?>
			<div class="item-builder--thumb">
				<div class="item-builder--thumb-img">
					<?php echo $this->render_item( $this->item_thumb_id ); // WPCS: XSS ok. ?>
				</div>
				<?php $this->render_items( 'thumb-left', $this->get_items( 'thumb_left' ) ); ?>
				<?php $this->render_items( 'thumb-center', $this->get_items( 'thumb' ) ); ?>
				<?php $this->render_items( 'thumb-bottom', $this->get_items( 'thumb_bottom' ) ); ?>
				<?php $this->render_items( 'thumb-right', $this->get_items( 'thumb_right' ) ); ?>
			</div>
			<?php if ( ! empty( $body_items ) || ! empty( $body_left_items ) || ! empty( $body_right_items ) ) { ?>
			<div class="<?php echo esc_attr( join( ' ', $body_class ) ); ?>">
				<?php $this->render_items( 1 != $count ? 'body-left' : 'body-main', $body_left_items, $has_body_center ); ?>
				<?php $this->render_items( 1 != $count ? 'body-center' : 'body-main', $body_items ); ?>
				<?php $this->render_items( 1 != $count ? 'body-right' : 'body-main', $body_right_items, $has_body_center ); ?>
			</div>
			<?php } ?>
			<?php echo $this->render_items( 'bottom', $this->get_items( 'bottom' ) ); ?>
		</div>
		<?php
		do_action( 'onestore/item_builder/end' );
	}




}
