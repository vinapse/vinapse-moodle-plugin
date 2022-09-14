<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/daddyvideo/backup/moodle2/backup_daddyvideo_stepslib.php');

class backup_daddyvideo_activity_task extends backup_activity_task
{
    protected function define_my_settings()
    {
    }

    protected function define_my_steps()
    {
        $this->add_step(new backup_daddyvideo_activity_structure_step('daddyvideo_structure', 'daddyvideo.xml'));
    }

    static public function encode_content_links($content)
    {
        return $content;
    }
}
