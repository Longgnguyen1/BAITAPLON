<?php
session_start();

require_once 'app/App.php';
require_once 'core/Controller.php';
require_once 'core/funtions.php';
require_once 'configs/config.php';
require_once 'core/SqlConnection.php';

$app = new App();