<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'GenSanTech' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'PA$:`yEp^*Q7*)7TRem?qKE@]oxWGn#WE^P(X{.{tqxp_dNK(K4V0Kr7apvLH{$A' );
define( 'SECURE_AUTH_KEY',  '&8yT,(d3jG#)8Z01f!E8<(/!.o<T{d4K`bhlPaVBG3Bt%+Z bSb7}B?sH*$y^yY@' );
define( 'LOGGED_IN_KEY',    '$$]v2s.<;CUCtcK|u|ol>:`[B-(/vi4h#U.M`Xd;~=fZoy5XcDwi{JS^5],K}R+w' );
define( 'NONCE_KEY',        'kI4/:d.Q?thKJ $0=5F;;dG<f&S~*GOHNSlKcrp,KSg?.6fpPS1mg0queSpO6Mx,' );
define( 'AUTH_SALT',        'ar=i|8 ^]DY>vNPGv>d6X.9lxtx*0`pwoJ.4[F4@)*19sLm.CE;X7bfsTp]Ji(1j' );
define( 'SECURE_AUTH_SALT', 'S5j3}F?r#{$2]LiE-C(:gT,8]>z%L[K6QM`Smr|apc #f0!fO#k*zOot(rBCln<9' );
define( 'LOGGED_IN_SALT',   '*1w0Lw7$!i2Sc7#r7}SC?&5.oRq`y{6u1^EuTXoIh@(dyL.q/IJ !$JtE](?K8ap' );
define( 'NONCE_SALT',       '.INGAR{i$/xz_=v 0 o{yug>F8Qc6XDx0H0!AO~0 Q48kUtxBp(I<IAxLpvntm6f' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
