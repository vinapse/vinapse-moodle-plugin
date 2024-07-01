<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <https://www.gnu.org/licenses/>.

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_vinapse\external;

use context_module;
use external_api;
use external_function_parameters;
use external_value;

global $CFG;

require_once($CFG->dirroot . '/lib/externallib.php');

class api extends external_api
{
    public static function set_uuid_parameters()
    {
        return new external_function_parameters(
            array(
                'cmid' => new external_value(PARAM_INT, 'ID of the course module'),
                'uuid' => new external_value(PARAM_ALPHANUMEXT, 'Remote UUID to set', VALUE_OPTIONAL),
            )
        );
    }

    public static function set_uuid_returns()
    {
        return new external_value(PARAM_ALPHA, 'Status description');
    }

    public static function set_uuid($cmid, $uuid = null)
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
        require_capability('mod/vinapse:addinstance', $context);

        $cm = get_coursemodule_from_id('vinapse', $cmid, 0, false, MUST_EXIST);

        $DB->set_field_select(
            'vinapse',
            'remoteuuid',
            $params['uuid'],
            'id = :id',
            array('id' => $cm->instance)
        );

        return 'OK';
    }
}
