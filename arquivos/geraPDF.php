<?php
	$ids_post_export = $_POST['imgs_toex'];
	$nomePDF = substr_replace(sha1(microtime(true)), '', 12).'.pdf';
	//system('xvfb-run -a -s "-screen 0 1024x768x16" wkhtmltopdf '."http://spice.agency/resys/modeloPDF.php?ids=".$ids_post_export.' '.$nomePDF); //retorna log
	exec('xvfb-run -a -s "-screen 0 1024x768x16" wkhtmltopdf '."http://spice.agency/resys/modeloPDF.php?ids=".$ids_post_export.' '.$nomePDF); //nao retorna log

	echo '<p class="text-center">Para baixar seu PDF Click <a href="http://spice.agency/resys/arquivos/'.$nomePDF.'" target="new">AQUI</a></p>';
?>