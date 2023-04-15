import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

//se aplicara todo lo creado para estre dropzone a la etiqueta con id dropzone
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aqui tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //se ejecutara una vez se cree dropzone
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            //trim elimina espacios en blanco
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

// -- EVENTOS PARA DEBUGGEAR
//on para adjuntar un controlador de eventos que se ejecutara cuando se envie un archivo
//   xhr : representa un objeto que es una API que proporciona una forma de interactuar con servidores a traves de JS
//   formData : contiene datos que se envian junto al archivo
dropzone.on("sending", function (file, xhr, formData) {
    console.log(file);
});

dropzone.on("success", function (file, response) {
    // esta respuesta es la que obtenemos del controlador
    console.log("response: ", response);
    console.log("imagen: ", response.Imagen);
    //darle el valor a la etiqueta del input de imagen
    document.querySelector('[name="imagen"]').value = response.Imagen;
});

dropzone.on("error", function (file, message) {
    console.log("message error: ", message);
});

dropzone.on("removedfile", function () {
    console.log("Archivo eliminado");
    document.querySelector('[name="imagen"]').value = "";
});
