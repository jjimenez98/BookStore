/* VALIDAR STOCK */

$(document).on("submit", "#cantidadFormulario", function () {
  var cantidad = $("#cantidadAgregar").val();
  var id = $("#cantidadAgregar").attr("idCantidad");

  var datos = new FormData();

  datos.append("cantidad", cantidad);
  datos.append("id", id);

  $.ajax({
    url: url + "views/ajax/biblioteca_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta == "stock unavailable") {
        swal("¡Stock!", "¡Stock unavailable!", "warning");
      }
      if (respuesta == 0) {
        swal("¡Libro!", "¡Agregado a Carrito!", "success");
      }
    },
  });
});

/* End of VALIDAR STOCK */

/* FILTRAR POR AUTOR */

$(document).on("click", ".autoresBiblioteca", function () {
  var datos = new FormData();

  console.log($("#categoriasTable").attr("categoria"));

  datos.append("filtrarPorCategoria", $("#categoriasTable").attr("categoria"));
  datos.append("filtrarPorAutor", $(this).attr("value"));

  $.ajax({
    url: url + "views/ajax/biblioteca_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var datos = jQuery.parseJSON(respuesta);
      console.log(datos[0]);
      $(".categoriasTableBody").empty();
      $(function () {
        var content = "";
        for (var i = 0; i < datos.length; i++) {
          content += "<tr>";
          content += "<td>" + (i + 1) + "</td>";
          content +=
            "<td><a href=" +
            url +
            "biblioteca/" +
            datos[i]["ruta"] +
            "/" +
            datos[i][3] +
            ">" +
            datos[i][4] +
            "</a></td>";
          content +=
            "<td><image src= '" +
            url +
            datos[i][9] +
            "'width='100' height='80'>";

          content += `<td> ${datos[i][15]} </td>`;
          content += `<td> ${datos[i][13]} </td>`;
          content += `<td> ${datos[i][5]} </td>`;
          content += `<td> ${datos[i][6]} </td>`;
          content += "<td>" + datos[i][8] + "</td>";

          content += "</tr>";
        }
        $(".categoriasTableBody").html(content);
      });
    },
  });
});

/* End of FILTRAR POR AUTOR */

/* OBTENER ITEM DE USUARIO A CARRITO */
$(document).on("click", "#btnCarrito", function () {
  console.log("carrito btn pressionado");
  var datos = new FormData();

  datos.append("obtenerCarrito", 0);

  $.ajax({
    url: url + "views/ajax/biblioteca_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var datos = jQuery.parseJSON(respuesta);
      console.log(datos);
      $(".modal-body-carrito").empty();
      $(function () {
        var content = "";
        for (var i = 0; i < datos.length; i++) {
          content += `<div class="row">
          <div class="col">
              <div class="form-group">
                  <img src="https://via.placeholder.com/280x150" width="120" height="80">
              </div>

          </div>

          <div class="col">
              <div class="form-group">
                  <div class="row">
                      <label>Informacion:</label>
                  </div>
                  <div class="row">
                      <span>`;
          content += datos[i].id_libro;
          content += `</span>`;
          content += `</div>
          </div>
      </div>
      <div class="col-3">
          <div class="form-group">
              <div class="row">
                  <label>Cantidad:</label>
                  <input width="48" type="number" class="form-control"></input>
              </div>

          </div>
      </div>
      <div class="col">
          <button class="btn btn-eliminar v3 mt-4 ml-2">Eliminar</button>
      </div>
      </div>
      </div>`;
        }
        $(".modal-body-carrito").html(content);
      });
    },
  });
});

/* End of OBTENER ITEM DE USUARIO A CARRITO */
