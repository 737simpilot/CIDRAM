## CIDRAM 中文（傳統）文檔。

### 內容
- 1. [前言](#SECTION1)
- 2. [如何安裝](#SECTION2)
- 3. [如何使用](#SECTION3)
- 4. [前端管理](#SECTION4)
- 5. [文件在包](#SECTION5)
- 6. [配置選項](#SECTION6)
- 7. [簽名格式](#SECTION7)
- 8. [常見問題（FAQ）](#SECTION8)

*翻譯註釋：如果錯誤（例如，​翻譯差異，​錯別字，​等等），​英文版這個文件是考慮了原版和權威版。​如果您發現任何錯誤，​您的協助糾正他們將受到歡迎。​*

---


### 1. <a name="SECTION1"></a>前言

CIDRAM （無類別域間路由訪問管理器）是一個PHP腳本，​旨在保護網站途經阻止請求該從始發IP地址視為不良的流量來源，​包括（但不限於）流量該從非人類的訪問端點，​雲服務，​垃圾郵件發送者，​網站鏟運機，​等等。​它通過計算CIDR的提供的IP地址從入站請求和試圖匹配這些CIDR反對它的簽名文件（這些簽名文件包含CIDR的IP地址視為不良的流量來源）；如果找到匹配，​請求被阻止。

*(看到：[什麼是『CIDR』？​](#WHAT_IS_A_CIDR))。​*

CIDRAM COPYRIGHT 2016 and beyond GNU/GPLv2 by Caleb M (Maikuolan)。

本腳本是基於GNU通用許可V2.0版許可協議發布的，​您可以在許可協議的允許範圍內自行修改和發布，​但請遵守GNU通用許可協議。​使用腳本的過程中，​作者不提供任何擔保和任何隱含擔保。​更多的細節請參見GNU通用公共許可證，​下的`LICENSE.txt`文件也可從訪問：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

現在CIDRAM的代碼文件和關聯包可以從以下地址免費下載[GitHub](https://cidram.github.io/)。

---


### 2. <a name="SECTION2"></a>如何安裝

#### 2.0 安裝手工

1） 在閱讀到這里之前，​我假設您已經下載腳本的一個副本，​已解壓縮其內容並保存在您的機器的某個地方。​現在，​您要決定將腳本放在您服務器上的哪些文件夾中，​例如`/public_html/cidram/`或其他任何您覺得滿意和安全的地方。​*上傳完成後，​繼續閱讀。​。​*

2） 重命名`config.ini.RenameMe`到`config.ini`（位於內`vault`），​和如果您想（強烈推薦高級用戶，​但不推薦業餘用戶或者新手使用這個方法），​打開它（這個文件包含所有CIDRAM的可用配置選項；以上的每一個配置選項應有一個簡介來說明它是做什麼的和它的具有的功能）。​按照您認為合適的參數來調整這些選項，​然後保存文件，​關閉。

3） 上傳（CIDRAM和它的文件）到您選定的文件夾（不需要包括`*.txt`/`*.md`文件，​但大多數情況下，​您應上傳所有的文件）。

4） 修改的`vault`文件夾權限為『755』（如果有問題，​您可以試試『777』，​但是這是不太安全）。​注意，​主文件夾也應該是該權限，​如果遇上其他權限問題，​請修改對應文件夾和文件的權限。

5） 接下來，​您需要為您的系統或CMS設定啟動CIDRAM的鉤子。​有幾種不同的方式為您的系統或CMS設定鉤子，​最簡單的是在您的系統或CMS的核心文件的開頭中使用`require`或`include`命令直接包含腳本（這個方法通常會導致在有人訪問時每次都加載）。​平時，​這些都是存儲的在文件夾中，​例如`/includes`，​`/assets`或`/functions`等文件夾，​和將經常被命名的某物例如`init.php`，​`common_functions.php`，​`functions.php`。​這是根據您自己的情況決定的，​並不需要完全遵守；如果您遇到困難，​參觀GitHub上的CIDRAM問題頁面；可能其他用戶或者我自己也有這個問題並且解決了（您需要讓我們您在使用哪些CMS）。​為了使用`require`或`include`，​插入下面的代碼行到最開始的該核心文件，​更換裡面的數據引號以確切的地址的`loader.php`文件（本地地址，​不是HTTP地址；它會類似於前面提到的vault地址）。

`<?php require '/user_name/public_html/cidram/loader.php'; ?>`

保存文件，​關閉，​重新上傳。

-- 或替換 --

如果您使用Apache網絡服務器並且您可以訪問`php.ini`，​您可以使用該`auto_prepend_file`指令為任何PHP請求創建附上的CIDRAM。​就像是：

`auto_prepend_file = "/user_name/public_html/cidram/loader.php"`

或在該`.htaccess`文件：

`php_value auto_prepend_file "/user_name/public_html/cidram/loader.php"`

6) 這就是一切！​:-)

#### 2.1 與COMPOSER安裝

[CIDRAM是在Packagist上](https://packagist.org/packages/cidram/cidram)，​所以，​如果您熟悉Composer，​您可以使用Composer安裝CIDRAM（您仍然需要準備配置和鉤子；參考『安裝手工』步驟2和5）。

`composer require cidram/cidram`

#### 2.2 為WORDPRESS安裝

如果要使用CIDRAM與WordPress，​您可以忽略上述所有說明。​[CIDRAM在WordPress插件數據庫中註冊](https://wordpress.org/plugins/cidram/)，​您可以直接從插件儀表板安裝CIDRAM。​您可以像其他插件一樣安裝，​不需要添加步驟。​與其他安裝方法相同，​您可以通過修改`config.ini`來或通過使用前端配置頁面自定義您的安裝。​更新CIDRAM通過前端更新頁面時，​插件版本信息將自動與WordPress同步。

*警告：在插件儀表板裡更新CIDRAM會導致乾淨的安裝！​如果您已經自定義了您的安裝（更改了您的配置，​安裝的模塊等），​在插件儀表板裡進行更新時，​這些定制將會丟失！​日誌文件也將丟失！​要保留日誌文件和自定義，​請通過CIDRAM前端更新頁面進行更新。​*

---


### 3. <a name="SECTION3"></a>如何使用

CIDRAM 應自動阻止不良的請求至您的網站，​沒有任何需求除了初始安裝。

更新是手工完成，​和您可以定制您的配置和您可以定制什麼CIDR被阻止通過修改您的配置文件和/或您的簽名文件.

如果您遇到任何假陽性，​請聯繫我讓我知道這件事。 *(看到：[什麼是『假陽性』？​](#WHAT_IS_A_FALSE_POSITIVE))。​*

---


### 4. <a name="SECTION4"></a>前端管理

#### 4.0 什麼是前端。

前端提供了一種方便，​輕鬆的方式來維護，​管理和更新CIDRAM安裝。​您可以通過日誌頁面查看，​共享和下載日誌文件，​您可以通過配置頁面修改配置，​您可以通過更新頁面安裝和卸載組件，​和您可以通過文件管理器上傳，​下載和修改文件在vault。

默認情況是禁用前端，​以防止未授權訪問 （未授權訪問可能會對您的網站及其安全性造成嚴重後果）。​啟用它的說明包括在本段下面。

#### 4.1 如何啟用前端。

1) 裡面的`config.ini`文件，​找到指令`disable_frontend`，​並將其設置為`false` （默認值為`true`）。

2) 從瀏覽器訪問`loader.php` （例如，​`http://localhost/cidram/loader.php`）。

3) 使用默認用戶名和密碼（admin/password）登錄。

注意：第一次登錄後，​以防止未經授權的訪問前端，​您應該立即更改您的用戶名和密碼！​這是非常重要的，​因為它可以任意PHP代碼上傳到您的網站通過前端。

#### 4.2 如何使用前端。

每個前端頁面上都有說明，​用於解釋正確的用法和它的預期目的。​如果您需要進一步的解釋或幫助，​請聯繫支持。​另外，​YouTube上還有一些演示視頻。


---


### 5. <a name="SECTION5"></a>文件在包
（本段文件採用的自動翻譯，​因為都是一些文件描述，​參考意義不是很大，​如有疑問，​請參考英文原版）

下面是一個列表的所有的文件該應該是存在在您的存檔在下載時間，​任何文件該可能創建因之的您的使用這個腳本，​包括一個簡短說明的他們的目的。

文件 | 說明
----|----
/_docs/ | 筆記文件夾（包含若干文件）。
/_docs/readme.ar.md | 阿拉伯文自述文件。
/_docs/readme.de.md | 德文自述文件。
/_docs/readme.en.md | 英文自述文件。
/_docs/readme.es.md | 西班牙文自述文件。
/_docs/readme.fr.md | 法文自述文件。
/_docs/readme.id.md | 印度尼西亞文自述文件。
/_docs/readme.it.md | 意大利文自述文件。
/_docs/readme.ja.md | 日文自述文件。
/_docs/readme.ko.md | 韓文自述文件。
/_docs/readme.nl.md | 荷蘭文自述文件。
/_docs/readme.pt.md | 葡萄牙文自述文件。
/_docs/readme.ru.md | 俄文自述文件。
/_docs/readme.ur.md | 烏爾都文自述文件。
/_docs/readme.vi.md | 越南文自述文件。
/_docs/readme.zh-TW.md | 中文（簡體）自述文件。
/_docs/readme.zh.md | 中文（簡體）自述文件。
/vault/ | 安全/保險庫【Vault】文件夾（包含若干文件）。
/vault/fe_assets/ | 前端資產。
/vault/fe_assets/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/fe_assets/_accounts.html | 前端賬戶頁面的HTML模板。
/vault/fe_assets/_accounts_row.html | 前端賬戶頁面的HTML模板。
/vault/fe_assets/_cidr_calc.html | CIDR計算器的HTML模板。
/vault/fe_assets/_cidr_calc_row.html | CIDR計算器的HTML模板。
/vault/fe_assets/_config.html | 前端配置頁面的HTML模板。
/vault/fe_assets/_config_row.html | 前端配置頁面的HTML模板。
/vault/fe_assets/_files.html | 文件管理器的HTML模板。
/vault/fe_assets/_files_edit.html | 文件管理器的HTML模板。
/vault/fe_assets/_files_rename.html | 文件管理器的HTML模板。
/vault/fe_assets/_files_row.html | 文件管理器的HTML模板。
/vault/fe_assets/_home.html | 端主頁的HTML模板。
/vault/fe_assets/_ip_aggregator.html | IP聚合器HTML模板。
/vault/fe_assets/_ip_test.html | IP測試頁面的HTML模板。
/vault/fe_assets/_ip_test_row.html | IP測試頁面的HTML模板。
/vault/fe_assets/_ip_tracking.html | IP跟踪頁面的HTML模板。
/vault/fe_assets/_ip_tracking_row.html | IP跟踪頁面的HTML模板。
/vault/fe_assets/_login.html | 前端登錄的HTML模板。
/vault/fe_assets/_logs.html | 前端日誌頁面的HTML模板。
/vault/fe_assets/_nav_complete_access.html | 前端導航鏈接的HTML模板，​由那些與完全訪問使用。
/vault/fe_assets/_nav_logs_access_only.html | 前端導航鏈接的HTML模板，​由那些與僅日誌訪問使用。
/vault/fe_assets/_statistics.html | 前端統計頁面的HTML模板。
/vault/fe_assets/_updates.html | 前端更新頁面的HTML模板。
/vault/fe_assets/_updates_row.html | 前端更新頁面的HTML模板。
/vault/fe_assets/frontend.css | 前端CSS樣式表。
/vault/fe_assets/frontend.dat | 前端數據庫（包含賬戶信息，​會話信息，​和緩存；只生成如果前端是啟用和使用）。
/vault/fe_assets/frontend.html | 前端的主HTML模板文件。
/vault/fe_assets/icons.php | 圖標處理文件（由前端文件管理器使用）。
/vault/fe_assets/pips.php | 點數處理文件（由前端文件管理器使用）。
/vault/fe_assets/scripts.js | 包含前端JavaScript數據。
/vault/lang/ | 包含CIDRAM語言數據。
/vault/lang/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/lang/lang.ar.cli.php | 阿拉伯文CLI語言數據。
/vault/lang/lang.ar.fe.php | 阿拉伯文前端語言數據。
/vault/lang/lang.ar.php | 阿拉伯文語言數據。
/vault/lang/lang.bn.cli.php | 孟加拉文CLI語言數據。
/vault/lang/lang.bn.fe.php | 孟加拉文前端語言數據。
/vault/lang/lang.bn.php | 孟加拉文語言數據。
/vault/lang/lang.de.cli.php | 德文CLI語言數據。
/vault/lang/lang.de.fe.php | 德文前端語言數據。
/vault/lang/lang.de.php | 德文語言數據。
/vault/lang/lang.en.cli.php | 英文CLI語言數據。
/vault/lang/lang.en.fe.php | 英文前端語言數據。
/vault/lang/lang.en.php | 英文語言數據。
/vault/lang/lang.es.cli.php | 西班牙文CLI語言數據。
/vault/lang/lang.es.fe.php | 西班牙文前端語言數據。
/vault/lang/lang.es.php | 西班牙文語言數據。
/vault/lang/lang.fr.cli.php | 法文CLI語言數據。
/vault/lang/lang.fr.fe.php | 法文前端語言數據。
/vault/lang/lang.fr.php | 法文語言數據。
/vault/lang/lang.hi.cli.php | 印地文CLI語言數據。
/vault/lang/lang.hi.fe.php | 印地文前端語言數據。
/vault/lang/lang.hi.php | 印地文語言數據。
/vault/lang/lang.id.cli.php | 印度尼西亞文CLI語言數據。
/vault/lang/lang.id.fe.php | 印度尼西亞文前端語言數據。
/vault/lang/lang.id.php | 印度尼西亞文語言數據。
/vault/lang/lang.it.cli.php | 意大利文CLI語言數據。
/vault/lang/lang.it.fe.php | 意大利文前端語言數據。
/vault/lang/lang.it.php | 意大利文語言數據。
/vault/lang/lang.ja.cli.php | 日文CLI語言數據。
/vault/lang/lang.ja.fe.php | 日文前端語言數據。
/vault/lang/lang.ja.php | 日文語言數據。
/vault/lang/lang.ko.cli.php | 韓文CLI語言數據。
/vault/lang/lang.ko.fe.php | 韓文前端語言數據。
/vault/lang/lang.ko.php | 韓文語言數據。
/vault/lang/lang.nl.cli.php | 荷蘭文CLI語言數據。
/vault/lang/lang.nl.fe.php | 荷蘭文前端語言數據。
/vault/lang/lang.nl.php | 荷蘭文語言數據。
/vault/lang/lang.no.cli.php | 挪威文CLI語言數據。
/vault/lang/lang.no.fe.php | 挪威文前端語言數據。
/vault/lang/lang.no.php | 挪威文語言數據。
/vault/lang/lang.pt.cli.php | 葡萄牙文CLI語言數據。
/vault/lang/lang.pt.fe.php | 葡萄牙文前端語言數據。
/vault/lang/lang.pt.php | 葡萄牙文語言數據。
/vault/lang/lang.ru.cli.php | 俄文CLI語言數據。
/vault/lang/lang.ru.fe.php | 俄文前端語言數據。
/vault/lang/lang.ru.php | 俄文語言數據。
/vault/lang/lang.sv.cli.php | 瑞典文CLI語言數據。
/vault/lang/lang.sv.fe.php | 瑞典文前端語言數據。
/vault/lang/lang.sv.php | 瑞典文語言數據。
/vault/lang/lang.th.cli.php | 泰文CLI語言數據。
/vault/lang/lang.th.fe.php | 泰文前端語言數據。
/vault/lang/lang.th.php | 泰文語言數據。
/vault/lang/lang.tr.cli.php | 土耳其文CLI語言數據。
/vault/lang/lang.tr.fe.php | 土耳其文前端語言數據。
/vault/lang/lang.tr.php | 土耳其文語言數據。
/vault/lang/lang.ur.cli.php | 烏爾都文CLI語言數據。
/vault/lang/lang.ur.fe.php | 烏爾都文前端語言數據。
/vault/lang/lang.ur.php | 烏爾都文語言數據。
/vault/lang/lang.vi.cli.php | 越南文CLI語言數據。
/vault/lang/lang.vi.fe.php | 越南文前端語言數據。
/vault/lang/lang.vi.php | 越南文語言數據。
/vault/lang/lang.zh-tw.cli.php | 中文（傳統）CLI語言數據。
/vault/lang/lang.zh-tw.fe.php | 中文（傳統）前端語言數據。
/vault/lang/lang.zh-tw.php | 中文（傳統）語言數據。
/vault/lang/lang.zh.cli.php | 中文（簡體）CLI語言數據。
/vault/lang/lang.zh.fe.php | 中文（簡體）前端語言數據。
/vault/lang/lang.zh.php | 中文（簡體）語言數據。
/vault/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/.travis.php | 由Travis CI用於測試（不需要為正確經營腳本）。
/vault/.travis.yml | 由Travis CI用於測試（不需要為正確經營腳本）。
/vault/aggregator.php | IP聚合器。
/vault/cache.dat | 緩存數據。
/vault/cidramblocklists.dat | 包含的相關信息關於由Macmathan提供的可選的國家阻止列表；由更新功能使用由前端提供。
/vault/cli.php | CLI處理文件。
/vault/components.dat | 包含的相關信息關於CIDRAM的各種組件；它使用通過更新功能從前端。
/vault/config.ini.RenameMe | 配置文件；包含所有配置指令為CIDRAM，​告訴它什麼做和怎麼正確地經營（重命名為激活）。
/vault/config.php | 配置處理文件。
/vault/config.yaml | 配置默認文件；包含CIDRAM的默認配置值。
/vault/frontend.php | 前端處理文件。
/vault/frontend_functions.php | 前端功能處理文件。
/vault/functions.php | 功能處理文件（必不可少）。
/vault/hashes.dat | 包含列表接受哈希表（相關的reCAPTCHA功能；只有生成如果reCAPTCHA功能被啟用）。
/vault/ignore.dat | 忽略文件（用於指定其中簽名章節CIDRAM應該忽略）。
/vault/ipbypass.dat | 包含列表IP旁路（相關的reCAPTCHA功能；只有生成如果reCAPTCHA功能被啟用）。
/vault/ipv4.dat | IPv4簽名文件（不想要的雲服務和非人終端）。
/vault/ipv4_bogons.dat | IPv4簽名文件（bogon/火星CIDR）。
/vault/ipv4_custom.dat.RenameMe | IPv4定制簽名文件（重命名為激活）。
/vault/ipv4_isps.dat | IPv4簽名文件（危險和垃圾容易ISP）。
/vault/ipv4_other.dat | IPv4簽名文件（CIDR從代理，​VPN和其他不需要服務）。
/vault/ipv6.dat | IPv6簽名文件（不想要的雲服務和非人終端）。
/vault/ipv6_bogons.dat | IPv6簽名文件（bogon/火星CIDR）。
/vault/ipv6_custom.dat.RenameMe | IPv6定制簽名文件（重命名為激活）。
/vault/ipv6_isps.dat | IPv6簽名文件（危險和垃圾容易ISP）。
/vault/ipv6_other.dat | IPv6簽名文件（CIDR從代理，​VPN和其他不需要服務）。
/vault/lang.php | 語音數據。
/vault/modules.dat | 包含的相關信息關於CIDRAM的模塊；它使用通過更新功能從前端。
/vault/outgen.php | 輸出發生器。
/vault/php5.4.x.php | Polyfill對於PHP 5.4.X （PHP 5.4.X 向下兼容需要它；​較新的版本可以刪除它）。
/vault/recaptcha.php | reCAPTCHA模塊。
/vault/rules_as6939.php | 定制規則文件為 AS6939。
/vault/rules_softlayer.php | 定制規則文件為 Soft Layer。
/vault/rules_specific.php | 定制規則文件為一些特定的CIDR。
/vault/salt.dat | 鹽文件（使用由一些外圍功能；只產生當必要）。
/vault/template_custom.html | 模板文件；模板為HTML輸出產生通過CIDRAM輸出發生器。
/vault/template_default.html | 模板文件；模板為HTML輸出產生通過CIDRAM輸出發生器。
/vault/themes.dat | 主題文件；它使用通過更新功能從前端。
/.gitattributes | GitHub文件（不需要為正確經營腳本）。
/Changelog.txt | 記錄的變化做出至腳本間不同版本（不需要為正確經營腳本）。
/composer.json | Composer/Packagist 信息（不需要為正確經營腳本）。
/CONTRIBUTING.md | 相關信息如何有助於該項目。
/LICENSE.txt | GNU/GPLv2 執照文件（不需要為正確經營腳本）。
/loader.php | 加載文件。​這個是文件您應該【鉤子】（必不可少）!
/README.md | 項目概要信息。
/web.config | 一個ASP.NET配置文件（在這種情況，​以保護`/vault`文件夾從被訪問由非授權來源在事件的腳本是安裝在服務器根據ASP.NET技術）。

---


### 6. <a name="SECTION6"></a>配置選項
下列是一個列表的變量發現在`config.ini`配置文件的CIDRAM，​以及一個說明的他們的目的和功能。

#### 『general』 （類別）
基本CIDRAM配置。

『logfile』
- 人類可讀文件用於記錄所有被攔截的訪問。​指定一個文件名，​或留空以禁用。

『logfileApache』
- Apache風格文件用於記錄所有被攔截的訪問。​指定一個文件名，​或留空以禁用。

『logfileSerialized』
- 連載的文件用於記錄所有被攔截的訪問。​指定一個文件名，​或留空以禁用。

*有用的建議：如果您想，​可以追加日期/時間信息及附加到您的日誌文件的名稱通過包括這些中的名稱：`{yyyy}` 為今年完整，​`{yy}` 為今年縮寫，​`{mm}` 為今月，​`{dd}` 為今日，​`{hh}` 為今小時。​*

*例子：*
- *`logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'`*

『truncate』
- 截斷日誌文件當他們達到一定的大小嗎？​值是在B/KB/MB/GB/TB，​是日誌文件允許的最大大小直到它被截斷。​默認值為『0KB』將禁用截斷（日誌文件可以無限成長）。​注意：適用於單個日誌文件！​日誌文件大小不被算集體的。

『timeOffset』
- 如果您的服務器時間不符合您的本地時間，​您可以在這裡指定的偏移調整日期/時間信息該產生通過CIDRAM根據您的需要。​它一般建議，​而不是，​調整時區指令的文件`php.ini`，​但是有時（例如，​當利用有限的共享主機提供商）這並不總是可能做到，​所以，​此選項在這裡是提供。​偏移量是在分鐘。
- 例子（添加1小時）：`timeOffset=60`

『timeFormat』
- CIDRAM使用的日期符號格式。​標準 = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`。

『ipaddr』
- 在哪裡可以找到連接請求IP地址？​（可以使用為服務例如Cloudflare和類似）。​標準=REMOTE_ADDR。​警告：不要修改此除非您知道什麼您做著！

『forbid_on_block』
- 什麼頭CIDRAM應該應對當申請是拒絕？​False/200 = 200 OK【標準】；​True/403 = 403 Forbidden （被禁止）；​503 = 503 Service unavailable （服務暫停）。

『silent_mode』
- CIDRAM應該默默重定向被攔截的訪問而不是顯示該『拒絕訪問』頁嗎？​指定位置至重定向被攔截的訪問，​或讓它空將其禁用。

『lang』
- 指定標準CIDRAM語言。

『numbers』
- 指定如何顯示數字。

『emailaddr』
- 如果您希望，​您可以提供電子郵件地址這裡要給予用戶當他們被阻止，​他們使用作為接觸點為支持和/或幫助在的情況下他們錯誤地阻止。​警告:您提供的任何電子郵件地址，​它肯定會被獲得通過垃圾郵件機器人和鏟運機，​所以，​它強烈推薦如果選擇提供一個電子郵件地址這裡，​您保證它是一次性的和/或不是很重要（換一種說法，​您可能不希望使用您的主電子郵件地址或您的企業電子郵件地址）。

『emailaddr_display_style』
- 您希望如何將電子郵件地址呈現給用戶？ 『default』 = 可點擊的鏈接。 『noclick』 = 不可點擊的文字。

『disable_cli』
- 關閉CLI模式嗎？​CLI模式是按說激活作為標準，​但可以有時干擾某些測試工具（例如PHPUnit，​為例子）和其他基於CLI應用。​如果您沒有需要關閉CLI模式，​您應該忽略這個指令。​False（假）=激活CLI模式【標準】；​True（真）=關閉CLI模式。

『disable_frontend』
- 關閉前端訪問嗎？​前端訪問可以使CIDRAM更易於管理，​但也可能是潛在的安全風險。​建議管理CIDRAM通過後端只要有可能，​但前端訪問提供當不可能。​保持關閉除非您需要它。​False（假）=激活前端訪問；​True（真）=關閉前端訪問【標準】。

『max_login_attempts』
- 最大登錄嘗試次數（前端）。​標準=5。

『FrontEndLog』
- 前端登錄嘗試的錄音文件。​指定一個文件名，​或留空以禁用。

『ban_override』
- 覆蓋『forbid_on_block』當『infraction_limit』已被超過？​當覆蓋：已阻止的請求返回一個空白頁（不使用模板文件）。​200 = 不要覆蓋【標準】；​403 = 使用『403 Forbidden』覆蓋；​503 = 使用『503 Service unavailable』覆蓋。

『log_banned_ips』
- 包括IP禁止從阻止請求在日誌文件嗎？​True（真）=是【標準】；​False（假）=不是。

『default_dns』
- 以逗號分隔的DNS服務器列表，​用於主機名查找。​標準 = 『8.8.8.8,8.8.4.4』 (Google DNS)。​警告：不要修改此除非您知道什麼您做著！

『search_engine_verification』
- 嘗試驗證來自搜索引擎的請求？​驗證搜索引擎確保他們不會因超過違規限製而被禁止 （禁止在您的網站上使用搜索引擎通常會有產生負面影響對您的搜索引擎排名，​SEO，​等等）。​當被驗證，​搜索引擎可以被阻止，​但不會被禁止。​當不被驗證，​他們可以由於超過違規限製而被禁止。​另外，​搜索引擎驗證提供保護針對假搜索引擎請求和針對潛在的惡意實體偽裝成搜索引擎（當搜索引擎驗證是啟用，​這些請求將被阻止）。​True（真）=搜索引擎驗證是啟用【標準】；​False（假）=搜索引擎驗證是禁用。

『protect_frontend』
- 指定是否應將CIDRAM通常提供的保護應用於前端。​True（真）=是【標準】；​False（假）=不是。

『disable_webfonts』
- 關閉網絡字體嗎？​True（真）=關閉；​False（假）=不關閉【標準】。

『maintenance_mode』
- 啟用維護模式？​True（真）=關閉；​False（假）=不關閉【標準】。​它停用一切以外前端。​有時候在更新CMS，框架，等時有用。

『default_algo』
- 定義要用於所有未來密碼和會話的算法。​選項：​​PASSWORD_DEFAULT（標準），​PASSWORD_BCRYPT，​PASSWORD_ARGON2I（需要PHP >= 7.2.0）。

『statistics』
- 跟踪CIDRAM使用情況統計？​True（真）=跟踪； False（假）=不跟踪【標準】。

『force_hostname_lookup』
- 強制主機名查找？​True（真）=跟踪； False（假）=不跟踪【標準】。​主機名查詢通常在『根據需要』的基礎上執行，但可以在所有請求上強制。​這可能會有助於提供日誌文件中更詳細的信息，但也可能會對性能產生輕微的負面影響。

#### 『signatures』 （類別）
簽名配置。

『ipv4』
- 列表的IPv4簽名文件，​CIDRAM應該嘗試使用，​用逗號分隔。​您可以在這裡添加條目如果您想包括其他文件在CIDRAM。

『ipv6』
- 列表的IPv6簽名文件，​CIDRAM應該嘗試使用，​用逗號分隔。​您可以在這裡添加條目如果您想包括其他文件在CIDRAM。

『block_cloud』
- 阻止CIDR認定為屬於虛擬主機或云服務嗎？​如果您操作一個API服務從您的網站或如果您預計其他網站連接到您的網站，​這應該被設置為『false』（假）。​如果不，​這應該被設置為『true』（真）。

『block_bogons』
- 阻止bogon(『ㄅㄡㄍㄛㄋ』)/martian（​『火星』）CIDR嗎？​如果您希望連接到您的網站從您的本地網絡/本地主機/localhost/LAN/等等，​這應該被設置為『false』（假）。​如果不，​這應該被設置為『true』（真）。

『block_generic』
- 阻止CIDR一般建議對於黑名單嗎？​這包括簽名不標記為的一章节任何其他更具體簽名類別。

『block_proxies』
- 阻止CIDR認定為屬於代理服務嗎？​如果您需要該用戶可以訪問您的網站從匿名代理服務，​這應該被設置為『false』（假）。​除此以外，​如果您不需要匿名代理服務，​這應該被設置為『true』（真）作為一個方式以提高安全性。

『block_spam』
- 阻止高風險垃圾郵件CIDR嗎？​除非您遇到問題當這樣做，​通常，​這應該被設置為『true』（真）。

『modules』
- 模塊文件要加載的列表以後檢查簽名IPv4/IPv6，​用逗號分隔。

『default_tracktime』
- 多少秒鐘來跟踪模塊禁止的IP。​標準 = 604800 （1週）。

『infraction_limit』
- 從IP最大允許違規數量之前它被禁止。​標準=10。

『track_mode』
- 何時應該記錄違規？​False（假）=當IP被模塊阻止時。​True（真）=當IP由於任何原因阻止時。

#### 『recaptcha』 （類別）
如果您想，​您可以為用戶提供了一種方法繞過『拒絕訪問』頁面通過完成reCAPTCHA事件。​這有助於減輕一些風險假陽性有關，​對於當我們不能完全肯定一個請求是否源自機器或人。

由於風險相關的提供的方法為終端用戶至繞過『拒絕訪問』頁面，​通常，​我建議不要啟用此功能除非您覺得這是必要的做。​情況由此有必要：如果您的網站有客戶/用戶該需要具有訪問權限您的網站，​而如果這一點該不能妥協的，​但如果這些客戶/用戶碰巧被來自敵對網絡連接該可能被攜帶不需要的流量，​並阻斷這種不需要的流量也不能妥協的，​在那些沒有雙贏的局面，​reCAPTCHA的功能可能是有用的作為一種手段允許需要的客戶/用戶，​而避開不需要的流量從同一網絡。​雖然說，​鑑於一個CAPTCHA的預期目的是人類和非人類區分，​reCAPTCHA的功能只會協助在這些沒有雙贏的局面如果我們假設該不需要的流量是非人（例如，​垃圾郵件機器人，​網站鏟運機，​黑客工具，​交通自動化），​而不是作為人的不需要的流量（如人的垃圾郵件機器人，​黑客，​等等）。

為了獲得『site key』和『secret key』（需要為了使用reCAPTCHA），​請訪問：[https://developers.google.com/recaptcha/](https://developers.google.com/recaptcha/)

『usemode』
- 它定義瞭如何CIDRAM應該使用reCAPTCHA。
- 0 = reCAPTCHA是完全禁用【標準】。
- 1 = reCAPTCHA是啟用為所有簽名。
- 2 = reCAPTCHA是啟用只為簽名章節被特殊標記在簽名文件作為reCAPTCHA啟用。
- （任何其他值將以同樣的方式被視作0）。

『lockip』
- 指定是否哈希應鎖定到特定IP地址。​False（假）=Cookie和哈希可以由多個IP地址使用【標準】。​True（真）=Cookie和哈希不能由多個IP地址使用（cookies/哈希是鎖定到IP地址）。
- 注意：『lockip』值被忽略當『lockuser』是`false`（假），​由於該機制為記憶的『用戶』可以根據這個值的變化。

『lockuser』
- 指定是否一個reCAPTCHA成功完成應鎖定到特定用戶。​False（假）=一個reCAPTCHA成功完成將授予訪問為所有請求該來自同IP作為由用戶使用當完成的reCAPTCHA；​Cookie和哈希不被使用；代替，​一個IP白名單將被用於。​True（真）=一個reCAPTCHA成功完成只會授予訪問為用戶該完成了reCAPTCHA；​Cookie和哈希是用於記住用戶；一個IP白名單不被使用【標準】。

『sitekey』
- 該值應該對應於『site key』為您的reCAPTCHA，​該可以發現在reCAPTCHA的儀表板。

『secret』
- 該值應該對應於『secret key』為您的reCAPTCHA，​該可以發現在reCAPTCHA的儀表板。

『expiry』
- 當『lockuser』是true（真）【標準】，​為了記住當用戶已經成功完成reCAPTCHA，​為未來頁面請求，​CIDRAM生成一個標準的HTTP cookie含哈希對應於內部哈希記錄含有相同哈希；未來頁面請求將使用這些對應的哈希為了驗證該用戶已預先完成reCAPTCHA。​當『lockuser』是false（假），​一個IP白名單被用來確定是否請求應允許從請求的入站IP；條目添加到這個白名單當reCAPTCHA是成功完成。​這些cookies，​哈希，​和白名單條目應在多少小時內有效？​標準 = 720 （1個月）。

『logfile』
- 記錄所有的reCAPTCHA的嘗試？​要做到這一點，​指定一個文件名到使用。​如果不，​離開這個變量為空白。

*有用的建議：如果您想，​可以追加日期/時間信息及附加到您的日誌文件的名稱通過包括這些中的名稱：`{yyyy}` 為今年完整，​`{yy}` 為今年縮寫，​`{mm}` 為今月，​`{dd}` 為今日，​`{hh}` 為今小時。​*

*例子：*
- *`logfile='recaptcha.{yyyy}-{mm}-{dd}-{hh}.txt'`*

#### 『template_data』 （類別）
指令和變量為模板和主題。

涉及的HTML輸出用於生成該『拒絕訪問』頁面。​如果您使用個性化主題為CIDRAM，​HTML產量資源是從`template_custom.html`文件，​和否則，​HTML產量資源是從`template.html`文件。​變量書面在這個配置文件章节是餵在HTML產量通過更換任何變量名包圍在大括號發現在HTML產量使用相應變量數據。​為例子，​哪里`foo="bar"`，​任何發生的`<p>{foo}</p>`發現在HTML產量將成為`<p>bar</p>`。

『theme』
- 用於CIDRAM的默認主題。

『Magnification』
- 字體放大。​標準 = 1。

『css_url』
- 模板文件為個性化主題使用外部CSS屬性，​而模板文件為t標準主題使用內部CSS屬性。​以指令CIDRAM使用模板文件為個性化主題，​指定公共HTTP地址的您的個性化主題的CSS文件使用`css_url`變量。​如果您離開這個變量空白，​CIDRAM將使用模板文件為默認主題。

---


### 7. <a name="SECTION7"></a>簽名格式

*也可以看看：*
- *[什麼是『簽名』？](#WHAT_IS_A_SIGNATURE)*

#### 7.0 基本概念

CIDRAM簽名格式和結構描述可以被發現記錄在純文本在自定義簽名文件。​請參閱該文檔了解更多有關CIDRAM簽名格式和結構。

所有IPv4簽名遵循格式：`xxx.xxx.xxx.xxx/yy [Function] [Param]`。
- `xxx.xxx.xxx.xxx` 代表CIDR塊開始（初始IP地址八比特組）。
- `yy` 代表CIDR塊大小 [1-32]。
- `[Function]` 指令腳本做什麼用的署名（應該怎麼簽名考慮）。
- `[Param]` 代表任何其他信息其可以由需要 `[Function]`。

所有IPv6簽名遵循格式：`xxxx:xxxx:xxxx:xxxx::xxxx/yy [Function] [Param]`。
- `xxxx:xxxx:xxxx:xxxx::xxxx` 代表CIDR塊的開始（初始IP地址八比特組）。​完整符號和縮寫符號是可以接受的（和每都必須遵循相應和相關IPv6符號標準，​但有一個例外：IPv6地址不能開頭是與縮寫當用來在簽名該腳本，​由於以何種方式CIDR是構建由腳本；例如，​當用來在簽名，​`::1/128`應該這樣寫`0::1/128`，​和`::0/128`應該這樣寫`0::/128`)。
- `yy` 代表CIDR塊大小 [1-128]。
- `[Function]` 指令腳本做什麼用的署名（應該怎麼簽名考慮）。
- `[Param]` 代表任何其他信息其可以由需要 `[Function]`。

CIDRAM簽名文件應該使用Unix的換行符（`%0A`，​或`\n`）！​其他換行符類型/風格（例如，​Windows `%0D%0A`或`\r\n`換行符，​Mac `%0D`或`\r`換行符，​等等） 可以被用於，​但不是優選。​非Unix的換行符將正常化至Unix的換行符由腳本。

精準無誤的CIDR符號是必須的，​不會是承認簽名。​另外，​所有的CIDR簽名必須用一個IP地址該始於一個數在該CIDR塊分割適合於它的塊大小（例如，​如果您想阻止所有的IP從`10.128.0.0`到`11.127.255.255`，​`10.128.0.0/8`不會是承認由腳本，​但`10.128.0.0/9`和`11.0.0.0/9`結合使用，​將是承認由腳本）。

任何數據在簽名文件不承認為一個簽名也不為簽名相關的語法由腳本將被忽略，​因此，​這意味著您可以放心地把任何未簽名數據和任何您想要的在簽名文件沒有打破他們和沒有打破該腳本。​註釋是可以接受的在簽名文件，​和沒有特殊的格式需要為他們。​Shell風格的哈希註釋是首選，​但並非強制；從功能的角度，​無論您是否選擇使用Shell風格的哈希註釋，​有沒有區別為腳本，​但使用Shell風格的哈希幫助IDE和純文本編輯器正確地突出的各個章节簽名文件（所以，​Shell風格的哈希可以幫助作為視覺輔助在編輯）。

`[Function]` 可能的值如下：
- Run
- Whitelist
- Greylist
- Deny

如果『Run』是用來，​當該簽名被觸發，​該腳本將嘗試執行（使用一個`require_once`聲明）一個外部PHP腳本，​由指定的`[Param]`值（工作目錄應該是『/vault/』腳本目錄）。

例子：`127.0.0.0/8 Run example.php`

這可能是有用如果您想執行一些特定的PHP代碼對一些特定的IP和/或CIDR。

如果『Whitelist』是用來，​當該簽名被觸發，​該腳本將重置所有檢測（如果有過任何檢測）和打破該測試功能。​`[Param]`被忽略。​此功能將白名單一個IP地址或一個CIDR。

例子：`127.0.0.1/32 Whitelist`

如果『Greylist』是用來，​當該簽名被觸發，​該腳本將重置所有檢測（如果有過任何檢測）和跳到下一個簽名文件以繼續處理。​`[Param]`被忽略。

例子：`127.0.0.1/32 Greylist`

如果『Deny』是用來，​當該簽名被觸發，​假設沒有白名單簽名已觸發為IP地址和/或CIDR，​訪問至保護的頁面被拒絕。​您要使用『Deny』為實際拒絕一個IP地址和/或CIDR範圍。​當任何簽名利用的『Deny』被觸發，​該『拒絕訪問』腳本頁面將生成和請求到保護的頁面會被殺死。

『Deny』的`[Param]`值會被解析為『拒絕訪問』頁面，​提供給客戶機/用戶作為引原因他們訪問到請求的頁面被拒絕。​它可以是一個短期和簡單的句子，​為解釋原因（什麼應該足夠了；一個簡單的消息像『我不想讓您在我的網站』會好起來的），​或一小撮之一的短關鍵字供應的通過腳本。​如果使用，​它們將被替換由腳本使用預先準備的解釋為什麼客戶機/用戶已被阻止。

預先準備的解釋具有多語言支持和可以翻譯通過腳本根據您的語言指定的通過`lang`腳本配置指令。​另外，​您可以指令腳本忽略『Deny』簽名根據他們的價`[Param]`值（如果他們使用這些短關鍵字）通過腳本配置指令（每短關鍵字有一個相應的指令到處理相應的簽名或忽略它）。​`[Param]`值不使用這些短關鍵字，​然而，​沒有多語言支持和因此不會被翻譯通過腳本，​並且還，​不能直接控制由腳本配置。

可用的短關鍵字是：
- Bogon
- Cloud
- Generic
- Proxy
- Spam

#### 7.1 標籤

如果要分割您的自定義簽名成各個章節，​您可以識別這些各個章節為腳本通過加入一個章節標籤立即跟著每簽名章節，​伴隨著簽名章節名字（看下面的例子）。

```
# 部分一。
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud
4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
6.7.8.9/32 Deny Proxy
Tag: 部分一
```

為了打破章節標籤和以確保標籤不是確定不正確的對於簽名章節從較早的在簽名文件，​確保有至少有兩個連續的換行符之間您的標籤和您的較早的簽名章節。​任何未標記簽名將默認為『IPv4』或『IPv6』（取決於簽名類型被觸發的）。

```
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud

4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
Tag: 部分一
```

在上面的例子`1.2.3.4/32`和`2.3.4.5/32`將標為『IPv4』，​而`4.5.6.7/32`和`5.6.7.8/32`將標為『部分一』.

如果您想簽名一段時間後過期，​以類似的方式來章節標籤，​您可以使用一個『過期標籤』來指定在簽名應該不再有效。​過期標籤使用格式『年年年年.月月.日日』（看下面的例子）。

```
# 部分一。
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Expires: 2016.12.31
```

章節標籤和過期標籤可以結合使用，​又都是可選（看下面的例子）。

```
# 示例部分。
1.2.3.4/32 Deny Generic
Tag: 示例部分
Expires: 2016.12.31
```

#### 7.2 YAML

##### 7.2.0 YAML基本概念

簡化形式的YAML標記可以使用在簽名文件用於目的定義行為和配置設置具體到個人簽名章節。​這可能是有用的如果您希望您的配置指令值到變化之間的個人簽名和簽名章節（例如；如果您想提供一個電子郵件地址為支持票為任何用戶攔截的通過一個特定的簽名，​但不希望提供一個電子郵件地址為支持票為用戶攔截的通過任何其他簽名；如果您想一些具體的簽名到觸發頁面重定向；如果您想標記一個簽名為使用的reCAPTCHA；如果您想日誌攔截的訪問到單獨的文件按照個人簽名和/或簽名章節）。

使用YAML標記在簽名文件是完全可選（即，​如果您想用這個，​您可以用這個，​但您沒有需要用這個），​和能夠利用最的（但不所有的）配置指令。

注意：YAML標記實施在CIDRAM是很簡單也很有限；它的目的是滿足特定要求的CIDRAM在方式具有熟悉的YAML標記，​但不跟隨也不符合規定的官方規格（因此，​將不會是相同的其他實現別處，​和可能不適合其他項目別處）。

在CIDRAM，​YAML標記段被識別到腳本通過使用三個連字符（『---』），​和終止靠他們的簽名章節通過雙換行符。​一個典型的YAML標記段在一個簽名章節被組成的三個連字符在一行立馬之後的CIDR列表和任何標籤，​接著是二維表為鍵值對（第一維，​配置指令類別；第二維，​配置指令）為哪些配置指令應修改（和哪些值）每當一個簽名內那簽名章節被觸發（看下面的例子）。

```
# Foobar 1.
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
4.5.6.7/32 Deny Generic
Tag: Foobar 1
---
general:
 logfile: logfile.{yyyy}-{mm}-{dd}.txt
 logfileApache: access.{yyyy}-{mm}-{dd}.txt
 logfileSerialized: serial.{yyyy}-{mm}-{dd}.txt
 forbid_on_block: false
 emailaddr: username@domain.tld
recaptcha:
 lockip: false
 lockuser: true
 expiry: 720
 logfile: recaptcha.{yyyy}-{mm}-{dd}.txt
 enabled: true
template_data:
 css_url: http://domain.tld/cidram.css

# Foobar 2.
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
4.5.6.7/32 Deny Generic
Tag: Foobar 2
---
general:
 logfile: "logfile.Foobar2.{yyyy}-{mm}-{dd}.txt"
 logfileApache: "access.Foobar2.{yyyy}-{mm}-{dd}.txt"
 logfileSerialized: "serial.Foobar2.{yyyy}-{mm}-{dd}.txt"
 forbid_on_block: 503

# Foobar 3.
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
4.5.6.7/32 Deny Generic
Tag: Foobar 3
---
general:
 forbid_on_block: 403
 silent_mode: "http://127.0.0.1/"
```

##### 7.2.1 如何『特別標記』簽名章節為使用的reCAPTCHA

當『usemode』是『0』或『1』，​簽名章節不需要是『特別標記』簽名章節為使用的reCAPTCHA（因為他們也會或不會使用reCAPTCHA，​根據此設置）。

當『usemode』是『2』，​為『特別標記』簽名章節為使用的reCAPTCHA，​一個條目是包括在YAML段為了那個簽名章節（看下面的例子）。

```
# 本節將使用reCAPTCHA。
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Tag: reCAPTCHA-Enabled
---
recaptcha:
 enabled: true
```

注意：一個reCAPTCHA將僅提供給用戶如果reCAPTCHA是啟用（當『usemode』是『1』，​或『usemode』是『2』和『enabled』是『true』），​和如果只有一個簽名已觸發（不多不少；如果多個簽名被觸發，​一個reCAPTCHA將不提供）。

#### 7.3 輔

此外，​如果您想CIDRAM完全忽略一些具體的章節內的任何簽名文件，​您可以使用`ignore.dat`文件為指定忽略哪些章節。​在新行，​寫`Ignore`，​空間，​然後該名稱的章節您希望CIDRAM忽略（看下面的例子）。

```
Ignore 部分一
```

參考定制簽名文件了解更多信息。

---


### 8. <a name="SECTION8"></a>常見問題（FAQ）

#### <a name="WHAT_IS_A_SIGNATURE"></a>什麼是『簽名』？

在CIDRAM的上下文中，​『簽名』是一些數據，​它表示/識別我們正在尋找的東西，​通常是IP地址或CIDR，​並包含一些說明，​告訴CIDRAM最好的回應方法當它遇到我們正在尋找的。​CIDRAM的典型簽名如下所示：

`1.2.3.4/32 Deny Generic`

經常（但不總是），​簽名是捆綁在一起，​形成『簽名章節』，​經常伴隨評論，​標記，​和/或相關元數據。​這可以用於為簽名提供附加上下文和/或附加說明。

#### <a name="WHAT_IS_A_CIDR"></a>什麼是『CIDR』？

『CIDR』 是 『Classless Inter-Domain Routing』 的首字母縮寫 （『無類別域間路由』） *【[1](https://zh.wikipedia.org/wiki/%E6%97%A0%E7%B1%BB%E5%88%AB%E5%9F%9F%E9%97%B4%E8%B7%AF%E7%94%B1), [2](http://whatismyipaddress.com/cidr)】*。​這個首字母縮寫用於這個包的名稱，​『CIDRAM』，​是 『Classless Inter-Domain Routing Access Manager』 的首字母縮寫 （『無類別域間路由訪問管理器』）。

然而，​在CIDRAM的上下文中（如，​在本文檔中，​在CIDRAM的討論中，​或在CIDRAM語言數據中），​當『CIDR』（單數）或『CIDRs』（複數）被提及時（因此當我們用這些詞作為名詞在自己的權利，​而不作為首字母縮寫），​我們的意圖是一個子網，​用CIDR表示法表示。​使用CIDR/CIDRs而不是子網的原因是澄清它是用CIDR表示法表示的子網是我們的意思 （因為子網可以用幾種不同的方式表達）。​因此，​CIDRAM可以被認為是『子網訪問管理器』。

這個雙重含義可能看起來很歧義，​但這個解釋並提供上下文應該有助於解決這個歧義。

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>什麼是『假陽性』？

術語『假陽性』（*或者：『假陽性錯誤』；『虛驚』*；英語：*false positive*； *false positive error*； *false alarm*），​很簡單地描述，​和在一個廣義上下文，​被用來當測試一個因子，​作為參考的測試結果，​當結果是陽性（即：因子被確定為『陽性』，​或『真』），​但預計將為（或者應該是）陰性（即：因子，​在現實中，​是『陰性』，​或『假』）。​一個『假陽性』可被認為是同樣的『哭狼』 (其中，​因子被測試是是否有狼靠近牛群，​因子是『假』由於該有沒有狼靠近牛群，​和因子是報告為『陽性』由牧羊人通過叫喊『狼，​狼』），​或類似在醫學檢測情況，​當患者被診斷有一些疾病，​當在現實中，​他們沒有疾病。

一些相關術語是『真陽性』，​『真陰性』和『假陰性』。​一個『真陽性』指的是當測試結果和真實因子狀態都是『真』（或『陽性』），​和一個『真陰性』指的是當測試結果和真實因子狀態都是『假』（或『陰性』）；一個『真陽性』或『真陰性』被認為是一個『正確的推理』。​對立面『假陽性』是一個『假陰性』；一個『假陰性』指的是當測試結果是『陰性』（即：因子被確定為『陰性』，​或『假』），​但預計將為（或者應該是）陽性（即：因子，​在現實中，​是『陽性』，​或『真』）。

在CIDRAM的上下文，​這些術語指的是CIDRAM的簽名和什麼/誰他們阻止。​當CIDRAM阻止一個IP地址由於惡劣的，​過時的，​或不正確的簽名，​但不應該這樣做，​或當它這樣做為錯誤的原因，​我們將此事件作為一個『假陽性』。​當CIDRAM未能阻止IP地址該應該已被阻止，​由於不可預見的威脅，​缺少簽名或不足簽名，​我們將此事件作為一個『檢測錯過』（同樣的『假陰性』）。

這可以通過下表來概括：

&nbsp; | CIDRAM不應該阻止IP地址 | CIDRAM應該阻止IP地址
---|---|---
CIDRAM不會阻止IP地址 | 真陰性（正確的推理） | 檢測錯過（同樣的『假陰性』）
CIDRAM會阻止IP地址 | __假陽性__ | 真陽性（正確的推理）

#### CIDRAM可以阻止整個國家嗎？

它可以。​實現這個最簡單的方法是安裝一些由Macmathan提供的可選的國家阻止列表。​這可以通過直接從前端更新頁面的幾個簡單的點擊完成，​或，​如果您希望前端保持停用狀態，​通過直接從下載頁面下載它們。​通過直接從 **[可選的國家阻止列表下載頁面](https://macmathan.info/blocklists)** 下載它們，​上傳他們到vault，​在相關配置指令中引用它們的名稱。

#### 什麼是簽名更新頻率？

更新頻率根據相關的簽名文件而有所不同。​所有的CIDRAM簽名文件的維護者通常盡量保持他們的簽名為最新，​但是因為我們所有人都有各種其他承諾，​和因為我們的生活超越了項目，​和因為我們不得到經濟補償/付款為我們的項目的努力，​無法保證精確的更新時間表。​通常，​簽名被更新每當有足夠的時間，​和維護者嘗試根據必要性和根據范圍之間的變化頻率確定優先級。​幫助總是感謝，​如果你願意提供任何。

#### 我在使用CIDRAM時遇到問題和我不知道該怎麼辦！​請幫忙！

- 您使用軟件的最新版本嗎？​您使用簽名文件的最新版本嗎？​如果這兩個問題的答案是不，​嘗試首先更新一切，​然後檢查問題是否仍然存在。​如果它仍然存在，​繼續閱讀。
- 您檢查過所有的文檔嗎？​如果沒有做，​請這樣做。​如果文檔不能解決問題，​繼續閱讀。
- 您檢查過 **[問題頁面](https://github.com/CIDRAM/CIDRAM/issues)** 嗎？​檢查是否已經提到了問題。​如果已經提到了，​請檢查是否提供了任何建議，​想法或解決方案。​按照需要嘗試解決問題。
- 您檢查過 **[由Spambot Security提供的CIDRAM支持論壇](http://www.spambotsecurity.com/forum/viewforum.php?f=61)** 嗎？​檢查是否已經提到了問題。​如果已經提到了，​請檢查是否提供了任何建議，​想法或解決方案。​按照需要嘗試解決問題。
- 如果問題仍然存在，​請讓我們知道；在問題頁面或支持論壇上開始新的討論。

#### 因為CIDRAM，​我被阻止從我想訪問的網站！​請幫忙！

CIDRAM使網站所有者能夠阻止不良流量，​但網站所有者有責任為自己決定如何使用CIDRAM。​在關於默認簽名文件假陽性的情況下，​可以進行校正。​但關於從特定網站解除阻止，​您需要與相關網站的所有者進行溝通。​當進行校正時，​至少，​他們需要更新他們的簽名文件和/或安裝。​在其他情況下（例如，​當他們修改了他們的安裝，​當他們創建自己的自定義簽名，​等等），​解決您的問題的責任完全是他們的，​並完全不在我們的控制之內。

#### 我想使用CIDRAM與早於5.4.0的PHP版本；​您能幫我嗎？

不能。​PHP 5.4.0於2014年達到官方EoL（『生命終止』）。​延長的安全支持在2015年終止。​這時候目前，​它是2017年，​和PHP 7.1.0已經可用。​目前，​有支持使用CIDRAM與PHP 5.4.0和所有可用的較新的PHP版本，​但不有支持使用CIDRAM與任何以前的PHP版本。

*也可以看看：​[兼容性圖表](https://maikuolan.github.io/Compatibility-Charts/)。*

#### 我可以使用單個CIDRAM安裝來保護多個域嗎？

可以。​CIDRAM安裝未綁定到特定域，​因此可以用來保護多個域。​通常，​當CIDRAM安裝保護只一個域，​我們稱之為『單域安裝』，​和當CIDRAM安裝保護多個域和/或子域，​我們稱之為『多域安裝』。​如果您進行多域安裝並需要使用不同的簽名文件為不同的域，​或需要不同配置CIDRAM為不同的域，​這可以做到。​加載配置文件後（`config.ini`），​CIDRAM將尋找『配置覆蓋文件』特定於所請求的域（`xn--cjs74vvlieukn40a.tld.config.ini`），​並如果發現，​由配置覆蓋文件定義的任何配置值將用於執行實例而不是由配置文件定義的配置值。​配置覆蓋文件與配置文件相同，​並通過您的決定，​可能包含CIDRAM可用的所有配置指令，​或任何必需的部分當需要。​配置覆蓋文件根據它們旨在的域來命名（所以，​例如，​如果您需要一個配置覆蓋文件為域，​`http://www.some-domain.tld/`，​它的配置覆蓋文件應該被命名`some-domain.tld.config.ini`，​和它應該放置在`vault`與配置文件，​`config.ini`）。​域名是從標題`HTTP_HOST`派生的；『www』被忽略。

#### 我不想浪費時間安裝這個和確保它在我的網站上功能正常；我可以僱用您這樣做嗎？

也許。​這是根據具體情況考慮的。​告訴我們您需要什麼，​您提供什麼，​和我們會告訴您是否可以幫忙。

#### 我可以聘請您或這個項目的任何開發者私人工作嗎？

*參考上面。​*

#### 我需要專家修改，​的定制，​等等；您能幫我嗎？

*參考上面。​*

#### 我是開發人員，​網站設計師，​或程序員。​我可以接受還是提供與這個項目有關的工作？

您可以。​我們的許可證並不禁止這一點。

#### 我想為這個項目做出貢獻；我可以這樣做嗎？

您可以。​對項目的貢獻是歡迎。​有關詳細信息，​請參閱『CONTRIBUTING.md』。

#### 『ipaddr』的推薦值。

值 | 運用
---|---
`HTTP_INCAP_CLIENT_IP` | Incapsula反向代理。
`HTTP_CF_CONNECTING_IP` | Cloudflare反向代理。
`CF-Connecting-IP` | Cloudflare反向代理（替代；如果另一個不工作）。
`HTTP_X_FORWARDED_FOR` | Cloudbric反向代理。
`X-Forwarded-For` | [Squid反向代理](http://www.squid-cache.org/Doc/config/forwarded_for/)。
*由服務器配置定義。​* | [Nginx反向代理](https://www.nginx.com/resources/admin-guide/reverse-proxy/)。
`REMOTE_ADDR` | 沒有反向代理（默認值）。

#### 可以使用cron自動更新嗎？

您可以。​前端有內置了API，外部腳本可以使用它與更新頁面進行交互。​一個單獨的腳本，『[Cronable](https://github.com/Maikuolan/Cronable)』，是可用，它可以由您的cron manager或cron scheduler程序使用於自動更新此和其他支持的包（此腳本提供自己的文檔）。

#### 什麼是『違規』？

『違規』決定何時還沒有被任何特定簽名文件阻止的IP應該開始被阻止以將來的任何請求，​他們與IP跟踪密切相關。​一些功能和模塊允許請求由於起源IP以外的原因被阻塞（例如，spambot或hacktool用戶代理【user agent】，危險的查詢，假的DNS，等等），當發生這種情況時，可能會發生『違規』。​這提供了一種識別不需要的請求的IP地址的方法（如果被任何特定的簽名文件的不被阻止已經）。​違規通常與IP被阻止的次數是1比1，但不總是（在嚴重事件中，可能會產生大於1的違規值，如果『track_mode』是假的【false】，對於僅由簽名文件觸發的塊事件，不會發生違規）。

---


最後更新：2017年11月25日。
