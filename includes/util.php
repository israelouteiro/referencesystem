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


 function nmes2tmes($mes){
	 if(floor($mes)==1){
		 return "Janeiro";
	 }
	 if(floor($mes)==2){
		 return "Fevereiro";
	 }
	 if(floor($mes)==3){
		 return "Março";
	 }
	 if(floor($mes)==4){
		 return "Abril";
	 }
	 if(floor($mes)==5){
		 return "Maio";
	 }
	 if(floor($mes)==6){
		 return "Junho";
	 }
	 if(floor($mes)==7){
		 return "Julho";
	 }
	 if(floor($mes)==8){
		 return "Agosto";
	 }
	 if(floor($mes)==9){
		 return "Setembro";
	 }
	 if(floor($mes)==10){
		 return "Outubro";
	 }
	 if(floor($mes)==11){
		 return "Novembro";
	 }
	 if(floor($mes)==12){
		 return "Dezembro";
	 }
	 return "";
 }

	function getTag($id){
		$q = mysql_query("SELECT * FROM tags WHERE id='$id' ");
		if(haveResults($q)){
			return mysql_result($q,0,"nome");
		}
		return false;
	} 

	function getConfig($config){
        $tconfig = mysql_query("SELECT * FROM config WHERE config='$config' ");
        if($tconfig&&mysql_num_rows($tconfig)>0){
            $value = mysql_result($tconfig,0,"value");
            return $value;
        }else{  
            return false;
        }
    }

    function setConfig($config,$value){
    	return mysql_query("UPDATE config SET value='$value' WHERE config='$config' ");
    }

    function linkifyYouTubeURLs($text) {
    $text = preg_replace('~
            # Match non-linked youtube URL in the wild. (Rev:20130823)
            https?://         # Required scheme. Either http or https.
            (?:[0-9A-Z-]+\.)? # Optional subdomain.
            (?:               # Group host alternatives.
              youtu\.be/      # Either youtu.be,
            | youtube         # or youtube.com or
              (?:-nocookie)?  # youtube-nocookie.com
              \.com           # followed by
              \S*             # Allow anything up to VIDEO_ID,
              [^\w\s-]       # but char before ID is non-ID char.
            )                 # End host alternatives.
            ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
            (?=[^\w-]|$)     # Assert next char is non-ID or EOS.
            (?!               # Assert URL is not pre-linked.
              [?=&+%\w.-]*    # Allow URL (query) remainder.
              (?:             # Group pre-linked alternatives.
                [\'"][^<>]*>  # Either inside a start tag,
              | </a>          # or inside <a> element text contents.
              )               # End recognized pre-linked alts.
            )                 # End negative lookahead assertion.
            [?=&+%\w.-]*        # Consume any URL (query) remainder.
            ~ix', 
            '<br><br><div class="vid-wrapper"><iframe width="420" height="345" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></div><br>',
            $text);
        return $text;
    }
    function linkifyYouTubeURLsSmall($text) {
    $text = preg_replace('~
            # Match non-linked youtube URL in the wild. (Rev:20130823)
            https?://         # Required scheme. Either http or https.
            (?:[0-9A-Z-]+\.)? # Optional subdomain.
            (?:               # Group host alternatives.
              youtu\.be/      # Either youtu.be,
            | youtube         # or youtube.com or
              (?:-nocookie)?  # youtube-nocookie.com
              \.com           # followed by
              \S*             # Allow anything up to VIDEO_ID,
              [^\w\s-]       # but char before ID is non-ID char.
            )                 # End host alternatives.
            ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
            (?=[^\w-]|$)     # Assert next char is non-ID or EOS.
            (?!               # Assert URL is not pre-linked.
              [?=&+%\w.-]*    # Allow URL (query) remainder.
              (?:             # Group pre-linked alternatives.
                [\'"][^<>]*>  # Either inside a start tag,
              | </a>          # or inside <a> element text contents.
              )               # End recognized pre-linked alts.
            )                 # End negative lookahead assertion.
            [?=&+%\w.-]*        # Consume any URL (query) remainder.
            ~ix', 
            '<br><br><div class="vid-wrapper"><iframe width="210" height="172" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></div><br>',
            $text);
        return $text;
    }

?>