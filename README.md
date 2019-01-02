パフォーマンスチェックプラグイン
==============

ボトルネックを発見するために、どこが問題なるか調査する

## 調査

 ### パタン 1

 NC3のAppコントローラ(AppController(NetCommonsAppController))を継承しているパタン(既存のパタン)

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/layout_old/index


 ### パタン 2

 NC3のAppコントローラ(AppController(NetCommonsAppController))を継承せず、NetCommons.defaultのレイアウトを使用したパタン

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/layout_case/index


 ### パタン 3

NC3のAppコントローラ(AppController(NetCommonsAppController))を継承せず、NetCommons.defaultのレイアウトも使用しないパタン
また、下記の部分も利用しないようにしている
~~~
 $this->element('NetCommons.common_header');
~~~

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/layout_case2/index


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

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/layout_case2/index_2


 ### パタン 5

 NetCommonsHtmlHelperの変更前

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/html_old/link_test


 ### パタン 6

 NetCommonsHtmlHelperのlink()の改善

 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用する |
 | レイアウト($layout) | NetCommons.default | ※1
 | NetCommonsHtmlHelper | 使用しない |

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/html_case/link_test


 ### パタン 7

 View::elementの変更前

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/view_class_old/element_test


 ### パタン 8

 Viewのイベント削除の速度改善

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/view_class_case/element_test


 ### パタン 9

 NetCommonsHtmlHelperのlink()の改善、Viewのイベント削除

 #### URL)
http://html.local:9094/nc3-speedup-2/nc3_speed_up/view_class_case2/element_test



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
