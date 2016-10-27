Hotel.controller('ctrlPreguntas', function($scope,$http,$q){
	
	$scope.divErro = false;
	$scope.mensaje = "";

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

	$scope.initPreguntas = function(){
		$scope.config = configLogin;
		$scope.GetPreguntas();
		$scope.graficas = true;
		$scope.BotonSubmit = true;

	};
	$scope.GetPreguntas = function(){
		//alert(idHotel);
		var controlador = $scope.config.apiUrl+"index/GetPreguntas";
		var parametros 	= "Eliminado=0"+"&idHotel="+idHotel;
		$scope.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1){
				$scope.Preguntas = json.data;
				$scope.$digest();
			}
		});
	}
	$scope.Respuesta = function(){
		//alert(idHotel);
		$scope.Nombre 		= $("#Nombre").val();
		$scope.habitacion 	= $("#habitacion").val();
		$scope.OpcionUno 	= $(".califica0:checked").val();
		$scope.OpcionDos 	= $(".califica1:checked").val();
		$scope.OpcionTres 	= $(".califica2:checked").val();
		$scope.OpcionCuatro = $(".califica3:checked").val();
		$scope.OpcionCinco 	= $(".califica4:checked").val();

		if($scope.Nombre == ""  || $scope.Nombre == undefined){
			$scope.divErro = true;
			$scope.mensaje = " Debe escribir su nombre";
			swal("Atención!", "Debe escribir su nombre!", "warning");
			
		}else if($scope.habitacion == ""  || $scope.habitacion == undefined){
			swal("Atención!", "Debe escribir su numero de habitacion!", "warning");
			$scope.divErro = true;
			$scope.mensaje = " Debe escribir su numero de habitacion";

		}else if($scope.OpcionUno == ""  || $scope.OpcionUno == undefined){
			swal("Atención!", "Por favor responda la pregunta nro 1", "warning");
			$scope.divErro = true;
			$scope.mensaje = " Por favor responda la pregunta nro 1";
			
		}else if ($scope.OpcionDos == ""  || $scope.OpcionDos == undefined){
			swal("Atención!", "Por favor responda la pregunta nro 2", "warning");
			$scope.divErro = true;
			$scope.mensaje = " Por favor responda la pregunta nro 2";
			
		}else if($scope.OpcionTres == ""  || $scope.OpcionTres == undefined){
			swal("Atención!", "Por favor responda la pregunta nro 3", "warning");
			$scope.divErro = true;
			$scope.mensaje = " Por favor responda la pregunta nro 3";
			
		}else if($scope.OpcionCuatro == ""  || $scope.OpcionCuatro == undefined){
			swal("Atención!", "Por favor responda la pregunta nro 4", "warning");
			$scope.divErro = true;
			$scope.mensaje = " Por favor responda la pregunta nro 4";
			
		}else if($scope.OpcionCinco == ""  || $scope.OpcionCinco == undefined){
			swal("Atención!", "Por favor responda la pregunta nro 5", "warning");
			$scope.divErro = true;
			$scope.mensaje = " Por favor responda la pregunta nro 5";
			
		}else{

			$scope.BotonSubmit = false;
			$scope.divErro = false;
			$scope.mensaje = "";

			var Cuenta = 0;

			var controlador = $scope.config.apiUrl+"index/InsertaRespuesas";
			var elementoPre = $(".preguntas");
			
			$.each(elementoPre,function(){
				var idPregunta = $(this).attr('rel');
				var OpcionUno 	= $(".res"+idPregunta+":checked").val();
				var observaciones = $(".observacion"+idPregunta).val();
				//alert($(this).attr('rel') + " - " + OpcionUno +" - "+observaciones);
				
				var parametros 	= "Nombre="+$scope.Nombre+"&habitacion="+$scope.habitacion+"&idHotel="+idHotel+"&idPregunta="+idPregunta+"&calificacion="+OpcionUno+"&Observa="+observaciones;
				$scope.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						Cuenta++;
						if(Cuenta == elementoPre.length){
							swal(
								{
									title: "Notificación",   
									text: json.mensaje, 
									type:"success",  
									html: true 
								},function(){
									location.reload();
								}
							);
						}
					}
				});

				//var parametros 	= "Nombre="+$scope.Nombre+"&habitacion="+$scope.habitacion+"&PreguntaUno="+$scope.OpcionUno+"&PreguntaDos="+$scope.OpcionDos+"&PreguntaTres="+$scope.OpcionTres+"&PreguntaCuatro="+$scope.OpcionCuatro+"&PreguntaCinco="+$scope.OpcionCinco;
			});

			//var parametros 	= $("#Respuesta").serialize();
			//window.location.assign("http://localhost:8080/Hoteles/index/gracias/")
		}

		//alert($scope.OpcionUno);
	}
});


