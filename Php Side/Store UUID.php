<?php
// This will whitelist whoever posts to this ( basically, for testing purposes. )
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
$id =  md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT'].$_SERVER['REMOTE_ADDR']);
$database = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', replitdb_get('Whitelisted')), true );
$database[$id] = 'a';
replitdb_set('Whitelisted', json_encode($database));
echo $id;
?>
