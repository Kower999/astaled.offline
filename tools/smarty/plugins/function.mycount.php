<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {mycount} function plugin
 *
 * Type:     function<br>
 * Name:     mycount<br>
 * Purpose:  count values of array
 *
 */
function smarty_function_mycount($params, $template)
{
    $total = 0;
    if(isset($params['this']) && is_array($params['this'])) {
        foreach($params['this'] as $row) {
            $tmp = str_replace(array(',',' ','€'),array('.','',''),$row);
            $total += floatval($tmp);
        }
    }
    
    $return = number_format($total,2,',',' ')." €";
    
    return $return;
    
}

?>