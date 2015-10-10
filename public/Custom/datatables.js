$(document).ready( function () {
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
                    }, 
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
    	});
} );