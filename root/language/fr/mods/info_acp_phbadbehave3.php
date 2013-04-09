<?php
/**
*
* phBadBehave3 plugin [french]
*
* @package language
* @version $Id info_acp_phbadbehave3.php
* @copyright (c) 2011 philnate <phsoftware.de>
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_PBB3_TITLE'					=> 'phBadBehave3',
	'ACP_PBB3_TITLE_SETTINGS'			=> 'phBadBehave3 - Réglages',
	'ACP_PBB3_TITLE_OVERVIEW'			=> 'phBadBehave3 - Vue générale',
	'ACP_PBB3_TITLE_SEARCH'				=> 'phBadBehave3 - Recherche',
	'ACP_PBB3_TITLE_LEGEND'				=> 'phBadBehave3 - Légende',
	'ACP_PBB3_MENU'						=> 'phBadBehave3',
	'ACP_PBB3_MENU_GENERAL'				=> 'Général',
	'ACP_PBB3_MENU_OVERVIEW'			=> 'Vue générale',
	'ACP_PBB3_MENU_SETTINGS'			=> 'Réglages',
	'ACP_PBB3_MENU_SEARCH'				=> 'Recherche',
	'ACP_PBB3_MENU_LEGEND'				=> 'Légende',
	'PBB3_LEGEND_CAPTION'				=> 'Clés utilisées au sein de Bad Behavior',
	'PBB3_LEGEND_REASON'				=> 'Raison du blocage',
	'PBB3_KEY'							=> 'Clé',
	'PBB3_HTTP'							=> 'Code HTTP renvoyé',
	'PBB3_IP'							=> 'Adresse IP',
	'PBB3_PAGE'							=> 'Page',
	'PBB3_AMOUNT'						=> 'Nombre total',
	'PBB3_PERCENTAGE'					=> '%',
	'PBB3_LASTTIME'						=> 'Date la plus récente',
	'PBB3_AGENT'						=> 'Useragent',
	'PBB3_DATE'							=> 'Date',
	'PBB3_HOUR'							=> 'Heure',
	'PBB3_URL'							=> 'URL de la requête',
	'PBB3_METHOD'						=> 'Méthode de la requête',
	'PBB3_PROTOCOL'						=> 'Protocole serveur',
	'PBB3_HEADERS'						=> 'En-têtes HTTP',
	'PBB3_200'							=> 'OK - Le site s\'est affiché normalement',
	'PBB3_400'							=> 'ERROR - La requête était mal construite',
	'PBB3_403'							=> 'ERROR - Le client n\'a pas les droits d\'accéder à la page',
	'PBB3_417'							=> 'ERROR - Bad Behavior ne peut pas être fourni par le serveur',
	'PBB3_OVERVIEW_PURGE'				=> 'Purger tous les enregistrements',
	'PBB3_OVERVIEW_STATS'				=> 'Statistiques de phBadBehave3',
	'PBB3_OVERVIEW_STATS_DESC'			=> 'Vous avez accès ici à quelques statistiques sur la façon dont Bad Behavior fait son travail',
	'PBB3_OVERVIEW_LAST_CATCHES'		=> 'Derniers accès bloqués',
	'PBB3_OVERVIEW_LC_DESC'				=> 'Les 20 dernières requêtes bloquées vers votre forum',
	'PBB3_OVERVIEW_LAST_ACTIONS'		=> 'Derniers accès non bloqués',
	'PBB3_OVERVIEW_LA_DESC'				=> 'Les 20 dernières requêtes non bloquées vers votre forum',
	'PBB3_OVERVIEW_DISTRIBUTION'		=> 'Répartition des clés',
	'PBB3_OVERVIEW_DI_DESC'				=> 'Répartition des clés que Bad Behavior utilise; Les clés non affichées n\'ont jamais été utilisées',
	'PBB3_OVERVIEW_BLOCK_DAY'			=> 'Blocages par jour',
	'PBB3_OVERVIEW_BD_DESC'				=> 'Vue d\'ensemble de la répartition des blocages durant les 30 derniers jours',
	'PBB3_OVERVIEW_BLOCK_HOUR'			=> 'Blocages par heure',
	'PBB3_OVERVIEW_BH_DESC'				=> 'Répartition des blocages au cours de la journée durant les 30 derniers jours',
	'PBB3_OVERVIEW_BLOCK_IP'			=> 'IPs les plus bloquées',
	'PBB3_OVERVIEW_BI_DESC'				=> 'Vue d\'ensemble des IPs les plus bloquées',
	'PBB3_OVERVIEW_BLOCK_PAGE'			=> 'Requêtes les plus bloquées',
	'PBB3_OVERVIEW_BP_DESC'				=> 'Vue d\'ensemble des requêtes les plus bloquées',
	'PBB3_LUCKY'						=> 'Quelle chance ! Durant cette période, aucun comportement suspect n\'a été détecté !',
	'PBB3_OVERVIEW_LA_NOTE'				=> 'Aucune action n\'a été bloquée ou le mode verbeux a été désactivé',
	'PBB3_RUNNING_WITH'					=> 'phBadBehave3 est propulsé par',
	'PBB3_LOGGING'						=> 'Journaliser les requêtes',
	'PBB3_VERBOSE'						=> 'Journalisation verbeuse (même les requêtes valides sont enregistrées). NOTE : cela entraîne une lourde surcharge de la base',
	'PBB3_STRICT'						=> 'Vérifie de manière plus stricte. Cela bloque quelques logiciels mal conçus, mais peut également bloquer des utilisateurs légitimes !',
	'PBB3_OFFSITE'						=> 'Permet de recevoir des données de formulaires présents sur d\'autres sites comme le cache Google, c\'est une technique dont abusent les spammeurs, mais certaines applications comme OpenID utilisent également cette fonctionnalité',
	'PBB3_HTTPBL_KEY'					=> 'Bad Behavior est capable d\'utiliser http:BL pour effectuer des vérifications supplémentaires sur les requêtes entrantes. Pour utiliser cette fonctionnalité vous devez posséder une clé http:BL que vous pouvez obtenir ici : <a href="http://projecthoneypot.org">ProjectHoneyPot</a>',
	'PBB3_HTTPBL_MAXAGE'				=> 'Les requêtes venant d\'IPs ayant eu des activités suspectes au cours de ces derniers jours seront bloquées',
	'PBB3_HTTPBL_LEVEL'					=> 'Le niveau de menace indique à quel point une adresse IP est suspecte. Les requêtes en provenance d\'IPs qui auront ce niveau ou plus seront bloquées par Bad Behavior',
	'PBB3_HTTPBL'						=> 'Réglages http:BL (purement optionnel)',
	'PBB3_KEEP_DAYS'					=> 'Conserver les entrées du journal uniquement pour ces X derniers jours; Entrez -1 pour désactiver cette fonctionnalité',
	'PBB3_KEEP_AMOUNT'					=> 'Conserver uniquement les X dernières entrées du journal; Entrez -1 pour désactiver cette fonctionnalité',
	'PBB3_SEARCH_NOTE'					=> 'Aucun résultat ne correspond à votre recherche',
	'PBB3_SEARCH_IS'					=> 'Est',
	'PBB3_SEARCH_ISNT'					=> 'N\'est pas',
	'PBB3_SEARCH_LIKE'					=> 'Contient',
	'PBB3_SEARCH'						=> 'Chercher',
	'PBB3_SEARCH_LIMIT'					=> 'Nombre maximum',
	'PBB3_SEARCH_ASC'					=> 'Croissant',
	'PBB3_SEARCH_DESC'					=> 'Décroissant',
	'PBB3_SEARCH_ORDERBY'				=> 'Trier par',
	'PBB3_TITLE_LOGGING'				=> 'Journalisation',
	'PBB3_TITLE_VERBOSE'				=> 'Verbeux',
	'PBB3_TITLE_STRICT'					=> 'Strict',
	'PBB3_TITLE_OFFSITE'				=> 'Formulaires extérieurs',
	'PBB3_TITLE_KEEPDAYS'				=> 'Jours',
	'PBB3_TITLE_KEEPAMOUNT'				=> 'Nombre d\'entrées',
	'PBB3_TITLE_HTTPBLKEY'				=> 'http:BL : clé API',
	'PBB3_TITLE_HTTPBLAGE'				=> 'http:BL : âge maximum',
	'PBB3_TITLE_HTTPBLLEVEL'			=> 'http:BL : niveau de menace',
));
?>
