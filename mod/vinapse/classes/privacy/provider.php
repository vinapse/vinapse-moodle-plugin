<?php

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_vinapse\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\approved_userlist;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\userlist;

class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\plugin\provider,
    \core_privacy\local\request\core_userlist_provider
{

    public static function get_metadata(collection $collection): collection
    {
        $collection->add_external_location_link('lti_client', [
            'userid' => 'privacy:metadata:userid',
            'language' => 'privacy:metadata:language',
            'roles' => 'privacy:metadata:roles',
            'courses' => 'privacy:metadata:courses',
        ], 'privacy:metadata:purpose');

        return $collection;
    }

    public static function get_contexts_for_userid(int $userid): contextlist
    {
        return new contextlist();
    }

    public static function export_user_data(approved_contextlist $contextlist)
    {
    }

    public static function delete_data_for_all_users_in_context(\context $context)
    {
    }

    public static function delete_data_for_user(approved_contextlist $contextlist)
    {
    }

    public static function get_users_in_context(userlist $userlist)
    {
    }

    public static function delete_data_for_users(approved_userlist $userlist)
    {
    }
}
