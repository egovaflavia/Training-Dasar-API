<?php
// Koneksi
$con = new mysqli('localhost', 'root', '', 'db_dummy');

// Cek koneksi
if ($con->connect_error) {
    die("Connection Failed:" . $con->connect_error);
}

// Mengambil data dari database
$sql = "SELECT id, firstname, lastname, email, reg_date FROM guests";
$result = $con->query($sql);

// Deklarasi
$json = [];
$i = 0;

// Cek hasil query
if ($result->num_rows > 0) {

    // Extrak data
    while ($row = $result->fetch_assoc()) {
        $json[$i] = [
            'id' => $row["id"],
            'firstname' => $row["firstname"],
            'lastname' => $row["lastname"],
            'email' => $row["email"],
            'reg_date' => $row["reg_date"]
        ];
        $i = $i + 1;
    }
} else {
    echo "0 results";
}

$con->close();

$data = [
    'status' => 'success',
    'data' => $json
];

header('Content-Type: application/json');
echo json_encode($data);
