<?php

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(
    'mod_vinapse_set_uuid' => array(
        'classname' => 'mod_vinapse\external\api',
        'methodname' => 'set_uuid',
        'description' => 'Set remote UUID for the Vinapse course module.',
        'type' => 'write',
        'ajax' => true,
        'capabilities' => 'mod/vinapse:addinstance',
        'services' => array()
    )
);
