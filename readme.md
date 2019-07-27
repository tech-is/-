# Animarl
## Animarlとは
ペットサロンむけの顧客管理システムのAnimarl(アニマール)です

## ダウンロード
GitHubからダウンロードしてください  
https://github.com/tech-is/teamWM/archive/master.zip

## 環境構成
・PHP 7.x  
・MYSQL 10.1.38-MariaDB

## 導入方法
サーバー内でindex.phpを読み込むことにより、cl_mainのindexメソッドを実行します。

## フォルダ構成
・application/  
　　・config/　デフォルトコントローラーの設定やデータベースの設定ファイルを置いています  
　　・controler/　コントローラーのフォルダ  
　　・model/　データベース周りのクラスを置いています  
　　・views/　htmlなどのフロント専用のフォルダです  
・system/ ライブラリやヘルパーを置いているフォルダです  
・assets/ CSSやjsをおいているフォルダです  
　　・  CMS/　CMS本体のcssとjsを置いています  
・index.php　最初にこのファイルを読み込んでください

