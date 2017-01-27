# Dictionary
2013/12 實習中的玩物，自我挑戰性質，由程式自動建立資料庫、抓取音檔，反白部分讓Google翻譯發音。 無純前端頁面。
<ul>
<li>程式自動建立資料庫</li>
<li>程式自動抓取字庫符合音檔</li>
<li>取得反白部分讓Google翻譯發音</li>
<li>原生Html、Css、PHP、JQuery製成</li>
<li>遵守程式撰寫規範</li>
</ul>
使用方式：
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
