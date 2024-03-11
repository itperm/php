<?php

session_start();

$p = $_GET['p'];
if ($p == "") {$p = "37";}

$HR = getenv('HTTP_REFERER');
$SR = "i.ru";
$SR1 = "80agdmdbbsf1acpf9a9cxic.xn--p1ai";
$hacker = "0";
if (!mb_eregi($SR,$HR) AND !mb_eregi($SR1,$HR)) {
  $hacker = "1";
}

if ($p >= "10000" AND $p <= "90000" AND $hacker == "0") {
  $fn = "qknfw/ishbz/f".$p.".jpg";
  $f = fopen($fn, "r");
  $s1 = fread($f, filesize($fn));
  fclose($f);
  echo $s1;
  exit;
}

//if ($p >= "120001" AND $p <= "170420") {
//  $fn = "qknfw/ishbz/f".$p.".jpg";
//  $f = fopen($fn, "r");
//  $s1 = fread($f, filesize($fn));
//  fclose($f);
//  echo $s1;
//  exit;
//}

$fn = "qknfw/hpsmr/menu.htm";
$f = fopen($fn, "r");
$s1 = fread($f, filesize($fn));
fclose($f);

$fn = "qknfw/hpsmr/keywords.htm";
$f = fopen($fn, "r");
$s2 = fread($f, filesize($fn));
fclose($f);

if ($p == "37") {
  $fn = "qknfw/hpsmr/about37.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "701" OR
   ($p >= "710" AND $p <= "723")) {
  $fn = "qknfw/hpsmr/mater".$p.".htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}



if ($p == "702") {
  $fn = "qknfw/hpsmr/zakaz702.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "703") {
  $fn = "qknfw/hpsmr/otzyv703.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "704") {
  $fn = "qknfw/hpsmr/contact704.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "705") {
  $fn = "qknfw/hpsmr/price705.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}




if ($p == "36") {
  $fn = "qknfw/hpsmr/vodos36.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "603") {
  $fn = "qknfw/hpsmr/rezka603_31.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}



if ($p == "38") {
  $fn = "qknfw/hpsmr/futer38.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "801") {
  $fn = "qknfw/hpsmr/futer801.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "802") {
  $fn = "qknfw/hpsmr/futer802.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "803") {
  $fn = "qknfw/hpsmr/futer803.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}




if ($p == "501") {
  $fn = "qknfw/hpsmr/rez501.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "502") {
  $fn = "qknfw/hpsmr/bent502.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}



if ($p == "34") {
  $fn = "qknfw/hpsmr/vosst34.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "401") {
  $fn = "qknfw/hpsmr/torkr401.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}



if ($p == "33") {
  $fn = "qknfw/hpsmr/inject33.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}



if ($p == "32") {
  $fn = "qknfw/hpsmr/usil32.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "201") {
  $fn = "qknfw/hpsmr/zdan201.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "202") {
  $fn = "qknfw/hpsmr/nes202.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "203") {
  $fn = "qknfw/hpsmr/sgus203.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if ($p == "204") {
  $fn = "qknfw/hpsmr/fund204.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  $str = str_replace("&menu",$s1,$str);
  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}


?>