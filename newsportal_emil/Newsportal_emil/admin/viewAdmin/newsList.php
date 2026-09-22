<?php ob_start(); ?>
<h2>Uudiste nimekiri</h2>
<p><a class="btn btn-primary" href="newsAdd">Lisa uudis</a></p>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Uudis</th><th>Tegevused</th></tr></thead>
    <tbody>
    <?php foreach ($arr as $row): ?>
    <tr>
        <td><?php echo (int)$row['id']; ?></td>
        <td>
            <strong><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></strong><br>
            Kategooria: <?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?><br>
            Autor: <?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?>
        </td>
        <td>
            <a href="newsEdit?id=<?php echo (int)$row['id']; ?>">Muuda</a> |
            <a href="newsDelete?id=<?php echo (int)$row['id']; ?>">Kustuta</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); include __DIR__ . '/templates/layout.php'; ?>
