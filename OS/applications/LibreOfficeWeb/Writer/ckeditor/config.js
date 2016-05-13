/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	 config.language = 'it';
	 config.skin = 'moonocolor';
	 config.toolbarCanCollapse = true;
	 //config.uiColor = '#AADC6E';

	config.language_list = [ 'it:Italian', 'he:Hebrew:rtl', 'pt:Portuguese', 'de:German', 'ar:Arabic', 'es:Spanish', 'fr:France', 'ru:Russian', 'zh:Cina' ];

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

	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'save', 'preview', 'print', 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'replace', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'ckwebspeech'}, //Add the CKWebSpeech button on the toolbar
		{ name: 'about', groups: [ 'about' ] }
	];

//config.extraPlugins = 'autosave';
//config.autosave_SaveKey = 'autosaveKey';
//config.autosave_NotOlderThen = 1440;
//config.autosave_saveOnDestroy = false;
//config.autosave_saveDetectionSelectors = "a[href^='javascript:__doPostBack'][id*='Save'],a[id*='Cancel']";
//config.extraPlugins = 'notification';

};

