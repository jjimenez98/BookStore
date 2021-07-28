//////////////////////////////
/*
      REGISTRAR USUARIO 
                        */
//////////////////////////////

$(document).on("submit", ".formularioLibroModal", function () {
  var categoria = $("#registrarCategoriaLibro").val();
  var codigo = $("#registrarCodigoLibro").val();
  var nombre = $("#registrarNombreLibro").val();
  var autor = $("#registrarAutorLibro").val();
  var editorial = $("#registrarEditorialLibro").val();
  var precio = $("#registrarPrecioLibro").val();
  var stock = $("#registrarStockLibro").val();
  var imagen = $("#registrarImagenLibro")[0].files[0];
  var datos = new FormData();
  datos.append("registrarCategoria", categoria);
  datos.append("registrarCodigo", codigo);
  datos.append("registrarNombre", nombre);
  datos.append("registrarAutor", autor);
  datos.append("registrarEditorial", editorial);
  datos.append("registrarPrecio", precio);
  datos.append("registrarStock", stock);
  datos.append("registrarImagen", imagen);

  console.log(categoria, codigo, nombre, autor, editorial, precio, stock);

  $.ajax({
    url: "views/ajax/libro_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == "ok") {
        swal({
          title: "¡Libros!",
          text: "Libro registrado",
          icon: "success",
        }).then((value) => {
          if (value) {
            location.reload();
          }
        });
      }
      if (respuesta == "codigo ya existe") {
        swal({
          title: "¡Libros!",
          text: "Codigo ingresado ya existe",
          icon: "warning",
        });
      }
      if (respuesta == "nombre ya existe") {
        swal({
          title: "¡Libros!",
          text: "Nombre del libro en la categoria ya existe",
          icon: "warning",
        });
      }
      console.log(respuesta);
    },
  });
});

//////////////////////////////
/*  
TOGGLE MODAL DE REGISTRAR STOCK
                        */
//////////////////////////////

$(document).on("submit", ".formulariostockModal", function () {
  var stock = $("#registrarStockAgregarLibro").val();
  $("#registrarStockLibro").val(stock);
  $("#stockModal").modal("toggle"); //or  $('#IDModal').modal('hide');
});

///////////////////////////////////////
/*
  CAMBIAR ESTADO DE TABLA DE LIBROS
                                    */
///////////////////////////////////////

$(document).on("change", ".swtichLibroEstado", function () {
  var estado = $(this).val();
  var id = $(this).attr("id");
  var isChecked = $(this).is(":checked");
  var selectedData;
  var $switchLabel = $(".switch-label");
  console.log("isChecked: " + isChecked);
  var datos = new FormData();
  datos.append("estado", isChecked);
  datos.append("id", id);

  $.ajax({
    url: "views/ajax/libro_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta, "SUCCESS!!");
    },
  });

  console.log("Selected data: " + selectedData);
});

///////////////////////////////////////
/*
  MOSTRAR INFO DE EDITAR LIBROS
                                    */
///////////////////////////////////////

$(document).on("click", ".editarLibrosButton", function () {
  let id = $(this).attr("id");
  console.log(id);
  let datos = new FormData();
  datos.append("editarMostrarID", id);

  $.ajax({
    url: "views/ajax/libro_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = jQuery.parseJSON(respuesta);
      console.log(data);

      $("#editarLibrosID").val(data.id);
      $("#editarCodigoLibro").val(data.codigo);
      $("#editarNombreLibro").val(data.nombre);
      $("#editarAutorLibro").val(data.autor);
      $("#editarEditorialLibro").val(data.editorial);
      $("#editarPrecioLibro").val(data.precio);
      $("#editarStockLibro").val(data.stock);
      $("#libroEditarImagenPreview").attr("src", data.imagen);
    },
  });
});

///////////////
/*
  BORRAR LIBRO
               */
////////////////
$(document).on("click", ".eliminarLibro", function () {
  console.log("submitUsuario click");
  let datos = new FormData();
  let id = $(this).attr("id");
  // let row = $(this).parent().parent().parent().parent();
  console.log(id);
  datos.append("idLibro", id);

  swal({
    title: "¡Libro!",
    text: "Presiona Ok para Borrar Libro",
    icon: "warning",
  }).then((value) => {
    if (value) {
      $.ajax({
        url: "views/ajax/libro_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          console.log("usuario => estado : 3");
          swal({
            title: "¡Libro!",
            text: "Libro Borrado",
            icon: "success",
          }).then((value) => {
            if (value) {
              location.reload();
            }
          });
          // row.remove();
        },
      });
    }
  });
});

//////////////////////////////
/*
     EDITAR LIBRO
                        */
//////////////////////////////

