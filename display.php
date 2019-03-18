<?php
/**
 * Created by PhpStorm.
 * User: Black
 * Date: 3/18/2019
 * Time: 11:52 PM
 */
echo "<link rel='stylesheet' type='text/css' href='table.css' />";
include "conn.php";
echo "<h3>All Students</h3>";
$tbHeader = "<tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Birth Date</th>
                <th>Address</th>
                <th>Photo</th>
            </tr>";
$tbBody = '';
$sql = "SELECT *FROM student";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tbBody .= "<tr>
                        <td>".$row['studentId']."</td>
                        <td>".$row['studentName']."</td>
                        <td>".$row['bithDate']."</td>
                        <td>".$row['address']."</td>
                        <td><img src='".$row['photoName']."'/></td>
                   </tr>";
    }
    echo "<table>".$tbHeader.$tbBody."</table>";
}
echo "<a href='create.html'>More </a>";
echo "<a href='display.php'> View</a>";