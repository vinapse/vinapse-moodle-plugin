<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(
    'mod_daddyvideo_set_uuid' => array(
        'classname' => 'mod_daddyvideo\external\api',
        'methodname' => 'set_uuid',
        'description' => 'Set remote UUID for the Vinapse course module.',
        'type' => 'write',
        'ajax' => true,
        'capabilities' => 'mod/daddyvideo:addinstance',
        'services' => array()
    )
);
