//////////////////////////////
/*
      BORRAR USUARIO 
                        */
//////////////////////////////

$(document).on("click", ".submitUsuario", function () {
  console.log("submitUsuario click");
  let datos = new FormData();
  let id = $(this).attr("id");
  let row = $(this).parent().parent().parent().parent();
  console.log(id);
  datos.append("idUsuario", id);

  swal({
    title: "¡Registro!",
    text: "Presiona Ok para Borrar Usuario",
    icon: "success",
  }).then((value) => {
    if (value) {
      $.ajax({
        url: "views/ajax/usuario_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          console.log("usuario => estado : 3");
          row.remove();
        },
      });
    }
  });
});

//////////////////////////////
/*
      REGISTRAR USUARIO 
                        */
//////////////////////////////

$(document).on("submit", ".formularioUsuario", function () {
  let nombre = $("#registrarNombre").val();
  let codigo = $("#registrarCodigo").val();
  let nacimiento = $("#registrarNacimiento").val();
  let nivel = $("#registrarNivel").val();
  let estado = 0;
  let idalta = $("#registrarIdalta").val();
  let correo = $("#registrarCorreo").val();
  let imagen = $("#registrarImagen")[0].files[0];
  let contraseña = $("#registrarContraseña").val();
  let ccontraseña = $("#registrarCContraseña").val();

  console.log(idalta);
  let datos = new FormData();

  datos.append("registrarNombre", nombre);
  datos.append("registrarNacimiento", nacimiento);
  datos.append("registrarNivel", nivel);
  datos.append("registrarEstado", estado);
  datos.append("registrarIdalta", idalta);
  datos.append("registrarCorreo", correo);
  datos.append("registrarCodigo", codigo);
  datos.append("registrarImagen", imagen);
  datos.append("registrarContraseña", contraseña);
  datos.append("registrarCContraseña", ccontraseña);
  swal({
    title: "Registro!",
    text: "Presiona Ok para crear nuevo Usuario",
    icon: "warning",
  }).then((value) => {
    if (value) {
      $.ajax({
        url: "views/ajax/usuario_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          swal({
            title: "Registro!",
            text: "Nuevo Usuario Creado",
            icon: "success",
          }).then((value) => {
            if(value){
              window.location = "usuarios";
            }
          });
        },
      });
    }
  });
});

//////////////////////////////
/*
  MOSTRAR INFO DE EDITAR USUARIO 
                        */
//////////////////////////////

$(document).on("click", ".editarbutton", function () {
  let id = $(this).attr("id");
  console.log(id);
  let datos = new FormData();
  datos.append("editarMostrarID", id);

  $.ajax({
    url: "views/ajax/usuario_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = jQuery.parseJSON(respuesta);
      console.log(data.imagen);

      $("#editarID").val(data.id);
      $("#editarNombre").val(data.nombre_completo);
      $("#editarCodigo").val(data["codigo"]);
      $("#editarNacimiento").val(data.fecha_nacimiento);
      $("#editarNivel").val(data.nivel);
      $("#editarCorreo").val(data.correo);
      // $("#editarImagen").val(data.imagen);
      $("#editarImagenPreview").attr("src", data.imagen);
    },
  });
});

//////////////////////////////
/*
      EDITAR USUARIO
                        */
//////////////////////////////

$(document).on("submit", ".formularioEditarUsuario", function () {
  let nombre = $("#editarNombre").val();
  let codigo = $("#editarCodigo").val();
  let nacimiento = $("#editarNacimiento").val();
  let nivel = $("#editarNivel").val();
  let estado = $("#editarEstado").val();
  let idalta = $("#editarIdalta").val();
  let correo = $("#editarCorreo").val();
  let imagen = $("#editarImagen")[0].files[0];
  let id = $("#editarID").val();
  let contrasena = $("#editarContraseña").val();
  console.log(id, "id de usuario");

  let datos = new FormData();
  datos.append("editarNombre", nombre);
  datos.append("editarNacimiento", nacimiento);
  datos.append("editarNivel", nivel);
  datos.append("editarEstado", estado);
  datos.append("editarCorreo", correo);
  datos.append("editarCodigo", codigo);
  datos.append("editarImagen", imagen);
  datos.append("editarID", id);
  datos.append("editarContraseña", contrasena);

  $.ajax({
    url: "views/ajax/usuario_ajax.php",
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
        if(value){
          window.location= "usuarios";
        }
      });
    },
  });
});

