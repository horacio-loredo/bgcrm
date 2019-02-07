<?php
session_start();
if ( isset( $_SESSION[ 'INGRESO' ] ) && $_SESSION[ 'INGRESO' ] == 'YES' || $_SESSION[ 'rol' ] == 1 ) {
  ?>
  <!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link href="../media/pace/themes/pace-theme-minimal.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../media/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../media/open-iconic-master/font/css/open-iconic.min.css" >
    <link rel="stylesheet" href="../media/datatables.min.css">

    <title>BGCRM</title>
  </head>
  <body style="height:1060px">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <a class="navbar-brand" ><font face="Agency FB"><strong style="color: slategray"><b>B<strong style="color:#2282C7"><b>G</b></strong>CRM</b>
      </strong>
    </font></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <a class="nav-link" id=""># Llamadas:<span class="sr-only">(current)</span></a>
        <a class="nav-link" id="num_llamadas"><span class="sr-only">(current)</span></a>

        <a class="nav-link" id=""># Clientes:<span class="sr-only">(current)</span></a>
        <a class="nav-link" id="clientes_contac"><span class="sr-only">(current)</span></a>


        <a class="nav-link" ># Llamadas Productivas:<span class="sr-only">(current)</span></a>
        <a class="nav-link" id="llamada_pro"></a>


        <a class="nav-link" >Campaña: <span class="sr-only">(current)</span></a>
        <a class="nav-link" ><?php echo $_SESSION['nom_camp'];?><span class="sr-only">(current)</span></a>
        <a class="nav-link" style="color: #000000"> MANUAL</a>




      </ul>
      <form class="form-inline my-2 my-lg-0">
        <a href="http://172.18.55.26/biggestioncrm/vista_atm/convenios.php" class="navbar-brand" >
          <?php echo $_SESSION['NOMBRES']." ".$_SESSION['APELLIDOS'];?>
          <input type="hidden" id="usuario_sac" value="">
          <input type="hidden" id="extension" value="<?php echo $_SESSION['EXTENSION'];?>">
          <input type="hidden" id="ced_agente" value="<?php echo $_SESSION['EXTENSION'];?>">
          <input type="hidden" value="2" id="tipo_llamada">
        </a>
        <a href="#" onClick="cerrar();" ><span class="oi" data-glyph="account-login"></span> Salir</a>
      </form>
    </div>
  </nav>

  <br>
  <br>
  <br>


  <br>
  <div class="container-fluid">
    <div class="row">

     <!-- ---------------------------------------------bloque 1---------------------------------------------- -->
     <div class="col-sm-3 mb-2">
      <div class="card border-primary bm-6">
       <div class="card-header border-primary">Busqueda</div>
       <div class="card-body">
        <form id="formbuscar" action method="post" class="input-group">
          <input id="cedula" type="text" class="form-control form-control-lg" placeholder="Ingresar Cedula" aria-label="Ingresar Cedula" aria-describedby="button-addon4">
          <div class="input-group-append" id="button-addon4">
            <button id="buscar" type="submit" class="btn btn-primary" type="button">Buscar</button>
            <button class="btn btn-danger" id="finalizar" type="button">Finalizar</button>
          </div>
        </form>
        <br>
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Datos
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
               <div class="row">
                <div class="col-12 mb-2">
                 <input type="text" class="form-control form-control-lg" id="nombre_cli" placeholder="Nombres y Apellidos">
               </div>
               <div class="col-12 mb-2">
                 <input type="text" class="form-control form-control-lg" id="cedula_cli" placeholder="Cedula">
               </div>
               <div class="col-12 mb-2">
                 <input type="text" class="update1 form-control form-control-lg" id="correo" data-column="CORREO_ELECTRONICO" placeholder="Correo">
               </div>



             </div>

           </div>
         </div>
       </div>
       <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Informacion
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
           <div class="table-responsive">
            <table id="multas_atm" class="table table-hover">
              <thead>
                <tr>
                  <th>ID_CEDULA</th>
                  <th>SALDO</th>
                  <th>DIAS_MORA</th>
                  <th>PLACA_VEHICULO</th>
                  <th>DESCRIPCION_INFRACION</th>
                </tr>
              </thead>
              <tbody>
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Speech
          </button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
          Anim pariatur cliche reprehende 
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- -----------------------------------------------fin bloque 1--------------------------------------------- -->


<!-- ------------------------------------bloque 2--------------------------------------------------------------- -->
<div class="col-sm-4 mb-2">
  <div class="card border-primary bm-6">
    <div class="card-header border-primary">Contacto</div>
    <div class="card-body">

      <div class="table-responsive">
        <div align="right">
         <button type="button" name="add" id="add" class="btn btn-primary">Nuevo</button>
       </div>
       <table id="tabla_numeros" class="table table-hover">
        <thead>
          <tr>
            <th>NÚMERO</th>
            <th>CONTACTO</th>
            <th>PROPIETARIO</th>
            <th>NOMBRE</th>
            <th>EDITAR</th>
          </tr>
        </thead>

      </table>
      <datalist id="listaC">
        <option value="TITULAR">
          <option value="TERCERO">
            <option value="EQUIVOCADO">
              <option value="NO CONTACTADO">
              </datalist>

              <datalist id="listaP">
                <option value="FAMILIAR">
                  <option value="PADRES">
                    <option value="HIJOS">
                      <option value="VECINOS">
                      </datalist>
                    </div>
                  </div>
                </div>
              </div>


              <!-- -------------------------------------------fin bloque 2----------------------------------------------- -->
              <!-- -------------------------------------------------------bloque 4------------------------------------------- -->
              <div class="col-sm-5 mb-2">
                <div class="card border-primary bm-6">
                  <div class="card-header border-primary">Gestión</div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <input type="text" class="form-control form-control-lg" id="ing_num" placeholder="Celular">
                        <label for="">TIPO DE GESTIÓN</label>
                        <select class="custom-select" id='nivel1'>
                         <OPTION value="0">Seleccionar</OPTION>
                       </select>

                       <label for="">CONTACTABILIDAD</label>
                       <select class="custom-select" id='nivel2'>
                        <option selected value="0">Seleccionar</option>
                      </select>
                      <label for="">SEG CALLTYPE</label>

                      <select class="custom-select" id='nivel3'>
                        <option selected value="0">Seleccionar</option>
                      </select>
                      <label for="">CALLTYPE</label>
                      <select class="custom-select" id='nivel4'>

                        <option selected value="0">Seleccionar</option>
                      </select>
                      <label for="">MOTIVO ATRASO</label>
                      <select class="custom-select" id='nivel5'>

                        <option selected value="0">Seleccionar</option>
                      </select>
                    </div>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-5">
                          <input type="date" class="form-control mb-2" id="fecha_pago">
                        </div>
                        <div class="col-3">
                          <input type="text" class="form-control mb-2" onkeypress="return numeros_cel_cuenta(event)" id="num_cuenta" placeholder="#Cuenta">
                        </div>
                        <div class="col-4">
                          <input type="text" class="form-control mb-2" id="valor_pagar" onkeypress="return valor_pagar(event)" placeholder="Valor a Pagar">
                        </div>
                        <div class="col-12">
                          <textarea id="inputlg" class="form-control mb-2" cols="10" rows="10" style="text-transform: uppercase;"></textarea>
                          <div id="contador1">

                          </div>
                        </div>
                        <div class="col-12">
                          <button type="button" id="guardar_datos_atm" class="btn btn-primary">Guardar</button>
                        </div>
                      </div>
                    </div>

                  </div>

        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a> -->
        </div>
      </div>
    </div>

    <!-- --------------------------------------------------fin bloque 4-------------------------------------------- -->
  </div>

  <div class="row">
   <!-- --------------------------------------------------- bloque 3---------------------------------- -->
   <div class="col-sm-12 mb-2">
    <div class="card border-primary bm-6">
      <div class="card-header border-primary">Historial</div>
      <div class="card-body">
       <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Historial Agente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Historial IVR</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="table-responsive">
            <table id="tabla_historial_atm" class="table table-hover">
              <thead>
                <tr>
                  <th>USUARIO</th>
                  <th>FECHA GESTIÓN</th>
                  <th>NUMERO_GESTION</th>
                  <th>RESPUESTA_OBTENIDA</th>
                  <th>COMENTARIOS_GESTIONO</th>
                  <th>MOTIVO_NO_PAGO</th>
                </tr>
              </thead>
              <tbody>
              </tbody>


            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="table-responsive">
            <div align="right">
              <button type="button" id="ivr" class="btn btn-primary">Historial</button>
            </div>

            <table id="tabla_historial_atm_ivr" class="table table-hover">
              <thead>
                <tr>
                  <th>COD. CAM.</th>
                  <th>EXT</th>
                  <th>TELEFONO</th>
                  <th>NOMBRE</th>
                  <th>CEDULA</th>
                  <th>O.</th>
                  <th>FECHA VARIABLE</th>
                  <th>DIAS</th>
                  <th>VALOR</th>
                  <th>C.</th>
                  <th>C/NC</th>
                  <th>FECHA LLAMADA</th>
                  <th>T. TOTAL(S)</th>
                  <th>TIEMPO HABLADO</th>
                  <th>ESTADO</th>
                </tr>
              </thead>
              <tbody>
              </tbody>



            </table>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
<!-- ----------------------------------------------------fin bloque 3-------------------------------------------- -->



</div>
</div>
<footer class="container-fluid text-center">
  <p style="font-family: aclonica">Copyright © 2018 | J3RRY Todos los derechos reservados. </p>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../media/jquery-3.3.1.slim.min.js" ></script>
<script src="../media/popper.min.js" ></script>
<script src="../media/js/bootstrap.min.js" ></script>
<script src="../media/datatables.min.js"></script>
<script src="../media/pace/pace.js"></script>
<script src="../procesos_js/atm/tabla_numero.js"></script>
<script src="../procesos_js/atm/select_opcion.js"></script>
<script src="../procesos_js/atm/tabla_info_cliente.js"></script>
<script src="../procesos_js/atm/actualizar_correo.js"></script>
<script src="../procesos_js/atm/funcion_copiar.js"></script>
<script src="../procesos_js/atm/contador_caracteres.js"></script>
<script src="../procesos_js/atm/teclado.js"></script>
<script src="../procesos_js/atm/guardar_datos.js"></script>

<script type="text/javascript">
  $( "#finalizar" ).click( function () {
    $( '#cedula' ).val( "" );
    $( '#nombre_cli' ).val( "" );
    $( '#cedula_cli' ).val( "" );
    $( '#nivel1' ).val( "TIPO DE GESTIÓN" );
    $( '#nivel2' ).val( "CONTACTABILIDAD" );
    $( '#nivel3' ).val( "SEG CALLTYPE" );
    $( '#nivel4' ).val( "CALLTYPE" );
    $( '#nivel5' ).val( "MOTIVO ATRASO" );
    $( '#fecha_pago' ).val( "" );
    $( '#valor_pagar' ).val( "" );
    $( '#inputlg' ).val( "" );
    $( '#ing_num' ).val( "" );
    $( '#correo' ).val( "" );
    $( '#multas_atm' ).dataTable().fnClearTable();
    $( '#tabla_numeros' ).dataTable().fnClearTable();
    $( '#tabla_historial_atm' ).dataTable().fnClearTable();
    $( '#tabla_historial_atm_ivr' ).dataTable().fnClearTable();
    $(':input:visible:enabled:first').focus();
  } );

  $("document").ready(function(){
    $("#nivel1").load("../includes/nivel1.php");
  })
</script>
<script>
  function cerrar() {
    $.ajax( {
      url: '../Controllers/atmcontroller.php',
      type: 'POST',
      data: "boton=cerrar"
    } ).done( function ( resp ) {

      location.href = 'login.php';
    } );
  }
</script>

</body>
</html>
<?php

} else {
  header( "location: login.php" );
}
?>