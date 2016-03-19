<?php
/**
 * This file is a part of the CIDRAM package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/CIDRAM/ GitHub}.
 *
 * CIDRAM COPYRIGHT 2016 and beyond by Caleb Mazalevskis (Maikuolan).
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Chinese (traditional) language data (last modified: 2016.03.20).
 *
 * @package Maikuolan/CIDRAM
 */

/** Prevents execution from outside of CIDRAM. */
if (!defined('CIDRAM')) {
    die('[CIDRAM] This should not be accessed directly.');
}

$CIDRAM['lang']['click_here'] = '點擊這裡';
$CIDRAM['lang']['denied'] = '拒絕訪問！';
$CIDRAM['lang']['Error_WriteCache'] = '無法寫入緩存！請檢查您的CHMOD文件的權限！';
$CIDRAM['lang']['field_datetime'] = '日期/時間: ';
$CIDRAM['lang']['field_id'] = 'ID: ';
$CIDRAM['lang']['field_ipaddr'] = 'IP地址: ';
$CIDRAM['lang']['field_query'] = '網頁查詢: ';
$CIDRAM['lang']['field_referrer'] = '引薦: ';
$CIDRAM['lang']['field_scriptversion'] = '腳本版本: ';
$CIDRAM['lang']['field_sigcount'] = '簽名計數: ';
$CIDRAM['lang']['field_sigref'] = '簽名參考: ';
$CIDRAM['lang']['field_ua'] = '用戶代理: ';
$CIDRAM['lang']['generated_by'] = '所產生通過';
$CIDRAM['lang']['preamble'] = '-- 結束序言。添加您的問題或意見該行之後。 --';
$CIDRAM['lang']['ReasonMessage_BadIP'] = '您的訪問這個頁面被拒絕因為您試圖訪問該頁面使用一個無效的IP地址。';
$CIDRAM['lang']['ReasonMessage_Bogon'] = '您的訪問這個頁面被拒絕因為您的IP地址被識別作為火星IP地址，和來自這些IP連接不是由網站所有者允許。';
$CIDRAM['lang']['ReasonMessage_Cloud'] = '您的訪問這個頁面被拒絕因為您的IP地址被識別為屬於雲服務，和來自這些IP連接不是由網站所有者允許。';
$CIDRAM['lang']['ReasonMessage_Generic'] = '您的訪問這個頁面被拒絕因為您的IP地址屬於一個網絡在黑名單中所列使用本網站。';
$CIDRAM['lang']['ReasonMessage_Spam'] = '您的訪問這個頁面被拒絕因為您的IP地址屬於一個網絡被認為是高風險的垃圾郵件。';
$CIDRAM['lang']['Short_BadIP'] = '無效的IP！';
$CIDRAM['lang']['Support_Email'] = '如果您認為這是錯誤的，或尋求援助，{ClickHereLink}發送電子郵件支持票本網站的網站管理員（請不要改變序言或主題行）。';

$CIDRAM['lang']['CLI_H'] = "
 CIDRAM CLI模式輔助。

 用法：
 /path/to/php/php.exe /path/to/cidram/loader.php -鍵 （輸入）

 鍵：
    -h  顯示此幫助信息。
    -c  檢查如果一個IP地址被阻止由CIDRAM簽名文件。
    -g  生成CIDR從一個IP地址。

 輸入： 可以是任何有效的地址（IPv4/IPv6）。

 例子：
        -c  192.168.0.0/16
        -c  127.0.0.1/32
        -c  2001:db8::/32
        -c  2002::1/128

";

$CIDRAM['lang']['CLI_Bad_IP'] = ' 指定的IP地址，“{IP}”，不是有效地址（IPv4/IPv6）！';
$CIDRAM['lang']['CLI_IP_Blocked'] = ' 指定的IP地址，“{IP}”，是由一個或多個阻塞簽名文件。';
$CIDRAM['lang']['CLI_IP_Not_Blocked'] = ' 指定的IP地址，“{IP}”，不是由一個或多個阻塞簽名文件。';
