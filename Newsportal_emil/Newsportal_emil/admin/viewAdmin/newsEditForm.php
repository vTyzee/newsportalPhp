<?php
if (!isset($_SESSION['editToken'])) {
    $_SESSION['editToken'] = bin2hex(random_bytes(16));
}
ob_start();
?>
<h2>Muuda uudist</h2>
<?php if (isset($saved)): ?>
    <div class="alert <?php echo $saved ? 'alert-success' : 'alert-warning'; ?>">
        <?php echo $saved ? 'Uudis on muudetud.' : 'Uudise muutmine ebaõnnestus. Kontrolli välju ja pilti.'; ?>
    </div>
<?php endif; ?>
<form action="newsEditResult" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo (int)$news['id']; ?>">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['editToken'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="form-group">
        <label>Pealkiri</label>
        <input class="form-control" name="title" maxlength="255" value="<?php echo htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="form-group">
        <label>Uudise tekst</label>
        <textarea class="form-control" name="text" rows="6" required><?php echo htmlspecialchars($news['text'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <div class="form-group">
        <label>Kategooria</label>
        <select class="form-control" name="idCategory" required>
            <?php foreach ($arr as $category): ?>
                <option value="<?php echo (int)$category['id']; ?>" <?php echo (int)$news['category_id'] === (int)$category['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Uus pilt (valikuline)</label>
        <input class="form-control" type="file" name="picture" accept="image/jpeg,image/png,image/gif,image/webp">
        <small>Kui uut pilti ei vali, jääb eelmine pilt alles.</small>
    </div>
    <button type="submit" name="save" class="btn btn-primary">Salvesta muudatused</button>
    <a href="newsAdmin" class="btn btn-default">Tagasi</a>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/templates/layout.php'; ?>
