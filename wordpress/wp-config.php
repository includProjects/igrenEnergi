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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'V?G?p~7xklNwuuShCXI[HR-LrUmX[0D;%RM4!G8Hq]vi!$cg$QY6&tWJ_+~:D{]v' );
define( 'SECURE_AUTH_KEY',  'd:_B@/v>+pEIayZZ-QZQ49K~&4zNg6U?Q8I<|yY2e|7n7BhDj%A8eDK:.EL#nx:B' );
define( 'LOGGED_IN_KEY',    'YRU+$k4~2EQ8Jv6@@LYj<7{B0DJ?IYH?/ThOXcis$]16lyo7.|5eb4YC2QkClMAi' );
define( 'NONCE_KEY',        'ov4mI*hMi+eZ{KZD7|^*,`|PuBYNk6_mnvD$Q,p6R.:]wg+/j4t>8nfR%;YIY6#W' );
define( 'AUTH_SALT',        'n+t)%H|OX<9`I]=6@T6(8ZDsxmbFcj<2}]XTM%Gle$rDGpJD-k.*Mhx(ZmK1_W ~' );
define( 'SECURE_AUTH_SALT', 'g#U:E08Uv?T35*3/PD}CRoIjZb+`z8yFxDIh_XZ,[dkuZ/K<&4QiDE7%^3;ne)/n' );
define( 'LOGGED_IN_SALT',   '_tJV667 4mHCFO/+@EXeS+R5Cq/0~z|!wo.cNZFmk|l-Z8gW7s:FdF&c&dNtjYEi' );
define( 'NONCE_SALT',       'ukB0;kgh#6#-^<01XP07wGT12n{a`yhUodo=Y pBjNqd6ELtup%sjT3wj&dzXNG9' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'igrenwp_';

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
