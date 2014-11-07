function addTag(){
	var nTag = $('#valorTags').val();
	if(nTag!=''){
		$.post('includes/addTag.php', { nome: nTag }).done(function(r){
			if(r=='sucesso'){
				$('#valorTags').val('');
				carregaTags();
			}
		});
	}
}

function carregaTags(){
	valores = ($('#fe_tags').val());
	$.post('includes/getTags.php',{ jaTags : valores }).done(function(ve){
		$('#listaTags').html(ve);
	});
}


function selecionaTag(idx){
	
	if($('#fe_tags').val()==''){
		$('#fe_tags').val(''+idx);
	}else{
		$('#fe_tags').val($('#fe_tags').val()+','+idx);
	}
	carregaTags();
}

$(document).ready(function(e){
	carregaTags();
});