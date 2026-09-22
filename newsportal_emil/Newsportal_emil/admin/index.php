<?php

session_start();

require_once __DIR__ . '/../inc/db.php';

require_once __DIR__ . '/modelAdmin/modelAdmin.php';
require_once __DIR__ . '/modelAdmin/modelAdminNews.php';
require_once __DIR__ . '/modelAdmin/modelAdminCategory.php';

require_once __DIR__ . '/controllerAdmin/controllerAdmin.php';
require_once __DIR__ . '/controllerAdmin/controllerAdminNews.php';

include_once __DIR__ . '/routeAdmin/routingAdmin.php';

if (isset($response)) {
    echo $response;
}

?>