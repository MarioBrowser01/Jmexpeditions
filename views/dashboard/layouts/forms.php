<script>
    $(document).ready(function() {
        $(".btn-nuevo").on("click", function() {
            // Resetea el formulario
            $(this).closest('form')[0].reset();

            // Pone el foco en el primer campo de entrada después del reset
            $(this).closest('form').find('input:first').focus();
        });
    });
    console.log("Hola desde forms.php");

    function verificarNombreEntidad(entidad, groupId) {
        const nombreInput = document.querySelector(`#${groupId} input`);
        const nombreGroup = document.getElementById(groupId);
        const nombreError = document.querySelector(`#${groupId} .help-block`);

        const nombreEntidad = nombreInput.value;

        if (nombreEntidad.length > 0) {
            fetch(`../../app/controller/${entidad}/create.php?nombre=${encodeURIComponent(nombreEntidad)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.existe) {
                        nombreGroup.classList.add('has-error', 'has-feedback');
                        nombreError.style.display = 'block';
                    } else {
                        nombreGroup.classList.remove('has-error', 'has-feedback');
                        nombreError.style.display = 'none';
                    }
                })
                .catch(error => console.error(`Error al verificar el nombre de ${entidad}:`, error));
        } else {
            nombreGroup.classList.remove('has-error', 'has-feedback');
            nombreError.style.display = 'none';
        }
    }

   
</script>