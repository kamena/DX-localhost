<?php
/**
 * Plugin Name: DX Localhost
 * Description: Display a yellow notice box when you're working on localhost
 * Author: nofearinc
 * Author URI: http://devwp.eu/
 * License: GPL2

 Copyright 2014 mpeshev (email : mpeshev AT devrix DOT com)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 2, as
 published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

add_action( 'admin_enqueue_scripts', 'dx_localhost_display' ); 
add_action( 'wp_enqueue_scripts', 'dx_localhost_display' );

/**
 * Verify login activities and load script if on localhost
 */
function dx_localhost_display() {
    if( dx_is_localhost() ) {
        wp_enqueue_script( 'dx-localhost', 
            plugins_url( 'dx-localhost.js' , __FILE__ ), array( 'jquery' ) );
        
        wp_enqueue_style( 'dx-localhost', 
            plugins_url( 'dx-localhost.css', __FILE__ ) );
        
        wp_localize_script( 'dx-localhost', 'dxlocalhost', array(
            'notice_msg' => __( 'You are working on localhost', 'dxloc' )
        ));
    }
}
 
/**
 * Check if the current server is localhost
 */
function dx_is_localhost() {
    if ( $_SERVER['SERVER_NAME'] === 'localhost' || 
         $_SERVER['SERVER_ADDR'] === '127.0.0.1' ) {
         return true;
    }
         
    return false;
}

