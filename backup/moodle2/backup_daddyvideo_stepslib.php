<?php

defined('MOODLE_INTERNAL') || die();

class backup_daddyvideo_activity_structure_step extends backup_activity_structure_step
{
    protected function define_structure()
    {
        $resource = new backup_nested_element(
            'daddyvideo',
            array('id'),
            array('name', 'timecreated', 'timemodified', 'intro', 'introformat', 'remoteuuid')
        );

        $resource->set_source_table(
            'daddyvideo',
            array(
                'id' => backup::VAR_ACTIVITYID
            )
        );

        return $this->prepare_activity_structure($resource);
    }
}
