<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/vinapse/backup/moodle2/restore_vinapse_stepslib.php');

class restore_vinapse_activity_task extends restore_activity_task
{
    protected function define_my_settings()
    {
    }

    protected function define_my_steps()
    {
        $this->add_step(new restore_vinapse_activity_structure_step('vinapse_structure', 'vinapse.xml'));
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
