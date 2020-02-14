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
define( 'DB_NAME', 'ebuycr' );

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
define( 'AUTH_KEY',         'f3kB ANz_yE8d7r~bO_F)!jr@PLMoW!hekB>ES4N|{ +t6[#W.Uk5HL)3X(o-x>I' );
define( 'SECURE_AUTH_KEY',  'a|Y_dkD2j@/o*%L0Uh.Tp8pshFI7<B~^oQ PbXdHi]FLt.:=G[+++0xI>e=j513?' );
define( 'LOGGED_IN_KEY',    'b %q|iNf(*a?!4BCkpZ|k;P/Y;;G-Y+f_ZJ!}x#OBRZjX-Z`4}K@u-n3XFm2SbWV' );
define( 'NONCE_KEY',        'YOu)a/($(!g7A{A N92y8cq+JI<hQL~+ykv01(343@4>.z sfFE$ rR)6[5Y|NM:' );
define( 'AUTH_SALT',        'K&d(3kd~txewJ%L:E$:b%T|~5Au%]Ly7jF{ma|?AGYl#[ZcpwC$do7zv]!r|ZzHg' );
define( 'SECURE_AUTH_SALT', 'L@SAACnc(J3U9h2#8EQS;`13p,MO~iTPnF-wI?s:PF:8Y2W;~AJ(U#/gVBHu}2=%' );
define( 'LOGGED_IN_SALT',   '!tXu]z<$J{yeVIJ.%A*Q*8Ik<^m@.zLPj/J10Mpe#_hvAi-re8Kqgic&03 &HZy^' );
define( 'NONCE_SALT',       'ZJZ?D]z&w@/n1-KU7otTl[6<rfz*ew-VV~e_<{2aaY4D[,0(ECNZ/)(c3{lUc|,]' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
