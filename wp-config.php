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
define( 'DB_NAME', 'wordpress_one' );

/** MySQL database username */
define( 'DB_USER', 'wordpressuser_one' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Wp#197525' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '%+sFj[._Py+TWGq6%szRbRpenO8C`A3ETBD_*ac(h-saS?.*x1?j+5w%Nj/2~tcM' );
define( 'SECURE_AUTH_KEY',  'w*S9RV<Z3Nz~XQg{DhCf{liw%10o}#`|8GUJ]o4UGD;=V,PHt|^Jzn2w;Z>aPb~{' );
define( 'LOGGED_IN_KEY',    'LI7yz6=|[|>i-<-QYoZ`6:E<zJXErgckN;--);KG}:Is,uYnrEH:R`r%e5f]oN[7' );
define( 'NONCE_KEY',        'X5]wEUAe ?CSmX%3%XjH1EY;/-U6[u![lfRI0Y&Fc5-+$ut,C<lg<bU4IT0LWMh+' );
define( 'AUTH_SALT',        'qoHLGPz5-1=u>MhwTm#`|N+l.y)Y1N3B~VRFNBw[)oBt~sBb&kmPZrU6*kD`-^Rd' );
define( 'SECURE_AUTH_SALT', '4d1SGg:)4g9|UA)mjRy@WNf@ORt9_6Mf%<e}u>K8b_C]:0xXhS.9$tdGB=E ):4e' );
define( 'LOGGED_IN_SALT',   '=q^-!uM#9@IG5FxnDkWg7n*W-0Km-+TY1.+-vkwlWEQGI/)2d-!ve? [D}lHli+s' );
define( 'NONCE_SALT',       '*C)rE%VkhaSxsVs;E2p+F=!v1?$IVOMoAlK(5Y>R3Op^,JT3B)WMnG -e3B-Y:l+' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
