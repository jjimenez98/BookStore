$(document).ready(function () {
  let datos = new FormData();
  datos.append("categoriasVendidas", true);

  var cargar = $("#cargarPieMetricosDashboard").val();
  console.log("metricos");

  if (cargar === "si") {
    $.ajax({
      url: "views/ajax/dashboard_ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        if (respuesta) {
            var labels = [];
            var value= [];
          var data =  jQuery.parseJSON(respuesta);
          for (var key in data){
              labels.push(Object.keys(data[key]));
              console.log(data[key]);
              value.push(data[key][Object.keys(data[key])]);
          }
          var ctx = document.getElementById("pieChartMetrico");
          var myChart = new Chart(ctx, {
            type: "pie",
            data: {
              labels: labels,
              datasets: [
                {
                  label: "# of Votes",
                  data: value,
                  backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                  ],
                  borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                  ],
                  borderWidth: 1,
                },
              ],
            },
            options: {
              scales: {
                yAxes: [
                  {
                    ticks: {
                      beginAtZero: true,
                    },
                  },
                ],
              },
            },
          });
        }
      },
    });
  }
});
