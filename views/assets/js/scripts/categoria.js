//////////////////////////////
/*
      REGISTRAR CATEGORIA 
                        */
//////////////////////////////

$(document).on("submit", "#formularioCategorias", function () {
  var categoria = $("#categoria").val();
  var id_alta = $("#id_alta").val();
  let datos = new FormData();
  datos.append("categoria", categoria);
  datos.append("id_alta", id_alta);
  console.log(categoria);


  swal({
    title: "¡Categoria!",
    text: "Presiona Ok para Registrar Categoria",
    icon: "warning",
  }).then((value) => {
    if (value) {
      $.ajax({
        url: "views/ajax/categoria_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          if (respuesta == "match") {
            swal({
              title: "Categoria!",
              text: "Nueva Categoria Creada",
              icon: "success",
            }).then((value) => {
              if (value) {
                window.location = "categorias";
              }
            });
          }
          if(respuesta == "categoria existe"){
            swal({
              title: "Categoria!",
              text: "La categoria ya existe en la base de datos,  por favor ingrese otro diferente",
              icon: "error",
            });
          }
        },
      });
    }
  });

});

//////////////////////////////
/*
      VERIFICAR CATEGORIA 
                        */
//////////////////////////////

$(document).on("change", "#categoria", function () {
  console.log("vcategoria change");
  var vcategoria = $("#categoria").val();
  let datos = new FormData();
  datos.append("vcategoria", vcategoria);
  $.ajax({
    url: "views/ajax/categoria_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == "match") {
        $("#rbtnCategorias").after(`
                            
                            <div class="alert alert-warning">
        
                                    <b>ERROR:</b>
        
                                    La categoria ya existe en la base de datos,  por favor ingrese otro diferente
                            </div>
                `);
      }
    },
  });
});

//////////////////////////////
/*
  MOSTRAR INFO A EDITAR CATEGORIA 
                        */
//////////////////////////////

$(document).on("click", ".editarCategoriaButton", function () {
  var id = $(this).attr("id");
  console.log(id);
  $("#editarID").val(id);
  let datos = new FormData();
  datos.append("editarMostrarCategoria", id);
  $.ajax({
    url: "views/ajax/categoria_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      $("#editarCategoria").val(respuesta);
    },
  });
});

//////////////////////////////
/*
  VERIFICAR CATEGORIA EN EDITAR 
                        */
//////////////////////////////

$(document).on("change", "#editarCategoria", function () {
  console.log("change");
  var categoria = $("#editarCategoria").val();
  let datos = new FormData();
  datos.append("vcategoria", categoria);
  $.ajax({
    url: "views/ajax/categoria_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == "match") {
        $("#editarCategoria").after(`  
            <div class="alert alert-warning">
                <b>ERROR:</b>
                La categoria ya existe en la base de datos,  por favor ingrese otro diferente
            </div>
                        `);
      }
    },
  });
});

//////////////////////////////
/*
     ELIMINAR CATEGORIA 
                        */
//////////////////////////////

$(document).on("click", ".eliminarCategoria", function () {
  url = $(".url").val();
  var id = $(this).attr("id");
  console.log(id);
  console.log("elimiar categoria");
  let datos = new FormData();
  datos.append("eliminarCategoriaID", id);

  swal({}).then((value) => {
    if (value) {
      $.ajax({
        url: url + "views/ajax/categoria_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          location.reload();
        },
      });
    }
  });
});

//////////////////////////////
/*
     EDITAR CATEGORIA 
                        */
//////////////////////////////

$(document).on("submit", ".formularioCategoriasModal", function () {
  var categoria = $("#editarCategoria").val();
  var id = $("#editarID").val();
  let datos = new FormData();
  datos.append("editarCategoria", categoria);
  datos.append("editarID", id);
  console.log(categoria);
  console.log("fdsafdsfadsafs")

  swal({
    title: "Categoria!",
    text: "Nueva Categoria Creada",
    icon: "success",
  }).then((value) => {
    console.log("hey");
    if (value) {
      $.ajax({
        url: "views/ajax/categoria_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          console.log("hey")
          console.log(respuesta, "SUCCESS");
          if (respuesta == "ok") {
            location.reload();
          }

          if(respuesta == "categoria existe"){
            swal({
              title: "Categoria!",
              text: "La categoria ya existe en la base de datos,  por favor ingrese otro diferente",
              icon: "error",
            });
          }
        },
      });
    }
  });
});

///////////////////////////////////////
/*
  VERIFICAR ESTADO DE TABLA DE USAURIOS
                        */
///////////////////////////////////////

$(document).on("change", ".categoriaswitchEstado", function () {
  var estado = $(this).val();
  var id = $(this).attr("id");
  console.log(estado, id);
  var isChecked = $(this).is(":checked");
  var selectedData;
  var $switchLabel = $(".switch-label");
  console.log("isChecked: " + isChecked);
  var datos = new FormData();
  datos.append("categoriaEstado", isChecked);
  datos.append("id", id);

  $.ajax({
    url: "views/ajax/categoria_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);
    },
  });

  console.log("Selected data: " + selectedData);
});
