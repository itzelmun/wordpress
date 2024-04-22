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
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
        // https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
        function getenv_docker($env, $default) {
                if ($fileEnv = getenv($env . '_FILE')) {
                        return rtrim(file_get_contents($fileEnv), "\r\n");
                }
                else if (($val = getenv($env)) !== false) {
                        return $val;
                }
                else {
                        return $default;
                }
        }
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'proyecto') );

/** Database username */
define( 'DB_USER', getenv_docker('WORDPRESS_DB_USER', 'user') );

/** Database password */
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'psswrd-proyecto-user!') );

/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/1356f6537220ffdc32b9dad2a6cdbe2d010b7a88/wp-admin/setup-config.php#L224-L238
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/** Database hostname */
define( 'DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql-wordpress') );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8') );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', '') );

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
    define('AUTH_KEY',         'QqX 7~}r&]c4hf)q9{h{h&Oi_6T]$l{=3dN[F`]ciyL{9fHyd>z:;.6@KHaLdyv*');
    define('SECURE_AUTH_KEY',  'C<R)n2`:t&{2y`>n;sMw@B4o!$e?kS+Xby?H3ttL7n-vY<Rpw@JL-X{>(e`E(LQ;');
    define('LOGGED_IN_KEY',    '~$t(J_U|~y6T-Qb8.zm^+6_s?<3n8a7j[Q1FDG->/E;#K**jTpHck=Du+V!+ieu,');
    define('NONCE_KEY',        'uV0#J<JsHy>?!AEJ%?=jxr7r[!|+aPBZTJoonQDNV}l3}[d^vdDN@KkE-HNjy?L)');
    define('AUTH_SALT',        'P;}$uQ-PC,a]=f^:E5w|mN&KR8?x gx[{hYM-2:jfUz5-n94<~K|Q@:<M4J]v)1[');
    define('SECURE_AUTH_SALT', '$%7,w~)m:}]z _J&#;zQmjiqOFA!+*1)h&K[S{`u~|3E:RX>ET{S7mwi[fvAn<8B');
    define('LOGGED_IN_SALT',   't3F>t91q|siT ;X]5(ErHjpf80oG!DpG#,uR$e8SZZ.Mzw*`<0~BmeOEf9MM]r9K');
    define('NONCE_SALT',       'pq==SlW| X+ZMk<zq5E_+ZfV)`yyE]p)ey@o-.?uJ|6e*H3VC^{3ct1aS2L$wo68');
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

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
define( 'WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );

/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
        $_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
        eval($configExtra);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';