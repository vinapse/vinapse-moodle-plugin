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
 * The main mod_daddyvideo configuration form.
 *
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Module instance settings form.
 *
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_daddyvideo_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     */
    public function definition() {

        $EDITFRAME = '<div id="fitem_id_editframe" class="form-group row  fitem   ">
            <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                
                        <label class="d-inline word-break " for="id_editframe">
                            Video file
                        </label>
                
                <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                    
                </div>
            </div>
            <script>
            if (window.addEventListener) {
                window.addEventListener("message", onMessage, false);        
            }  else if (window.attachEvent) {
                window.attachEvent("onmessage", onMessage, false);
            }

            function onMessage(event) {
                // TODO: check event.origin
                var data = event.data;
                document.getElementById("id_remoteuuid").value = data.uuid;
            }

            </script>
            <div class="col-md-9 form-inline align-items-start felement" data-fieldtype="text" id="yui_3_17_2_1_1617346993839_780">
                    <iframe src="http://127.0.0.1/mod/daddyvideo/lti_launch.php" title="" style="width: 100%; height: 300px"></iframe>
            </div>
        </div>';

        global $CFG;

        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are shown.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('daddyvideoname', 'mod_daddyvideo'), array('size' => '64'));

        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'daddyvideoname', 'mod_daddyvideo');

        // Adding the standard "intro" and "introformat" fields.
        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }

        // Adding the rest of mod_daddyvideo settings, spreading all them into this fieldset
        // ... or adding more fieldsets ('header' elements) if needed for better logic.
        //$mform->addElement('static', 'label1', 'daddyvideosettings', get_string('daddyvideosettings', 'mod_daddyvideo'));
        //$mform->addElement('header', 'daddyvideofieldset', get_string('daddyvideofieldset', 'mod_daddyvideo'));

        // Adding the Uuid remote reference.
        $mform->addElement('text', 'remoteuuid', get_string('remoteuuid', 'mod_daddyvideo'), array('size' => '36'));

        // Edit iFrame
        $mform->addElement('html', $EDITFRAME);

        // Add standard elements.
        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();
    }
}
