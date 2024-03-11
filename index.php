<?php

session_start();

include_once 'simplehtmldom/simple_html_dom.php';

function curlGetPage ($url, $referer) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_USERAGENT, '');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_REFERER, $referer);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;
}

function pReadBible ($s1) {
  if ((strlen($s1) == 7) and (substr($s1, -1) == 'b')) {
    $s1 = substr($s1,0,	6);
    if (ctype_digit($s1)) { return true; }
  }
  return false;
}

function pDaily($s1) {
  if ((strlen($s1) == 7) and (substr($s1, -1) == 'd')) {
    $s1 = substr($s1,0,	6);
    if (ctype_digit($s1)) { return true; }
  }
  return false;
}

function pSaint($s1) {
  if ((strlen($s1) == 7) and (substr($s1, -1) == 's')) {
    $s1 = substr($s1,0,	6);
    if (ctype_digit($s1)) { return true; }
  }
  return false;
}

function pText($s1) {
  if ((strlen($s1) == 7) and (substr($s1, -1) == 't')) {
    $s1 = substr($s1,0,	6);
    if (ctype_digit($s1)) { return true; }
  }
  return false;
}

function pProp($s1) {
  if ((strlen($s1) == 7) and (substr($s1, -1) == 'p')) {
    $s1 = substr($s1,0,	6);
    if (ctype_digit($s1)) { return true; }
  }
  return false;
}

function pNast($s1) {
  if ((strlen($s1) == 9) and (substr($s1, -1) == 'n')) {
    $s1 = substr($s1,0,	8);
    if (ctype_digit($s1)) { return true; }
  }
  return false;
}

function DelTag($t, $s) {
  $out = '';
  $dtBeg = strpos($s, $t);
  if ($dtBeg === false) { return $s; } 
  if ($dtBeg > 0) { $out = substr($s, 0, $dtBeg); }
  $out2 = substr($s, $dtBeg);
  $dtEnd = strpos($out2, '>'); 
  if ($dtEnd === false) { return $s; }
  if ($dtEnd == strlen($out2)-1) { return $out; }
  $out2 = substr($out2, $dtEnd+1);
  return $out . $out2;
}

function TagsOff ($in) {
  $in = (string)$in;
   $i1 = strpos($in, '<button');
   $i2 = strpos($in, '</button>');
   if (($i1 !== false) and ($i2 !== false)) { $in = substr($in, 0, $i1) . substr($in, $i2+9); }
  $cont = true;
  $out = '';
  for($i=0; $i < strlen($in); $i++) {
     if ($in[$i] == '<') { $cont = false; continue;}
     if ($in[$i] == '>') { $cont = true; continue;}
     if ($cont) { $out = $out . $in[$i]; }
  }
  return $out;
}

function ZachaloOff ($in) {
  $in = (string)$in;
  $cont = true;
  $out = '';
  $i1 = strpos($in, utf('[Зач.'));
  if ($i1 === false) { return $in; }
  for($i=0; $i < strlen($in); $i++) {
     if ($i == $i1) { $cont = false; continue;}
     if ($in[$i] == ']') { $cont = true; continue;}
     if ($cont) { $out = $out . $in[$i]; }
  }
  return $out;
}

function GetAudio ($in) {
  $in = (string)$in;
  $i1 = strpos($in, 'href');
  if ($i1 === false) { return ''; }
  $b1 = false;
  $out = '';
  for($i=$i1; $i < strlen($in); $i++) {
     if (($in[$i] == '"') and !$b1) { $b1 = true; continue;}
     if (($in[$i] == '"') and $b1) { return $out;}
     if ($b1) { $out = $out . $in[$i]; }
  }
  return '';
}

function Encode($uA) {
  $oses = array ( 'iPhone', 'Windows', 'Android' );
  foreach ($oses as $ose) {
    $a = strpos($uA, $ose);
      if( $a !== false) { return true; }
  }
  return false;
}

