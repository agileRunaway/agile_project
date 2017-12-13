<?php 
    require("session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PHP and form</title>
        <style type="text/css">
            body {width: 600px; margin:10px auto; font-size:14pt}
            #content {color:ivory; background-color:DarkOliveGreen; border:2px solid #ccc; padding:20px}
            table {margin: 10px auto; border: 1px solid #ccc; width:500px; padding:10px}
            td {text-align:right; padding:5px 10px  }
            td+td {text-align: left}
            input {font-size:14pt}
        </style>
        <script language="JavaScript">
            function enable1(status)
            {
                status=!status;
                document.f1.text1.disabled = status;
                if(status==true){
                   document.f1.text1.value="";
                }       
            }
            function enable2(status)
            {
                status=!status;
                document.f1.text2.disabled = status;
                if(status==true){
                    document.f1.text2.value="";
                }
            }
            function enable3(status)
            {
                status=!status;
                document.f1.text3.disabled = status;
                if(status==true){
                    document.f1.text3.value="";
                }
            }
            function enable4(status)
            {
                status=!status;
                document.f1.text4.disabled = status;
                if(status==true){
                    document.f1.text4.value="";
                }
            }
            function enable5(status)
            {
                status=!status;
                document.f1.text5.disabled = status;
                if(status==true){
                    document.f1.text5.value="";
                }
            }
            function enable6(status)
            {
                status=!status;
                document.f1.text6.disabled = status;
                if(status==true){
                    document.f1.text6.value="";
                }
            }
        </script>
    </head>
<body onload=enable1(false),onload=enable2(false),onload=enable3(false),onload=enable4(false),onload=enable5(false),onload=enable6(false);>
    <div id="content">
    <form name=f1 method="post" action="purphase.php">
        <table>
        <tr><td>使用者名稱:</td><td><input type="text" name="user" /></td></tr>
        <tr><td>會員資格:</td><td><label><input type="radio" name="men" value="0" checked="checked" />金卡會員  7折</label>
         </td></tr>
         <tr><td></td><td>
        <label><input type="radio" name="men" value="1" />銀卡會員  8折</label>
        </td></tr>
        <tr><td></td><td>
        <label><input type="radio" name="men" value="2" />一般會員  95折</label>
        </td></tr>
        <tr><td>購買數量:</td>
        <td><label><input type="checkbox" name="wp[]" value="Java" onclick="enable1(this.checked)"/>Java入門書     $400</label></td><td><input type="text" name=text1 size="4" /></td></tr>
        <tr><td></td><td><label><input type="checkbox" name="wp[]" value="HTML5" onclick="enable2(this.checked)"/>HTML5與JavaScript $550</label></td><td><input type="text" name=text2 size="4" /></td></tr>
        <tr><td></td><td><label><input type="checkbox" name="wp[]" value="資料結構" onclick="enable3(this.checked)" />資料結構原文書   $800</label></td><td><input type="text" name=text3 size="4" /></td></tr>
        <tr><td></td><td><label><input type="checkbox" name="wp[]" value="PHP5" onclick="enable4(this.checked)"/>PHP5/MYSQL教學    $750</label></td><td><input type="text" name=text4 size="4" /></td></tr>
        <tr><td></td><td><label><input type="checkbox" name="wp[]" value="CS6" onclick="enable5(this.checked)"/>Adobe CS6教學     $1000</label></td><td><input type="text" name=text5 size="4" /></td></tr>
        <tr><td></td><td><label><input type="checkbox" name="wp[]" value="威力導演" onclick="enable6(this.checked)"/>威力導演13教學 $1200</label></td><td><input type="text" name=text6 size="4" /></td></tr>
        <tr><td colspan="2" style="text-align:center"><input type="submit" /> <input type="reset" /></td></tr>
        </table>
    </form>
    </div>
</body>
</html>