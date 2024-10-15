<script>
  $(document).ready(function () {
    // Inicializa la tabla básica con configuración adicional y soporte para lenguaje español
    $("#basic-datatables").DataTable({
      paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: true,
      responsive: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
      }
    });

    // Inicializa la tabla con filtro múltiple
    $("#multi-filter-select").DataTable({
      pageLength: 5,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
      },
      initComplete: function () {
        this.api()
          .columns()
          .every(function () {
            var column = this;
            var select = $(
              '<select class="form-select"><option value=""></option></select>'
            )
              .appendTo($(column.footer()).empty())
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      }
    });

    // Inicializa la tabla para agregar filas
    $("#add-row").DataTable({
      pageLength: 5,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
      }
    });

    // Acción para agregar una nueva fila
    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function () {
      $("#add-row")
        .dataTable()
        .fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action,
        ]);
      $("#addRowModal").modal("hide");
    });
  });
</script>