function WriteLog($f, $s) {
  $today = date("d-m-Y H:i:s");
  $f = 'sec/'.$f.'.txt';
  $fn = fopen($f, "a");
  fwrite($fn, $today.' '.$s.PHP_EOL);
  fclose($fn);
}

function utf($s) {
  return mb_convert_encoding($s, 'UTF-8', 'windows-1251');
}

function h1zpt($s) {
  $out = '';
  foreach (str_split($s) as $char) {
     $out = $out . $char;
     if ( $char == ',' ) { $out = $out . '&nbsp';}
  }
  return $out;
}

function NormDate($s) {
  return substr($s,0,2) . '.' . substr($s,2,2) . '.20' . substr($s,4,2);
}

function ParseUdarTropar($in) {
  $in = (string)$in;
  $out = '';
  for($i=0; $i < strlen($in); $i++) {
    if ($in[$i] !== '?') {
      $out = $out . $in[$i];
    } else {
      $out = $out . '&#769;';
    }
  }
  return $out;
}

function ColorTropar($in) {
  $trkons = array ( 'Тропарь', 'Кондак', 'Молитва', 'Икос', 'Светилен' );
  foreach ($trkons as $trkon) {
    $in = (string)$in;
    $in1 = utf($in);
    $out = '';
    $trkon = utf($trkon);
    $t = strpos($in1, $trkon);
    if ($t !== false) {
      if ($t !== 0) { $out = substr($in1,0,$t); }
      $out = $out . '<span style="color: red">' . $trkon . '</span>';
      if (($t+strlen($trkon)) !== strlen($in1)) { $out = $out . substr($in1,$t+strlen($trkon)); }
      return $out;
    }
  }

    $trkon = utf('Перевод:');
    $t = strpos($in1, $trkon);
    if ($t !== false) {
      if ($t === 0) {
        $out = '<span style="color: blue">' . $trkon . '</span>';
        if (($t+strlen($trkon)) !== strlen($in1)) { $out = $out . substr($in1,$t+strlen($trkon)); }
        return $out;
      }
    }

  return $in;
}

$os = $_SERVER['HTTP_USER_AGENT'];
$qs = $_SERVER['QUERY_STRING'];
WriteLog('log', '"' . $qs . '" ' . $os);

if (!isset($_GET['p'])) { $p = 37; }
else { $p = $_GET['p']; }


$HR = getenv('HTTP_REFERER');
$SR = "e.ru";
$SR1 = "80agdmdbbsf1acpf9a9cxic.xn--p1ai";
$hacker = false;
if (!mb_eregi($SR,$HR) and !mb_eregi($SR1,$HR)) {
  $hacker = true;
}

if ($p == "37") {
  echo utf('Сайт на стадии разработки'); exit;

  $fn = "sec/main37.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
//  $str = str_replace("&menu",$s1,$str);
//  $str = str_replace("&keywords",$s2,$str);
  fclose($f);
  echo $str;
  exit;
}

if (pText($p)) {
  $srv = "localhost";
  $db = "u2_hupb";
  $user = "u2_a";
  $pass = "s";
  $conn = new mysqli($srv, $user, $pass, $db);
  if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
  }
  $res = mysqli_query($conn,"create table if not exists Gadget (
                               ID int not null auto_increment,
                               PRIMARY KEY(ID),
                               NAME varchar(200) )");
  if( !empty($res) ) {
    $res2 = mysqli_query($conn, "insert into Gadget (ID, NAME) values ( NULL, '" . $os . "')");
    $sql = 'select * from Gadget';
    $str = '';
    if ( $res = $conn->query($sql) ) {
      foreach ( $res as $row ) {
        $str = $str . $row["ID"] . '. ' . $row["NAME"] . PHP_EOL;
      }
    }
  }

  echo $str;
  exit;
}

