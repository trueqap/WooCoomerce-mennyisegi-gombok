<?php

if (!defined('ABSPATH')) {
    die('Sorry, but what?!?!');
}

class WooCommerce_Mennyisegi_Gombok
{

    protected $loader;
    protected $plugin_slug;

    public function __construct()
    {

        $this->plugin_slug = 'woocoomerce-mennyisegi-gombok';

        //ADMIN-FIGYELMEZTETÉS
        add_action('admin_notices', array(&$this, 'woomg_admin_notices'));

        //NYELVI FÁJLOK
        add_action('plugins_loaded', array(&$this, 'woomg_language'));

        //WOOCOMMERCE TEMPLATE MÓDOSÍTÁS
        add_action('woocommerce_locate_template', array(&$this, 'woomg_locate_template'), 1, 3);

        //LOAD ASSETS
        wp_enqueue_script('woo_mg.js', plugin_dir_url(__FILE__) . 'assets/js/woo_mg.js', array('jquery'));
        wp_enqueue_style('slider', plugin_dir_url(__FILE__) . 'assets/css/woo_mg.css', false, '0.1', 'all');

    }

    public function woomg_admin_notices()
    {
        global $woocommerce;

        if (!class_exists('WooCommerce') || version_compare($woocommerce->version, '2.3', '<')) {
            $class   = 'notice notice-warning is-dismissible';
            $message = __('FIGYELEM, WooCommerce Mennyiségi Gombok bővítményhez a szükséges WooCommerce verzió minimum 2.3.', 'woocoomerce-mennyisegi-gombok');

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
        }
    }

    public function woomg_language()
    {
        load_plugin_textdomain('woocoomerce-mennyisegi-gombok', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    public function woomg_locate_template($template, $template_name, $template_path)
    {
        global $woocommerce;

        $_template     = $template;
        $plugin_path   = untrailingslashit(plugin_dir_path(__FILE__)) . '/template/';
        $template_path = (!$template_path) ? $woocommerce->template_url : null;
        $template      = locate_template(array($template_path . $template_name, $template_name));

        if (!$template && file_exists($plugin_path . $template_name)) {
            $template = $plugin_path . $template_name;
        }

        if (!$template) {
            $template = $_template;
        }

        return $template;
    }

}
