<?php
    include 'connection.php';

    $namasiswa = '%'.htmlspecialchars($_POST['nama']).'%';

    $query = "SELECT * FROM `siswa` WHERE `nama` LIKE ? ORDER BY `nama` ASC LIMIT 5";

    $sql = $db->prepare($query);
    $sql->bindParam(1, $namasiswa, PDO::PARAM_STR);
    $sql->execute();

    $i = 1;

    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
        $data[$i]['id'] = $row['id'];
        $data[$i]['nama'] = $row['nama'];
        $data[$i]['alamat'] = $row['alamat'];
        $data[$i]['avatar'] = $row['avatar'];

        $i++;
    }

    $result = array_values($data);
    echo json_encode($result);
?>