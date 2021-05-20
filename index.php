<?php
$servername = "remotemysql.com";
$username = "jEeQTyFE0p";
$password = "u99amg6nsY";
$dbname = "jEeQTyFE0p";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$truncate_sql = "TRUNCATE TABLE `order`";
$conn->query($truncate_sql);

$data = json_decode(file_get_contents("php://input"),true);

$order = $data['order'];
$coffee = $data['coffee'];

$i = 0;

foreach ($coffee as $value) {
    $sql = "INSERT INTO `order`(`order`, `coffee`) VALUES ('".array_values($order)[$i++]."','".$value."')";

    if( $conn->query($sql)) {
        $messgae = "created Successfully.";
        $status = 1;			
    } else {
        $messgae = "creation failed.";
        $status = 0;			
    }

    $empResponse = array(
        'status' => $status,
        'status_message' => $messgae
    );
    header('Content-Type: application/json');
    echo json_encode($empResponse);
}

$conn->close();
?>
