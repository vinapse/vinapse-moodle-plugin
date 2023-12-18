<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/vinapse/backup/moodle2/backup_vinapse_stepslib.php');

class backup_vinapse_activity_task extends backup_activity_task
{
    protected function define_my_settings()
    {
    }

    protected function define_my_steps()
    {
        $this->add_step(new backup_vinapse_activity_structure_step('vinapse_structure', 'vinapse.xml'));
    }

    static public function encode_content_links($content)
    {
        return $content;
    }
}
