<?php

/*
Plugin Name: Wedding BE
Description: General BE for a wedding site.
Author: Matias Berger
Version: 1.0.0
*/

$files = glob(WPMU_PLUGIN_DIR . '/wedding/*/*.php');
foreach ($files as $file) {
    require_once($file);
}

use DelfiNico\Guest\GuestModel;
use DelfiNico\Guest\GuestController;
use DelfiNico\Guest\GuestEndpoints;

$guest_model = new GuestModel(true);
$guest_controller = new GuestController($guest_model);
$guest_endpoints = new GuestEndpoints($guest_controller);
