<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<h2>POST DATA:</h2><pre>';
    print_r($_POST);
    echo '</pre>';
    echo '<h2>SESSION:</h2><pre>';
    print_r($_SESSION);
    echo '</pre>';
} else {
    echo '<form method="post">
    <input type="email" name="email" placeholder="email" value="admin@sigit.mg"><br>
    <input type="password" name="password" placeholder="password" value="admin123"><br>
    <button type="submit">Test Login</button>
    </form>';
}