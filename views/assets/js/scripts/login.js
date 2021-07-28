//JQuery para verficar que el email no exite en la base de datos
//respuesta = match o no-match
//match = email y contra existen en la base de datos
//no-match = no existen
// $("#email").change(function () {
//   $(".alert").remove();

//   var email = $(this).val();

//   var datos = new FormData();
//   datos.append("validarEmail", email);

//   $.ajax({
//     url: "views/ajax/login_ajax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     dataType: "json",
//     success: function (respuesta) {
//       if (respuesta == "match") {
//         $("#login-ps").after(`

// 					<div class="alert alert-warning">

// 							<b>ERROR:</b>

// 							El correo electrónico ya existe en la base de datos,  por favor ingrese otro diferente
// 					</div>
// 	    `);
//       }
//     },
//   });
// });

//JQuery para verificar que el email y contra coincida con la base de datps
//respuesta = match o no-match
//match = email existe en la base de datos
//no-match = no existe

$(document).on("submit", "#formularioLogin", () => {
  let datos = new FormData();
  var email = $("#email").val();
  var password = $("#pwd").val();
  datos.append("ingresoNombre", email);
  datos.append("ingresoPassword", password);

  $.ajax({
    url: "views/ajax/login_ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta == "no-match") {
        $("#email").val("");

        swal({
          title: "¡Error!",
          text: "Usuario contraseña no coinciden",
          icon: "error",
        });
      } else if (respuesta == "match") {
        console.log("respuesta = match");
        $("#email").val("");
        $("#pwd").val("");
        swal({
          title: "Good job!",
          text: "You clicked the button!",
          icon: "success",
        }).then((value) => {
          if (value) {
            window.location = "dashboard";
          }
        });
      }
    },
  });
});
