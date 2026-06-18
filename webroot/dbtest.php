<?php
header("Content-Type: text/plain");
$content = file_get_contents(dirname(__DIR__) . "/config/app_local.php");
$content = preg_replace("/(password[\"\x27]\\s*=>\\s*[\"\x27])[^\"\x27]*([\"\x27])/i", "$1HIDDEN$2", $content);
echo $content;
