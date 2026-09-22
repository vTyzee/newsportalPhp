<?php

$isAdmin = ($_SESSION['status'] ?? '') === 'admin';

$username = htmlspecialchars(
    $_SESSION['username'] ?? 'kasutaja',
    ENT_QUOTES,
    'UTF-8'
);

?>

<!DOCTYPE html>
<html lang="et">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Newsportal</title>

    <link
        rel="stylesheet"
        href="css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        href="css/font-awesome.min.css"
    >

    <link
        rel="stylesheet"
        href="css/mystyle.css"
    >

    <link
        rel="stylesheet"
        href="css/portal-theme.css"
    >

</head>

<body>

<nav class="portal-nav">

    <ul class="portal-menu">

        <li>
            <a href="../">
                Avaleht
            </a>
        </li>

        <li>
            <a href="./">

                <?php
                echo $isAdmin
                    ? 'Admin avaleht'
                    : 'Kasutaja avaleht';
                ?>

            </a>
        </li>

        <?php if ($isAdmin): ?>

            <li>
                <a href="newsAdmin">
                    Uudised
                </a>
            </li>

        <?php endif; ?>

        <li class="right">

            <a href="./">
                <?php echo $username; ?>
            </a>

        </li>

        <li>
            <a href="logout">
                Välju
            </a>
        </li>

    </ul>

</nav>

<main class="portal-content">

    <div id="content">

        <?php
        echo $content ?? '';
        ?>

    </div>

</main>

<footer class="portal-footer">
    Newsportal
</footer>

</body>
</html>