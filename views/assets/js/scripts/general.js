$(document).ready(function(){

	/*===========================================
	=            VARIABLE GLOBAL URL            =
	===========================================*/
	
	url = $(".url").val();
	
	/*=====  End of VARIABLE GLOBAL URL  ======*/

	/*==============================================
	=            INICIALIZAR DATA TABLE            =
	==============================================*/
	
	// $('.dataTable').DataTable({
	//     dom: 'Bfrtip',
	//     buttons: [
	//           'copy', 'excel', 'pdf'
	//      ],
	//     responsive: true,
	//     ordering: true
	// });
	
	/*=====  End of INICIALIZAR DATA TABLE  ======*/

	$('.editable-select').editableSelect();

});