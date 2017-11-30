<?php
include( 'config.php' );

$template = new Template(TEMPLATE_ROOT . 'index.php');

$template->set('page_title', 'CAI Time Entry');

ob_start();
include('views/student/dashboard.php');
$content = ob_get_clean();
$template->set('content', $content);

echo $template->fetch();
