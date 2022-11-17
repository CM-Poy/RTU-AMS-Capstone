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

							<td><a href="Edit-class.php"><button name="addclass" type="button" class= "btn btn-primary"><i class<i class="bi bi-pen"></i>
							
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
							</svg></button></a>
							
							<button name="delclass" type="button" class="btn btn-danger"><i
							   class="far fa-trash-alt"></i>
							
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
							</svg></button></td>
       					 </tr>
					';
				}
			}
		}
	}
?>