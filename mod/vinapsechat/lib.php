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
 * Library of interface functions and constants.
 *
 * @package     mod_vinapse // TODO
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return mixed True if module supports feature, false if not, null if doesn't know
 */
function vinapsechat_supports($feature)
{
    switch ($feature) {
        case FEATURE_BACKUP_MOODLE2:
        case FEATURE_MOD_PURPOSE:
            return MOD_PURPOSE_CONTENT;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_vinapse into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_vinapse_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 * @throws dml_exception
 */
function vinapsechat_add_instance($moduleinstance, $mform = null): int
{
    global $DB;

    $moduleinstance->timecreated = time();
    $moduleinstance->timemodified = $moduleinstance->timecreated;

    $id = $DB->insert_record('vinapsechat', $moduleinstance);

    return $id;
}

/**
 * Updates an instance of the mod_vinapse in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_vinapse_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 * @throws dml_exception
 */
function vinapsechat_update_instance($moduleinstance, $mform = null)
{
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('vinapsechat', $moduleinstance);
}

/**
 * Removes an instance of the mod_vinapse from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 * @throws dml_exception
 */
function vinapsechat_delete_instance($id): bool
{
    global $DB;

    $exists = $DB->get_record('vinapsechat', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('vinapsechat', array('id' => $id));

    return true;
}

function mod_vinapsechat_cm_info_view(cm_info $cm)
{
    global $CFG;
    global $OUTPUT;

    $cm->set_custom_cmlist_item(true);

    $cm->set_content($OUTPUT->render_from_template('mod_vinapsechat/chat_module', [
        'wwwroot' => $CFG->wwwroot,
        'post_url' => $cm->get_url()
    ]));
}
