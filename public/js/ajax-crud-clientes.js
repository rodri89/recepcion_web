

$(document).ready(function(){



    //ESTO TRAE LOS DATOS DEL CLIENTE QUE SE VA A ACTUALIZAR
    $('.tt').click(function(){
    var id_cliente = $(this).val();//el id del cliente esta cargado en el boton
    var contador= $(this).attr("name");
    //alert('Contador = '+contador);		
    var url = "/eventos/cliente/update/"+id_cliente+""; 
    $.get(url, function (data) {
            //success data
            console.log(data);
            $('#id').val(data.id);
            $('#dni').val(data.cli_dni);
            $('#nombre').val(data.cli_nombre);
            $('#apellido').val(data.cli_apellido);
            $('#telefono').val(data.cli_telefono);
            $('#mail').val(data.cli_mail);
            $('#contador2').val(contador);

            $('.btn-confirmar').val('update');
            $('#titulo').text('Actualizar Cliente');
            $('#myModal2').modal('show');
            }) 
    });
    


	//BUSQUEDA DE CLIENTES POR NOMBRE Y APELLIDO
    $(".btn-buscar-cli").click(function (e) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
		 e.preventDefault();
		var boton = $(this).attr("name");
		
		if (boton == 'todo') //traer todo
		{
			var formData = 
			{
				busqueda: 'todo',
			}
			var parte_eventos = $('#btn_traertodo').val();//esta variable me dice si estoy entrando de la vista Clientes o de la vista nuevo evento
		}
		else //Busqueda por nombre y apellido
		{
			var formData = 
			{
				busqueda: $('#busqueda').val(),
			}
			var parte_eventos = $('#btn_buscar').val();//esta variable me dice si estoy entrando de la vista Clientes o de la vista nuevo evento
		}

        var type = "post";
        var my_url = '/eventos/cliente/busqueda';
        
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
                $("#tabla_clientes").find("tr:gt(0)").remove();
                for(var i in data){
                    contador = contador + 1;

                    if (parte_eventos=="1") //pantalla nuevo evento  
                    {
                        var cliente =  "<tr id='cli"+data[i].id+"'>";
							cliente += "<td><h6><span class='fa fa-user' aria-hidden='true'></span></h6></td>";
							cliente += "<td><h6><button type='button' class='btn btn-primary btn-xs copiar_dni' id='datos_cli' value="+data[i].cli_dni+">"+data[i].cli_dni+"</button></h6></td>";
							cliente += "<td><h6>"+data[i].cli_nombre+" "+data[i].cli_apellido+"</h6></td>";
							cliente += "<td><h6>"+data[i].cli_telefono+"</h6></td>";
							cliente += "<td><h6>"+data[i].email+"</h6></td>";
							cliente += "<td><a href='http://localhost:8000/clientes/update/"+data[i].id+"' class='btn btn-info btn-edit'><span class='fa fa-pencil-square-o' aria-hidden='true'></span>  Editar</a></td>";
							cliente += "</td>";
							cliente += "</tr>";
                    }
                    else //pantalla clientes
                    {
                        var cliente =  "<tr id='cli"+data[i].id+"'>";
							cliente += "<td><h6><span class='fa fa-user' aria-hidden='true'></span></h6></td>";
							cliente += "<td><h6>"+data[i].cli_dni+"</h6></td>";
							cliente += "<td><h6>"+data[i].cli_nombre+" "+data[i].cli_apellido+"</h6></td>";
							cliente += "<td><h6>"+data[i].cli_telefono+"</h6></td>";
							cliente += "<td><h6>"+data[i].email+"</h6></td>";
							cliente += "<td><a href='http://localhost:8000/eventos/clientes/listar_eventos/"+data[i].id+"' class='btn btn-primary'><span class='fa fa-star' aria-hidden='true'></span>  Eventos</a></td>";
							cliente += "<td><a href='http://localhost:8000/clientes/update/"+data[i].id+"' class='btn btn-info btn-edit'><span class='fa fa-pencil-square-o' aria-hidden='true'></span>  Editar</a></td>";
							cliente += "</tr>";
                    }
					$('#clientes-list').append(cliente); 
                }
                $("#paginacion").remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
	
    //ESTE BUSCAR ES PARA LA PANTALLA DE UPDATE EVENTOS
    $(".btn-buscar-cli-update").click(function (e) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
         e.preventDefault();

        var formData = 
        {
            busqueda: $('#busqueda').val(),
        }
        var type = "post";
        var my_url = '/eventos/cliente/busqueda';
        
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
                $("#tabla_clientes").find("tr:gt(0)").remove();
                for(var i in data){
                    contador = contador + 1;

                    var cliente = "<tr><td><h6>"+contador+"</h6></td><td><h6><button type='button' class='btn btn-default btn-xs copiar_dni' id='datos_cli' name="+data[i].cli_dni+" value="+data[i].id+">"+data[i].cli_dni+"</button></h6></td><td><h6>"+data[i].cli_nombre+" "+data[i].cli_apellido+"</h6></td><td><h6>"+data[i].cli_telefono+"</h6></td><td><h6>"+data[i].email+"</h6></td><input type='hidden' id='contador1' name='contador1' value='"+contador+"'><td></td></tr>";
                    $('#clientes-list').append(cliente); 
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});

