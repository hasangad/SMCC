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

define('DB_NAME', 'hmohsain_ss_dbnameaa1');


/** MySQL database username */

define('DB_USER', 'hmohsain_ss_daa1');


/** MySQL database password */

define('DB_PASSWORD', 'mdO2qavTk3Xv');


/** MySQL hostname */

define('DB_HOST', 'localhost');


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

define('AUTH_KEY', '=>MN-oD_F/a_&e|z+m%]lNK(=uTxpKwAGQYw)nr|a%(>+cOMKqBz>OwCKVq_(eTO+d(_T}XxXQ&)gjam_@E<(b=@)Xga+iyp@wUbUAe!y*SVM/Ci|hxTTHOm|E-*U}kv');
define('SECURE_AUTH_KEY', 'a(};<K/ekUSB}*sybn&PiablecoPi@CA;SC&eQjAf+s^G_*wk<bvZAOqCe*ZBK<vK{q?+Glk-/@NJCQHmZ/ZDuLjrRuwNi}]uG^JP|?[;nC{yc%bAO>zrA>E*]L=QQUt');
define('LOGGED_IN_KEY', '<dMMd=P(h^|-i$$_Ios&FlHZ_Pgi&(I/iZ$^h]PBLR;VKj}+^!dMKXE_Kq>vR+JykAf(G$IVCoM;xf@kv;cW+)OI<!|mG{=;BA-Pn-ya|Z$GqTeRK&Zo@;OjP(fEE!yX');
define('NONCE_KEY', 'iB_fWLSvH$UDde;V?cBoz)?rPby)GNSAltS<pntwg%jn%W!x<tpId<noHDrSk/mTUIZOYexyh$FYA<)b[&grZhcp;qru+|yBNhvNe_DsEH-Y+G(B@FW]>n!E?pygbdzs');
define('AUTH_SALT', 'pqua/JLoblE)iOjja}thb!kCukik-REk]NVcscS|RQZVCJWrtmG(cWLWyfjHA]vZ@oV<fBw*sGs-UmQn&t/PA/U](wJ(IGk{N|K<&Kc]xxkN;PKRfe*BGf%->ouL&TM]');
define('SECURE_AUTH_SALT', 'bU|j*]xemZDhAdb^/nH>cJ!YK[<ZkMlIF?CrP[P+&=NFoO%Ew{cBe!OaChF)r[gzPb?RJp]NOP$<IgAmF&=RjM_H(-q}q=}eE[_FNg;aq=q|L>BArgTTWMQ*TDaxlXJg');
define('LOGGED_IN_SALT', '(U-gR{NF{PXVbe!NvAcaY$(W&qtFvDMT{?W_rh;d/}GfbpJEX)t?/}L[h(NxzC{_nMbG}Wv&vm)OzCV@vEy/RJbfNwIzzWZLPzmT<fdO>V|JjvZr(gq<+lWPXv|!QEt?');
define('NONCE_SALT', 'T!&NJ<pAM!z=QblX[{V>;otU)QtvoS*)=hh>{R$w?C@Bwj[$FP=!NekxrFL@X^!F<LgrRx>wEh[[/BJSN!g(AuwcWF=qUAvxPq&l^HNpGuQjtDq<C!T{/DraOlg]MOeG');


/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wp_iifw_';


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




/*-----------------------------------*/
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/*----------- Hide  ------------*/
define ( 'WP_CONTENT_FOLDERNAME', 'site/' );
define ( 'WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME );
define ( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/dary/' );
define ( 'WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME );
define( 'WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/dary/site/addons/' );
define( 'WP_PLUGIN_URL','http://' . $_SERVER['HTTP_HOST'] . '/dary/site/addons/');

/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

