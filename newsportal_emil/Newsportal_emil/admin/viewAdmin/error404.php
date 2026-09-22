<?php ob_start(); ?>
<h2>404 – Lehte ei leitud</h2>
<p><a href="./">Tagasi admin avalehele</a></p>
<?php $content = ob_get_clean(); include __DIR__ . '/templates/layout.php'; ?>
