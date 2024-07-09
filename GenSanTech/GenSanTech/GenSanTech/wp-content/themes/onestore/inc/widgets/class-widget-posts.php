<?php
/**
 * Custom Posts Widget.
 *
 * @package OneStore
 */

class OneStore_Widget_Posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'onestore_widget_posts',
			/* translators: %s: theme name. */
			sprintf( esc_html__( '%s - Posts with Featured Image', 'onestore' ), onestore_get_theme_info( 'name' ) ),
			array(
				'classname' => 'onestore_widget_posts',
				'description' => esc_html__( 'Posts list with thumbnail images', 'onestore' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$cats = get_categories();
		$category_default = array();
		foreach ( $cats as $cat ) $category_default[] = $cat->term_id;

		$title          = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
		$number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$orderby        = isset( $instance['orderby'] ) ? sanitize_key( $instance['orderby'] ) : 'post_date';
		$all_categories = isset( $instance['all_categories'] ) ? (bool) $instance['all_categories'] : false;
		$category       = isset( $instance['category'] ) ? $instance['category'] : $category_default;
		$show_date      = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;

		$query_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $number,
			'ignore_sticky_posts' => 1,
			'orderby'             => $orderby,
		);
		if ( ! $all_categories ) $query_args['cat'] = implode( ',', $category );

		$query = new WP_Query( $query_args );

		if ( $query->have_posts() ) :
			ob_start();

			echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo ! empty( $title ) ? $args['before_title'] . $title . $args['after_title'] : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			?>
			<ul>
				<?php foreach ( $query->posts as $qpost ) : ?>
					<?php
					$post_title = get_the_title( $qpost->ID );
					$title      = ( ! empty( $post_title ) ) ? $post_title : esc_html__( '(no title)', 'onestore' );
					?>
					<li>
						<a href="<?php the_permalink( $qpost->ID ); ?>">
							<?php
							if ( has_post_thumbnail( $qpost->ID ) ) {
								echo get_the_post_thumbnail( $qpost->ID, apply_filters( 'onestore/frontend/widget_posts_thumbnail_size', 'thumbnail' ) );
							}

							echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</a>
						<?php if ( $show_date ) : ?>
							<span class="post-date"><?php echo get_the_date( '', $qpost->ID ); ?></span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php

			echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			ob_end_flush();
		endif;
	}

	public function form( $instance ) {
		$cats = get_categories();

		$orders = array(
			'post_date' => esc_html__( 'Recent Published', 'onestore' ),
			'rand'      => esc_html__( 'Random', 'onestore' ),
		);

		$title          = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		$number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$orderby        = isset( $instance['orderby'] ) ? sanitize_key( $instance['orderby'] ) : 'post_date';
		$all_categories = isset( $instance['all_categories'] ) ? (bool) $instance['all_categories'] : false;
		$category       = isset( $instance['category'] ) ? $instance['category'] : array();
		$show_date      = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'onestore' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'onestore' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Sort By:', 'onestore' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
				<?php foreach ( $orders as $key => $value ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>"<?php selected( $orderby, $key ); ?>><?php echo esc_html( $value ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'all_categories' ) ); ?>">
				<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'all_categories' ) ); ?>" type="checkbox" <?php checked( $all_categories ); ?> name="<?php echo esc_attr( $this->get_field_name( 'all_categories' ) ); ?>">
				<?php esc_html_e( 'Query from All Categories?', 'onestore' ); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'or Choose Specific Categories:', 'onestore' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>[]" multiple>
				<?php foreach ( $cats as $cat ) : ?>
					<option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php echo ( in_array( $cat->term_id, (array) $category ) ? 'selected' : '' ); ?>><?php echo esc_html( $cat->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>">
				<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" type="checkbox" <?php checked( $show_date ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>">
				<?php esc_html_e( 'Display post date?', 'onestore' ); ?>
			</label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;

		$instance['title']          = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['number']         = isset( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 5;
		$instance['orderby']        = isset( $new_instance['orderby'] ) ? sanitize_key( $new_instance['orderby'] ) : 'post_date';
		$instance['all_categories'] = isset( $new_instance['all_categories'] ) ? (bool) $new_instance['all_categories'] : false;
		$instance['category']       = isset( $new_instance['category'] ) ? $new_instance['category'] : array();
		$instance['show_date']      = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}
}

register_widget( 'OneStore_Widget_Posts' );