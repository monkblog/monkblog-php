<?php


if( ! function_exists( 'current_theme' ) ) {
    /**
     * @return mixed
     */
    function current_theme() {
        return Config::get( 'theme_manager.current', 'monk' );
    }
}

if( ! function_exists( 'current_theme_view' ) ) {
    /**
     * @param       $view
     * @param array $data
     *
     * @return string
     */
    function current_theme_view( $view, $data = [] ) {
        debug( 'home_theme' );
        return view( current_theme() . '::' . $view, $data )->render();
    }
}

if( ! function_exists( 'theme_view_exists' ) ) {
    /**
     * @param $namespace
     * @param $view
     *
     * @return bool
     */
    function theme_view_exists( $namespace, $view ) {
        return View::exists( $namespace  .'::' . $view );
    }
}

if( ! function_exists( 'current_theme_exists' ) ) {
    /**
     * @return bool
     */
    function current_theme_exists() {
        $currentTheme = current_theme();
        return ( File::exists( base_path( "themes/{$currentTheme}/" ) ) );
    }
}