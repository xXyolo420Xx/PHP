/*Funciones validación formulario, cada vez que se salga 
del foco de cada elemento del formulario se comprobara
si es correcto o no*/
function setBlurs(){
	$('#nombre').blur(function(){
		if($('#nombre').val().length<2){
			$('#nombre').parent().addClass('has-error');
			$('#nombre').parent().parent().next().html('<p class="text-danger">Error, el nombre debe tener mas de 2 carácteres</p>');
			$('#nombre').parent().find('i').removeClass('glyphicon glyphicon-user').addClass('glyphicon glyphicon-remove');
		}else{
			$('#nombre').parent().removeClass('has-error').addClass('has-success');
			$('#nombre').parent().parent().next().html('');
			$('#nombre').parent().find('i').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-user');

		}
	});
	$('#apellidos').blur(function(){
		if($('#apellidos').val().length<2){
			$('#apellidos').parent().addClass('has-error');
			$('#apellidos').parent().parent().next().html('<p class="text-danger">Error, los apellidos deben tener mas de 2 carácteres</p>');
			$('#apellidos').parent().find('i').removeClass('glyphicon glyphicon-user').addClass('glyphicon glyphicon-remove');
		}else{
			$('#apellidos').parent().removeClass('has-error').addClass('has-success');
			$('#apellidos').parent().parent().next().html('');
			$('#apellidos').parent().find('i').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-user');

		}
	});
	$('#email').blur(function(){
		var regmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(!regmail.test($('#email').val())){
			$('#email').parent().addClass('has-error');
			$('#email').parent().parent().next().html('<p class="text-danger">Error, el email es incorrecto</p>');
			$('#email').parent().find('i').removeClass('glyphicon glyphicon-paperclip').addClass('glyphicon glyphicon-remove');
		}else{
			$('#email').parent().removeClass('has-error').addClass('has-success');
			$('#email').parent().parent().next().html('');
			$('#email').parent().find('i').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-paperclip');
		}
	});
	$('#telefono').blur(function(){
		var telreg = /^\+\d{10,13}$|^00\d{10,13}$|^6\d{8}$|^9\d{8}$/;
		if(!telreg.test($('#telefono').val())){
			$('#telefono').parent().addClass('has-error');
			$('#telefono').parent().parent().next().html('<p class="text-danger">El formato de teléfono no es válido</p>');
			$('#telefono').parent().find('i').removeClass('glyphicon glyphicon-earphone').addClass('glyphicon glyphicon-remove');
		}else{
			$('#telefono').parent().removeClass('has-error').addClass('has-success');
			$('#telefono').parent().parent().next().html('');
			$('#telefono').parent().find('i').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-earphone');
		}
	});
	$('#username').blur(function(){
		if ($('#username').val().length<2){
			$('#username').parent().addClass('has-error');
			$('#username').parent().parent().next().html('<p class="text-danger">El nombre de usuario debe tener mínimo 2 caracteres</p>');
			$('#username').parent().find('i').removeClass('glyphicon glyphicon-user').addClass('glyphicon glyphicon-remove');
		}else{
			$('#username').parent().removeClass('has-error').addClass('has-success');
			$('#username').parent().parent().next().html('');
			$('#username').parent().find('i').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-user');
		}
	});
	$('#password1').blur(function(){
		if($('#password1').val().length<6){
			$('#password1').parent().addClass('has-error');
			$('#password1').parent().parent().next().html('<p class="text-danger">La contraseña debe tener al menos 6 carácteres</p>');
			$('#password1').parent().find('i').removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-remove');
		}else if($('#password1').val().length<10){
			$('#password1').parent().removeClass('has-error').addClass('has-warning');
			$('#password1').parent().parent().next().html('<p class="text-warning">La contraseña es poco segura</p>');
			$('#password1').parent().find('i').removeClass('glyphicon glyphicon-eye-close').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-warning-sign');
		}else{
			$('#password1').parent().removeClass('has-error').removeClass('has-warning').addClass('has-success');
			$('#password1').parent().parent().next().html('');
			$('#password1').parent().find('i').removeClass('glyphicon glyphicon-remove').removeClass('glyphicon glyphicon-warning-sign').addClass('glyphicon glyphicon-eye-close');
		}
	});
	$('#password2').blur(function(){
		if($('#password2').val()!==$('#password1').val()){
			$('#password2').parent().addClass('has-error');
			$('#password2').parent().parent().next().html('<p class="text-danger">Las contraseñas no coinciden</p>');
			$('#password2').parent().find('i').removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-remove');
		}else{
			$('#password2').parent().removeClass('has-error').addClass('has-success');
			$('#password2').parent().parent().next().html('');
			$('#password2').parent().find('i').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-eye-close');
		}
	});
}