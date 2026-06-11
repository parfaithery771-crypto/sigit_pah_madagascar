<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: text/plain');
    echo "EMAIL: [" . ($_POST['email'] ?? 'EMPTY') . "]\n";
    echo "PASSWORD: [" . ($_POST['password'] ?? 'EMPTY') . "]\n";
    echo "ALL POST:\n";
    print_r($_POST);
} else {
    echo '<form method="post" action="/test_post.php">
    <input type="email" name="email" value="admin@sigit.mg"><br>
    <input type="password" name="password" value="admin123"><br>
    <button type="submit">Test</button>
    </form>';
}