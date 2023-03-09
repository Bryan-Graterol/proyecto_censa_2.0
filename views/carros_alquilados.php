<?php
	#require_once('model.php');

	#$bd = new Model();

	#$usuario = $_GET['nombreUsuario'];

	$result = $bd->obtenerCarroAlquilado($usuario);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['delete'])) {
			$bd->eliminarCuenta($usuario);
			header('Location: index.php');
			exit;
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Carros alquilados</title>
	<style>
		body {
			background-color: rgb(200, 200, 200);
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}

		table {
			margin-top: 20px;
			border-collapse: collapse;
			width: 50%;
			background-color: white;
		}

		th, td {
			text-align: left;
			padding: 8px;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		button {
			margin-top: 20px;
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			border: none;
			cursor: pointer;
			border-radius: 4px;
		}

	</style>
</head>
<body>
	<h1>Carros alquilados por <?php echo $usuario ?></h1>

	<?php if (!empty($result)): ?>
		<table>
			<thead>
				<tr>
					<th>Modelo del carro</th>
					<th>Precio del carro</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $row): ?>
					<tr>
						<td><?php echo $row['modelo_carro']; ?></td>
						<td><?php echo $row['precio_carro']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>El usuario <?php echo $usuario; ?> no ha alquilado ningún carro.</p>
	<?php endif; ?>
    <form method="post" action="">
		<input type="hidden" name="id" value="">
		<button type="submit" name="exit">Exit</button>
		<button type="submit" name="delete">Borrar cuenta</button>
	</form>
</body>
</html>
