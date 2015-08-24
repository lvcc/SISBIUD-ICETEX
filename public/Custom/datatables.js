$(document).ready( function () {
    if($('.table').length > 0)
    	$('.table').DataTable( {
    		"oLanguage": {
    			 "sInfoEmpty": "No hay datos",
    			 "sSearch": "Filtrar Resultados",
    			 "sZeroRecords": "No hay datos",
    			 "oPaginate": {
       				 "sPrevious": "Anterior",
       				 "sNext": "Siguiente",
       				 "sLast": "Ultima",
       				 "sFirst": "Primera"
      			 },
      			 "sInfo":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      			 "sLengthMenu":"Mostrar _MENU_ registros"
    		}
    	});
} );