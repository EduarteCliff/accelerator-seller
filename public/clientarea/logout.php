<?php
    $bool1=setcookie("user","");
    $bool2=setcookie("pass","");
	if($bool1&&$bool2)
    	echo "success!";
	else
        echo "failed!";
?>
