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
	<form method="post" action="all_users.php">
	<h3>Start with a letter :</h3>
	<input type="text" name="lettre" placeholder="Tapez une lettre"/></p>
	<h3>and status is : </h3>
       	<select class="form-control" name="status">
       		<?php
       			echo '<option ';
       			if(isset($_POST["status"]) && 'Waiting for account validation' == $_POST["status"]){
        			echo ' selected';
        		}
       			echo '>Waiting for account validation</option>';
       			echo '<option ';
       			if(isset($_POST["status"]) && 'Active Account' == $_POST["status"]){
        			echo ' selected';
        		}
       			echo '>Active Account</option>';
       		?>
       	</select>
       	<input type="submit" value="OK" />
       </form>
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
		if(isset($_POST["lettre"])) {
			$lettre = $_POST["lettre"];
		} else {
			$lettre = '';
		}
		if(isset($_POST["status"])) {
			if ('Active Account' == $_POST["status"]) {
				$status_id = '2';
			} else {
				$status_id = '1';
			}
		} else {
			$status_id = '1';
		}
		
		$stmt = $pdo->query("SELECT U.id,U.username,U.email,S.name 
							 FROM users U 
							 JOIN status S 
							 ON S.id = U.status_id 
							 AND U.status_id = $status_id 
							 WHERE username LIKE '$lettre%'
							 ORDER BY username");
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