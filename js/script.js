// Buscador

const ctn_buscador = document.getElementById("ctn_buscador");
const cover_ctn_buscador = document.getElementById("cover_ctn_buscador");
const buscador = document.getElementById("buscador");
const buscador_lista = document.getElementById("buscador_lista");

buscador.addEventListener("click", mostrar_buscador);
cover_ctn_buscador.addEventListener("click", ocultar_cover);


// Función para mostrar el cover del buscador
function mostrar_buscador() {

    cover_ctn_buscador.style.display = "block";
}

// Función para ocultar el cover del buscador
function ocultar_cover() {

    cover_ctn_buscador.style.display = "none";
    buscador.value = "";
    buscador_lista.style.display = "none";
}



// Filtrado de búsqueda


document.getElementById("buscador").addEventListener("keyup", buscador_interno);

function buscador_interno() {

    let filtro = buscador.value.toUpperCase();
    let li = buscador_lista.getElementsByTagName("li");

    // Recorriendo elementos para filtrar mediante los "li"

    for (i = 0; i < li.length; i++) {

        let button = li[i].getElementsByTagName("button")[0];
        let textoValor = button.value;

        if (textoValor.toUpperCase().startsWith(filtro)) {

            li[i].style.display = "";
            buscador_lista.style.display = "block";

            if (buscador.value == "") {
                buscador_lista.style.display = "none";
            }

        } else {
            li[i].style.display = "none";
        }
    }

}



// Ventana modal publicaciones

$(document).on("click", "#btn-publicacion", function () {
    let publicacion = $(this).data("publicacion");
    let id = $(this).data("id");    // id de la publicación
    document.getElementById("modal-img-publicacion-" + id).setAttribute("src", "img/" + publicacion);

    let comentarios = $(this).data("comentarios");
    let nombre = $(this).data("nombre");
    let descrip = $(this).data("descripcion");
    let fecha = $(this).data("fecha");
    let ubicacion = $(this).data("ubicacion");

    document.getElementById("modal-ubicacion-" + id).innerHTML = ubicacion;
    document.getElementById("num-comentarios-" + id).innerHTML = comentarios;
    document.getElementById("modal-nombre-usuario-" + id).setAttribute("href", "perfil-otro.php?usuario=" + nombre);
    document.querySelector(".like").setAttribute("id", id);
    document.getElementById("modal-nombre-usuario-" + id).innerHTML = nombre;
    document.getElementById("modal-descrip-publicacion-" + id).innerHTML = descrip;
    document.getElementById("modal-fecha-publicacion-" + id).innerHTML = fecha;
});



// Funcionalidad de likes

$(document).ready(function() {
    $(".like").click(function() {
        let id = this.id;
        
        $.ajax({
            url: "./php/likes.php",
            type: "POST",
            data: {id:id},
            dataType: "text",

            success:function(data) {
                let likes = data;

                $("#likes_" + id).text(likes);
                $("#like_" + id).text(likes);
            }
        });

        if(document.getElementById(id).getAttribute("fill") == "red") {
            document.getElementById(id).setAttribute("fill", "black");
            document.getElementById("mg_"+id).setAttribute("fill", "black");
        } else {
            document.getElementById(id).setAttribute("fill", "red");
            document.getElementById("mg_"+id).setAttribute("fill", "red");
        }
    });
});


// Funcionalidad de comentarios

$(document).ready(function() {
    $(".enviar-comentario").click(function() {
        let id_publicacion = $(this).data("id-publicacion");
        let comentario = $("#nuevo_comentario_" + id_publicacion).val();
        //let num_comentarios = parseInt($(this).data("num-comentarios"));
        let num_comentarios = parseInt($("#num-comentarios-" + id_publicacion).text());
        let id_usuario = $("#id_usuario_" + id_publicacion).val();
        
        $.ajax({
            url: "./php/enviar-comentario.php",
            type: "POST",
            data: {comentario:comentario,
                id_usuario:id_usuario,
                id_publicacion:id_publicacion
            },

            success:function(response) {
                let data = JSON.parse(response);

                if(data.success) {

                    let nuevoComentarioHtml = "<div class='d-flex flex-column mb-3'>" +
                                              "<div>" +
                                              "<a href='perfil.php' class='text-dark text-decoration-none fw-bold'>" + data.nombre_usuario_comentario + ": </a>" +
                                              "<span>" + data.comentario + "</span>" +
                                              "</div>" +
                                              "<span class='ms-auto text-secondary fw-light'>" + data.fecha + "</span>" +
                                              "</div>";
                                              
                    $("#comentarios-" + id_publicacion + " .modal-body").append(nuevoComentarioHtml);
                    $("#nuevo_comentario_" + id_publicacion).val("");
                    num_comentarios += 1;
                    $("#num-comentarios-" + id_publicacion).text(num_comentarios);

                    // Actualizar el atributo data-num-comentarios del botón
                    $("#comentario").attr("data-num-comentarios", num_comentarios);
                } else {
                    alert("Error al enviar el comentario");
                }
            }
        });
    });
});