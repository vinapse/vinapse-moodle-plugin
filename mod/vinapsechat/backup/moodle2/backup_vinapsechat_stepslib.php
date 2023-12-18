<?php

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
