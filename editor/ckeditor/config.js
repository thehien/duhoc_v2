/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	// For kcfinder
	config.filebrowserBrowseUrl = '../editor/kcfinder/browse.php?type=files';
	
	config.filebrowserImageBrowseUrl = '../editor/kcfinder/browse.php?type=images';
	
	config.filebrowserFlashBrowseUrl = '../editor/kcfinder/browse.php?type=flash';
	
	config.filebrowserUploadUrl = '../editor/kcfinder/upload.php?type=files';
	
	config.filebrowserImageUploadUrl = '../editor/kcfinder/upload.php?type=images';
	
	config.filebrowserFlashUploadUrl = '../editor/kcfinder/upload.php?type=flash';
	
	
	
	config.filebrowserWindowWidth = '800';
	
	config.filebrowserWindowHeight = '1000';
	
	
	
	config.enterMode = CKEDITOR.ENTER_BR;
	
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	
	
	config.resize_enabled = true;
	
	config.htmlEncodeOutput = false;
	
	config.entities = false;
	
	
	config.contentsLangDirection = 'ltr';
	
	// config.contentsLangDirection = 'rtl';
	
	config.skin = 'moono';
	
	// config.skin = 'kama';
	
	config.toolbar = 'full';
	
	// config.toolbar = 'Custom';

};


function CheckAuthentication()
{
	// WARNING : DO NOT simply return “true”. By doing so, you are allowing
	// “anyone” to upload and list the files in your server. You must implement
	// some kind of session validation here. Even something very simple as…
	// return isset($_SESSION['IsAuthorized']) && $_SESSION['IsAuthorized'];
	// … where $_SESSION['IsAuthorized'] is set to “true” as soon as the
	// user logs in your system. To be able to use session variables don’t
	// forget to add session_start() at the top of this file.
	//return false;
	return true;
}