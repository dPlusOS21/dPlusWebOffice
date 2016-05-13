/*
'
' html5 input library 
'
'   Name:      input.js
'   Purpose: general purpose input library   
'
'  Author:     vroby.mail@gmail.com   
'  Licence:    GPL
'
' Bugs:
'
' Todo:
'
'-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

//keyboard code

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// KEY_BACKSPACE     = 8;
// KEY_TAB           = 9;
// KEY_ENTER         = 13;
// KEY_SHIFT         = 16;
// KEY_CTRL          = 17;
// KEY_ALT           = 18;
// KEY_PAUSE/BREACK  = 19;
// KEY_CAPS_LOCK     = 20;
// KEY_ESC           = 27;
// KEY_SPACE         = 32;
// KEY_PAGE_UP       = 33;
// KEY_PAGE_DOWN     = 34;
// KEY_END           = 35;
// KEY_HOME    	     = 36;
// KEY_LEFT_ARROW    = 37;
// KEY_UP_ARROW      = 38;
// KEY_RIGHT_ARROW   = 39;
// KEY_DOWN_ARROW    = 40;
// KEY_INSERT        = 45;
// KEY_DELETE	     = 46;


// if (charCode == 91) textBox.value = "left window"; // left window
// if (charCode == 92) textBox.value = "right window"; // right window
// if (charCode == 93) textBox.value = "select key"; // select key
// if (charCode == 96) textBox.value = "numpad 0"; // numpad 0
// if (charCode == 97) textBox.value = "numpad 1"; // numpad 1
// if (charCode == 98) textBox.value = "numpad 2"; // numpad 2
// if (charCode == 99) textBox.value = "numpad 3"; // numpad 3
// if (charCode == 100) textBox.value = "numpad 4"; // numpad 4
// if (charCode == 101) textBox.value = "numpad 5"; // numpad 5
// if (charCode == 102) textBox.value = "numpad 6"; // numpad 6
// if (charCode == 103) textBox.value = "numpad 7"; // numpad 7
// if (charCode == 104) textBox.value = "numpad 8"; // numpad 8
// if (charCode == 105) textBox.value = "numpad 9"; // numpad 9
// if (charCode == 106) textBox.value = "multiply"; // multiply
// if (charCode == 107) textBox.value = "add"; // add
// if (charCode == 109) textBox.value = "subtract"; // subtract
// if (charCode == 110) textBox.value = "decimal point"; // decimal point
// if (charCode == 111) textBox.value = "divide"; // divide

// KEY_F1           = 112;
// KEY_F2           = 113;
// KEY_F3           = 114;
// KEY_F4           = 115;
// KEY_F5           = 116;
// KEY_F6           = 117;
// KEY_F7           = 118;
// KEY_F8           = 119;
// KEY_F9           = 120;
// KEY_F10          = 121;
// KEY_F11          = 122;
// KEY_F12          = 123;
// KEY_NUM_LOCK     = 144;
// KEY_SCROLL_LOCK  = 145;

// if (charCode == 186) textBox.value = ";"; // semi-colon
// if (charCode == 187) textBox.value = "="; // equal-sign
// if (charCode == 188) textBox.value = ","; // comma
// if (charCode == 189) textBox.value = "-"; // dash
// if (charCode == 190) textBox.value = "."; // period
// if (charCode == 191) textBox.value = "/"; // forward slash
// if (charCode == 192) textBox.value = "`"; // grave accent
// if (charCode == 219) textBox.value = "["; // open bracket
// if (charCode == 220) textBox.value = "\\"; // back slash
// if (charCode == 221) textBox.value = "]"; // close bracket
// if (charCode == 222) textBox.value = "'"; // single quote


var key=new Array();

//attiva tastiera
document.onkeydown = handleKeyDown;
function handleKeyDown(e) {
	//cross browser issues exist
	if(!e){ var e = window.event; };
	key[e.keyCode]=1; 
}


document.onkeyup = handleKeyUp;
function handleKeyUp(e) {
	//cross browser issues exist
	if(!e){ var e = window.event; }
if (event.shiftKey) {alert ("hai premuto SHIFT");}; 
if (event.ctrlKey) {alert ("hai premuto CTRL");}; 
if (event.altKey) {alert ("hai premuto ALT");}; 
if (event.metaKey) {alert ("hai premuto COMMAND");};
if (event.which == 13) {/*alert ("hai premuto INVIO");*/};
if (event.which == 27) {alert ("hai premuto ESC");};
if (event.which == 32) {alert ("hai premuto SPACE");};
if (event.which == 113) { help(); /* F2 */ };
if (event.which == 115) { DeskSetting(); /* F4 */ };
if (event.which == 117) {alert ("hai premuto F6");};
if (event.which == 118) {MemoryPositions(); /* F7 */ };
if (event.which == 119) {ResetAllPositions(); /* F8 */ };
if (event.which == 120) {SyncroMemoryPositions(); /* F9 */ };
if (event.ctrlKey && event.which == 65 ) {alert ("hai premuto CTRL + a");}; 
//if (event.ctrlKey && event.which == 66 ) {alert ("hai premuto CTRL + b");}; 
//if (event.ctrlKey && event.which == 67 ) {alert ("hai premuto CTRL + c");}; 
	key[e.keyCode]=0;
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------

