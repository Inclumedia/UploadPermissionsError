<?php
/**
 * Internationalization file for the UploadPermissionsError extension.
 *
 * @since 1.0.0
 *
 * @file
 *
 * @licence GNU GPL
 * @author Nathan Larson (Leucosticte)
 */
$messages = array();
/** English
 * @author Nathan Larson (Leucosticte)
 */
$messages['en'] = array(
    'uploadpermissionserror-desc' => 'Implements a new permissions error page for uploads.',
    'badaccess-group0-upload' => "You are not allowed to execute the action you have requested.
To request a file be added to the wiki, please add a new entry at [[Project:Requests for file uploads]].",
    "badaccess-groups-upload" => "The action you have requested is limited to users in {{PLURAL:$2|the group|one of the groups}}: $1.
To request a file be added to the wiki, please add a new entry at [[Project:Requests for file uploads]]."
);