<?php
/*
 * Plugin Name:       WooCommerce Mennyiségi Gombok
 * Plugin URI:        https://github.com/trueqap/WooCoomerce-mennyisegi-gombok
 * Description:       Description Szeretnél gombokat WooCommerce termékek mennyiségének növelésére és csökkentésére?
 * Version:           0.0.1
 * Author:            Laszlo Patai
 * Author URI:        https://webmi.io
 * Text Domain:       woocoomerce-mennyisegi-gombok
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die;
}

require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-loader.php';
require_once plugin_dir_path(__FILE__) . 'includes/updater/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/trueqap/WooCoomerce-mennyisegi-gombok',
    __FILE__,
    'WooCoomerce-mennyisegi-gombok'
);

function run_plugin_loader()
{

    $woomg = new WooCommerce_Mennyisegi_Gombok();
    return $woomg;

}

run_plugin_loader();
