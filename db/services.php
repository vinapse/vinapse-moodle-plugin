<?php

$functions = array(
    'mod_daddyvideo_set_uuid' => array(
        'classname' => 'mod_daddyvideo\external\api',
        'methodname' => 'set_uuid',
        'description' => 'Set remote UUID for the DADdy video course module.',
        'type' => 'write',
        'ajax' => true,
        'capabilities' => 'mod/daddyvideo:addinstance',
        'services' => array()
    )
);
