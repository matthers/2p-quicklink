<?php
/**
 * Plugin Name: 2P Quicklink
 * Plugin URI: https://github.com/matthers/2p-quicklink
 * Description: This plugin converts all links to active co
 * Version: 0.69	
 * Author: Razvan Manole
 * Author URI: http://razvan.manole.ro/
 * License: GPLv2 or later.
 */
 
add_action('admin_menu', 'doipql');

function doipql(){
        add_menu_page( '2P Quicklink', '2P Quicklink', 'manage_options', '2p-quicklink', 'admin_setari_doipql' );
}
 function admin_setari_doipql(){
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
echo "<h2>Token-ul tau de afiliere este :  ".$codaff."</h2>";
echo "<br>Pentru a schimba Token-ul de afiliere, introdu noul token in formularul de mai jos:<br>";
?>
<form method="post">
Cod de afiliere nou: <input type="text" name="codaff" maxlength="35"  title="Pot fi introduse doar caractere alfanumerice"> <br><br>
<input type="submit">
</form>
<?
echo "<br><br><hr><br>	Pentru detalii complete privind modul de functionare, eventuale bug-uri sau feature-uri dorite, click <b><a href=\"http://razvan.manole.ro/\">aici</a></b></b>";
echo "<br>Creat de <b><a href=\"http://razvan.manole.ro/\">Razvan Manole</a></b><br><br><hr>";
?>
<?
}
function replace_links_doipql($data , $postarr){ 
$content_vechi=wp_unslash($data['post_content']);
$urls = wp_extract_urls( $content_vechi );
$url_arr=array();
$url_fin_arr=array();

foreach($urls as $urls) {
array_push($url_arr, $urls);
//Calling the API to transform the link

$pbk="https://api.2performant.com/public/bookmarklet.json?redirect_to=";
$cod=get_option("doipql-affcode");
$book=$pbk.$urls."&buster=".rand(1,99999)."&token=".$cod;
$string= file_get_contents($book);
if (strpos($string,'errors') !== false)
{
$url_final=$urls;
}
else
{
$obj = json_decode($string);
$url_final = $obj->url; 


}
array_push($url_fin_arr, $url_final);
}

$data['post_content']=str_replace($url_arr,$url_fin_arr,$content_vechi);
return $data;
}
add_filter( 'wp_insert_post_data', 'replace_links_doipql', '99', 2 );
