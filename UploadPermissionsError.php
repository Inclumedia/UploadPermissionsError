<?php
/**
 * UploadPermissionsError MediaWiki extension.
 *
 * Written by Leucosticte
 * https://www.mediawiki.org/wiki/User:Leucosticte
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Extensions
 */
if( !defined( 'MEDIAWIKI' ) ) {
        echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
        die( 1 );
}
$wgExtensionCredits['specialpage'][] = array(
        'path' => __FILE__,
        'name' => 'UploadPermissionsError',
        'author' => 'Nathan Larson',
        'url' => 'https://boywiki.org/en/User:Leucosticte/UploadPermissionsError',
        'descriptionmsg' => 'uploadpermissionserror-desc',
        'version' => '1.0.1'
);
$wgExtensionMessagesFiles['UploadPermissionsError'] = __DIR__ . '/UploadPermissionsError.i18n.php';

$wgHooks['UploadForm:permissionRequired'][] = array( 'uploadAccessDenied' );
function uploadAccessDenied( $permissionRequired ) {
    throw new UploadPermissionsError( $permissionRequired );
}

class UploadPermissionsError extends ErrorPageError {
	public $permission, $errors;

	public function __construct( $permission, $errors = array() ) {
		global $wgLang;

		$this->permission = $permission;

		if ( !count( $errors ) ) {
			$groups = array_map(
				array( 'User', 'makeGroupLinkWiki' ),
				User::getGroupsWithPermission( $this->permission )
			);

			if ( $groups ) {
				$errors[] = array( 'badaccess-groups-upload', $wgLang->commaList( $groups ), count( $groups ) );
			} else {
				$errors[] = array( 'badaccess-group0-upload' );
			}
		}

		$this->errors = $errors;
	}

	public function report() {
		global $wgOut;

		$wgOut->showPermissionsErrorPage( $this->errors, $this->permission );
		$wgOut->output();
	}
}