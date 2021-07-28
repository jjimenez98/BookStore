$(document).on("submit", "#metricosFormulario", function () {
  console.log("submit!!!!!!!");
  var fecha1 = $("#fecha1Metricos").val();
  var fecha2 = $("#fecha2Metricos").val();

  var datos = new FormData();
  datos.append("fecha1", fecha1);
  datos.append("fecha2", fecha2);

  $.ajax({
    url: url + "views/ajax/metricos_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);
    },
  });
});
