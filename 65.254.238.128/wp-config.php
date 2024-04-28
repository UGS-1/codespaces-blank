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
define('DB_NAME', 'ss_dbname_mfeck4n7md');

/** MySQL database username */
define('DB_USER', '5WFQvMP2bu3hEy5');

/** MySQL database password */
define('DB_PASSWORD', 'ZtydGQZSjqttENzq');

/** MySQL hostname */
define('DB_HOST', 'oeaoman.accountsupportmysql.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', '?lz+hk;S|hdf]eg*$IxOL!DQt_O{gK*|B(_VOUAE{o*>!MpTfkX^vzVxwn+dEtX&Ypdmn(NDFUG{d|NtM(FCkuQjbo=E{gi_><h=!Fk{>uL|t/Ydsa(FZc]H>uro&FIL');
define('SECURE_AUTH_KEY', '&U=)EpmHc_]Bm[PPKf_|nrvBnuyAo_}e-uJ=rfh{GeQOl|n=HrhHt?j@NhaF{iR;G<y*yavU)VL{?xQKu}[H;cczbWhdzB$?WR%a!Ux_/(e-e_azOxvy&;=e&i;oG}gh');
define('LOGGED_IN_KEY', 'a@PHIGnBi_tCyNsC!KNK&mAZol(XmJ(dXHm|CC+K;C-kX-i_/lmczjGqXi<piXNGTFz=%QjdpnG(}+L{A}n!dvnAHkC)Pegfo$rYsDC=L+?jmO{qFcpzTv|iM{Fv]iKn');
define('NONCE_KEY', 'jI|EACYMzl=A%URtTK-}S@oq[!$dgSnSXII-};l^T+)Ws|I]plGima%u[pujW&MoEjc&/(j!UA[Ioc*Wj!MxXkZMFMWDy)OqVOU?Uwb[$lDaRUdE&!iwgsu*]UeKeu_=');
define('AUTH_SALT', 'w-@$}$LOX;PpvQi=gLbKVRf;xu$@%Tw/eoWP$btQgHFsAkwamxU+HNwC;<]b(L_g++c](W)hHmFB)DQ@LrIlKUafN;Q&_Ci;gCSx^)ILMpi$^l?xch/v)OdLrjYS$BA-');
define('SECURE_AUTH_SALT', '<FTEy{Xc(Cmv_k(yY=>daZ^K[qu}]qE+C<_y>MpoUvY%]_bgF)|Re<ZjefVmMpPxCOuD-wYuuWoH&mWb%xpsbM?q;TlEeUcNLx@usCIMzgvygorLMCHZ!lN)YladFkvv');
define('LOGGED_IN_SALT', 'AkPCk?IW%on*pqZYUwcmZezkFv_-sc[H=Mqt?g|X?)@eFXO{kKhBhk@<x<S|[y=[pzyMXE&?V[(aqKijZR<*WMBO%SHMUUyNkW|FhM/-/Mv?}bk)o+kc><LKt?wZD_Mw');
define('NONCE_SALT', 'Q<<+Hk_]^lZ)s!n}EkVJoG&q;V|Vgs]DHSw-SBfIVsr=k?JhAGRassk&+bqlMb)N+bovUKFobQ[B%Bk*EPj;yNTyTWB+ao;M|^&gcXDv=Hv^Za!QmI@T-Fie(Jf<;o!V');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_imzp_';

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
