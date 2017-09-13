<?php
/**
 * Plugin Name: 2P Quicklink
 * Plugin URI: http://matthers.ro/2p-quicklink/
 * Description: Pluginul scaneaza link-urile din postari si le inlocuieste cu link-uri de afiliere 2Parale catre acea pagina
 * Version: 0.23	
 * Author: Razvan Manole
 * Author URI: http://matthers.ro/
 * License: GPLv2 or later.
 */
add_action('admin_menu', 'doipql');

function doipql(){
        add_menu_page( '2P Quicklink', '2P Quicklink', 'manage_options', '2p-quicklink', 'admin_setari_doipql' );
}
 function admin_setari_doipql(){
//$affcode="bf60f816d";
$codaff=get_option("doipql-affcode");
if (empty($_POST['codaff'])) {
$codaff=get_option("doipql-affcode");
     }else{
$codaff=$_POST["codaff"];
}
$option="doipql-affcode";
$value=$codaff;
update_option( $option, $value );

echo "<h1>2P Quicklink</h1><hr><br>";
echo "<h2>Codul tau de afiliere este :  ".$codaff."</h2>";
echo "<br>Pentru a schimba codul de afiliere, introdu noul cod in formularul de mai jos:<br>";
?>
<form method="post">
Cod de afiliere nou: <input type="text" name="codaff" maxlength="12" pattern="[A-Z|a-z|0-9]{2,12}" title="Pot fi introduse doar caractere alfanumerice"> <br><br>
<input type="submit">
</form>
<?
echo "<br><br><hr><br>	Pentru detalii complete privind modul de functionare, eventuale bug-uri sau feature-uri dorite, click <b><a href=\"http://matthers.ro/2p-quicklink/\">aici</a></b>";
echo "<br>Creat de <b><a href=\"http://matthers.ro/\">Matthers.ro</a></b><br><br><hr>";
?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<?
}
function replace_links_doipql($data , $postarr){ 
$content_vechi=wp_unslash($data['post_content']);
$urls = wp_extract_urls( $content_vechi );
$url_arr=array();
$url_fin_arr=array();

foreach($urls as $urls) {
array_push($url_arr, $urls);
$pbk="https://www.2parale.ro/affiliates/bookmarklet.js?url=";
//$cod="bf60f816d";
//$cod=file_get_contents('../affcode.txt');
$cod=get_option("doipql-affcode");
$book=$pbk.$urls."&unique_code=".$cod."&buster=".rand(1,99999);
$string= file_get_contents($book);
if (strpos($string,'Sorry') !== false)
{
$url_final=$urls;
}
else
{
$start="none;\'>";
$end="<\/textarea>";
$startpos = strpos($string, $start) + strlen($start);
if (strpos($string, $start) !== false) {
$endpos = strpos($string, $end, $startpos);
if (strpos($string, $end, $startpos) !== false) {
$url_final= substr($string, $startpos, $endpos - $startpos);
}
}
}
array_push($url_fin_arr, $url_final);
}

$data['post_content']=str_replace($url_arr,$url_fin_arr,$content_vechi);
return $data;
}
add_filter( 'wp_insert_post_data', 'replace_links_doipql', '99', 2 );