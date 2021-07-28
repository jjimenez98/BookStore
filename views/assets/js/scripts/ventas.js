$(document).ready(function(){
    var tabla = $("#cargarTablaVentas").val();
    console.log(tabla);
    if(tabla === "si"){
        $("#tablaVentas").DataTable({
            ajax: "views/ajax/dataTables/ventas_datatable_ajax.php",
            deferRender:true,
            retrieve:true,
            processing:true,
            dom:"Bfrtip",
            buttons:["copy","csv","excel","pdf","print"],
            responsive:true,
            ordering:true,
        })
    }
})