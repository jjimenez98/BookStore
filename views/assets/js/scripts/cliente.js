$(document).ready(function () {
  var tabla = $("#cargarTablaClientes").val();

  if (tabla === "si") {
    $("#tablaClientes").DataTable({
      ajax: "views/ajax/dataTables/cliente_datatable_ajax.php",
      deferRender: true,
      retrieve: true,
      processing: true,
      dom: "Bfrtip",
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      responsive: true,
      ordering: true,
    });
  }
});

$(document).ready(function () {
  var tabla = $("#cargarTablaClientesSingular").val();
  var id = $("#idCliente").val();
  console.log(id);

  if (tabla === "si") {
    $("#tablaClienteVentas").DataTable({
      ajax: "../views/ajax/dataTables/cliente_ventas_datatable_ajax.php?data="+id,
      deferRender: true,
      retrieve: true,
      processing: true,
      dom: "Bfrtip",
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      responsive: true,
      ordering: true,
    });
  }
  
});
