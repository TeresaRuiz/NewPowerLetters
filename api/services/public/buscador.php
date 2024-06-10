<?php

// Se incluye la clase del modelo.
require_once('../../models/data/comentario_data_public.php');

if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'LibroData' para interactuar con los datos relacionados con 'comentarios'.
    $comentariop = new ComentarioDataPublic;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null, // Excepción del servidor de base de datos si es aplicable.
        'fileStatus' => null,
        'cliente' => 0,
        'detalle' => 0,
        'libro' => 0
    ); // Estado de archivo (si es necesario para alguna operación).

    // Verificar si el usuario tiene una sesión iniciada como administrador.

    if (isset($_SESSION['idUsuario'])) {
        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {

            if ($_POST["buscar"] == '1') {

                $query ="SELECT * FROM articulos WHERE nombre != '' ";
                
                if ($_POST["color"] != 'Todos')
                
                $query = "AND color = '".$_POST["color"]."' ";
                
                if ($_POST["modelo"] != 'Todos') {
                
                }
                
                $query = "AND modelo = '".$_POST["modelo"]."'";
                
                if ($_POST["precio"] != 'Todos'){
                
                $query = "ORDER BY precio ".$_POST["precio"]."";
                
                 }
            }
                



        }
    }
}




while($row = $result->fetch_assoc()) {
    echo '
    <div id="mi_div" class="col-4">
        <div class="card shadow-sm">
            <img src="img/'.$row["img"].'.jpg">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-text">'.$row["nombre"].' '.$row["color"].' '.$row["modelo"].'</p>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Detalles</button>
                        <button id="al_carro" type="submit" class="btn btn-sm btn-outline-secondary">Añadir al carrito</button>
                    </div>
                </div>
                <small class="text-muted">'.$row["precio"].'€</small>
            </div>
        </div>
    </div>';
}
}
