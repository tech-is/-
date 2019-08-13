# Animarl
## Animarl(アニマール)とは
ペットサロンむけの顧客管理システムです

## ダウンロード
GitHubからダウンロードしてください
https://github.com/tech-is/teamWM/archive/master.zip

## 環境構成
```
・PHP 7.x
・MYSQL 10.1.38-MariaDB
・Codeigniter 3.x
```

## 導入方法
apacheやnginxのDocummentRoot内に当プロジェクトを展開してください

## データベース構築
まずMYSQL内に
```
create database Animarl character set utf8mb4 collate utf8mb4_general_ci;
```
でデータベースを構築して
database.txtに記述しているSQL文を
```
use Animarl;
/* database.txtに記述されているSQL文 */
```
を実行してください
## フォルダ構成
・application/
　　・config/　デフォルトコントローラーの設定やデータベースの設定ファイルを置いています
　　・controler/　コントローラーのフォルダ
　　・model/　データベース周りのクラスを置いています
　　・views/　htmlなどのフロント専用のフォルダです
・system/ ライブラリやヘルパーを置いているフォルダです
・assets/ 静的ファイルをおいているフォルダです
　　・  CMS/　CMS本体のcssとjsを置いています
・index.php　最初にこのファイルを読み込んでください