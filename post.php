<?php
require_once('conn.php');
if(isset($_POST['post'])) {
    $content = $_POST['post'];
    $content = str_ireplace("<div><br></div>","",$content);
    $detect_url = '#(https?|ftp|file)://[-A-Za-z0-9+&@\#/%()?=~_|$!:,.;]*[-A-Za-z0-9+&@\#/%()=~_|$]#';
    if($content != "") {
//        echo count(preg_match($detect_url,$content,$url));
        if(preg_match($detect_url,$content,$url)) {
            $content = '<div class="view">'.preg_replace($detect_url,'<a target="_blank" href="'.$url[0].'">'.$url[0].'</a>',$content).'</div>';
        } else {
            $content = '<div class="view">'.$content.'</div>';
        }
        $stmt = $conn->prepare('INSERT INTO tbl_posts SET post_content=?');
        $stmt->execute(array($content));
        echo $content;
        die();
    }
}
?>
