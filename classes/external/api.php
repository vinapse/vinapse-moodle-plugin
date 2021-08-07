<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_daddyvideo\external;

use context_module;
use external_api;
use external_function_parameters;
use external_value;

class api extends external_api
{
    public static function set_uuid_parameters()
    {
        return new external_function_parameters(
            array(
                'cmid' => new external_value(PARAM_INT, 'ID of the course module'),
                'uuid' => new external_value(PARAM_ALPHANUMEXT, 'Remote UUID to set'),
            )
        );
    }

    public static function set_uuid_returns()
    {
        return new external_value(PARAM_ALPHA, 'Status description');
    }

    public static function set_uuid($cmid, $uuid)
    {
        global $DB;

        $params = self::validate_parameters(
            self::set_uuid_parameters(),
            array(
                'cmid' => $cmid,
                'uuid' => $uuid
            )
        );

        $context = context_module::instance($params['cmid']);
        self::validate_context($context);
        require_capability('mod/daddyvideo:addinstance', $context);

        $cm = get_coursemodule_from_id('daddyvideo', $cmid, 0, false, MUST_EXIST);

        $DB->set_field_select(
            'daddyvideo',
            'remoteuuid',
            $params['uuid'],
            'id = :id',
            array('id' => $cm->instance)
        );

        return 'OK';
    }
}
