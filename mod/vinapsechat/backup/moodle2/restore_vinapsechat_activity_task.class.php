<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/vinapsechat/backup/moodle2/restore_vinapsechat_stepslib.php');

class restore_vinapsechat_activity_task extends restore_activity_task
{
    protected function define_my_settings()
    {
    }

    protected function define_my_steps()
    {
        $this->add_step(new restore_vinapsechat_activity_structure_step('vinapsechat_structure', 'vinapsechat.xml'));
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
