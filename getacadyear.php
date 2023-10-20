<?php
    require_once "php/core.php";
    $syID = $_POST['syID'];

	$sql = "SELECT syID, sy, termID, is_active FROM school_year WHERE syID = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($syID));
    $stmt->execute();
    
    $result = [];
    if ($fetch = $stmt->fetch()) {
        $result = [
            "sy" => $fetch["sy"],
            "termID" => $fetch["termID"],
        ];
    }
    echo json_encode($result);
    unset($result);
    unset($pdo);
?>