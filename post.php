<?php

/**
 * Bootstrap-wysiwygから受け取ったHTMLの画像の保存やXSS対策です。
 * 
 * @license http://www.gnu.org/licenses/lgpl.html GNU LESSER GENERAL PUBLIC LICENSE Version 2.1
 * @author Takahiro Watanabe
 * @since PHP 5.5にて動作確認
 * @version 0.0.1
 */

header("Content-Type: text/html; charset=UTF-8");
?>
<head>
    <meta charset="utf-8">
    <title>bootstrap-wysiwyg-php</title>
</head>
<body>
<?php

require_once 'htmlpurifier/library/HTMLPurifier.auto.php';
require_once 'ImageSaver.php';


if(isset($_POST['edited']) && is_string($_POST['edited'])){
    
    /**
     * base64形式の画像の保存
     */
    $originalHTML = $_POST['edited'];
    $imageSaver = new ImageSaver('img/');
    $html = $imageSaver->saveImages($originalHTML);
    
    /**
     * htmlpurifierの設定
     */
    $config = HTMLPurifier_Config::createDefault();
    $config -> set('URI.AllowedSchemes', array('http' => true, 'https' => true, 'mailto' => true, 'ftp' => true, 'nntp' => true, 'news' => true, 'data' => true));
    $config -> set('Core.Encoding', 'UTF-8');
    $config -> set('Core.Language', 'ja');
    $config -> set('HTML.AllowedElements', array('a', 'img', 'em', 'p', 'h2', 'span', 'br', 'div'));
    $purifier = new HTMLPurifier();
    $safeHTML = $purifier ->purify($html);
    
    echo $safeHTML;
}
?>
</body>