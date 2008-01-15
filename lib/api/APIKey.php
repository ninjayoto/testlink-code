<?php
/*
 * TestLink Open Source Project - http://testlink.sourceforge.net/
 * $Id: APIKey.php,v 1.2 2008/01/15 20:30:40 havlat Exp $
 * 
 * Class that deals with API keys
 */
require_once(dirname(__FILE__) . "/../../config.inc.php");
require_once('common.php');

class APIKey extends tlObjectWithDB
{	
	public function __construct()
	{		
		$db = null;
		doDBConnect($db);				
		parent::__construct($db);	
	}
	
	public function addKeyForUser($userid)
	{
		$query = "INSERT INTO users (script_key) VALUES ('" . 
					$this->generate_key() . "') WHERE id=".$userid; 
		$result = $this->db->exec_query($query);
		if ($result)
			$this->dbID = $this->db->insert_id();
		
		return $result ? tl::OK : tl::ERROR;
	}

	/**
	 *  very simple key generation 
	*/
	private function generate_key()
	{
		$key = '';
		
		for($i=0; $i<8; $i++)
		  $key .= mt_rand();
		
		return md5($key) . "\n";
	}

}


?>