# Dictionary
英英字典，透過xml建立資料庫與php抓音檔

須先建立資料庫gcide及資料表gcide，再執行import_gcide_xml.php建立資料表(因資料非常多，建立時間非常長，約1小時)，再執行catchSound.php抓下音檔(約1天，檔案數量與大小也非常大)，即可使用。

catchSound.php
透過db中的單字抓音效，儲存檔案後寫入資料庫

gcide_search.php
搜尋翻譯及發音功能、反白部分發音

import_gcide_xml.php
將字典資料xml匯入資料庫

tts.php
Google發音

![image](https://raw.githubusercontent.com/yoyo82725/Dictionary/master/TestDictionary.JPG)
