$(document).ready(function(){
    tablacontenedores = $("#tablacontenedores").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button><button class='btn btn-dark btnContenedor'>Ver Contenedor</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formcontenedores").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Contenedor");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    ubicacion = fila.find('td:eq(2)').text();
    
    $("#nombre").val(nombre);
    $("#ubicacion").val(ubicacion);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Contenedor");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el contenedor: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablacontenedores.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

//botón Ver Contenedor    
$(document).on("click", ".btnContenedor", function(){
    fila = $(this).closest("tr");
    nombre = fila.find('td:eq(1)').text();
    nombre = "http://localhost:8080/Smart%20Trash"+"/"+nombre+"/index.php";
    window.location.href = nombre;
});
    
$("#formcontenedores").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    ubicacion = $.trim($("#ubicacion").val());  
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, ubicacion:ubicacion, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            ubicacion = data[0].ubicacion;
            if(opcion == 1){tablacontenedores.row.add([id,nombre,ubicacion]).draw();}
            else{tablacontenedores.row(fila).data([id,nombre,ubicacion]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});