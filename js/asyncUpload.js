$('#editProfilePhoto').bind('change',function(e){

		    var file = this.files[0];
		    var name = file.name;
		    var size = file.size;
		    var type = file.type;

		    if (!type.match('image.*')) {
		    	alert('O arquivo escolhido não é uma imagem');
		    }else{
		    	//Upload
		    	showLoad();
		    	var nomeArquivo = file.name;
		    	var fileReader = new FileReader();
		    	fileReader.readAsDataURL(file);
				fileReader.onload = (function(file) {
					
					return function(e) { 

						var image = this.result;
						var objPost = {name : nomeArquivo, value : image};

							$.post('includes/savePhoto.php', objPost, function(data) {
					
								var fileName = nomeArquivo;
								hideLoad();
								//APENAS PARA VERIFICAR SUCESSO NO PHP
								var dataSplit = data.split(':');
								if(dataSplit[1] == 'successfully') {
									$('.userPhotoProfile').css('background','url(arquivos/'+dataSplit[0]+') no-repeat center center');
									$('.userPhotoProfile').css('background-size','cover');
									setEditProfile();
								} else {
									alert(data);
								}
								
							});

					}; 
					
				})(this.files[0]);
					
				
			}
		});
