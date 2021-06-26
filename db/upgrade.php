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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin upgrade steps are defined here.
 *
 * @package     mod_daddyvideo
 * @category    upgrade
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute mod_daddyvideo upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_daddyvideo_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    // Reference to the Uuid of the lecture on the provider DADdy
    if ($oldversion < 2021033100) {

        $table = new xmldb_table('daddyvideo');
        $field = new xmldb_field('remoteuuid', XMLDB_TYPE_CHAR, '36', null, null, null, null);

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        upgrade_mod_savepoint(true, 2021033100, 'daddyvideo');
    }

    // Reference to the department and year on the provider DADdy
    if ($oldversion < 2021033100) {

        $table = new xmldb_table('daddyvideo');
        $field = new xmldb_field('department', XMLDB_TYPE_CHAR, '36', null, null, null, null);
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('year', XMLDB_TYPE_CHAR, '8', null, null, null, null);
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        upgrade_mod_savepoint(true, 2021052500, 'daddyvideo');
    }

    return true;
}
