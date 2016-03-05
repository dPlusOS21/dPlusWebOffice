/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	config.language_list = [ 'he:Hebrew:rtl', 'pt:Portuguese', 'de:German', 'ar:Arabic', 'es:Spanish', 'fr:France', 'ru:Russian', 'zh:Cina' ];

	//Initializes and loads the resources CKWebSpeech
      	config.extraPlugins = 'ckwebspeech';
	/* Initializes the default language, if this line is not added by default starts with 
           English-United States (en-us) */
      	config.ckwebspeech = {'culture' : 'en-us',
                     'commandvoice' : 'command',   //trigger voice commands
                     'commands': [                 //command list
                                 {'newline': 'new line'},            //trigger to add a new line in CKEditor
                                 {'newparagraph': 'new paragraph'},  //trigger to add a new paragraph in CKEditor
                                 {'undo': 'undo'},                   //trigger to undo changes in CKEditor
                                 {'redo': 'redo'}                    //trigger to redo changes in CKEditor
                              ]
                           };

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'ckwebspeech'}, //Add the CKWebSpeech button on the toolbar
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