if (pReadBible($p)) {
  $fn = "sec/bible.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  fclose($f);
  if (Encode($os)) { $str = utf($str); }
   $fn = "sec/" . substr($p,4,2) . "bible.txt";
   $f = fopen($fn, "r");
   $str1 = fread($f, filesize($fn));
   fclose($f);
   $beg = strpos($str1, "&" . $p . "ible");
   $end = strpos($str1, "&/" . $p . "ible");
   if ($beg >= 0 and $end > 0) {
     $content = substr($str1, $beg + 12, $end - $beg - 12);
   }
   if (Encode($os)) { $content = utf($content); }
     $lines = preg_split('/\\r\\n?|\\n/', $content);
     $content = '<div class="b2d0">' . utf('ЧТЕНИЕ БИБЛИИ ЗА ГОД' . '</div>') . 
       '<div class="b2d01">' . NormDate($p) . '</div><div class="b2d02">';
     $ref = '';
     $ri = 0;
     foreach ($lines as $char) { 
       $http = strpos($char, 'http');
       if ($http !== false) {$ref = $char; continue;};
       if ($ref === '') {
         $content = $content . $char . '<br>' . PHP_EOL;
       }
       else {
         $ri += 1;
         $bible = strpos($ref, 'https://azbyka.ru/biblia/?');
         if ($bible !== false) { //текст Библии
           $page = curlGetPage($ref, '');
           $html = str_get_html($page);
           $h1 = h1zpt(TagsOff($html->find('h1', 0)));
           $lang = TagsOff($html->find('.lang-label__title', 0));
           $audio = GetAudio($html->find('.play-audio-btn', 0));
           $sacr_n = '';
           foreach ($html->find('.verse-fullnumber') as $sacr) { $sacr_n = $sacr_n . TagsOff($sacr) . '<br>'; }
           $sacral = '';
           foreach ($html->find('.verse') as $sacr) { $sacral = $sacral . ZachaloOff(TagsOff($sacr)) . '<br>'; }
           $bri = "b2r".$ri;
           $content = $content .
             '<div class="' . $bri . 'd1">'. $h1 . '</div>' . PHP_EOL . 
           //  '<div class="' . $bri . 'd2">'. utf('Язык:&nbsp') . $lang . '</div>' . PHP_EOL .
             '<div><label class="' . $bri . 'd3" for="_' . $ri . '1">' . utf('СЛУШАТЬ') . '</label>' . PHP_EOL .
              '<input id="_' . $ri . '1" type="checkbox" name="_' . $ri . '1" onclick="PlayPause(' . $ri . ')">' . PHP_EOL .
               '<div class="' . $bri . 'd4">' . '<audio id="au' . $ri . '" src="' . $audio . '" controls></audio>' . '</div>' . PHP_EOL .
             '</div>' . PHP_EOL .
             '<div><label class="' . $bri . 'd5" for="_' . $ri . '2">' . utf('ЧИТАТЬ') . '</label>' . PHP_EOL .
              '<input id="_' . $ri . '2" type="checkbox">' . PHP_EOL .
                '<div class="' . $bri . 'd6">' . $sacral . '</div>'. PHP_EOL .
             '</div>' . PHP_EOL;
         } //--текст Библии
         else { //текст толкования
           $content = $content . '<a href="' . $ref . '">' . $char .'</a><br>';
         } //--текст толкования
         $ref = '';
       }
     }
     $content = $content . '</div>';

  $str = str_replace("&cssid", date('ymdhis'), $str);
  $str = str_replace("&date", NormDate($p), $str);
  $str = str_replace("&content", $content, $str);
  echo $str;
  exit;
}

