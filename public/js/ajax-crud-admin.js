$(document).ready(function(){

    $('.copiar_empresa').click(function(){ //permite pasar los datos del cliente al formulario
        var id_empresa = $(this).val();
    	var empresa_nombre = $(this).parents("tr").find("h6")[2].innerHTML;
		var fecha_desde = $(this).parents("tr").find("h6")[7].innerHTML;
		var fecha_hasta = $(this).parents("tr").find("h6")[8].innerHTML;
		var email = $(this).parents("tr").find("h6")[5].innerHTML;
		var pago_id = $(this).parents("tr").find("h6")[1].innerHTML;
		
        $('#empresa_nombre').val(empresa_nombre);
        $('#empresa_id').val(id_empresa);
		$('#empresa_id_2').val(id_empresa);
        $('#fecha_desde_no').val(fecha_desde);
		$('#fecha_hasta_no').val(fecha_hasta);
		$('#email').val(email);
		$('#email_2').val(email);
		$('#pago_id').val(pago_id);
		$('#pago_id_2').val(pago_id);
		
		
		$('#boton_caducar_seleccionado').attr("disabled", false);
		$('#boton_confirmar_pago').attr("disabled", false);
		
    	});









		
});



