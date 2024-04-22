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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// * Database settings - You can get this info from your web host * //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'user' );

/** Database password */
define( 'DB_PASSWORD', 'user-W0rdPr3sp#5d?w-Ud3}e' );

/** Database hostname */
define( 'DB_HOST', 'mysql-wordpress-pre' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'FV!+,**P)K@.PZ3[+6+GdW9-k9e&A?VKI)|,yE%%:%)kKo(+!..4|_2wVxuZ8%+X');
define('SECURE_AUTH_KEY',  'k`%v@q[=:vSzON~`pT.-W-(CB97`w6LU2t_yQ9nLtDWj-?L C4RC;.e`TR:3pL:%');
define('LOGGED_IN_KEY',    'e6I9> hg}qS,ru6CVA>@U4]K{D4E1e71a`hJfk;|BV0E-W0H.ce$|XZ,&dj>07-F');
define('NONCE_KEY',        'cVGTxu$gW:We||4($ODpRG-$cE`WbJ{&HrF0W|KJz`]}B2sbG[{8t uSQ-hoGiIS');
define('AUTH_SALT',        'Tzu}>vC>DN+31HL$LoExoY;TuOl8u}<|+1yE{c(YkoM$<|t*Ja+Z};1|}H$C,;');
define('SECURE_AUTH_SALT', 'NJYk)Ht87|-9%Cs>j*kWklfXbLIcDs3f^mhM@vWOvkk:2{0fumkS1eXf}).*+-my');
define('LOGGED_IN_SALT',   ')!{5=MCQ!Wi8P>,W`P*p5<+$Wi`da8_:)vX[X_|wuvd=G1O$xGheT0&$ ge^Q]~L');
define('NONCE_SALT',       '|!H_(%785M1%q.?ydhWTtU0~!2-8iDMYa0*v$`,LVjqPjW/$l|cgFz5M[lK%,I91');

/*#@-/

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', _DIR_ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp