<?php ob_start(); ?>
<h2>Kustuta uudis</h2>
<div class="alert alert-warning">
    Kas soovid kustutada uudise <strong><?php echo htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8'); ?></strong> ja selle kommentaarid?
</div>
<form action="newsDeleteResult" method="POST">
    <input type="hidden" name="id" value="<?php echo (int)$news['id']; ?>">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['deleteToken'], ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit" class="btn btn-danger">Jah, kustuta</button>
    <a href="newsAdmin" class="btn btn-default">Tühista</a>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/templates/layout.php'; ?>
