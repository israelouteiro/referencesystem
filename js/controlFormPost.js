
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
									sucessoArquivos(idx,nomeArquivo);
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
									sucessoArquivos(idx,nomeArquivo);
								} else {
									alert(data);
								}
								
							});

					}; 
					
				})(this.files[0]);
					
			
		});


		function sucessoArquivos(idx,fileName){
			if($('#fe_anexos').val()==''){
				$('#fe_anexos').val(''+idx);
			}else{
				$('#fe_anexos').val($('#fe_anexos').val()+','+idx);
			}
			//alert('adicionei arquivo ('+fileName+') com sucesso');
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