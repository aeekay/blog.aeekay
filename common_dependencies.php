<?
	$cwd_arr = explode("/", getcwd());
    array_pop($cwd_arr);
    $root = implode("/", $cwd_arr); 
    define('DRUPAL_ROOT', $root);
    require_once DRUPAL_ROOT . '/includes/cache.inc';
    require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
    require_once DRUPAL_ROOT . '/includes/common.inc';
    require_once DRUPAL_ROOT . '/' . variable_get('path_inc', 'includes/path.inc');
    require_once DRUPAL_ROOT . '/includes/theme.inc';
    require_once DRUPAL_ROOT . '/' . variable_get('menu_inc', 'includes/menu.inc');
    require_once DRUPAL_ROOT . '/includes/entity.inc';
    require_once DRUPAL_ROOT . '/includes/file.inc';
    require_once DRUPAL_ROOT . '/includes/unicode.inc';
    require_once DRUPAL_ROOT . '/includes/image.inc';
    require_once DRUPAL_ROOT . '/includes/form.inc';
    require_once DRUPAL_ROOT . '/includes/mail.inc';
    require_once DRUPAL_ROOT . '/includes/actions.inc';
    require_once DRUPAL_ROOT . '/includes/ajax.inc';
    require_once DRUPAL_ROOT . '/includes/token.inc';
    require_once DRUPAL_ROOT . '/includes/errors.inc';
    require_once DRUPAL_ROOT . '/includes/module.inc';
    _drupal_bootstrap_configuration(); 
    _drupal_bootstrap_database();
    require_once DRUPAL_ROOT . '/includes/pager.inc';
    require_once DRUPAL_ROOT . '/includes/tablesort.inc';
    require_once DRUPAL_ROOT . '/modules/node/node.module';
    _drupal_bootstrap_page_header();
    _drupal_bootstrap_page_cache();
    // _drupal_bootstrap_session_initialize();
    // _drupal_bootstrap_variables();

    // my personal files 
    require_once 'lib/Inflector.class.php';
    require_once 'lib/Router.class.php';