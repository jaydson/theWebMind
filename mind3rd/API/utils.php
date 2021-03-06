<?php
	/**
	* This file corresponds to the bootstrap.
	* Every requisition should pass here
	* This file decides which environment will be used
	* and also some permissions, starting some environmental
	* variables, such as language for localization
	*/
	session_start();
	define('_CONSOLE_LINE_LENGTH_', 80);

	function __autoload($what)
	{
		GLOBAL $_MIND;
		$what= preg_replace("/[ '\"\.\/]/", '', $what);
		if(file_exists(_MINDSRC_.'/mind3rd/API/programs/'.$what.'.php'))
		{
			include(_MINDSRC_.'/mind3rd/API/programs/'.$what.'.php');
			return true;
		}
		if(strpos($what, '\\')>=0)
		{
			$what= explode('\\', $what);
			$what= array_pop($what);
		}
		$dirs= Array(
			_MINDSRC_.'/mind3rd/API/external/Symfony/Component/Console/Input/',
			_MINDSRC_.'/mind3rd/API/external/Symfony/Component/Console/Output/',
			_MINDSRC_.'/mind3rd/API/external/Symfony/Component/Console/Command/',
			_MINDSRC_.'/mind3rd/API/external/Symfony/Component/Console/Helper/'
		);
		for($i=0; $i<sizeof($dirs); $i++)
		{
			if(file_exists($dirs[$i].$what.'.php'))
			{
				require_once($dirs[$i].$what.'.php');
				return true;
			}
		}
		echo " [ERROR] Class not found: ".$what."\n";
		exit;
		return false;
	}

	require(_MINDSRC_.'/mind3rd/API/interfaces/program.php');
	require(_MINDSRC_.'/mind3rd/API/classes/Mind.php');
	require(_MINDSRC_.'/mind3rd/API/classes/MindCommand.php');
	require_once(_MINDSRC_.'/mind3rd/API/external/Symfony/Component/Console/Shell.php');
	require_once(_MINDSRC_.'/mind3rd/API/external/Symfony/Component/Console/Application.php');
	require_once(_MINDSRC_.'/mind3rd/API/external/Symfony/Component/Console/Command/Command.php');

	use Symfony\Component\Console\Application;
	use Symfony\Component\Console\Helper\HelperSet;

	$app= new Symfony\Component\Console\Application('mind');
	$app->addCommands(Array(
		new RunTest(),
		new Quit(),
		new Auth(),
		new Clear(),
		new Info(),
		new Create()
	));

	$helperSet= false;
	$helperSet = ($helperSet) ?: new Symfony\Component\Console\Helper\HelperSet();
    $app->setHelperSet($helperSet);
	

	if(isset($_SERVER['argv']))
	{
		$params= $_SERVER['argv'];
		array_shift($params);
	}
	$_MIND= new Mind();
	if($_REQ['env']=='shell')
            include('shell.php');
	else
            include('http.php');
