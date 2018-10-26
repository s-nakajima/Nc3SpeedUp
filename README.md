パフォーマンスチェックプラグイン
==============

ボトルネックを発見するために、どこが問題なるか調査する

## 調査ケース

 ### ケース 1

 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用する | 
 | レイアウト($layout) | NetCommons.default | ※1

 #### URL) 
 http://(NC3のURL)/nc3_speed_up/nc3_speed_old_layout/index
 
 
 ### ケース 2
 
 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用しない | 
 | レイアウト($layout) | NetCommons.default | ※1
 
 #### URL)
 http://(NC3のURL)/nc3_speed_up/nc3_speed_up_layout/index
 
 
 ### ケース 3
 
 | 条件 | 設定 | 備考
 | ---- | ------ | ------
 | AppController(NetCommonsAppController) | 使用しない | 
 | レイアウト($layout) | Nc3SpeedUp.default | 
 
 #### URL)
 http://(NC3のURL)/nc3_speed_up/nc3_speed_up_layout2/index
 
 
 ## 注釈
   
 ### ※1) 
 NetCommons.layoutを使用するために、下記を追加する必要がある
 - App::uses('Current', 'NetCommons.Utility');
 - App::uses('NetCommonsUrl', 'NetCommons.Utility');
 - App::uses('SiteSettingUtil', 'SiteManager.Utility');
 - App::uses('AuthComponent', 'Controller/Component');
