$(document).ready(function(){

    $('#btn-copiar_dni-cont').on("click", ".copiar_dni", function(){ //permite pasar los datos del cliente al formulario

    	var dni_cliente = $(this).val();
		
        $('#cli_dni').val(dni_cliente);
    	});

    $('#btn-info-cont').on("click", ".inhabilitar", function (e) {
		
			e.preventDefault();
			var $form=$(this);
			$('#myModal3').modal({ backdrop: 'static', keyboard: false })
				.on('click', '#inhabilitar-si', function(){
            $form.submit();
    	});
   
   
   
    $("#btn-info-cont").on("click", ".btn-info", function (e) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
        e.preventDefault(); 

        var formData = 
        {
            evento_id: $(this).val(),// el id del evento esta cargado en el boton
        }

        var type = 'post';
        var my_url = '/eventos/ver';

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

    	success: function (data) {
            console.log(data);
            $('#frmClientes').trigger("reset");
            $('#Descripcion').val(data.eve_descripcion);
            $('#Fecha').val(data.eve_fecha);
            $('#Lugar').val(data.eve_lugar);
            $('#Nombre').val(data.cli_nombre);
			$('#Apellido').val(data.cli_apellido);
            $('#Telefono').val(data.cli_telefono);
            $('#Mail').val(data.email);
			$('#DNI').val(data.cli_dni);
			
            $('#myModal2').modal('show');
            },
        error: function (data) {
            console.log('Error:', data);
            }
            });
    	});
	
	
	$(".btn-buscar").click(function (e) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})

		var formData = 
        {
            descripcion: $('#descripcion_b').val(),
			fecha_desde: $('#fecha_desde_b').val(),
			fecha_hasta: $('#fecha_hasta_b').val(),
			dni: $('#dni_b').val(),
        }
        
		
        var type = 'post';
        var my_url = '/eventos/busqueda';

        $.ajax({
            type: type,
            url: my_url,
			data: formData,
            dataType: 'json',
            
            success: function (data) {
                console.log(data);
                // data es un arreglo que contiene en cada celda toda una fila de la base.
                // para acceder data[i].cli_nombre de esta forma accedemos al valor nombre que asi esta definido en la base
                var contador = 0;
                $("#tabla_eve").find("tr:gt(0)").remove();
                $('#panel_2').remove();
				$('#tabla_eve').removeAttr('hidden');
                for(var i in data){
                    contador = contador + 1;
                    var cliente = "<tr><td><h6><span class='fa fa-star' aria-hidden='true'></span></h6></td><td><h6>"+contador+"</h6></td><td><h6>"+data[i].eve_descripcion+"</h6></td><td><h6>"+data[i].eve_fecha+"</h6></td><td><h6>"+data[i].eve_lugar+"</h6></td><td><h6>"+data[i].cli_nombre+""+data[i].cli_apellido+"</h6></td><td><h6>"+data[i].cli_dni+"</h6></td><td><a href='http://localhost:8000/eventos/update/"+data[i].eve_id+"' class='btn btn-primary'><span class='fa fa-pencil-square-o' aria-hidden='true'></span>  Editar</a></td><td><button type='button' value="+data[i].eve_id+" class='btn btn-default btn-info'><span class='fa fa-eye' aria-hidden='true'></span>  Ver</button></td></tr>";
					
					//var cliente ="<div class='panel panel-default' id='titi'><div class='panel-body'><h5 class='list-group-item-heading'><strong>"+data[i].eve_descripcion+"</strong></h5><h6><strong><span class='fa fa-user' aria-hidden='true'></span>&nbsp;&nbsp;Fecha:</strong>"+data[i].eve_fecha+"</h6><h6><strong><span class='fa fa-map-marker' aria-hidden='true'></span>&nbsp;&nbsp;Lugar:</strong>"+data[i].eve_lugar+"</h6><h6><strong><span class='fa fa-user' aria-hidden='true'></span>&nbsp;&nbsp;Cliente:</strong>"+data[i].cli_nombre+""+data[i].cli_apellido+"</h6><Form action='eventos/update' method='POST'>{!! Form::token() !!}<input name='id' type='hidden' value="+data[i].eve_id+"><button type='submit' class='btn btn-primary'><span class='fa fa-pencil-square-o' aria-hidden='true'></span>  Editar</button><button type='button' class='btn btn-default btn-info' value="+data[i].eve_id+"><span class='fa fa-eye' aria-hidden='true'></span>  Ver</button></Form></div></div>";

					$('#tabla_eve').append(cliente);

                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });



});