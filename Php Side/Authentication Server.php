<?php
function replitdb_set($key, $value) {
	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-Type: application/x-www-form-urlencoded',
	        'content' => "$key=$value"
	    )
	);
	$replitdb_url = getenv("REPLIT_DB_URL");
	return file_get_contents($replitdb_url, false, stream_context_create($opts));
}

function replitdb_get($key) {
	$replitdb_url = getenv("REPLIT_DB_URL");
	return file_get_contents("$replitdb_url/$key");
}

function replitdb_delete($key) {
	$opts = array('http' =>
	    array(
	        'method'  => 'DELETE'
	    )
	);
	$replitdb_url = getenv("REPLIT_DB_URL");
	return file_get_contents("$replitdb_url/$key", false, stream_context_create($opts));
}
function random_salt($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// computer Id
$randomphrases = array(
  'YWZkY2ViOWI5Mzg3ZGU5ZjYzYzU1YWQ2MjE1OGE0ZjhuUGdqYndRbTVPWXdB',
  'RJIowjoidjawjudj(*IWJdw1iIJOKD9iqojhdiuKHUijhquidJHS*UIdqhue',
  'I(WODJ(UIOQHDUIsjhdUIWHDUIhuiajKDHUWIQJHDUIShduiwJHD*UIgsh8y',
  'W*UDJ(SIOdh9uiqwhUISDH9uqwhdusaihcbnxIUWYH(*UOIhuisdh(AOWUej',
  'IWUd9iosad8)(IUWJD98uhd9o9iudjas(*SAydh893u2h8siuh98Y@*(1238',
  'W(*D9s8uahd98IYHSDuijh289SY*(7hASduy9287y8UISd981y((9y321)wi',
  ')(UJioahIUSHduis)(7))8dyhausiu9ha(*89a*&UhuakBSuyBuywg8U&*7t',
  'I(dh98siou98aIOSHjduihgu9w892&@7187&*27uhS&UD918ys8uaihdiwgw',
  'S(0ud0saiudj98uw98iodjauihd9wqhwd9usahD*(Dy71289hs7UDh98syuS',
  'I(D)u829i*(&89i2wu8JS79dy79&*#h398u8sayu89dY&*UY#$79eudyh7wU',
  'SU(d993u89USAJ(*y3d289y(*YS&*udg8yuiwhbad7SU(Yd8huys7(*98yGW',
  '(U(*ISyhd892ihHS*(yh7ue*&g87hu8w7iuya8ui()O)09U7uagsuduywiag',
  'JSIduwioud)I(SOU89dij9832y9)*9sy32u4hsdy*WDY98yd(*Ssa908e92Y',
  'U*D(iowyqh98quih(S&DYquihdwui2378UY83274y7uYHS*udih9729y78yG',
  '(HUOYHUIy9w8uIOS90u97SG&D(@#9y78uS)(*@*#98gduaD8wGI&*g87uig8',
  'UI)(789w198&(Y7uihuisyhudh(78wuhdkhaiUHGJJJJ(*8(&@*7s6g^w6gd',
  'IWUDjiod89iOuj98IJ9ud8SH*(&YA*huiuHWuih*&hduiawhsuhd*S&hwaiw',
  'DJ(Wuih*&(UD98iohsu8H&*whA*SUidg8awyU*&WyduhjxdgashnGHHHydgy',
  'U*)&)9wyuSH(Uidhj928&*&23h(UISYHDj98yGH*ug92(9dsa0)(dhyAs8da',
  'JSIDIu08wu)IJw9udYh89xucj(&*^&*(U@H9u9*&S9j98yd98ue98E@82e9w',
  'dj89wau8A(I*7uw9iy7e*&WY89wuih2eyh8wsduH*UWH8uwhd8ayW&*Y&@*!',
  'SJ(*Djw982iouj08UD)Iwu80iau(*SDH98u9suIUASHD(*&y7usuiGAHUIJC'
);

shuffle($randomphrases);
$catchphrase = $randomphrases[1];
$Second = ceil(date('s') / 3) * 3;
$computerId = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT'].$_SERVER['REMOTE_ADDR']);
$database = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', replitdb_get('Whitelisted')), true );
$enhash = base64_encode(hash('sha256', ($computerId . $Second . $catchphrase)) . ' == Do not share this == ');
if (array_key_exists($computerId, $database)){
echo $enhash;
  }else{
  echo base64_encode(hash('sha256', 'you naughty little cracker' . random_salt(15)) . ' == Do not share this == '); // so like itll look just like normal but itll be a fake auth! this is for ppl that post to the server to see what it returns... theyll be really confused when the output looks real/the same!
  }
?>
