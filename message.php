<!-- Created By CampCodes -->
<!-- Trducido y Editado por Tanitoadri -->
<?php
header('Content-Type: text/html; charset=utf-8');

// conexion base de datos
$conn = mysqli_connect("HOST", "USUARIO", "CONTRASENA", "NOMBRE_BD") or die("Database Error");
mysqli_set_charset($conn, 'utf8');

// Para evitar problemas con "ñ" y tilde, poner cotejamiento en utf-8-spanish-ci

// obtener el mensaje del usuario a traves de ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

//comprobando la consulta del usuario a la consulta de la base de datos
$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$check_data_web = "SELECT web FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");
$run_query_web = mysqli_query($conn, $check_data_web) or die("Error");

// si la consulta del usuario coincide con la consulta de la base de datos, mostraremos la respuesta
// de lo contrario, ira a otra declaracion
if(mysqli_num_rows($run_query) > 0){
    //obteniendo la respuesta de la base de datos de acuerdo con la consulta del usuario
    $fetch_data = mysqli_fetch_assoc($run_query);
    //almacenando la respuesta a una variable que enviaremos a ajax
    $replay = $fetch_data['replies'];
    echo $replay;

//si hay algo en web, lo incluye en el mensaje
if(mysqli_num_rows($run_query_web) > 0){
$fetch_data_web = mysqli_fetch_assoc($run_query_web);
$replay_web = $fetch_data_web['web'];
echo  $replay_web;
}

}else{
    echo "Lo siento, no te he entendido.";
}

?>