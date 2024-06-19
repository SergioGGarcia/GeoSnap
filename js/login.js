


let contenedor_login_registro = document.querySelector(".container_login_registro");
let formulario_login = document.querySelector(".formulario_login");
let formulario_registro = document.querySelector(".formulario_registro");
let caja_trasera_login = document.querySelector(".caja_trasera_login");
let caja_trasera_registro = document.querySelector(".caja_trasera_registro");

function registro() {

    formulario_registro.style.display = "block";
    contenedor_login_registro.style.left = "410px";
    formulario_login.style.display = "none";
    caja_trasera_registro.style.opacity = "0";
    caja_trasera_login.style.opacity = "1";
}

function iniciarSesion() {

    formulario_registro.style.display = "none";
    contenedor_login_registro.style.left = "10px";
    formulario_login.style.display = "block";
    caja_trasera_registro.style.opacity = "1";
    caja_trasera_login.style.opacity = "0";
}