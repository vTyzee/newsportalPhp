<?php

$path = basename(rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
if ($path === 'admin' || $path === 'index' || $path === 'index.php') {
    $response = controllerAdmin::formLoginSite();
} elseif ($path === 'login') {
    $response = controllerAdmin::loginAction();
} elseif ($path === 'logout') {
    $response = controllerAdmin::logoutAction();
} elseif ($path === 'newsAdmin') {
    $response = controllerAdminNews::NewsList();
} elseif ($path === 'newsAdd') {
    $response = controllerAdminNews::newsAddForm();
} elseif ($path === 'newsAddResult') {
    $response = controllerAdminNews::newsAddResult();
} elseif ($path === 'newsEdit') {
    $response = controllerAdminNews::newsEditForm();
} elseif ($path === 'newsEditResult') {
    $response = controllerAdminNews::newsEditResult();
} elseif ($path === 'newsDelete') {
    $response = controllerAdminNews::newsDeleteForm();
} elseif ($path === 'newsDeleteResult') {
    $response = controllerAdminNews::newsDeleteResult();
} else {
    $response = controllerAdmin::error404();
}
