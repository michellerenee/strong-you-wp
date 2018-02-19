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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'michellerenee_dk_db');

/** MySQL database username */
define('DB_USER', 'michellerenee_dk');

/** MySQL database password */
define('DB_PASSWORD', '***REMOVED***');

/** MySQL hostname */
define('DB_HOST', 'mysql71.unoeuro.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5:.t_&.qu[*g-[%fKrBVd8)SjRuD[_G98i@?60I@5+dwfp[Ng4f%/S=atNsz?Yw1');
define('SECURE_AUTH_KEY',  '2GSGtk3.=|t? +5.uPB5P8z){2zt $?t<d3#. $;#P_vpvW-? U*<F#3OneJwg2=');
define('LOGGED_IN_KEY',    '@$X ]rT pnd$eyzyrjVo{!L:!7KTpsz}]^L:Kh0!r+Gz2mC5uYmy9}$A@%&pzo1%');
define('NONCE_KEY',        'orGORv_8~r$oGs*4/[{.je/fyl{.*vdh>OXAL$R x]?QLd:CcF^k`v!lg?/Y:$@)');
define('AUTH_SALT',        'oxm`24@7sCj&`4ng(tpNHVY8^zY)PgltsgXeDE_v^yC()><j^*L5nZ>9t<yy;H~N');
define('SECURE_AUTH_SALT', ']f)vg,w7hY^`$FnHRh W-]EeN%A!@Y!xTWLydJR<KS<scMVlg=siYVCl__VQp!h3');
define('LOGGED_IN_SALT',   '47>7f+j|Frg;BLJh[9DM~az$%u_!Bnv9Mj8;9r1U.Z+Dn!OVuoS4tzF=K[gsg4u,');
define('NONCE_SALT',       '%h1r@ n(CuF{%6iT}u%S#c-Bx?)(vfynUJ3WHc,>^sM}wduBQ$p2>?pn)kD._~L,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sy_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
