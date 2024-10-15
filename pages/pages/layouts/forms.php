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
</script>