<?php
include('includes/header.php'); 
require('includes/config.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title>Checkbox Table</title>
</head>
<body>
    <form method="POST" action="process.php">
        <table>
            <tr>
                <th>Option</th>
                <th>Data 1</th>
                <th>Data 2</th>
                <th>Data 3</th>
                <th>Selection</th>
            </tr>
            <?php
            // Assuming you have a database connection established

            // Retrieve data from the database
            $query = "SELECT * FROM your_table";
            $result = mysqli_query($connection, $query);

            // Loop through the database results and create table rows
            while ($row = mysqli_fetch_assoc($result)) {
                $option = $row['option'];
                $data1 = $row['data1'];
                $data2 = $row['data2'];
                $data3 = $row['data3'];

                echo "<tr>";
                echo "<td>$option</td>";
                echo "<td>$data1</td>";
                echo "<td>$data2</td>";
                echo "<td>$data3</td>";
                echo "<td>";
                echo "<input type=\"checkbox\" name=\"selection[$option][]\" value=\"checkbox1\">";
                echo "<input type=\"checkbox\" name=\"selection[$option][]\" value=\"checkbox2\">";
                echo "<input type=\"checkbox\" name=\"selection[$option][]\" value=\"checkbox3\">";
                echo "</td>";
                echo "</tr>";
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </table>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>