function addTag(){
	var nTag = $('#valorTags').val();
	if(nTag!=''){
		showLoad();
		$.post('includes/addTag.php', { nome: nTag }).done(function(r){
			if(r=='sucesso'){
				$('#valorTags').val('');
				hideLoad();
				carregaTags();
			}
		});
	}
}

function carregaTags(){
	showLoad();
	valores = ($('#fe_tags').val());
	$.post('includes/getTags.php',{ jaTags : valores }).done(function(ve){
		$('#listaTags').html(ve);
		hideLoad();
	});
}


function selecionaTag(idx,nomex){
	
	if($('#fe_tags').val()==''){
		$('#fe_tags').val(''+idx);
	}else{
		$('#fe_tags').val($('#fe_tags').val()+','+idx);
	}

	$('#post-area-tags ul').append('<li onclick="removeFromListTag('+idx+');$(this).remove();">#'+nomex+' <img src="images/36.png"></li>');

	//dropbox
	carregaTags();
}


		function removeFromListTag(idx){
			valor = $('#fe_tags').val();
			ind = valor.indexOf(','+idx+',');
			if( ind != -1 ){
				// no meio //
				valor = valor.replace(','+idx+',',',');
			}else{
				ind = valor.indexOf(','+idx);
				if( ind != -1 ){
					// no final //
					valor = valor.replace(','+idx,'');
				}else{
					ind = valor.indexOf(idx+',');
					if( ind != -1 ){
						// no inicio //
						valor = valor.replace(idx+',','');
					}else{
						ind = valor.indexOf(idx);
						if( ind != -1 ){
							//só tem ele
							valor = valor.replace(idx,'');
						}
					}
				}
			}
			$('#fe_tags').val(valor);
			carregaTags();
		}



var numEPo = 0;

$(document).ready(function(e){
	carregaTags();
	garregaPosts(numEPo);
});

function garregaPosts(inic){
	showLoad();
	$.get('includes/generatePosts.php?in='+inic).done(function(alm){
		$('#allPosts').append(alm);
		numEPo = inic +12;
		hideLoad();
	});
}

function carregaPosts(){
	$('#allPosts').html('');
	showLoad();
	$.get('includes/generatePosts.php').done(function(alm){
		$('#allPosts').html(alm);
		numEPo = 12;
		hideLoad();
	});
}

function removePost(idx){
	showLoad();
	$.post('includes/removePost.php',{id:idx},function(so){
		hideLoad();
		carregaPosts();
	});
}