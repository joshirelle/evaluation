<?php
// Include config file
require_once "php/core.php";

$sy = $_POST['acadYear'];

$sql = "INSERT INTO school_year (sy) VALUES (:sy)";

// Begin transaction
$pdo->beginTransaction();

try {
    $stmt_fac = $pdo->prepare($sql);
    $stmt_fac->bindParam(":sy", $sy);
    $stmt_fac->execute();
    
    $pdo->commit();
    echo "success";
} catch (PDOException $ex) {
    // prevent insert in database when error occurs
    $pdo->rollBack();
    exit($ex->getMessage());
}

unset($stmt);
unset($pdo);

