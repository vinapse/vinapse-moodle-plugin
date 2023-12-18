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
 * Plugin administration pages are defined here.
 *
 * @package     mod_vinapse
 * @category    admin
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings->add(
        new admin_setting_configtext(
            'mod_vinapse/lti_provider_base_url',
            get_string('setting_lti_provider_url', 'mod_vinapse'),
            get_string('setting_lti_provider_url_desc', 'mod_vinapse'),
            "",
            PARAM_URL
        )
    );

    $settings->add(
        new admin_setting_configtext(
            'mod_vinapse/lti_key',
            get_string('setting_lti_key', 'mod_vinapse'),
            get_string('setting_lti_key_desc', 'mod_vinapse'),
            "",
            PARAM_ALPHANUMEXT
        )
    );

    $settings->add(
        new admin_setting_configtext(
            'mod_vinapse/lti_secret',
            get_string('setting_lti_secret', 'mod_vinapse'),
            get_string('setting_lti_secret_desc', 'mod_vinapse'),
            "",
            PARAM_ALPHANUMEXT
        )
    );
}
