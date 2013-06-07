<? 
	ob_start();

	include_once('common_dependencies.php');

	Router::route();
	ob_end_flush();
?>