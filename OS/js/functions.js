
function CodeEditor(){
 var winEditor2 = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " Code Editor", width:'500', height:300, top: 0, left:0}); 
//// winEditor2.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/editor-js/editor.htm' ></iframe>");
//   winEditor2.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/editor/editor.php' ></iframe>");
     winEditor2.setURL('applications/editor/editor.php');
     winEditor2.setStatusBar("Code Editor");
//     winEditor2.showCenter();
     winEditor2.show();    
}

function FormEditor(){
    var winfck = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " Form Editor", width:'500', height:300, top: 0, left:0}); 
//    winfck.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/ckeditor/_samples/php/ckeditor.php' ></iframe>");
    winfck.setURL('applications/ckeditor/_samples/php/ckeditor.php');
    winfck.setStatusBar("Form Editor");
//    winfck.showCenter();
    winfck.show();    
}

function shell(){
    var winshell = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " SHELL", width:'500', height:300, top: 0, left:0}); 
//    winshell.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/ajaxphpterm/index.php' ></iframe>");
    winshell.setURL('applications/ajaxphpterm/index.php');
    winshell.setStatusBar("Terminal - Shell");
//    winshell.showCenter();
    winshell.show();    
}

function ftp(){
    var winftp = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " FTP window", width:500, height:300, top: 0, left:0}); 
//    winftp.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/FTP/index.php' ></iframe>");
    winftp.setURL('applications/FTP/index.php');
    winftp.setStatusBar("FTP");
//    winftp.showCenter();
    winftp.show();    
}

function file(){
    var winfile = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " Files Manager", width:300, height:600, top: 0, left:0}); 
//    winfile.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/php_file_tree/demo.php' ></iframe>");
    winfile.setURL('applications/php_file_tree/demo.php');
    winfile.setStatusBar("Files Manager");
//    winfile.showCenter();
    winfile.show();    
}

function file2(){
    var winfile2 = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " Files Manager", width:500, height:300, top: 0, left:0}); 
//    winfile2.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/ajaxexplorer/index.php' ></iframe>");
    winfile2.setURL('applications/ajaxexplorer/index.php');
    winfile2.setStatusBar("Files Manager");
//    winfile2.showCenter();
    winfile2.show();    
}

function sqldesign(){
    var winsql = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " SQL Designer", width:500, height:300, top: 0, left:0}); 
//    winsql.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/wwwsqldesigner-2.3.2/index.html' ></iframe>");
    winsql.setURL('applications/wwwsqldesigner-2.7/index.html');
    winsql.setStatusBar("SQL Designer");
//    winsql.showCenter();
    winsql.show();    
}

function todo(){
    var wintodo = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " TO DO", width:500, height:300, top: 0, left:0}); 
//    wintodo.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/todo/index.php' ></iframe>");
    wintodo.setURL('applications/todo/index.php');
    wintodo.setStatusBar("To Do");
//    wintodo.showCenter();
    wintodo.show();    
}

function phpsysinfo(){
    var winphpsysinfo = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " PhpSysInfo", width:500, height:300, top: 0, left:0}); 
//    winphpsysinfo.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/system/phpsysinfo/index.php' ></iframe>");
    winphpsysinfo.setURL('applications/system/phpsysinfo/index.php');
    winphpsysinfo.setStatusBar("PhP Sys Info");
//    winphpsysinfo.showCenter();
    winphpsysinfo.show();    
}

function PhpInfo(){
    var winPhpInfo = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " PhpInfo", width:500, height:300, top: 0, left:0}); 
//    winPhpInfo.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/system/phpinfo/phpinfo.php' ></iframe>");
    winPhpInfo.setURL('applications/system/phpinfo/phpinfo.php');
    winPhpInfo.setStatusBar("PhP Info");
//    winPhpInfo.showCenter();
    winPhpInfo.show();    
}


function PhpSecInfo(){
    var winPhpSecInfo = new Window({className: "mac_os_x", blurClassName: "blur_os_x", title: " PhpSecInfo", width:500, height:300, top: 0, left:0}); 
//    winPhpSecInfo.getContent().update("<iframe STYLE='width:100%; height:100%' src='applications/system/PhpSecInfo/InitTest.php' ></iframe>");
    winPhpSecInfo.setURL('applications/system/PhpSecInfo/InitTest.php');
    winPhpSecInfo.setStatusBar("PhpSecInfo");
//    winPhpSecInfo.showCenter();
    winPhpSecInfo.show();    
}

