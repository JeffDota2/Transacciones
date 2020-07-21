<?php


	$conexion=mysqli_connect('localhost','root','','tarea');

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Transacciones</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<body>

<br>

<table class="table table-striped table-dark">
<thead>
		<tr>
			<td>Nro_cuenta</td>
			<td>Cedula</td>
			<td>Saldo</td>
        </tr>
</thead>

		<?php 
		$sql="SELECT * from cuentas";
		$result=mysqli_query($conexion,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>

		<tr>
			<td><?php echo $mostrar['nro_cuenta'] ?></td>
			<td><?php echo $mostrar['cedula'] ?></td>
			<td><?php echo $mostrar['saldo'] ?></td>
		</tr>
	<?php 
	}
	 ?>
<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=tarea', 'root', '', 
        array(PDO::ATTR_PERSISTENT => true));
    echo "Transaccion Exitosa";
  } catch (Exception $e) {
    die("Transaccion Fallida: " . $e->getMessage());
  }

try {  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $db->beginTransaction();
    $db->exec("UPDATE  cuentas set saldo= saldo - 50 where nro_cuenta  = '1111' ");
    echo $db->inTransaction();
    $db->exec("UPDATE  cuentas set saldo= saldo + 50 where nro_cuenta  = '222' ");
    $db->commit();
    
  } catch (Exception $e) {
    $db->rollBack();
    echo "Fallo: " . $e->getMessage();
  }

?>
</body>
</html>

