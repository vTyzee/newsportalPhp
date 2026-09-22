<?php

ob_start();

$isAdmin = ($_SESSION['status'] ?? '') === 'admin';

$username = htmlspecialchars(
    $_SESSION['username'] ?? 'kasutaja',
    ENT_QUOTES,
    'UTF-8'
);

?>

<h3>
    <?php echo $isAdmin ? 'Admin paneel' : 'Kasutaja paneel'; ?>
</h3>

<p>Tere, <?php echo $username; ?>!</p>

<?php if ($isAdmin): ?>

    <p>Saad hallata uudiseid.</p>

    <a href="newsAdmin" class="btn btn-primary">
        Uudiste haldamine
    </a>

<?php else: ?>

    <p>Oled sisse loginud tavakasutajana.</p>

    <a href="../" class="btn btn-primary">
        Vaata uudiseid
    </a>

<?php endif; ?>

<?php

$content = ob_get_clean();

include 'viewAdmin/templates/layout.php';

?>