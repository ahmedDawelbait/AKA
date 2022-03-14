<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'akanet_landing' );

/** Database username */
define( 'DB_USER', 'akanet_Aljakan' );

/** Database password */
define( 'DB_PASSWORD', 'Aljakan_1' );

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
define( 'AUTH_KEY',         '{Tb#.RB.`T[.2U9}N:j[^XHuu`(~*@%m>,TsNt1m;bVny&=#k{uL(Kh9cgrI<.F~' );
define( 'SECURE_AUTH_KEY',  'M,sG@1eP^vGtV5tSyPf%G~B{yL>xp,#1gCPl4[XFn%Lkr[c,6:w.?6b0h3RU6+k&' );
define( 'LOGGED_IN_KEY',    'q[ezk_W7r20P^ H$Y-{-U+k<ygo$Y_q RinLRa64Fl&K)e>tA;qnU,CXd:jM4f>A' );
define( 'NONCE_KEY',        '4!orz^>Z=E)~7py.=)qu>JonL-S~`~bGjTMRDaTV:aFY(Z|.F;hM:OAH)Gl:O.N=' );
define( 'AUTH_SALT',        '1H<1@fCG1GqgSTO<k59$/x &V$jJ)>3Iu/KHzK@CR/ng9VrIKS{qhiM?fLuJblAe' );
define( 'SECURE_AUTH_SALT', '<8y&a~O7|I6fQ-1w4D5W5AD+CL:Hi5=Ae,)be>kG,SOp;!auBvEa=1rUE3m:4x[2' );
define( 'LOGGED_IN_SALT',   '?&;x5|+(:^AVE<qPD!9~*7x4#u7bm|ea[;Tl^|c_:S~t7,DFz[>)v!znz<$OUfiE' );
define( 'NONCE_SALT',       'p_-l/S~Yn14i9Q(frvspy}0ruKLAjqEzya!GZPmM}!49i?TX},%RB@bT+CVy7Pm}' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
