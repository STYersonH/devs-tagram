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
});

dropzone.on("error", function (file, message) {
    console.log("message error: ", message);
});

dropzone.on("removedfile", function () {
    console.log("Archivo eliminado");
});
