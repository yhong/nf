<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     block.I.php
 * Type:     block
 * Name:     I
 * Purpose:  refrence the code in the file of CONFIG_LANG_PATH
 * -------------------------------------------------------------
 */
function smarty_block_I($params, $content, &$smarty, &$repeat)
{
    return I($content);
}
?> 