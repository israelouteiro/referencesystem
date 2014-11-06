<?php
function montaEmailM($mensagem){
return 
'<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="4" align="center" style="background:url('.URLSite.'images/01.jpg) no-repeat center center;background-size:cover;height:84px;">&nbsp;</td>
</tr>
<tr>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
</tr>
<tr>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
</tr>
<tr>
<td colspan="4" style="background:#FFFFFF;height:auto;padding:25px;text-align:center;color:#666666;font-family:Verdana, Geneva, sans-serif;">'.$mensagem.'</td>
</tr>
<tr>
<td style="background:#404040;">&nbsp;</td>
<td style="background:#404040;">&nbsp;</td>
<td style="background:#404040;">&nbsp;</td>
<td style="background:#404040;">&nbsp;</td>
</tr>
</table>';
/*
<tr>

<td colspan="4" style="background:#efefef;height:30px;font-weight:bold;padding-top:7px;padding-bottom:1px;padding-right:15px;color:#666666;font-family:Helvetica;" align="right">&nbsp;</td>

</tr>
*/
}

function montaEmailMCL($mensagem,$textoLink,$hrefLink){
return '
      <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="4" align="center" style="background:url('.URLSite.'images/01.jpg) no-repeat center center;background-size:cover;height:84px;">&nbsp;</td>
</tr>
<tr>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
</tr>
<tr>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
</tr>
<tr>
<td colspan="4" style="background:#FFFFFF;height:auto;padding:25px;text-align:center;color:#666666;font-family:Verdana, Geneva, sans-serif;">'.$mensagem.'</td>
</tr>
<tr>
  <td style="background:#FFFFFF;">&nbsp;</td>
  <td style="background:#FFFFFF;">&nbsp;</td>
  <td style="background:#FFFFFF;">&nbsp;</td>
  <td style="background:#FFFFFF;">&nbsp;</td>
</tr>
<tr>
<td style="background:#FFFFFF;" colspan="4" align="center"><a href="'.$hrefLink.'" style="text-decoration:none;width:auto;height:40px;padding:15px;background:#efefef;margin-left:20px;color:#666666;font-family:Verdana, Geneva, sans-serif;font-size:1.2em;font-weight:bold;">'.$textoLink.'</a></td>
</tr>
<tr>
<td style="background:#FFFFFF;" height="5">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
<td style="background:#FFFFFF;">&nbsp;</td>
</tr>
</table>
';
/*
<tr>

<td colspan="4" style="background:#efefef;height:30px;font-weight:bold;padding-top:7px;padding-bottom:1px;padding-right:15px;color:#666666;font-family:Helvetica;" align="right">&nbsp;</td>

</tr>
*/
}
function mandaEmail($mensagem,$assunto,$xmail){
		$headers = "MIME-Version: 1.1\n".
		"Content-type: text/html; charset=utf-8\n".
		"From:reference_system@spyce.agency \n".
		"Return-Path:israel@racionalize.com.br\n";
	
	
	/*	
		$headers = "MIME-Version: 1.1\r\n".
		"Content-type: text/html; charset=utf-8\r\n".
		"From:no-reply@prefeitoempreendedor.sebrae.com.br \r\n".
		"Return-Path:israel@racionalize.com.br \r\n";
	*/	
		
		if(mail( $xmail, $assunto, $mensagem, $headers,"-r israel@racionalize.com.br")){
			return true;
		}else{
			return false;
		}

}

function alert($texto){
	echo "<script>alert('".$texto."');</script>";
}

function locationHref($url){
	echo "<script>location.href=('".$url."');</script>";
}

	function haveResults($query){
		if($query&&mysql_num_rows($query)>0){
			return true;
		}
		return false;
	}

	function my2json($sth){
		$rows = array();
		while($r = mysql_fetch_assoc($sth)) {
		    $rows[] = $r;
		}
		return json_encode($rows);
	}
?>