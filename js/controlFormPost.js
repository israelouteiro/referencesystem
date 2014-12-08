		$(document).on('change','#selectPicture',function(e){

		    var file = this.files[0];
		    var name = file.name;
		    var size = file.size;
		    var type = file.type;

		    if (!type.match('image.*')) {
		    	alert('The current file is not an image');
		    }else{
		    	//Upload
		    	showLoad("Sending photo: "+name);
		    	var nomeArquivo = file.name;
		    	var fileReader = new FileReader();
		    	fileReader.readAsDataURL(file);
				fileReader.onload = (function(file) {
					
					return function(e) { 

						var image = this.result;
						var objPost = {name : nomeArquivo, value : image};

							$.post('includes/savePhotoPost.php', objPost, function(data) {
								//APENAS PARA VERIFICAR SUCESSO NO PHP
								hideLoad();
								var dataSplit = data.split(':');
								if(dataSplit[1] == 'successfully') {
									var idx = dataSplit[0];
									sucessoArquivos(idx,nomeArquivo,'imagem');
								} else {
									alert(data);
								}
								$('#selectPicture').val('');
							}).fail(function(){
								alert('Connection error');
								hideLoad();
								$('#selectPicture').val('');
							});

					}; 
					
				})(this.files[0]);
					
				
			}
		});




		$(document).on('change','#selectFile',function(e){

		    var file = this.files[0];
		    var name = file.name;
		    var size = file.size;
		    var type = file.type;
		    	showLoad("Sending file: "+name);
		    	//Upload
		    	var nomeArquivo = file.name;
		    	var fileReader = new FileReader();
		    	fileReader.readAsDataURL(file);
				fileReader.onload = (function(file) {
					
					return function(e) { 

						var image = this.result;
						var objPost = {name : nomeArquivo, value : image};
							$.post('includes/saveFilePost.php', objPost, function(data) {
								//APENAS PARA VERIFICAR SUCESSO NO PHP
								hideLoad();
								var dataSplit = data.split(':');
								if(dataSplit[1] == 'successfully') {
									var idx = dataSplit[0];
									sucessoArquivos(idx,nomeArquivo,'file');
								} else {
									alert(data);
								}
								$('#selectFile').val('');
							}).fail(function(){
								alert('Connection error');
								hideLoad();
								$('#selectFile').val('');
							});

					}; 
					
				})(this.files[0]);
					
			
		});


		function sucessoArquivos(idx,fileName,donde){
			if($('#fe_anexos').val()==''){
				$('#fe_anexos').val(''+idx);
			}else{
				$('#fe_anexos').val($('#fe_anexos').val()+','+idx);
			}

			if(donde=='file'){
				$('#post-area-attaches ul').append('<li onclick="removeFromList('+idx+');$(this).remove();"><img src="images/37.png"> '+fileName+' <img src="images/36.png"></li>');
			}else{
				$('#post-area-attaches ul').append('<li onclick="removeFromList('+idx+');$(this).remove();"><img src="images/38.png"> '+fileName+' <img src="images/36.png"></li>');
			}
		}

		function removeFromList(idx){
			valor = $('#fe_anexos').val();
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
			$('#fe_anexos').val(valor);
		}

		function submitPost(){
			var types = '';
				if(changeReferenceState){
					var types = 'reference';
				}else{
					var types = 'request';
				}
			$('#fe_type').val(types);
			if($('#post-area-middle-textarea').val()!=''){
				$('#fe_texto').val($('#post-area-middle-textarea').val());
				showLoad("Saving post");
							$.post('includes/savePost.php', $('#formEnvios').serialize(), function(data) {
								var dataSplit = data.split(':');
								if(dataSplit[1] == 'successfully') {
									document.getElementById('formEnvios').reset();
									$('#fe_tags').val('');
									$('#fe_anexos').val('');
									$('#fe_texto').val('');
									$('#fe_type').val('');
									$('#post-area-attaches ul').html('');
									$('#post-area-tags ul').html('');
									changeReferenceState=false;changeReference();
									$('#post-area-middle-textarea').val('');
									hideLoad();
									carregaTags();
									carregaPosts();
								} else {
									alert(data);
								}
							}).fail(function(){
								alert('Connection error');
								hideLoad();
							});
			}else{
				alert('You have to write something before you post');
			}
		}


		function postComment(idPoste){
				if($('#textos_comentarios'+idPoste).val()!=''){
					$.post('includes/saveComento.php',{ texto: $('#textos_comentarios'+idPoste).val(), fk_poste : idPoste }, function (foiz){
						ds = foiz.split(':');
						if(ds[1]=='successfully'){
							recarregaComentarios(idPoste);
							$('#textos_comentarios'+idPoste).val('');
						}else{
							alert(foiz);
						}
					}).fail(function(){
						alert('Connection error');
						hideLoad();
					});
				}
		}

		function recarregaComentarios(id){
			$.get('includes/generateComentes.php?id='+id).done(function(susexo){
				$('#lista_comentartio'+id).html(susexo);
				recarregaBadgeComentos(id);
			}).fail(function(){
				alert('Connection error');
				hideLoad();
			});
		}

		function recarregaBadgeComentos(id){
			$.get('includes/generateBComentes.php?id='+id).done(function(susexo){
				$('#bComm'+id).html(susexo+' comments');
			}).fail(function(){
				alert('Connection error');
				hideLoad();
			});
		}

		function curtiu(id){
			showLoad("Loading");
			$.get('includes/curtiuLikes.php?id='+id).done(function(susexo){
				susexo = susexo.split(':');
				if(susexo[0]=='curtiu'){
					$('#likesObj'+id+' img').attr('src','images/17.png');
				}else{
					$('#likesObj'+id+' img').attr('src','images/18.png');
				}
				$('#likesObj'+id+' p').html(susexo[1]+' users liked');
				hideLoad();
			}).fail(function(){
				alert('Connection error');
				hideLoad();
			});
		}


		var iniMPople = 0;
		function morePeople(){
			iniMPople += 8;
			showLoad("Loading more people");
			$.post('includes/generateMorePeople.php',{inicio:iniMPople},function(simn){
				$('#morePhotosButton').before(simn);
				hideLoad();
			}).fail(function(){
				alert('Connection error');
				hideLoad();
			});
		}


						function filtraPostes(fillt,nombressito){
                            if(fillt=='reference'){
                                $('#textoFiltro').html('Reference <span class="caret">');
                            }else{
                                if(fillt=='request'){
                                    $('#textoFiltro').html('Request <span class="caret">');
                                }else{
                                    if(fillt=='all'){
                                        $('#textoFiltro').html('All posts <span class="caret">');
                                    }else{
                                        $('#textoFiltro').html(nombressito+' <span class="caret">');
                                    }
                                }
                            }
                            showLoad("Filtering posts");
                            $.post('includes/generatePosts.php',{filtro:fillt}).done(function(alm){
                                $('#allPosts').html(alm);
                                numEPo = 12;
                                hideLoad();
                            }).fail(function(){
								alert('Connection error');
								hideLoad();
							});
                        }
    
    function editPost(idx){
    	$.post("includes/getEditPost.php",{id:idx}).done(function(realdate){
    		$('body').append(realdate);
    	});
    }