<?php

class StringUtil {
	
	public static function is_html($string)
	{
	  return preg_match("/<[^<]+>/",$string,$m) != 0;
	}
}





?>