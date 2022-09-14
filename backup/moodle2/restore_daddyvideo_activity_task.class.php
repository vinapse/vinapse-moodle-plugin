<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/daddyvideo/backup/moodle2/restore_daddyvideo_stepslib.php');

class restore_daddyvideo_activity_task extends restore_activity_task
{
    protected function define_my_settings()
    {
    }

    protected function define_my_steps()
    {
        $this->add_step(new restore_daddyvideo_activity_structure_step('daddyvideo_structure', 'daddyvideo.xml'));
    }

    static public function define_decode_contents()
    {
        return array();
    }

    static public function define_decode_rules()
    {
        return array();
    }

    static public function define_restore_log_rules()
    {
        // We don't have logs
        return array();
    }

    static public function define_restore_log_rules_for_course()
    {
        return array();
    }
}
