#TSURINS  
[TSURINS](http://www.tsurins.com/)  

![tsurins_top](https://user-images.githubusercontent.com/61406078/84632349-bc8b7f00-af29-11ea-8dc4-7dd1cfd01da7.png)

私の趣味が釣りなので、みんなで釣りを共有できるサービスを作りました！
釣り記録の投稿はもちろん、フレンド機能やコメント機能、そして通知機能をつけ、よりユーザー間で釣りの楽しさや技術を共有できるようにしました。

##使った言語やサービス
*php:laravelを用いて開発しました。
*サーバーはAWSを使用。terraformで構築したのでいつでも簡単に作り直すことができます。
*シェルスクリプトを作成し、AWSのECRのリポジトリへのpushとECSへのデプロイをコマンド一つで行えるようにしました。->command:sh aws.sh
*CircleCIを使用したのでテストの自動化とAWSへの自動デプロイを行うことができます。

