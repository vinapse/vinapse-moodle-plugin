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
 * @category    backup
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/vinapse/backup/moodle2/restore_vinapse_stepslib.php');

class restore_vinapse_activity_task extends restore_activity_task
{
    protected function define_my_settings()
    {
    }

    protected function define_my_steps()
    {
        $this->add_step(new restore_vinapse_activity_structure_step('vinapse_structure', 'vinapse.xml'));
    }

    static public function define_decode_contents()
    {
        return array();
    }

    static public function define_decode_rules()
    {
        return array();
    }

    static public function define_restore_log_rules()
    {
        // We don't have logs
        return array();
    }

    static public function define_restore_log_rules_for_course()
    {
        return array();
    }
}
