<?php
ob_start();
?>

<h2>Registreerimine</h2>

<form method="POST" action="registerAnswer">

    <div>
        <label>Kasutajanimi</label><br>
        <input
            type="text"
            name="name"
            required
            autofocus
        >
    </div>

    <br>

    <div>
        <label>E-post</label><br>
        <input
            type="email"
            name="email"
            required
        >
    </div>

    <br>

    <div>
        <label>Parool</label><br>
        <input
            type="password"
            name="password"
            required
        >
    </div>

    <br>

    <div>
        <label>Korda parooli</label><br>
        <input
            type="password"
            name="confirm"
            required
        >
    </div>

    <br>

    <button type="submit" name="save">
        Registreeri
    </button>

</form>

<?php

$content = ob_get_clean();

include_once 'view/layout.php';

?>