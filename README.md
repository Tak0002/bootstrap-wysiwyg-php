bootstrap-wysiwyg-php
=====================

jQueryリッチテキストエディタのbootstrap-wysiwygから受け取ったデータをPHPで処理するサンプルです。

 * jQuey側でbase64形式に変換して画像を転送するため、画像のアップロードがスムーズです。
 * PHP側で画像を外部ファイルに分離しています。
 * HTMLPurifierを利用することで適切なXSS対策がされています。
 
同封しているアプリケーション
================================

* [bootstrap-wysiwyg](http://mindmup.github.io/bootstrap-wysiwyg/) 
	* Twitter Boostrap風デザインのjQueryリッチテキストエディタ
	* The MIT License (MIT)
	* 2014年5月現在最新のMasterブランチ
	* <https://github.com/mindmup/bootstrap-wysiwyg>

* [HTMLPurifier](http://htmlpurifier.org/)
	* 適切なHTMLのみを通すフィルター
	* version 4.6.0
	* [LGPL v2.1+](http://www.gnu.org/licenses/lgpl.html)
	* 2014年5月現在最新版

* ImageSaver
	* Base64形式の画像が含まれるHTMLから画像を抽出し、外部ファイルに画像を保存し、HTML中のBASE64形式の画像を外部ファイルにURLを置換。
	* Tak0002自身により作成
	* The MIT License (MIT)
	* version 0.0.1
	* 2014年5月現在最新版

ライセンス
=======================================

 [LGPL v2.1+](http://www.gnu.org/licenses/lgpl.html)
 

使い方
========================

post.phpを見てください。