<!DOCTYPE html>

<html>

<head>

    <title>NEWSPORTAL</title>

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="style.css"
    >

    <link
        href="https://fonts.googleapis.com/css?family=Noto+Serif"
        rel="stylesheet"
    >

    <meta charset="utf-8">

</head>

<body>

<nav class="one">

    <ul class="topmenu">

        <li>

            <a href="#">Kategooriad</a>

            <ul class="submenu">

                <?php
                Controller::AllCategory();
                ?>

            </ul>

        </li>

        <li>
            <a href="all">Info</a>
        </li>

        <li>
            <a href="./">Avaleht</a>
        </li>

        <li>
            <a href="registerForm">Registreeru</a>
        </li>

    </ul>

</nav>

<section>

    <div class="divbox">

        <?php

        if (isset($content)) {
            echo $content;
        } else {
            echo '<h1>Content is gone!</h1>';
        }

        ?>

    </div>

</section>

<hr>

<p style="display:block; text-align:center;">
    Newsportal
</p>

</body>

</html>