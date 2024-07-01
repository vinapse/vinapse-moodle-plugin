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
 * @package     mod_vinapsechat
 * @category    backup
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class backup_vinapsechat_activity_structure_step extends backup_activity_structure_step
{
    protected function define_structure()
    {
        $resource = new backup_nested_element(
            'vinapsechat',
            array('id'),
            array('name', 'timecreated', 'timemodified')
        );

        $resource->set_source_table(
            'vinapsechat',
            array(
                'id' => backup::VAR_ACTIVITYID
            )
        );

        return $this->prepare_activity_structure($resource);
    }
}
