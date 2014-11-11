
		$('#selectPicture').bind('change',function(e){

		    var file = this.files[0];
		    var name = file.name;
		    var size = file.size;
		    var type = file.type;

		    if (!type.match('image.*')) {
		    	alert('O arquivo escolhido não é uma imagem');
		    }else{
		    	//Upload
		    	var nomeArquivo = file.name;
		    	var fileReader = new FileReader();
		    	fileReader.readAsDataURL(file);
				fileReader.onload = (function(file) {
					
					return function(e) { 

						var image = this.result;
						var objPost = {name : nomeArquivo, value : image};

							$.post('includes/savePhotoPost.php', objPost, function(data) {
								//APENAS PARA VERIFICAR SUCESSO NO PHP
								var dataSplit = data.split(':');
								if(dataSplit[1] == 'successfully') {
									var idx = dataSplit[0];
									sucessoArquivos(idx,nomeArquivo,'imagem');
								} else {
									alert(data);
								}
								
							});

					}; 
					
				})(this.files[0]);
					
				
			}
		});





		$('#selectFile').bind('change',function(e){

		    var file = this.files[0];
		    var name = file.name;
		    var size = file.size;
		    var type = file.type;

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
								var dataSplit = data.split(':');
								if(dataSplit[1] == 'successfully') {
									var idx = dataSplit[0];
									sucessoArquivos(idx,nomeArquivo,'file');
								} else {
									alert(data);
								}
								
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
									carregaTags();
									carregaPosts();
								} else {
									alert(data);
								}
							});
			}else{
				alert('Digite algo em sua postagem');
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
					});
				}
		}

		function recarregaComentarios(id){
			$.get('includes/generateComentes.php?id='+id).done(function(susexo){
				$('#lista_comentartio'+id).html(susexo);
				recarregaBadgeComentos(id);
			});
		}

		function recarregaBadgeComentos(id){
			$.get('includes/generateBComentes.php?id='+id).done(function(susexo){
				$('#bComm'+id).html(susexo+' comments');
			});
		}

		function curtiu(id){
			$.get('includes/curtiuLikes.php?id='+id).done(function(susexo){
				susexo = susexo.split(':');
				if(susexo[0]=='curtiu'){
					$('#likesObj'+id+' img').attr('src','images/17.png');
				}else{
					$('#likesObj'+id+' img').attr('src','images/18.png');
				}
				$('#likesObj'+id+' p').html(susexo[1]+' users liked');
			});
		}


		var iniMPople = 0;
		function morePeople(){
			iniMPople += 8;
			$('includes/generateMorePeople.php',{inicio:iniMPople},function(simn){
				$('#morePhotosButton').before(simn);
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
                            $.post('includes/generatePosts.php',{filtro:fillt}).done(function(alm){
                                $('#allPosts').html(alm);
                                numEPo = 12;
                            });
                        }