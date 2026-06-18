<?php
header("Content-Type: text/plain");
try {
    $pdo = new PDO("mysql:host=sql7.freesqldatabase.com;port=3306;dbname=sql7830743", "sql7830743", "X9UVEJYT3f", [PDO::ATTR_TIMEOUT => 5]);
    echo "PDO CONNECTED OK\n";
    $stmt = $pdo->query("SHOW TABLES");
    echo "Tables:\n";
    foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $t) {
        echo "- $t\n";
    }
    $stmt2 = $pdo->query("SELECT COUNT(*) FROM users");
    echo "Users count: " . $stmt2->fetchColumn() . "\n";
} catch (Exception $e) {
    echo "PDO ERROR: " . $e->getMessage() . "\n";
}
