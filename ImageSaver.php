<?php

/**
 * HTMLからbase64形式の画像を外部ファイルに保存し、保存先のURLを読み込むようにしたHTMLを返します。
 * 
 * @author Takahiro Watanabe https://github.com/Tak0002
 * @since PHP 5.5にて動作確認済み
 * @version 0.0.1
 * @license The MIT License (MIT) - このファイルのみMITライセンスです。
 */

class ImageSaver
{
    private $saveURL = 'img/';
    private $number = 0;
    
    /**
     * 画像の保存先URLを指定します。
     * @param string $saveURL
     */
    public function __construct($saveURL = 'img/') {
        $this->saveURL = $saveURL;
    }

    /**
     * HTML中に含まれるBASE64形式で受け取った画像を外部ファイルに保存し、保存先のURLを含むHTMLで返します。
     * @param type $originalHTML
     * @return string 画像保存後のhtml
     */
    public function saveImages($originalHTML) {
        $ex = explode('<img src="data:image/', $originalHTML);
        if (count($ex) > 0) {
            $html = $ex[0];
            for ($i = 1; $i < count($ex); $i++) {
                $ex[$i] = explode('">', $ex[$i], 2);
                if (strstr($ex[$i][0], '"')) {
                    $html = $html . $ex[$i][1];
                } else {
                    $imageUrl = $this->baseToFile($ex[$i][0]);
                    $html = $html . '<img src="' . $imageUrl . '">' . $ex[$i][1];
                }
            }
            return $html;
        } else {
            return $originalHTML;
        }
    }

    /**
     * base64形式の画像を保存し、保存したURLを返します。
     * @param string $base64Image png;base64,…の形式
     * @return string 保存したイメージのURL
     */
    private function baseToFile($base64Image){
        $extension = explode(';', $base64Image , 2)[0];
        $base64Image = explode(',', $base64Image , 2)[1];
        $filename = $this->saveURL . time() . $this->number . '.' . $extension;
        file_put_contents($filename, base64_decode(str_replace(' ', '+', $base64Image)));
        $this->number ++;
        return $filename;
    }    
}