$(document).on("submit", ".formularioLibroEditarModal", function () {
  let nombre = $("#editarNombreLibro").val();
  let codigo = $("#editarCodigoLibro").val();
  let autor = $("#editarAutorLibro").val();
  let editorial = $("#editarEditorialLibro").val();
  let precio = $("#editarPrecioLibro").val();
  let stock = $("#editarStockLibro").val();

  let imagen = $("#editarImagenLibro")[0].files[0];
  let id = $("#editarLibrosID").val();

  console.log(id, nombre, codigo, autor, editorial, precio, stock, imagen);

  let datos = new FormData();
  datos.append("id", id);
  datos.append("editarNombre", nombre);
  datos.append("editarCodigo", codigo);
  datos.append("editarAutor", autor);
  datos.append("editarEditorial", editorial);
  datos.append("editarPrecio", precio);
  datos.append("editarStock", stock);
  datos.append("imagen", imagen);

  swal({
    title: "¡Libros!",
    text: "Presiona ok para editar libro",
    icon: "warning",
  }).then((value) => {
    if (value) {
      $.ajax({
        url: "views/ajax/libro_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          console.log(respuesta);
          if (respuesta == "ok") {
            swal({
              title: "¡libros!",
              text: "Libro editado",
              icon: "success",
            }).then((value) => {
              if (value) {
                location.reload();
              }
            });
          }
        },
      });
    }
  });
});

/////////////////////////////////
/*
 MOSTRAR VALOR DE STOCK EN MODAL
                                 */
//////////////////////////////////

$(document).on("click", ".stockTabla", function () {
  console.log("stock pressed in table");
  var valor = $(".stockTabla").attr("value");
  var id = $(this).attr("id");
  $("#editarLibrosStockID").val(id);
  console.log(valor, " ", id);
  $("#stockLabel").html(valor);
});

////////////////////////////////
/*
 EDITAR STOCK DE STOCK MODAL
                              */
////////////////////////////////

$(document).on("submit", ".formulariostockModal", function () {
  let stock = $("#stockAgregarLibro").val();
  let id = $("#editarLibrosStockID").val();

  console.log(id, "id de usuario", stock, " -stock");

  let datos = new FormData();

  datos.append("editarStockID", id);
  datos.append("editarStockValor", stock);

  $.ajax({
    url: "views/ajax/libro_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);
      swal({
        title: "Editar!",
        text: "Usuario Editado",
        icon: "success",
      }).then((value) => {
        if (value) {
          location.reload();
        }
      });
    },
  });
});

////////////////////////////////
/*
  ONCHANGE VALIDAR CODIGO 
                              */
////////////////////////////////
$(document).on("change", ".validarCodigoLibro", function () {
  console.log("codigo validar on change");
  $(".registrarAlertaLibro").empty();
  let codigo = $(this).val();
  let datos = new FormData();
  datos.append("validarCodigo", codigo);
  $.ajax({
    url: "views/ajax/libro_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == "match") {
        $(".registrarAlertaLibro").html(function () {
          return (
            "<div class='alert alert-warning' role='alert'>" +
            "codigo del libro ya existe" +
            "</div>"
          );
        });
      }
      console.log(respuesta);
    },
  });
});

////////////////////////////////
/*
  ONCHANGE VALIDAR NOMBRE
                              */
////////////////////////////////
$(document).on("change keyup", ".validarNombreLibro, .registrarCategoriaLibro", function () {
  let nombre = $(".validarNombreLibro").val();
  let categoria = $("#registrarCategoriaLibro").val();

  if (categoria != null && nombre !=null) {

    $(".registrarAlertaLibro").empty();

    console.log("nombre validar on change; ", nombre);
    let datos = new FormData();
    datos.append("validarNombre", nombre);
    datos.append("validarCategoria", categoria);

    $.ajax({
      url: "views/ajax/libro_ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        console.log(respuesta);
        if (respuesta == "match") {
          $(".registrarAlertaLibro").html(function () {
            return (
              "<div class='alert alert-warning' role='alert'>" +
              "nombre del libro ya existe" +
              "</div>"
            );
          });
        }
      },
    });
  }
});


/////////////////////////////////////
/*
  ONCHANGE VALIDAR NOMBRE EN EDITAR
                                  */
/////////////////////////////////////
$(document).on("change keyup", ".validarNombreLibro, .registrarCategoriaLibro", function () {
  let nombre = $(".validarNombreLibro").val();
  let categoria = $("#registrarCategoriaLibro").val();

  if (categoria != null && nombre !=null) {

    $(".registrarAlertaLibro").empty();

    console.log("nombre validar on change; ", nombre);
    let datos = new FormData();
    datos.append("validarNombre", nombre);
    datos.append("validarCategoria", categoria);

    $.ajax({
      url: "views/ajax/libro_ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        console.log(respuesta);
        if (respuesta == "match") {
          $(".registrarAlertaLibro").html(function () {
            return (
              "<div class='alert alert-warning' role='alert'>" +
              "nombre del libro ya existe" +
              "</div>"
            );
          });
        }
      },
    });
  }
});
