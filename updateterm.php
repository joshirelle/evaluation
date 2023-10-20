<?php
// Include config file
require_once "php/core.php";

$syID = $_POST['syID'];
$sy = $_POST['acadYear'];
$termID = $_POST['termID'];
$isActive = $_POST['isActive'];

$sql = "SELECT sy, termID FROM school_year WHERE sy = :sy AND termID = :termID";
$sql2 = "SELECT is_active FROM school_year WHERE is_active = 1";
$sql3 = "UPDATE school_year SET sy = :sy, termID = :termID, is_active = :is_active WHERE syID = :syID";

// Begin transaction
$pdo->beginTransaction();

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":sy", $sy);
    $stmt->bindParam(":termID", $termID);
    $stmt->execute();

    $countSYTerm = $stmt->rowCount();

    if ($countSYTerm == 0) {
        $stmt = $pdo->prepare($sql2);
        $stmt->execute();

        $countIsActive = $stmt->rowCount();

        if($countIsActive == 0 || $countIsActive != 0 && $isActive == 0) {
            $stmt = $pdo->prepare($sql3);
            $stmt->bindParam(":sy", $sy);
            $stmt->bindParam(":termid", $termID);
            $stmt->bindParam(":is_active", $isActive);
            $stmt->bindParam(":syID", $syID);
            $stmt->execute();
            
            $pdo->commit();
            echo "success";
        }else{
            echo "There is an active academic year, unable to set current record to active";
        }
    }else{
        echo "Academic Year and Semester already exist, please try again";
    }

    
} catch (PDOException $ex) {
    // prevent insert in database when error occurs
    $pdo->rollBack();
    exit($ex->getMessage());
}

unset($stmt);
unset($pdo);

