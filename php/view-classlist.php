<?php
	require_once 'config.php';
	

	class classTable {
		public function viewall(){
			global $conn;
			$sql = "SELECT * from class";
			$result = $conn->prepare($sql);
			$result->execute();
			if($result->rowCount() > 0){
				while ($row = $result->fetch(PDO::FETCH_ASSOC)){
					echo '
						<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">	
						<link rel="stylesheet" href="../css/STYLE.css">
						<tr>
       						<td>'.$row["subname"].'</td>
       						<td>'.$row["subcode"].'</td>
       						<td>'.$row["day"].'</td>
       						<td>'.$row["time"].'</td>

							<td><button name="delclass" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
							<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
							</svg></button></td>
       					 </tr>
					';
				}
			}
		}
	}
?>