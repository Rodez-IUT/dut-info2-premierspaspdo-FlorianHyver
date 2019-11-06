<html>
<head>
	<meta charset="utf-8" />
	<title>all_user</title>
	<link rel="stylesheet" href="CSS.css" />
</head>
<body>
	<?php
		$host = 'localhost';
		$db   = 'my_activities';
		$user = 'root';
		$pass = 'root';
		$charset = 'utf8mb4';
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$options = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
		     $pdo = new PDO($dsn, $user, $pass, $options);
			} catch (PDOException $e) {
	     throw new PDOException($e->getMessage(), (int)$e->getCode());
		}

	?>
	<table>
		<thead>
			<td>
				ID
			</td>
			<td>
				Username
			</td>
			<td>
				Email
			</td>
			<td>
				Status
			</td>
		</thead>
	<?php
		$stmt = $pdo->query('SELECT U.id,U.username,U.email,S.name FROM users U JOIN status S ON S.id = U.status_id ORDER BY username');
		while ($row = $stmt->fetch())
		{
			echo '<tr>';
		    echo '<td>'. $row['id']. '</td>';
		    echo '<td>'. $row['username']. '</td>';
		    echo '<td>'. $row['email']. '</td>';
		    echo '<td>'. $row['name']. '</td>';
		    echo '</tr>';
		}
	?>
	</table>
</body>
</html>