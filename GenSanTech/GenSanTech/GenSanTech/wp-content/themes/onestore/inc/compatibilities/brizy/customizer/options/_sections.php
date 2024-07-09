<?php
/**
 * Customizer sections
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

// Brizy Integration
$wp_customize->add_section( 'onestore_section_brizy', array(
	'title'       => esc_html__( 'Brizy Integration', 'onestore' ),
	'priority'    => 199,
) );