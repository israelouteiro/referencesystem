$(document).on('change','#editProfilePhoto',function(e){
		    var file = this.files[0];
		    var name = file.name;
		    var size = file.size;
		    var type = file.type;

		    if (!type.match('image.*')) {
		    	alert('O arquivo escolhido não é uma imagem');
		    }else{
		    	//Upload
		    	
		    	var nomeArquivo = file.name;
		    	showLoad("Sending photo: "+nomeArquivo);
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
									//setEditProfile();
								} else {
									alert(data);
								}
								$('#editProfilePhoto').val('');
							}).fail(function(){
								alert('Error in connection retry');
								hideLoad();
								$('#editProfilePhoto').val('');
							});

					}; 
					
				})(this.files[0]);
					
				
			}
		});
