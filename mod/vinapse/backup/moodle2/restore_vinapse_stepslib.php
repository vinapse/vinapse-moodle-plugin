<?php

defined('MOODLE_INTERNAL') || die();

class restore_vinapse_activity_structure_step extends restore_activity_structure_step
{
    protected function define_structure()
    {
        $paths = array(
            new restore_path_element('vinapse', '/activity/vinapse')
        );

        return $this->prepare_activity_structure($paths);
    }

    protected function process_vinapse($data)
    {
        global $DB;

        $data = (object)$data;
        $data->course = $this->get_courseid();

        $newitemid = $DB->insert_record('vinapse', $data);
        $this->apply_activity_instance($newitemid);
    }
}
