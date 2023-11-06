<?php
echo "<h1>Users</h1>";
echo "<h3>" . $title . "</h3>";

echo "<ul>";
foreach($users as $user) {
    echo "<li>". $user['id'] ." => ". $user['email'] ."</li>";
}
echo "</ul>";