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
 * The main mod_vinapse configuration form.
 *
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * Module instance settings form.
 *
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_vinapse_mod_form extends moodleform_mod
{

    /**
     * Defines forms elements
     */
    public function definition()
    {
        $mform = $this->_form;

        // Add the "general" fieldset, where all the common settings are shown
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Add the standard "name" field
        $mform->addElement('text', 'name', get_string('vinapsename', 'mod_vinapse'), array('size' => '64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 100), 'maxlength', 100, 'client');

        // Add the standard "intro" and "introformat" fields
        $this->standard_intro_elements();

        // If we're editing an existing resource
        if ($this->get_instance() != "") {
            // Add the UUID field
            $mform->addElement('text', 'remoteuuid', get_string('form_remoteuuid', 'mod_vinapse'), array('size' => '40'));
            $mform->setType('remoteuuid', PARAM_TEXT);
        } else {
            $mform->addElement('static', 'uploadhint',
                get_string('form_uploadhint_label', 'mod_vinapse'),
                get_string('form_uploadhint_text', 'mod_vinapse'));
        }

        // Add standard elements
        $this->standard_coursemodule_elements();

        if ($this->get_instance() == "") {
            // Add create & upload button
            $this->add_action_buttons(true, get_string('form_gotoupload', 'mod_vinapse'), false);
        } else {
            // Add standard buttons (edit mode)
            $this->add_action_buttons();
        }
    }
}
