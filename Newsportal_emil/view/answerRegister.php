<?php
ob_start();
?>

<h2>Registreerimine</h2>

<?php

if ($result[0] === true) {
    echo '<p><strong>Kasutaja on lisatud.</strong></p>';
    echo '<a href="./">Avalehele</a>';
} else {
    echo '<p><strong>Viga!</strong></p>';
    echo '<p>' . htmlspecialchars($result[1]) . '</p>';
    echo '<a href="registerForm">Tagasi registreerimisele</a>';
}

$content = ob_get_clean();

include_once 'view/layout.php';

?>