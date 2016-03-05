CKEditor Insert Voice to Text with CKWebSpeech Plugin
===============================

This plugin convert and insert voice to text in CKEditor.

Installation
------------

1. Clone/copy this repository contents in a new "plugins/ckwebspeech" folder in your CKEditor installation.
2. Add button in toolbar
		config.toolbarGroups = [
		...,
		...,
		{ name: 'ckwebspeech'}];
	
3. Enable the "ckwebspeech" plugin in the CKEditor configuration file (config.js):

        config.extraPlugins = 'ckwebspeech';

That's all. Speech...

4. Optionally, you may specify which culture language by default initialize:

        config.ckwebspeech = {'culture' : 'es-mx'};


License
-------

Licensed under the terms of any of the following licenses at your choice: [GPL](http://www.gnu.org/licenses/gpl.html), [LGPL](http://www.gnu.org/licenses/lgpl.html) and [MPL](http://www.mozilla.org/MPL/MPL-1.1.html).