Hotel.controller('adminPreguntas', function($scope,$http,$q)
{
	
	$scope.preguntaTxt = "";
	$scope.tituloPopUp  = "CREAR UNA NUEVA PREGUNTA";
	$scope.textoBtn  	= "CREAR PREGUNTA";
	$scope.update  	    = 0;
	$scope.idModifica   = 0;

	$scope.initAdminPregunta = function()
	{
		$scope.config = configLogin;
	};


	$scope.crearPreguntaPop = function(idPregunta)
	{
		$("#myModal").modal();
		$scope.preguntaTxt = "";
		$scope.tituloPopUp  = "CREAR UNA NUEVA PREGUNTA";
		$scope.textoBtn  	= "CREAR PREGUNTA";
		$scope.update  	    = 0;
	$scope.idModifica   = 0;
	}

	$scope.getDataPreguntaSel = function(idPregunta)
	{
		$("#myModal").modal();
		$scope.preguntaTxt = "";
		$scope.tituloPopUp  = "MODIFICAR PREGUNTA";
		$scope.textoBtn  	= "MODIFICAR PREGUNTA";
		$scope.update  	    = 1;

		var controlador = $scope.config.apiUrl+"index/getDataPreguntaSel";
		var parametros 	= "idPregunta="+idPregunta;
		$scope.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$scope.preguntaTxt = json.data.Enunciado;
				$scope.idModifica   = json.data.IdPregunta;
				$scope.$digest();
			}
			else
			{

			}
		});

	}

	$scope.guardarPregunta = function()
	{	
		$scope.preguntaTxt = $("#preguntaTxt").val();
		//validamos el campo
		if($scope.preguntaTxt == "" || $scope.preguntaTxt == undefined)
		{
			swal(
				{
					title: "Error en formulario",   
					text: "Debe escribir la pregunta",  
					html: true ,
					type: 'info'
				},function(){
					//location.reload();
				}
			);
		}
		else
		{
			var controlador = $scope.config.apiUrl+"index/creaPregunta";
			var parametros 	= "pregunta="+$scope.preguntaTxt;
			$scope.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					swal(
						{
							title: "Registro exitoso",   
							text: json.mensaje,  
							html: true ,
							type: 'success'
						},function(){
							location.reload();
						}
					);	
				}
				else
				{
					swal(
						{
							title: "Error en la inserción",   
							text: json.mensaje,  
							html: true ,
							type: 'error'
						},function(){
							location.reload();
						}
					);
				}
			});
		}
	}

	$scope.modificarPregunta = function()
	{	
		//alert("está modificando")
		$scope.preguntaTxt = $("#preguntaTxt").val();
		//validamos el campo
		if($scope.preguntaTxt == "" || $scope.preguntaTxt == undefined)
		{
			swal(
				{
					title: "Error en formulario",   
					text: "Debe escribir la pregunta",  
					html: true ,
					type: 'info'
				},function(){
					//location.reload();
				}
			);
		}
		else
		{
			var controlador = $scope.config.apiUrl+"index/modificarPregunta";
			var parametros 	= "pregunta="+$scope.preguntaTxt+"&idPregunta="+$scope.idModifica;
			$scope.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					swal(
						{
							title: "Registro exitoso",   
							text: json.mensaje,  
							html: true ,
							type: 'success'
						},function(){
							location.reload();
						}
					);	
				}
				else
				{
					swal(
						{
							title: "Error en la inserción",   
							text: json.mensaje,  
							html: true ,
							type: 'error'
						},function(){
							location.reload();
						}
					);
				}
			});
		}
	}

	$scope.borrarPregunta = function(idPregunta)
	{
		swal(
			{
				title: "Confirmación",
				text: "Está a punto de eliminar la pregunta seleccionada, este proceso no se puede retroceder, desea continuar?",
				type: "info",
				showCancelButton: true,
				//confirmButtonText:"Yes, delete it!",
				showLoaderOnConfirm: true,
				closeOnConfirm: false 
			}, 
				function()
				{
						var controlador = $scope.config.apiUrl+"index/borrarPregunta";
						var parametros 	= "idPregunta="+idPregunta;
						$scope.consultaApi(controlador,parametros,function(json){
							if(json.continuar == 1)
							{
								swal(
									{
										title: "Proceso exitoso",   
										text: json.mensaje,  
										html: true ,
										type: 'success'
									},function(){
										location.reload();
									}
								);	
							}
							else
							{
								swal(
									{
										title: "Error en el proceso",   
										text: json.mensaje,  
										html: true ,
										type: 'error'
									},function(){
										location.reload();
									}
								);
							}
						});
				}

			);
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

});	


