<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Newsportal - Sisselogimine</title>

    <link
        rel="stylesheet"
        href="css/bootstrap.min.css"
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
            <a href="../registerForm">
                Registreeru
            </a>
        </li>

        <li>
            <a href="./">
                Logi sisse
            </a>
        </li>

    </ul>

</nav>

<main class="portal-content">

    <div class="portal-login">

        <h2>Sisselogimine</h2>

        <form action="login" method="POST">

            <label for="email">
                E-post
            </label>

            <input
                id="email"
                type="email"
                name="email"
                class="form-control"
                placeholder="E-post"
                required
                autofocus
            >

            <label for="password">
                Parool
            </label>

            <input
                id="password"
                type="password"
                name="password"
                class="form-control"
                placeholder="Parool"
                required
            >

            <button
                class="btn btn-primary"
                type="submit"
                name="btnLogin"
            >
                Logi sisse
            </button>

            <?php if (isset($_SESSION['errorstring'])): ?>

                <p style="color:red; margin-top:15px;">

                    <?php
                    echo htmlspecialchars(
                        $_SESSION['errorstring'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </p>

            <?php endif; ?>

        </form>

    </div>

</main>

<footer class="portal-footer">
    Newsportal
</footer>

</body>
</html>