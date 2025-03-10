<?php
if (!function_exists('get_admin_theme_path')) {
    function get_admin_theme_path($path = '') {
        return asset('admin_theme_assets/' . $path);
    }
}

?>