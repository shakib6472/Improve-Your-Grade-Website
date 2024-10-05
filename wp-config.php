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
define( 'DB_NAME', 'iyg' );

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
define( 'AUTH_KEY',         'L-J`@4SgHiTVba*mhoEwEdWmMCvm<84YG[r>sy* 3&y-$]:DT]n]J}Gs$v2:Zfz3' );
define( 'SECURE_AUTH_KEY',  '{1WkWEF|i/Bx.FXJhSu}I 3rA@}s*Mr3ULu&GIi3VW]UKgUGmc<F<2JFy5INRk-Y' );
define( 'LOGGED_IN_KEY',    'YxsnOm]Y.6DGAU[T#)$.wYA(a/t$pnk?JGE@nwc|8b|qoYj~L<29]C$L|V]sovJ;' );
define( 'NONCE_KEY',        'Fx}Z+AA I}n;KT8kswUc*iorgihU32N)Y+{p.@_N+KE09Sq+OInAN/TlR.We-g!+' );
define( 'AUTH_SALT',        '04(wyVp<Cg/I>c<TPT9o&;v8|895!j}+}^a[a-}? &)MB&6YH}]0.6;Gq>p1dMf/' );
define( 'SECURE_AUTH_SALT', '%I%fTd&DJJhxg^Wf2/3:VLs^O]^ -E~H-.W]jh[3L ^wz33jH-a>UP4([L;g3gDa' );
define( 'LOGGED_IN_SALT',   ':j,_>c9NXwPdJ0lXW`FV`jy:RofP)<Zf<9q[`Xe-sGHKGd7aHQNT74@5nHeng|q4' );
define( 'NONCE_SALT',       '%$k5fd`X-ulxk=Lswgp45Qz8)w7}j-;lS4?Ht#[E7t/de .;^eokiDzC&r?MC`6I' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