if (pDaily($p)) {
  $fn = "sec/daily.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  fclose($f);
  if (Encode($os)) { $str = utf($str); }
   $fn = "sec/" . substr($p,4,2) . "daily.txt";
   $f = fopen($fn, "r");
   $str1 = fread($f, filesize($fn));
   fclose($f);
  $beg = strpos($str1, "&" . $p . "aily");
  $end = strpos($str1, "&/" . $p . "aily");
  if ($beg >= 0 and $end > 0) {
    $content = substr($str1, $beg + 12, $end - $beg - 12);
  }
  if (Encode($os)) { $content = utf($content); }
  $lines = preg_split('/\\r\\n?|\\n/', $content);
  $content = '<div class="b3d0">' . utf('ЧТЕНИЯ ДНЯ' . '</div>') . 
    '<div class="b3d01">' . NormDate($p) . '</div><div class="b3d02">';
  $ap_sacral = false;
  $ap_tolk = false;
  $ev_sacral = false;
  $ev_tolk = false;
  foreach ($lines as $char) { 
    $ap = strpos($char, utf('Апостольское чтение'));
    $ev = strpos($char, utf('Евангельское чтение'));
    if ($ap !== false) {
      $content = $content . '<div class="b3d1">' . $char . '</div><br><div class="b3d2">' . PHP_EOL;
      $ap_sacral = true;
      continue;
    }
    if ($ap_sacral) {
      if ($char == '') {
        $content = $content . '</div><div class="b3d3"><br>' . PHP_EOL;
        $ap_sacral = false;
        $ap_tolk = true;
      } else {
        $content = $content . $char . '<br>' . PHP_EOL;
      }
      continue;
    }
    if ($ap_tolk) {
      if ($char == '') {
        $content = $content . '</div><br>' . PHP_EOL;
        $ap_tolk = false;
      } else {
        $content = $content . $char . '<br>' . PHP_EOL;
      }
      continue;
    }

    if ($ev !== false) {
      $content = $content . '<div class="b3d4">' . $char . '</div><br><div class="b3d5">' . PHP_EOL;
      $ev_sacral = true;
      continue;
    }
    if ($ev_sacral) {
      if ($char == '') {
        $content = $content . '</div><div class="b3d6"><br>' . PHP_EOL;
        $ev_sacral = false;
        $ev_tolk = true;
      } else {
        $content = $content . $char . '<br>' . PHP_EOL;
      }
      continue;
    }
    if ($ev_tolk) {
      if ($char == '') {
        $content = $content . '</div><br>' . PHP_EOL;
        $ev_tolk = false;
      } else {
        $content = $content . $char . '<br>' . PHP_EOL;
      }
      continue;
    }

    $content = $content . $char . '<br>' . PHP_EOL;

  }

  $content = $content . '</div>';

  $str = str_replace("&cssid", date('ymdhis'), $str);
  $str = str_replace("&date", NormDate($p), $str);
  $str = str_replace("&content", $content, $str);
  echo $str;
  exit;
}


if (pSaint($p)) {
  $fn = "sec/saint.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  fclose($f);
  if (Encode($os)) { $str = utf($str); }
   $fn = "sec/" . substr($p,4,2) . "rus.txt";
   $f = fopen($fn, "r");
   $rus = fread($f, filesize($fn));
   fclose($f);
  $fn = "sec/" . substr($p,4,2) . "saint.txt";
  $f = fopen($fn, "r");
  $str1 = fread($f, filesize($fn));
  fclose($f);
  $beg = strpos($str1, "&" . $p . "aint");
  $end = strpos($str1, "&/" . $p . "aint");
  if ($beg >= 0 and $end > 0) {
    $content = substr($str1, $beg + 13, $end - $beg - 13);
  } else { $content = ''; }
  if (Encode($os)) { $content = utf($content); }
  $lines = preg_split('/\\r\\n?|\\n/', $content);
  $content = '<div class="b4d0">' . utf('Молитва о Святой Руси') . '</div>' . 
     '<div class="b4d1">' . utf($rus) . '</div><br><br>';
  $sname = utf('Молитва о Святой Руси');
  $UdarTropar = false;
  foreach ($lines as $char) { 
    $sname = strpos($char, '&name');
    if ($sname !== false) {
      $content = '<div class="b4d00">' . substr($char, $sname + 5) . '</div><br>' . PHP_EOL . $content;
      continue;
    } else {
      $sname = utf('Молитва о Святой Руси');
    }
    $pray = strpos($char, '&pray');
    if ($pray !== false) {
      $content = $content . '<div class="b4d2">' . substr($char, $pray + 5) . '</div><br><div class="b4d3">' . PHP_EOL;
      continue;
    }

      if ($char === '&tropar') { $UdarTropar = true; continue; }
      if ($char === '&/tropar') { $UdarTropar = false; continue; }
      if ($UdarTropar) {
        $content = $content . ParseUdarTropar($char) . '<br>' . PHP_EOL;
        continue;
      }

    if (($char === '&date') or ($char === '&/date')
      or ($char === '&history') or ($char === '&/history')) {
      continue;
    }
    else {
      $content = $content . $char . '<br>' . PHP_EOL;
    }

  }

  $content = $content . '</div>' . PHP_EOL;

  $str = str_replace("&cssid", date('ymdhis'), $str);
  $str = str_replace("&saint", $sname, $str);
  $str = str_replace("&content", $content, $str);
  echo $str;
  exit;
}


