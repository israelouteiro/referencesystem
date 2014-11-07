<?php

include "util.php";

class conexao
{
	var $host;
	var $user;
	var $senha;
	var $banco;
	function conecta_banco()
	{
		mysql_connect($this->host, $this->user, $this->senha) or die (mysql_error());
		mysql_select_db($this->banco) or die (mysql_error());
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	}
}

 
 $cxn = new conexao;
 $cxn-> host= "localhost";
 $cxn-> user= "root";
 $cxn-> senha= "";
 $cxn-> banco= "referencesystem";
 $cxn->conecta_banco(); 
 
 define('URLSite','http://spice.agency/resys/');


?>

<?php

include "util.php";

class conexao
{
	var $host;
	var $user;
	var $senha;
	var $banco;
	function conecta_banco()
	{
		mysql_connect($this->host, $this->user, $this->senha) or die (mysql_error());
		mysql_select_db($this->banco) or die (mysql_error());
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	}
}

 
 $cxn = new conexao;
 $cxn-> host= "localhost";
 $cxn-> user= "referencesystem";
 $cxn-> senha= "rtacs12#$";
 $cxn-> banco= "referencesystem";
 $cxn->conecta_banco(); 
 
 define('URLSite','http://spice.agency/resys/');


?>
