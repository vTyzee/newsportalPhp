<?php

echo '<li><a href="all">ALL</a></li>';

foreach ($arr as $value) {

    echo '<li class="submenu">';
    echo '<a href="category?id=' . $value['id'] . '">';
    echo htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8');
    echo '</a>';
    echo '</li>';
}
?>