if (pProp($p)) {
  $fn = "sec/prop.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  fclose($f);
  if (Encode($os)) { $str = utf($str); }
  $fn = "sec/" . substr($p,4,2) . "prop.txt";
  $f = fopen($fn, "r");
  $str1 = fread($f, filesize($fn));
  fclose($f);
  $beg = strpos($str1, "&" . $p . "rop");
  $end = strpos($str1, "&/" . $p . "rop");
  if ($beg >= 0 and $end > 0) {
    $content = substr($str1, $beg + 11, $end - $beg - 11);
  } else { $content = ''; }
  if (Encode($os)) { $content = utf($content); }
  $lines = preg_split('/\\r\\n?|\\n/', $content);
  $content = '';
  $sname = '';
  foreach ($lines as $char) { 
    $sname = strpos($char, '&name');
    if ($sname !== false) {
      $content = '<div class="b4d00">' . substr($char, $sname + 5) . '</div><br><div class="b4d3">' . PHP_EOL;
      continue;
    }
    else {
      $content = $content . $char . '<br>' . PHP_EOL;
    }

  }

  $content = $content . '</div>' . PHP_EOL;

  $str = str_replace("&cssid", date('ymdhis'), $str);
  $str = str_replace("&date", NormDate($p), $str);
  $str = str_replace("&saint", $sname, $str);
  $str = str_replace("&content", $content, $str);
  echo $str;
  exit;

}


if (pNast($p)) {
  $fn = "sec/nast.htm";
  $f = fopen($fn, "r");
  $str = fread($f, filesize($fn));
  fclose($f);
  if (Encode($os)) { $str = utf($str); }
  $fn = "sec/" . substr($p,4,2) . "nast.txt";
  $f = fopen($fn, "r");
  $str1 = fread($f, filesize($fn));
  fclose($f);
  $beg = strpos($str1, "&" . $p . "ast");
  $end = strpos($str1, "&/" . $p . "ast");
  if ($beg >= 0 and $end > 0) {
    $content = substr($str1, $beg + 11, $end - $beg - 11);
  } else { $content = ''; }
  if (Encode($os)) { $content = utf($content); }
  $lines = preg_split('/\\r\\n?|\\n/', $content);
  $content = '';
  $sname = '';
  foreach ($lines as $char) { 
    $sname = strpos($char, '&name');
    if ($sname !== false) {
      $content = '<div class="b4d00">' . substr($char, $sname + 5) . '</div><br><div class="b4d3">' . PHP_EOL;
      continue;
    }
    else {
      $content = $content . $char . '<br>' . PHP_EOL;
    }

  }

  $content = $content . '</div>' . PHP_EOL;

  $str = str_replace("&cssid", date('ymdhis'), $str);
  $str = str_replace("&date", NormDate($p), $str);
  $str = str_replace("&saint", $sname, $str);
  $str = str_replace("&content", $content, $str);
  echo $str;
  exit;

}


?>