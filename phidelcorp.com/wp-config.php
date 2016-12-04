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
define('DB_NAME', 'dbphidelcorp');

/** MySQL database username */
define('DB_USER', 'userphidelcorp');

/** MySQL database password */
define('DB_PASSWORD', 'rootphidelcorp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'NWI)o|&kYMmXxLGl87!(OM!r%Sh]hDG6-;Knu-n/!%r<_*62xh-&;+)j,KOKmK)1');
define('SECURE_AUTH_KEY',  '*`=cjE9+2C!Ic?YMzsx8VOWy-F%fan@QdIi2alpvRLC$I!zZmShKz:vPdzwwX26S');
define('LOGGED_IN_KEY',    '//9L=BS)S+el<Vt~YZsH x#*@Co+T`F|J9t[MS[s[=p`%4tu{upRn>IdC6!92EYW');
define('NONCE_KEY',        'UPkCGaex_^n iYi$nVS>IkQb:WW2r&O&z.+ImuvCcN}sFR[u&wLUX&#uYg(<{_5Z');
define('AUTH_SALT',        'Jz^WNPSHxp>NV9Z~2~[.atQ. -m~10^:JRUg1uk,Vdi :Gxx%_~BbSQT5w(|rRSo');
define('SECURE_AUTH_SALT', '5e~zhW=Brp[N}1Og@A:Nt6m5]T|^M]xLEB##-H>fiXHm$ya&n9bJPZY}fqzvZuf%');
define('LOGGED_IN_SALT',   '`KgGRr-BM<[iO1ks#E0sb*xdY[&iWI9r9cHO $n&#dlQ3q5Em.Hrg?W`&mg|&V3 ');
define('NONCE_SALT',       'k8;S;_Fin(*`?%]7g^Dwr({<wOiz2SrkE3Zuto~g@ei8-K,,.UW%G+M!K<cch:%%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
