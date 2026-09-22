<?php

ob_start();

?>

<h3>Error 404</h3>

<p>Lehte ei leitud.</p>

<?php

$content = ob_get_clean();

include_once 'viewAdmin/templates/layout.php';

?>