パフォーマンスチェックプラグイン
==============

ボトルネックを発見するために、どこが問題なるか調査する

## 調査

 ### パタン 1
 
 NC3のAppコントローラ(AppController(NetCommonsAppController))を継承しているパタン(既存のパタン)

 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用する | 
 | レイアウト($layout) | NetCommons.default | ※1

 #### URL) 
 http://(NC3のURL)/nc3_speed_up/nc3_speed_old_layout/index
 
 
 ### パタン 2
 
 NC3のAppコントローラ(AppController(NetCommonsAppController))を継承せず、NetCommons.defaultのレイアウトを使用したパタン
 
 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用しない | 
 | レイアウト($layout) | NetCommons.default | ※1
 
 
 
 #### URL)
 http://(NC3のURL)/nc3_speed_up/nc3_speed_up_layout/index
 
 
 ### パタン 3
 
NC3のAppコントローラ(AppController(NetCommonsAppController))を継承せず、NetCommons.defaultのレイアウトも使用しないパタン
また、下記の部分も利用しないようにしている
~~~
 $this->element('NetCommons.common_header');
~~~
 
 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用しない | 
 | レイアウト($layout) | Nc3SpeedUp.default |
 
 #### URL)
 http://(NC3のURL)/nc3_speed_up/nc3_speed_up_layout2/index
 
 
 ### パタン 4
 
このケースでは、ケース3に加え、netcommons_css、netcommons_js、netcommons_theme_cssのエレメントを使用せず、直接書いたパタン。また、netcommons_cssで設定されている下記は除外している
~~~~
 echo $this->NetCommonsHtml->css(
	array(
		'/frames/css/style.css',
		'/pages/css/style.css',
		'/users/css/style.css',
		'/user_attributes/css/style.css',
		'/wysiwyg/css/style.css',
	)
);
~~~~
 
 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用しない | 
 | レイアウト($layout) | Nc3SpeedUp.default_2 | ※3
 
 #### URL)
 http://(NC3のURL)/nc3_speed_up/nc3_speed_up_layout2/index_2
 
 
 ## 改善(ISSUEに記述)

https://github.com/s-nakajima/Nc3SpeedUp/issues


 ## 注釈
   
 ### ※1) 
 NetCommons.layoutを使用するために、下記を追加する必要がある
 ~~~
 App::uses('Current', 'NetCommons.Utility');
 App::uses('NetCommonsUrl', 'NetCommons.Utility');
 App::uses('SiteSettingUtil', 'SiteManager.Utility');
 App::uses('AuthComponent', 'Controller/Component');
 ~~~
 
