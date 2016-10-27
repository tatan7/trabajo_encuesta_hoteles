Hotel.controller('ctrlLogin', function($scope,$http,$q){
	$scope.innitLogin = function(){
		$scope.config = configLogin;
	}
	$scope.consultaApi = function(url,parametros,callback)
	{
		 $.ajax({
	        url: url,
	        data: parametros,
	        type: "POST",
	        dataType: "json",
	        success:function(data)
	        {
	        	//alert(data);
	        	callback(data);
	        },
	        error:function(e) {
	            //$("#ERRORES").html(e.statusText + e.status + e.responseText);
	        }
	    });
	};
	$scope.login =function(){
		$scope.errorDv = false;
		$scope.mensaje = "";
		$scope.usuario 	=  	$("#usuario").val();
		$scope.clave 	= 	$("#clave").val();

		if($scope.usuario == "" || $scope.usuario == undefined){
			$scope.errorDv = true;
			$scope.mensaje = "Debes ingresar un usuario";
		}else if($scope.clave == "" || $scope.clave == undefined){
			$scope.errorDv = true;
			$scope.mensaje = "Debes ingresar tu clave";
		}else{
			
			$scope.errorDv = false;
			$scope.mensaje = "";

			var controlador = $scope.config.apiUrl+"index/startSession";
			var parametros 	= $("#LoginForm").serialize();
			$scope.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					location.reload();
				}else{
					swal({  title: "¡Error!",   
							text: json.mensaje,   
							type: "warning",   
							showCancelButton: false,   
							confirmButtonColor: "#DD6B55",   
							confirmButtonText: "Aceptar!",   
							closeOnConfirm: false }, 
						function(){
							location.reload();
						 });
				}
			});
		}
	}
});