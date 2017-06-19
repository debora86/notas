<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Notas!</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  </head>
  <body>
	<section class="top-head left" >
	 <div >
           <div class="container">
	     <div class="row">
	       <div class="col-lg-12">
	          <h1>Sistema de Notas<small></small></h1>
	       </div>
			        			
	    </div>
         </div>
	</div>
	  		
      </section>
					
    <div class="container-fluid">
	<div class="row">
	 <div class="col-md-4">
	 </div>
		<div class="col-lg-4">
			<h3 class="text-center">
				Todo
			</h3>
			
			    <form action="insert.php" method="POST" role="form">
	<legend></legend>

	<div class="form-group">
		<label for="">Ingrese Nota</label>
		<input type="text" class="form-control" name="det_nota" placeholder="Ingrese texto">
	</div>

	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>
		    
			<script>function eliminar() {
                                            var eliminar= confirm("Realmente quieres eliminar la nota?"); 
                                              return eliminar;
                                            } </script>
				
		<script>function finalizar() {
                                            var finalizar= confirm("Realmente quieres finalizar la nota?"); 
                                              return finalizar;
                                            } </script>
				<table class="table">
				<thead>
					<tr>
						
						<th>
							Notas
						</th>
						<th>
							Fecha
						</th>
						<th>
							Status
						</th>
					</tr>
				</thead>	
				<?php 
				require_once("miniOrm-master/miniOrm.php");//llamamos a la clase
				$db = miniOrm\Db::inst();// creamos el objeto
				
				$consultar=$db->consultar('*','notas',array("bool_eliminado='false'") );
                                for ($i=0; $i < count($consultar) ; $i++) {
					?>
			     
			
				<tbody>
					
					<tr class="active">
						
						<td>
						
						<?php echo $consultar[$i]['det_nota'];?>
						</td>
						<td>
						<?php echo  $consultar[$i]['fecha_crea'];?>
						</td>
						<td>
<?php if ($consultar[$i]['finalizado']==0){?>					
<a class="glyphicon glyphicon-ok" href="actualizar.php?cod=<?php echo $consultar [$i]['cod_nota'];?>" title="finalizar" onclick="return finalizar()"></a>
<?php }?>
<a href="eliminar.php?cod=<?php echo $consultar [$i]['cod_nota'];?>" class="glyphicon glyphicon-trash" title="Eliminar" onclick="return eliminar()"></a>

					</td>
					 <?php }?>
					</tr>					
				</tbody>
			</table>
	</div>
     </div>
    
  </body>
</html>
