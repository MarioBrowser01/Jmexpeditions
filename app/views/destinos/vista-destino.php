<script>
  document.addEventListener('DOMContentLoaded', function() {
    const departamentoSelect = document.getElementById('departamento');
    const provinciaSelect = document.getElementById('provincia');

    departamentoSelect.addEventListener('change', function() {
      const departamentoId = this.value;
      if (departamentoId) {
        fetch(`../../app/controller/destinos/listar-provincias.php?id_departamento=${departamentoId}`)
          .then(response => response.json())
          .then(data => {
            provinciaSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
            data.forEach(provincia => {
              provinciaSelect.innerHTML += `<option value="${provincia.id_provincia}">${provincia.nombre_provincia}</option>`;
            });
          });
      } else {
        provinciaSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
      }
    });

    document.getElementById('filtrar').addEventListener('click', function() {
      const departamento = departamentoSelect.value;
      const provincia = provinciaSelect.value;
      const categoria = document.getElementById('categoria').value;
      const ubicacion = document.getElementById('ubicacion').value;

      fetch(`../../app/controller/destinos/filtrar-destinos.php?departamento=${departamento}&provincia=${provincia}&categoria=${categoria}&ubicacion=${ubicacion}`)
        .then(response => response.json())
        .then(destinos => {
          const destinosList = document.getElementById('destinos-list');
          destinosList.innerHTML = '';

          destinos.forEach(destino => {
            destinosList.innerHTML += `
              <div class="col-md-4">
                <div class="card card-post card-round">
                  <div class="owl-carousel owl-theme owl-img-responsive">
                    ${destino.imagen1_destino ? `<img class="card-img-top" src="../../app/controller/public/uploads/${destino.imagen1_destino}" alt="Imagen de ${destino.nombre_destino}" />` : ''}
                    ${destino.imagen2_destino ? `<img class="card-img-top" src="../../app/controller/public/uploads/${destino.imagen2_destino}" alt="Imagen de ${destino.nombre_destino}" />` : ''}
                    ${destino.imagen3_destino ? `<img class="card-img-top" src="../../app/controller/public/uploads/${destino.imagen3_destino}" alt="Imagen de ${destino.nombre_destino}" />` : ''}
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="info-post">
                        <div class="card-flex">
                          <h3 class="card-title">
                            <a href="#"> ${destino.nombre_destino} </a>
                          </h3>
                          <p class="date text-muted">${destino.altitud_destino} <span>m.s.n.m</span> </p>
                        </div>
                        <p class="text-primary mb-0">
                          <span class="tag badge badge-secondary">${destino.nombre_departamento}</span>
                          <span class="text-muted">|</span>
                          <span class="tag badge badge-info">${destino.nombre_provincia}</span>
                        </p>
                      </div>
                    </div>
                    <div class="separator-solid"></div>
                    <p class="card-category text-info mb-1">
                      <a href="#">${destino.nombre_categoria}</a>
                    </p>
                    <p class="card-text text-muted">
                      ${destino.descripcion_destino}
                    </p>
                    <a href="#" class="btn m-auto btn-primary btn-md">Ver más</a>
                  </div>
                </div>
              </div>
            `;
          });

          $('.owl-carousel').owlCarousel({
            autoplaySpeed: 100,
            navSpeed: 800,
            items: 1,
            loop: true
          });
        });
    });
  });
</script>
