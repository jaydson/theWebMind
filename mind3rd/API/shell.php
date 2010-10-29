<?php
	/**
	* This file receives the shell call for a program,
	* and parses its parameters, calling the program from the API
	*
	*/

        function shellExecute($command)
        {
            GLOBAL $_MIND;
            if(!is_array($command))
            	$command= explode(' ', $command);
            $program= array_shift($command); // the first parameter is the program itself
            try
            {
            	$program= new $program($command);
            	//echo "\n";
            }catch(Exception $e){
            	print_r($e->getMessage());
            }
        }

        $fp = fopen("php://stdin", "r");
        $in = '';
        if(isset($params[0]))
		    if($params[0]== 'help' || $params[0]== '-h' || $params[0]== '--help')
		    {
		    	new help();
		    	exit;
		    }elseif($params[0]== '-u' && isset($params[1]))
		    	 {
		    		new autenticate(Array($params[1]));
		    	 }
		print_r($params);
		new clear();
        echo "Welcome to mind3rd:\nType help to see the help content\n";
        while($in != "exit")
        {
        	if(!isset($_SESSION['login']))
        		echo "mind > ";
        	else
            	echo $_SESSION['login'].'@mind > ';
            $in=trim(fgets($fp));
            if($in!='exit' && trim($in)!='')
            {
                shellExecute($in);
            }
        }
        new clear();
        exit;