function previewImages(input) {
    const previewContainer = document.getElementById('preview');
    previewContainer.innerHTML = ""; // Limpiar las vistas previas anteriores

    if (input.files.length > 3) {
        alert("Solo puedes subir hasta 3 imágenes.");
        input.value = ""; // Limpiar la selección
        document.querySelector('.custom-file-label').innerText = "Elegir archivos";
        return;
    }

    let fileNames = Array.from(input.files).map(file => file.name).join(', ');
    document.querySelector('.custom-file-label').innerText = fileNames;

    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            previewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
}

document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    previewImages(e.target);
});