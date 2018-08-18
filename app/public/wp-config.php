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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qhzGoJ93RWDEwV2w/dpVGq8tYRMMjklH7LYbMk8vkYfePskFbgG+gROi6KTH5Lc8oqcxehON8zxXtOdMNsfoEg==');
define('SECURE_AUTH_KEY',  'r0UV2J1nBn54zSiS8dVnEPsQUW6ty8pbI3eCNYi6wq3rvpaHTUye8rti3hCWtQDoD7jf1p6ELgnwNf3nZ1+WqQ==');
define('LOGGED_IN_KEY',    'TXy19AJGFFxSr9EU0TupthDM/KfVm3M3/EWEXsURsKc4Qlwpd3doNNesDGSrhw8nKgIcfOut1hmoaL6ECVorTw==');
define('NONCE_KEY',        'oE5cRVvHf+bRKwsKORQ8OIOEKncqx03UiwsPB0kVvNudveptGEvumsn5iHt+NYJFwZXKaMAL/Jpud3eFNmtWtQ==');
define('AUTH_SALT',        'Hh3+Qgf+ozHma/VQfTQoO8nyYZaXY5bGK++xfgacffxhdsJ8TmBweBciyrwcUqVbFIGtdImp9Qot3lofckjs+w==');
define('SECURE_AUTH_SALT', 'KWDzLVf1EdTCTFV5e79ddKA2K0wN7ZPYmA6kuxGU0sUdaD8CSiu644lNFZ3AU/mYzyyPPXLCQwUkQH5VI75MKQ==');
define('LOGGED_IN_SALT',   '8LwLAJ0Qn6Uz5srcq0etDQZvGEr/AgZSNCZR+PJMLG0nakkqPVslBFKuNqB1YpBgN3MRZVJVCdV5sCQNoyBr2Q==');
define('NONCE_SALT',       'AfuVh//JhWlCAXStdBTggJoELWNJqVqkdMsyioPpS9DRhHGZVLdlFPdAIA5DnyyrlHqrCSL61dcY076Eask8Yw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

define( 'WP_DEBUG', true );



/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
