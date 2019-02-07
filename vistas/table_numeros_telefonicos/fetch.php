<?php

$cedula = $_POST[ 'cedula' ];
//fetch.php
$connect = mysqli_connect("172.18.55.6", "comandato", "comandato123", "TELEFONICOS_NUMEROS");
$connect -> set_charset( 'utf8' );
$columns = array('CEDULA','NUMERO', 'CONTACTO', 'PROPIETARIO', 'NOMBRE');
$cedula_SINCERO=preg_replace('/^0+/', '',$cedula);
$query = "SELECT 
    CEDULA, NUMERO, CONTACTO, PROPIETARIO, NOMBRE
FROM
    TELEFONICOS_NUMEROS.TELEFONOS
WHERE
    CEDULA = '$cedula_SINCERO' ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 and NUMERO LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY CEDULA DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div  data-numero="'. $row["NUMERO"] . '" data-id="'.$row["CEDULA"].'" data-column="NUMERO">'.'+593'. $row["NUMERO"] . '</div>';
 $sub_array[] = '<div  title="TITULAR
 TERCERO
 EQUIVOCADO
 NO CONTACTADO" ><input  data-numero="'. $row["NUMERO"] . '" id="'. $row["NUMERO"] . '" class="update form-control" data-id="'.$row["CEDULA"].'" data-column="CONTACTO" type="" value="' . $row["CONTACTO"] . '"  list="listaC"></div>';

 $sub_array[] = '<div  title="FAMILIAR
 VECINOS
 PADRES
 HIJOS"><input type="text" name="'. $row["NUMERO"] . '" data-numero="'. $row["NUMERO"] . '" class="update form-control"  data-id="'.$row["CEDULA"].'" data-column="PROPIETARIO" value="' . $row["PROPIETARIO"] . '" list="listaP"></div>';
  
 $sub_array[] = '<div  contenteditable data-numero="'. $row["NUMERO"] . '" class="update" data-id="'.$row["CEDULA"].'" data-column="NOMBRE">' . $row["NOMBRE"] . '</div>';
 $sub_array[] = '<button disabled onclick="eliminar('.$row['NUMERO'].','.$row["CEDULA"].')" type="button"  class="btn btn-danger btn-xs delete" id="eliminar">Borrar</button>&nbsp;<button type="button" id="'.$row['NUMERO'].'" onclick="agregar('.$row['NUMERO'].')" class="btn btn-primary btn-xs">Copiar #</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT 
    CEDULA, NUMERO, CONTACTO, PROPIETARIO, NOMBRE
FROM
    TELEFONICOS_NUMEROS.TELEFONOS
WHERE
    CEDULA = '$cedula_SINCERO' ";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>