Hotel.controller('ctrlResultados', function($scope,$http,$q)
{

	$scope.fechaIni	=	$("#fechaIni").val();
	$scope.fechaFin	=	$("#fechaFin").val();
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
	$scope.initRespuesta = function()
	{
		$('#fechaIni').datetimepicker({
                format: 'YYYY-MM-DD'
         });

		$('#fechaFin').datetimepicker({
                format: 'YYYY-MM-DD'
         });

		$scope.config = configLogin;
		$scope.GetPreguntas();
		//$scope.Graficas();
	};

	$scope.buscarRes = function()
	{
		$scope.GetPreguntas();
	}

	$scope.GetPreguntas = function()
	{

		$scope.fechaIni	=	$("#fechaIni").val();
		$scope.fechaFin	=	$("#fechaFin").val();

		var controlador = $scope.config.apiUrl+"index/GetRespuestas";
		var parametros 	= "idHotel="+idHotelR+"&fechaIni="+$scope.fechaIni+"&fechaFin="+$scope.fechaFin;
		$scope.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{

				console.log(json.data);
				$scope.Preguntas = json.data;
				$scope.$digest();
				for(i=0;i<=json.data.length;i++)
				{
					$scope.Graficas(json.data[i].datos,json.data[i].idPregunta);
				}	
			}
		});
	}


	$scope.Graficas = function(data,i)
	{
		//console.log(data);

		setTimeout(function()
		{
				console.log(data);
				Morris.Donut({
			        element: 'morris-area-tree'+i,
			        data: data,
			        resize: true,
			        formatter:function (y, data) { return '%' + y }
		    	});
				
		},1000);

	}

	$scope.getPersons = function(idPregunta,calificacion)
	{
		$scope.fechaIni	=	$("#fechaIni").val();
		$scope.fechaFin	=	$("#fechaFin").val();
		//alert(idPregunta+" - "+calificacion+" - "+idHotelR);
		var controlador = $scope.config.apiUrl+"index/getPersonCalifica";
		var parametros 	= "idHotel="+idHotelR+"&idPregunta="+idPregunta+"&calificacion="+calificacion+"&fechaIni="+$scope.fechaIni+"&fechaFin="+$scope.fechaFin;
		$scope.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				var tabla = "<table class='table'>";
				tabla += "<tr>";
					tabla += "<th class='text-center'>PERSONA</th>";
					tabla += "<th class='text-center'>HABITACIÓN</th>";
					tabla += "<th class='text-center'>FECHA</th>";
				tabla += "</tr>";
				for(a in json.data)
				{
					tabla += "<tr>";
						tabla += "<td>";
							tabla += json.data[a].nombre;
						tabla += "</td>";
						tabla += "<td>";
							tabla += json.data[a].habitacion;
						tabla += "</td>";
						tabla += "<td>";
							tabla += json.data[a].fechaRegistro;
						tabla += "</td>";
					tabla += "</tr>";
				}
				tabla += "</table>";

				swal(
					{
						title: "Lista de personas",   
						text: tabla,  
						html: true 
					},function(){
						//location.reload();
					}
				);
			}
		});
	}

	$scope.exportaExcel = function(url)
	{
		$scope.fechaIni	=	$("#fechaIni").val();
		$scope.fechaFin	=	$("#fechaFin").val();
		document.location = url+"/"+$scope.fechaIni+"/"+$scope.fechaFin;
	}

});