//////////////////////////////
/*
  VERIFICAR CONTRA DE REGISTRO
                        */
//////////////////////////////


$(document).on("change", ".contrasena", function () {
  var contra = $("#registrarContraseña").val();
  var verificarcontra = $("#registrarCContraseña").val();
  console.log("cambio", contra, verificarcontra);
  if (verificarcontra == "" && verificarcontra != contra) {
    $(".contrasenaMessage").html(function () {
      return (
        "<div class='alert alert-danger' role='alert'>" +
        "contraseñas no coinciden" +
        "</div>"
      );
    });
  } else if (verificarcontra == "" && contra == "") {
    $(".contrasenaMessage").html(function () {
      return "<div class='no-message'></div>";
    });
  } else if (verificarcontra !== contra) {
    $(".contrasenaMessage").html(function () {
      return (
        "<div class='alert alert-danger' role='alert'>" +
        "contraseñas no coinciden" +
        "</div>"
      );
    });
  } else if (verificarcontra == contra) {
    $(".contrasenaMessage").html(function () {
      return (
        "<div class='alert alert-success' role='alert'>" +
        "contraseñas coinciden" +
        "</div>"
      );
    });
  } else {
    $(".contrasenaMessage").html(function () {
      return "<div></div>";
    });
  }
});


//////////////////////////////
/*
  VERIFICAR CONTRA DE EDITAR
                        */
//////////////////////////////




$(document).on("change", ".editarcontrasena", function () {
  var contra = $("#editarContraseña").val();
  var verificarcontra = $("#editarCContraseña").val();
  console.log("cambio", contra, verificarcontra);
  if (verificarcontra == "" && verificarcontra != contra) {
    $(".editarcontrasenaMessage").html(function () {
      return (
        "<div class='alert alert-danger' role='alert'>" +
        "contraseñas no coinciden" +
        "</div>"
      );
    });
  } else if (verificarcontra == "" && contra == "") {
    $(".editarcontrasenaMessage").html(function () {
      return "<div class='no-message'></div>";
    });
  } else if (verificarcontra !== contra) {
    $(".editarcontrasenaMessage").html(function () {
      return (
        "<div class='alert alert-danger' role='alert'>" +
        "contraseñas no coinciden" +
        "</div>"
      );
    });
  } else if (verificarcontra == contra) {
    $(".editarcontrasenaMessage").html(function () {
      return (
        "<div class='alert alert-success' role='alert'>" +
        "contraseñas coinciden" +
        "</div>"
      );
    });
  } else {
    $(".editarcontrasenaMessage").html(function () {
      return "<div></div>";
    });
  }
});


//////////////////////////////
/*
  VERIFICAR CORREO DE REGISTRO
                        */
//////////////////////////////
// JQuery para verficar que el email no exite en la base de datos
// respuesta = match o no-match
// match = email y contra existen en la base de datos
// no-match = no existen
$(document).on("change", "#registrarCorreo", function () {
  $(".alert").remove();

  console.log("correo onchange");

  var email = $(this).val();

  var datos = new FormData();
  datos.append("validarEmail", email);

  $.ajax({
    url: "views/ajax/usuario_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == "match") {
        $("#registrarCorreo").after(`
					
					<div class="alert alert-warning">

							<b>ERROR:</b>

							El correo electrónico ya existe en la base de datos,  por favor ingrese otro diferente
					</div>
	    `);
      }
    },
  });
});

///////////////////////////////////////
/*
  CAMBIAR ESTADO DE TABLA DE USAURIOS
                        */
///////////////////////////////////////


$(document).on("change", ".switchEstado", function () {
  var estado = $(this).val();
  var id = $(this).attr("id");
  console.log(estado, id);
  var isChecked = $(this).is(":checked");
  var selectedData;
  var $switchLabel = $(".switch-label");
  console.log("isChecked: " + isChecked);
  var datos = new FormData();
  datos.append("estado", isChecked);
  datos.append("id", id);

  $.ajax({
    url: "views/ajax/usuario_ajax.php",
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
