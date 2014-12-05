
function addTagx(valor){
	var nTag = valor;
	if(nTag!=''){
		showLoad("Adding tags");
		$.post('includes/addTag.php', { nome: nTag }).done(function(r){
			r = r.split(':')
			if(r[0]=='sucesso'){
				$('#valorTags').val('');
				hideLoad();
				carregaTags();
				selecionaTag(r[1],nTag);
			}
		}).fail(function(){
			alert('Error in connection retry');
			hideLoad();
		});
	}
}

function carregaTags(){
	showLoad("Loading tags");
	valores = ($('#fe_tags').val());
	$.post('includes/getTags.php',{ jaTags : valores }).done(function(ve){
		$('#listaTags').html(ve);
		hideLoad();
	}).fail(function(){
		alert('Error in connection retry');
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
function selecionaTags(idx,nomex){
	
	if($('#fe_tags').val()==''){
		$('#fe_tags').val(''+idx);
	}else{
		$('#fe_tags').val($('#fe_tags').val()+','+idx);
	}

	$('#post-area-tags ul').append('<li onclick="removeFromListTag('+idx+');$(this).remove();">#'+nomex+' <img src="images/36.png"></li>');

	//dropbox
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
	showLoad("Loading posts");
	$.get('includes/generatePosts.php?in='+inic).done(function(alm){
		$('#allPosts').append(alm);
		numEPo = inic +12;
		hideLoad();
	}).fail(function(){
		alert('Error in connection retry');
		hideLoad();
	});
}

function carregaPosts(){
	$('#allPosts').html('');
	showLoad("Loading posts");
	$.get('includes/generatePosts.php').done(function(alm){
		$('#allPosts').html(alm);
		numEPo = 12;
		hideLoad();
	}).fail(function(){
		alert('Error in connection retry');
		hideLoad();
	});
}

function removePost(idx){
	showLoad("Deleting post");
	$.post('includes/removePost.php',{id:idx},function(so){
		hideLoad();
		carregaPosts();
	}).fail(function(){
		alert('Error in connection retry');
		hideLoad();
	});
}