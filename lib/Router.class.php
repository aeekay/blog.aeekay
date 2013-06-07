<?php

	class Router
	{
		private static $inst = null;
		private static $path = null;
		private static $route = null;
		private static $nav = null;
		private static $active_path = null;
		
		private static $section = null;
		
		// add-on hooks to check routes
		private static $route_handlers = array();
		
		public $action_name = "";

		private static function singleton()
		{
			if(self::$inst == null)
				self::$inst = new Router();

			// get the navigation as of now there is none
			// place them in an array
		}

		public static function route($process = true)
		{
			@session_start();
			
			include_once('post.php'); 
		}
	}