<?php 
include('search_conn.php');
$output = '';

if(isset($_POST['query'])){
    $search = $_POST['query'];
    $stmt = $conn->prepare("SELECT * FROM `place_visited` WHERE username LIKE CONCAT('%',?,'%') OR place_visited LIKE CONCAT('%',?,'%') OR date_visited LIKE CONCAT('%',?,'%')");
    $stmt->bind_param('sss', $search,$search,$search);
}
else{
    $stmt=$conn->prepare("SELECT * FROM place_visited ");
}
$stmt->execute();
$result=$stmt->get_result();
if ($result->num_rows > 0){
    $output="
        <thead>
            <tr>
                <b>
                <th>TEMP</th>
                <th>USERNAME</th>
                <th>PLACE VISITED</th>
                <th>LOCATION</th>
                <th>TIME-IN</th>
                </b>
            </tr>
        </thead>
        <tbody>";
        while ($row=$result->fetch_assoc()) {
            $output .= "
            <tr>
                <td>".$row['temperature']."</td>
                <td>".$row['username']."</td>
                <td>".$row['place_visited']."</td>
                <td>".$row['location_address']."</td>
                <td>".$row['date_visited']."</td>
            </tr>";
        }
        $output .= "</tbody>";
        echo $output;

    }
    else{
        echo "<br><h4>No Record Found</h4>";
    }

?>
