<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'ss_dbname_iielahb4cf');

/** MySQL database username */
define('DB_USER', 'pbT9J1VOE93tYgw');

/** MySQL database password */
define('DB_PASSWORD', 'Se9tw9FstHa4HZJB');

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
define('AUTH_KEY', '+b/Q>;bFv^Zf<]pgYK=ENV-r/}zhG!*UwYOpPhdG;}@t@k})hIR+Vj@*cmpGfzR;_Uka$AT]!DLVrfdG_fJZ?)Z=ssX^lt{Vf?z{FVe$cef&DJ$pk>mlbG>-L)+=bOaU');
define('SECURE_AUTH_KEY', 'Vjlh^-I=[+nEPx(Awcuct&YO/hczXWmRXEw%R^lmS]ya_YTIDeNKtkyFjPn&o%{ijK-;ERH(xt_H<G=R<D_[U*H=NrHoJol;R{I=/tEQ]j/qBMu<w%PfIGWVC_zu-nDa');
define('LOGGED_IN_KEY', 'u_K$RoJ@/)NeLyiIyfjMYNfp*gOzEvS<mKdNyxd+{oiR@t=QU/KBEo}}>E]Y%NdEt*${n<{Bb!-(]b@JIiOoH%H>q!uY(CAvUrwePx|])CeXbKX{m<]&gRj>Hz?XBXJu');
define('NONCE_KEY', 'rft_ID-g{Z<nQM[aYsKw=tYCIAs%ZfAeETB%_yN|iCN=DG_J_ioZvO%J$t;NH=<rOtuQbkA(Bemce[=f(+{+i_Kl*bPpokuYXL_Onq/ZpoKeOr_UYXZ=gE][BHmQ/P;e');
define('AUTH_SALT', 'jmpNnh>^ElebzzL)DSePCY=sd!>f)g&EE@/eJgsc[IGgs<z>wAO=>B>$JGPH_k;iML|z(d+L&/pkf]nq@Hi*U=KZ_feLsk-qAxB$dB|LE)if)KziLI-!U$&x$W?pqVpJ');
define('SECURE_AUTH_SALT', 'y<=%q}%GXvzGXILt{Ynn_SobvrkOA=]Yh$p]_y{di/&QUQadUPFNiTizI_PwHfqwKbT(<lGvVDTxeIuch@/A|nH</wlWcXlTggkFpb$GmEaC*u@T|BidyXu@wvXAJIZL');
define('LOGGED_IN_SALT', '{QKEff}sb+GGcMLkc;=<<+sDW@YBjv/@;Hgio<)Jg@IWLf%UFm;SBOxz&b&G-Ml_yBwk@-/EXWCZTu}xW?Ni_NzxjAmdwlTBP]|Q**H!;nZle}IcPMGoLFRurn^OS%RM');
define('NONCE_SALT', 's>gwWIoACuad+cJn|H;M;}lQ*HI&/a]DyuI_V/*r/DtC*L[D}V}M}@tP(iZBMlly]XQ]&Q<L_Q[<LXpjXXuRXNVkXyXPbn?>spTWVCr@M/YK<t&}Zj]pvRenE}ZLcUKv');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_woer_';

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
