<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '-o l2,]nQ=_4Cf#~KoAzCC%VElUjOo=8>$pEs.pNsI@d5iqjgs8Sz,3Yd$3R)M^4' );
define( 'SECURE_AUTH_KEY',  '+TVXr~jYlD4h 1^g)fy9xMwVZ=c5ZF1R6YS9,O$dd~*EK9;xfTX]fGM3.y5MCb&y' );
define( 'LOGGED_IN_KEY',    ']-9k&/#?DWMfn=`GEdPBuIcBSa/us3tM(s{A9y1!U8+_Fsv0^s*97hwd0<h3@4J(' );
define( 'NONCE_KEY',        '=0?4qIb<@4MN8W/$c^0<y3G~l73={]F0V/#:{e 5eD(wQu_Z(Ry*RtHH|c{hM#C!' );
define( 'AUTH_SALT',        'I>{-0H6Gm#bQv/Tmf{-dJlV{3WiCv@|7/Q+xV!  Hc^@af`z)%,G{g;7l-f!Z4T@' );
define( 'SECURE_AUTH_SALT', 'm]k.Fc$T^9iNk0$zTqG(i-35Xk7p,[@n$C>_HA2Gj=Ea~X*LRs5SAx-{n!SnZmHb' );
define( 'LOGGED_IN_SALT',   'Hki`wlDaeCA<uX_`_HvV!dOjfm.>(rbm?S?ap;qWql.UBemQB*^3o>Ax]:TEh-Ax' );
define( 'NONCE_SALT',       'm2/tq~]l{z1sC37}C+}8EDl`b$TgK|phg7]Kv90ua6ur?vfoH%(R< 8@[.f|}f=e' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
