<?php
	spl_autoload_register(function($class){
		$paths = array(
					"Controller/",
					"Dao/",
					"Model/", 
					"Util/"
				);
		foreach($paths as $key => $dir){
			$path = $_SERVER['DOCUMENT_ROOT'] . '/lib/';
			$file = $path . $dir . $class . '.php';
			if(file_exists($file)){
				require_once $file;
			}
		}
	});
	function view($view){
		$file = $_SERVER['DOCUMENT_ROOT'] . "/lib/View/" . $view;
		if(file_exists($file)){
			require_once $file;
		} else {
			echo $file;
		}
	}
	
	function main_controller($controller){
		$file = $_SERVER['DOCUMENT_ROOT'] . "/lib/Controller/" . $controller;
		if(file_exists($file)){
			require_once $file;
		} else {
			echo $file;
		}
	}
	
?>