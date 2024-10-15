// Manejo de la zona de arrastre y caída de archivos
document.querySelectorAll('.dropzone').forEach((dropzone) => {
  const input = dropzone.querySelector('.custom-file-input');
  const label = dropzone.querySelector('.custom-file-label');

  dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('dragover');
  });

  dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('dragover');
  });

  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    const files = e.dataTransfer.files;
    if (files.length) {
      input.files = files;
      label.textContent = files[0].name;

      // Llamar a la función para mostrar la imagen
      showImage(input);
    }
  });

  input.addEventListener('change', () => {
    if (input.files.length) {
      label.textContent = input.files[0].name;

      // Llamar a la función para mostrar la imagen
      showImage(input);
    }
  });
});

// Función para mostrar la imagen cargada
function showImage(input) {
  const label = input.parentElement;
  const icon = label.querySelector('i');
  let img = label.querySelector('img');

  // Si ya hay una imagen, quítala antes de añadir la nueva
  if (img) {
    img.remove();
  }

  if (input.files && input.files[0]) {
    img = document.createElement('img'); // Crear un nuevo elemento de imagen
    const reader = new FileReader();

    reader.onload = function (e) {
      img.src = e.target.result;
      img.style.display = 'block'; // Mostrar la imagen
      img.style.maxWidth = '100%'; // Asegurar que la imagen no exceda el contenedor
      img.style.height = 'auto'; // Mantener la proporción de la imagen
      icon.style.display = 'none'; // Ocultar el ícono de carga
      label.appendChild(img); // Añadir la imagen al contenedor
    };

    reader.readAsDataURL(input.files[0]);
  } else {
    icon.style.display = 'block'; // Mostrar el ícono de carga si no hay archivo
  }
}

// Asegurar que se cargue el código cuando el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
  const fileInputs = document.querySelectorAll('.image-upload input[type="file"]');

  fileInputs.forEach(input => {
    input.addEventListener('change', function () {
      showImage(input);
    });
  });
});
/*FIN CODIGO DE LOS INPUT DE SUBIDA  DE IMAGENES*/

/**CODIGO DE DESTINO */
function generarCodigo() {
  var destino = document.getElementById('nombre').value;
  var ubicacion = document.getElementById('ubicacion').value;
  var categoria = document.getElementById('id_categoria').value;

  var codigo = '';

  var destinoPartes = destino.trim().split(' ');
  var ubicacionPartes = ubicacion.trim().split(' ');

  if (destinoPartes.length >= 2) {
    var primeraParteDestino = destinoPartes[0].substring(0, 2).toUpperCase();
    var segundaParteDestino = destinoPartes[1].substring(0, 2).toUpperCase();
    codigo += primeraParteDestino + segundaParteDestino;
  } else if (destinoPartes.length === 1 && destinoPartes[0].length >= 4) {
    codigo += destinoPartes[0].substring(0, 4).toUpperCase();
  } else {
    codigo += destinoPartes[0].substring(0, 2).toUpperCase();
  }

  if (ubicacionPartes.length >= 2) {
    var primeraParteUbicacion = ubicacionPartes[0].substring(0, 2).toUpperCase();
    var segundaParteUbicacion = ubicacionPartes[1].substring(0, 2).toUpperCase();
    codigo += primeraParteUbicacion + segundaParteUbicacion;
  } else if (ubicacionPartes.length === 1 && ubicacionPartes[0].length >= 4) {
    codigo += ubicacionPartes[0].substring(0, 4).toUpperCase();
  } else {
    codigo += ubicacionPartes[0].substring(0, 2).toUpperCase();
  }

  var randomNum = Math.floor(Math.random() * 100).toString().padStart(2, '0');
  codigo += randomNum;

  document.getElementById('codigo').value = codigo;
}
/**FIN CODIGO DE DESTINO */


/****Codigo de categorias */
function generarCodigoCategoria() {
  var nombre = document.getElementById('nombre_categoria').value.trim();
  var codigo = 'CA';

  if (nombre) {
    var palabras = nombre.split(' ');
    if (palabras.length > 1) {
      var parte1 = palabras[0].substring(0, 2).toUpperCase();
      var parte2 = palabras[1].substring(0, 2).toUpperCase();
      codigo += parte1 + parte2;
    } else {
      var parte = nombre.substring(0, 4).toUpperCase();
      codigo += parte;
    }
  }

  if (codigo.length > 6) {
    codigo = codigo.substring(0, 6);
  }

  document.getElementById('cod_categoria').value = codigo;
}

/****FIN Codigo de categorias */


/**Mostrar Formulario de actualizar Categoria */
function mostrarFormularioActualizar(id, codigo, nombre, descripcion) {
  document.getElementById('id_categoria_act').value = id;
  document.getElementById('cod_categoria_act').value = codigo;
  document.getElementById('nombre_categoria_act').value = nombre;
  document.getElementById('descripcion_categoria_act').value = descripcion;
  document.getElementById('form_registrar').style.display = 'none';
  document.getElementById('form_actualizar').style.display = 'block';
}

function ocultarFormularioActualizar() {
  document.getElementById('form_registrar').style.display = 'block';
  document.getElementById('form_actualizar').style.display = 'none';
}


/**FIN Formulario de actualizar Categoria  */
console.log("Hola amigutos ")


