<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'CMS' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '6/AqJ]*-%d/lEv:`)>ZlJ`u^XGB2r-ehiw0Gk!3GoK|s}l#F#<+&!wOc)R#d~8Q<' );
define( 'SECURE_AUTH_KEY',  'cUu;pi2qLy[<n`k{|Gf5&%j]GE(o?_g2pUc2^T){F&9I!^$<wI;Bo*dzW:7gy_M/' );
define( 'LOGGED_IN_KEY',    '!u!+r~o0OXO:QzyD cC,X!jl$u3TWg7 r-T<Gm8/Gj}d0hNEcGV}/9QVui:KM8Kf' );
define( 'NONCE_KEY',        'h)SWRGEBuTFNa|E%2eV5W24{pND5-HQG]o<Yn;[$1{b{k/]#Bm!6)GD+})9cFaA@' );
define( 'AUTH_SALT',        'G;hH$;#rvIR9H`gXEJZ`rWzPYlT2}+6sSj~f1GIU#D-S^I3KHdARY,tUa!/Xpx!p' );
define( 'SECURE_AUTH_SALT', 'R$K4@2A#H7-EcFF3RwJzSt1{eI/~1I/4DgnCg~/NtYFRTi:(iCI/2nH)hEB*m7u<' );
define( 'LOGGED_IN_SALT',   '@u91yIsTe,G*6[Zf)/,kV@bj7pWc&jRIUMTj{P)<X!SkIArLB$Pt3)(Z&cfx#_L$' );
define( 'NONCE_SALT',       'E9*X_*HF~b)4m9mQ3wTA|6RyF{K}4@qCS5a}QV<Y+mGs(<m3rf,e)s%/^N@~Nnjc' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
