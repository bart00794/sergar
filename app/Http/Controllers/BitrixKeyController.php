<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BitrixKeyController extends Controller
{
	private function BitrixExpireDate($date, $key){
		$outCode = '';
		$x = 0;
		for ($i = 0; $i < strlen($date); $i++) {
			$outCode .= chr(ord($date[$i]) ^ ord($key[$x]));
			if ($x == strlen($key) - 1)
				$x = 0;
			else
				$x = $x + 1;
		}
		return $outCode;
	}
	var $key1 = 'DO_NOT_STEAL_OUR_BUS'; // OLDSITEEXPIREDATE
	var $key2 = 'thRH4u67fhw87V7Hyr12Hwy0rFr'; // SITEEXPIREDATE

	function print(){
		$nowDate = date('mdY', time() + 60*60*24*30);
		$codeDate1 = 'XX'.$nowDate[3].$nowDate[7].'XX'.$nowDate[0].$nowDate[5].'X'.$nowDate[2].'XX'.$nowDate[4].'X'.$nowDate[6].'X'.$nowDate[1].'X'; // OLDSITEEXPIREDATE
		$codeDate2 = 'X'.$nowDate[2].'X'.$nowDate[1].'XX'.$nowDate[0].$nowDate[6].'XX'.$nowDate[4].'X'.$nowDate[7].'X'.$nowDate[3].'XXX'.$nowDate[5]; // SITEEXPIREDATE
		echo '&lt;?define("TEMPORARY_CACHE", "';
		echo $outCode1 = base64_encode($this->BitrixExpireDate($codeDate1, $this->key1)); // OLDSITEEXPIREDATE
		echo '");?&gt;';
		echo '<br>';
		echo "UPDATE  `b_option` SET  `VALUE` =  '";
		echo $outCode2 = base64_encode($this->BitrixExpireDate($codeDate2, $this->key2)); // SITEEXPIREDATE
		echo "' WHERE  `NAME` =  'admin_passwordh';";

		echo "<br><br><br>";

		echo <<<END
&lt;?require(\$_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");<br />\$APPLICATION-&gt;RestartBuffer();<br />?&gt;<br />&lt;?<br />CModule::IncludeModule("iblock");<br />\$res = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=&gt;"1","SECTION_ID"=&gt;"1"));<br />while(\$ob = \$res-&gt;GetNextElement())<br />{<br /> \$arFields = \$ob-&gt;GetFields();<br /> print_r(\$arFields);<br />}<br />?&gt; <br />&lt;?die();?&gt;
END;


	}
}
