## <div dir="rtl">CIDRAM لئے دستاویزی (اردو).</div>

### <div dir="rtl">فہرست:</div>
<div dir="rtl"><ul>
 <li>١. <a href="#SECTION1">تمہید</a></li>
 <li>٢. <a href="#SECTION2">انسٹال کرنے کا طریقہ</a></li>
 <li>٣. <a href="#SECTION3">کس طرح استعمال</a></li>
 <li>٤. <a href="#SECTION4">سامنے کے آخر میں انتظام</a></li>
 <li>٥. <a href="#SECTION5">فائل اس پیکیج میں شامل</a></li>
 <li>٦. <a href="#SECTION6">ترتیب کے اختیارات</a></li>
 <li>٧. <a href="#SECTION7">دستخط فارمیٹ</a></li>
 <li>٨. <a href="#SECTION8">اکثر پوچھے گئے سوالات (FAQ)</a></li>
</ul></div>

<div dir="rtl"><em>ترجمہ سلسلے نوٹ: کی غلطیوں کی صورت میں (جیسے، ترجمہ، typos کے، وغیرہ کے درمیان تضادات)، مجھے پڑھ کے انگریزی ورژن اصل اور مستند ورژن سمجھا جاتا ہے. آپ کو کسی بھی کی غلطیوں کو تلاش کریں تو ان کو ٹھیک کرنے میں آپ کی مدد کا خیر مقدم کیا جائے گا.</em></div>

---


### <div dir="rtl">١. <a name="SECTION1"></a>تمہید</div>

<div dir="rtl">CIDRAM (غیر طبقاتی انٹر ڈومین روٹنگ رسائی مینیجر) بشمول (لیکن تک محدود نہیں) غیر انسانی رسائی endpoints کے، کلاؤڈ سروسز سے ٹریفک ناپسندیدہ ٹریفک کے ہونے کی وجہ سے ذرائع، کے طور پر شمار IP پتوں سے شروع کی درخواستوں کو مسدود کرنے کی طرف سے ویب سائٹس کی حفاظت کے لئے ڈیزائن کیا ایک پی ایچ پی کی سکرپٹ ہے ، اسپیم بوٹس، سکراپارس، وغیرہ یہ باؤنڈ درخواستوں سے فراہم IP پتوں کی ممکنہ CIDRs کو شمار کرتے ہیں اور پھر (ان کے دستخط فائلوں ہونے کے ذرائع کے طور پر شمار IP پتوں کی CIDRs کی فہرستوں پر مشتمل اس کے دستخط فائلوں کے خلاف ان ممکن CIDRs سے ملنے کے لئے کی کوشش کر کے اس کرتا ہے ناپسندیدہ ٹریفک کے)؛ موازنہ نہیں ملا رہے ہیں تو، درخواستوں مسدود ہیں.<br /><br /></div>

<div dir="rtl"><em>(دیکھیں: <a href="#WHAT_IS_A_CIDR">ایک "CIDR" کیا ہے؟</a>).</em><br /><br /></div>

<div dir="rtl">CIDRAM کاپی رائٹ 2016 اور Caleb M (Maikuolan) کی طرف GNU/GPLv2 اجازت سے آگے.<br /><br /></div>

<div dir="rtl">یہ سکرپٹ مفت سافٹ ویئر ہے. آپ اسے دوبارہ تقسیم اور / یا کے طور پر مفت سافٹ ویئر فاؤنڈیشن کی جانب سے شائع GNU جنرل پبلک لائسنس کی شرائط کے تحت اس پر نظر ثانی کر سکتے ہیں؛ یا تو لائسنس کے ورژن 2، یا (آپ کے اختیارات پر) کسی بھی جدید ورژن. یہ سکرپٹ یہ مفید ہو جائے گا، لیکن کسی بھی وارنٹی کے بغیر امید میں تقسیم کیا جاتا ہے؛ کسی خاص مقصد کے لئے قابل فروختگی یا فٹنس کی بھی تقاضا وارنٹی کے بغیر. مزید تفصیلات کے لئے GNU جنرل پبلک لائسنس، "LICENSE.txt" فائل اور سے بھی دستیاب میں واقع دیکھیں:</div>

- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

<div dir="rtl">یہ دستاویز اور اس کے متعلقہ پیکج سے مفت کے لئے ڈاؤن لوڈ کیا جا سکتا ہے <a href="https://github.com/Maikuolan/CIDRAM/">GitHub</a>.</div>

---


### <div dir="rtl">٢. <a name="SECTION2"></a>انسٹال کرنے کا طریقہ</div>

#### <div dir="rtl">٢.٠ دستی طور پر نصب</div>

<div dir="rtl">١. آپ کے پڑھنے کی طرف سے اس، مجھے سنبھالنے رہا ہوں آپ کے پاس پہلے، اسکرپٹ کا ایک آرکائیو کاپی کو ڈاؤن لوڈ کیا اس کے مشمولات کو پھیلا اور اس کو اپنے مقامی مشین پر کہیں بیٹھے ہیں کیا ہے. یہاں سے، آپ جہاں آپ کا میزبان یا CMS پر آپ ان کے مندرجات رکھنے کے لئے چاہتے ہیں باہر کام کرنے چاہیں گے. جیسے "/public_html/cidram/" یا اسی طرح کی (اگرچہ، یہ جو آپ کو اسے محفوظ ہے کچھ اور کچھ اور آپ کے ساتھ خوش ہیں ہے اتنی دیر کے طور پر انتخاب کرتے ہیں، کوئی فرق نہیں پڑتا) ایک ڈائریکٹری کافی ہوگا. <em>آپ کو اپ لوڈ کرنے شروع کرنے سے پہلے، پر پڑھیں ..</em><br /><br /></div>

<div dir="rtl">٢. config.ini" (اندر "vault" واقع کرنے "config.ini.RenameMe" نام تبدیل)، اور اختیاری پختہ اعلی درجے کی صارفین کے لئے سفارش کی جاتی ہے، لیکن (اس فائل پر مشتمل ابتدائی کے لئے یا ناتجربہ کار)، اسے کھولنے کے لئے سفارش کی نہیں CIDRAM لئے دستیاب تمام ہدایات؛ ہر آپشن کے اوپر ایک مختصر تبصرہ یہ کیا کرتا بیان اور کیا اس کے لئے ہے) ہونا چاہئے. آپ کو فٹ دیکھ کے طور جو بھی اپنے مخصوص سیٹ اپ کے لئے مناسب ہے کے مطابق ان ہدایات کو ایڈجسٹ کریں. فائل محفوظ کریں، قریب ہے.<br /><br /></div>

<div dir="rtl">٣. (اگر آپ پہلے پر فیصلہ کیا تھا ڈائریکٹری میں مندرجات (CIDRAM اور اس کی فائلوں) کو اپ لوڈ کریں آپ "*.txt/*.md" فائلوں کو شامل کرنے کی ضرورت نہیں ہے، لیکن زیادہ تر، تم سب کچھ اپ لوڈ کرنا چاہئے) .<br /><br /></div>

<div dir="rtl">٤. CHMOD "755" (مسائل ہیں تو، آپ کو کوشش "vault" ڈائریکٹری میں کر سکتے ہیں "777"؛ اس سے کم محفوظ ہے، اگرچہ). مندرجات (آپ اس سے قبل انتخاب کیا ایک) ذخیرہ کرنے کے اہم ڈائریکٹری، عام طور پر، آپ کو آپ کے سسٹم پر ماضی میں اجازتیں مسائل پڑا ہے تو اکیلے چھوڑ دیا جا سکتا ہے، لیکن CHMOD کی حیثیت کی جانچ پڑتال کی جانی چاہئے (ڈیفالٹ کی طرف سے، جیسے "755" کچھ ہونا چاہئے).<br /><br /></div>

<div dir="rtl">٥. اگلا، آپ کو "ہک" آپ کے سسٹم یا CMS کرنے CIDRAM کرنا ہوگا. کئی مختلف طریقے ہیں آپ کر سکتے ہیں جیسا کہ آپ کے سسٹم یا CMS، لیکن سب سے آسان ہے صرف عام طور پر ہمیشہ سے لوڈ کیا جائے گا کہ آپ کے سسٹم یا CMS (ایک کی ایک بنیادی فائل کے شروع میں سکرپٹ کو شامل کرنے کے لئے کرنا CIDRAM "ہک" اسکرپٹس اگر کوئی ویب سائٹ بھر میں کسی بھی صفحے تک رسائی حاصل کرتا ہے جب) ایک "require" یا "include" بیان کا استعمال کرتے ہوئے. عام طور پر، اس طرح کے طور پر "/includes"، "/assets" یا "/functions" ایک ڈائریکٹری میں محفوظ کیا کچھ ہو جائے گا، اور اکثر" init.php"، "common_functions.php"،" افعال کی طرح کچھ نام دیا جائے گا. php" یا اسی طرح کی. تم جس فائل اگر یہ آپ کی صورت حال کے لئے ہے باہر کام کرنا پڑے گا؛ تم اپنے لئے اس سے باہر کام کرنے میں مشکلات کا سامنا کرتے ہیں، GitHub کے پر CIDRAM مسائل کا صفحہ ملاحظہ کریں. [ "require" یا" استعمال کرنے کے لئے include"] ایسا کرنے کے لئے، جو کہ بنیادی فائل کے شروع کرنے کے لئے کوڈ کی مندرجہ ذیل لائن داخل، "loader.php" فائل کا عین مطابق ایڈریس کے ساتھ واوین کے اندر موجود سٹرنگ کی جگہ (مقامی پتہ، نہ HTTP ایڈریس؛ یہ پہلے ذکر والٹ ایڈریس کو اسی طرح دیکھ لیں گے).<br /><br /></div>

`<?php require '/user_name/public_html/cidram/loader.php'; ?>`

<div dir="rtl">فائل، قریب، ہٹادیا بچائیں.<br /><br /></div>

<div dir="rtl">-- یا متبادل --<br /><br /></div>

<div dir="rtl">آپ ایک اپاچی ویب سرور استعمال کر رہے ہیں اور آپ کو "php.ini" تک رسائی ہے تو، تو آپ جب بھی کسی بھی پی ایچ پی کی درخواست کی جاتی ہے CIDRAM prepend کے کو "auto_prepend_file" ہدایت کو استعمال کر سکتے ہیں. کی طرح کچھ:<br /><br /></div>

`auto_prepend_file = "/user_name/public_html/cidram/loader.php"`

<div dir="rtl">یا ".htaccess" فائل میں اس:<br /><br /></div>

`php_value auto_prepend_file "/user_name/public_html/cidram/loader.php"`

<div dir="rtl">٦. یہی سب کچھ ہے! 😄<br /><br /></div>

#### <div dir="rtl">٢.١ COMPOSER کے ساتھ نصب</div>

<div dir="rtl"><a href="https://packagist.org/packages/maikuolan/cidram">CIDRAM Packagist ساتھ رجسٹرڈ ہے</a>، اور اسی طرح، آپ کمپوزر سے واقف ہیں تو، آپ (CIDRAM انسٹال کرنے کے کمپوزر استعمال کر سکتے ہیں اگر آپ اب بھی تیار کرنے کے لئے کی ضرورت ہو گی ترتیب اور ہکس اگرچہ؛ "دستی طور پر نصب کرنے" دیکھیں 2 اقدامات اور 5).<br /><br /></div>

`composer require maikuolan/cidram`

#### <div dir="rtl">٢.٢ ورڈپریس کے لئے نصب</div>

<div dir="rtl">اگر آپ ورڈپریس کے ساتھ CIDRAM استعمال کرنا چاہتے ہیں تو، آپ کو مندرجہ بالا تمام ہدایات کو نظر انداز کر سکتے ہیں. <a href="https://wordpress.org/plugins/cidram/">CIDRAM ورڈپریس پلگ ان کے ڈیٹا بیس کے ساتھ ایک پلگ ان کے طور پر رجسٹرڈ ہے</a>، اور آپ کو پلگ ان ڈیش بورڈ سے براہ راست CIDRAM انسٹال کر سکتے ہیں. آپ کسی بھی دیگر پلگ ان کے طور پر اسی انداز میں اسے انسٹال کر سکتے ہیں، اور کوئی اس کے علاوہ اقدامات کی ضرورت ہے. بس دوسرے کی تنصیب کے طریقوں کے ساتھ کے طور پر، آپ "config.ini" فائل کے مواد میں تبدیلی کرنے کی طرف سے یا سامنے کے آخر میں ترتیب صفحے کا استعمال کرتے ہوئے کی طرف سے آپ کی تنصیب کے اپنی مرضی کے مطابق کر سکتے ہیں. آپ کو سامنے کے آخر میں اپ ڈیٹس صفحے کا استعمال کرتے ہوئے CIDRAM سامنے کے آخر میں اور اپ ڈیٹ CIDRAM فعال کرتے ہیں تو یہ خود کار طریقے سے پلگ ان ڈیش بورڈ میں ظاہر پلگ ان ورژن کی معلومات کے ساتھ مطابقت پذیر ہو گی<br /><br /></div>

---


### <div dir="rtl">٣. <a name="SECTION3"></a>کس طرح استعمال</div>

<div dir="rtl">CIDRAM خود کار طریقے سے آپ کی ویب سائٹ کو ناپسندیدہ درخواستوں کسی بھی دستی امداد کی ضرورت کے بغیر، ایک طرف اس کی ابتدائی تنصیب سے مسدود کرنا چاہئے.<br /><br /></div>

<div dir="rtl">اپ ڈیٹ ہو دستی طور پر کیا گیا ہے، اور آپ کو آپ کی ترتیب اپنی مرضی کے مطابق اور اپنی مرضی کے مطابق جس CIDRs آپ کی کنفیگریشن فائل اور / یا آپ کے دستخط کی فائلوں میں تبدیلی کرنے کی طرف سے بلاک کر رہے ہیں کر سکتے ہیں.<br /><br /></div>

<div dir="rtl">آپ کو کسی بھی جھوٹے مثبت سامنا کرتے ہیں، مجھے اس کے بارے میں مطلع کرنے کے لئے مجھ سے رابطہ کریں.<br /><br /></div>

---


### <div dir="rtl">٤. <a name="SECTION4"></a>سامنے کے آخر میں انتظام</div>

#### <div dir="rtl">٤.٠ سامنے کے آخر کیا ہے.<br /><br /></div>

<div dir="rtl">سامنے کے آخر میں، برقرار رکھنے کا انتظام، اور آپ CIDRAM تنصیب کو اپ ڈیٹ کرنے کے لئے ایک آسان اور آسان طریقہ فراہم کرتا ہے. آپ صرف مسودہ دیکھ سکتے ہیں، اشتراک، اور نوشتہ صفحے کے ذریعے لاگ مسلیں لوڈ، آپ کی ترتیب کے صفحے کے ذریعے کی ترتیب تبدیل کر سکتے ہیں، آپ کو انسٹال کر سکتے ہیں اور اپ ڈیٹس صفحے کے ذریعے انسٹال اجزاء، اور آپ کو اپ لوڈ کر سکتے ہیں، ڈاؤن لوڈ، اتارنا، اور فائل کے ذریعے آپ کے والٹ میں فائلوں پر نظر ثانی مینیجر.<br /><br /></div>

<div dir="rtl">سامنے کے آخر میں (آپ کی ویب سائٹ اور اس کی سیکیورٹی کے لئے اہم نتائج ہو سکتے ہیں غیر مجاز رسائی) غیر مجاز رسائی کو روکنے کے لئے پہلے سے طے شدہ کی طرف سے غیر فعال ہے. اس کو چالو کرنے کے لئے ہدایات اس پیراگراف ذیل میں شامل ہیں.<br /><br /></div>

#### <div dir="rtl">٤.١ سامنے کے آخر میں فعال کرنے کا طریقہ.<br /><br /></div>

<div dir="rtl">١. اندر "config.ini", "disable_frontend" ہدایت کو تلاش کریں اور "false" کرنے کے لئے مقرر (یہ ڈیفالٹ کی طرف سے "true" ہو جائے گا).<br /><br /></div>

<div dir="rtl">٢. رسائی اپنے براؤزر سے "loader.php" (جیسے، "http://localhost/cidram/loader.php").<br /><br /></div>

<div dir="rtl">٣. پہلے سے طے شدہ صارف کا نام اور پاس ورڈ کے ساتھ لاگ ان کریں (admin/password).<br /><br /></div>

<div dir="rtl">نوٹ: اگر آپ کو پہلی بار کے لئے لاگ ان کرنے کے بعد، سامنے کے آخر تک غیر مجاز رسائی کو روکنے کے لئے، آپ کو فوری طور پر آپ کا صارف نام اور پاس ورڈ کو تبدیل کرنا چاہئے! یہ بہت اہم ہے، یہ سامنے کے آخر میں کے ذریعے آپ کی ویب سائٹ پر من مانی پی ایچ پی کوڈ کو اپ لوڈ کرنا ممکن ہے کیونکہ.<br /><br /></div>

#### <div dir="rtl">٤.٢ سامنے کے آخر میں کس طرح استعمال.<br /><br /></div>

<div dir="rtl">ہدایات یہ اور اس مقصد کو استعمال کرنے کا صحیح طریقہ کی وضاحت کے لئے سامنے کے آخر میں کے ہر صفحے پر فراہم کی جاتی ہیں. اگر آپ کو مزید وضاحت یا کوئی خاص مدد کی ضرورت ہے، کی مدد سے رابطہ کریں. متبادل طور پر، یو ٹیوب پر دستیاب کچھ ویڈیوز مظاہرے کی راہ کی طرف مدد کر سکتا ہے جس میں موجود ہیں.<br /><br /></div>

---


### <div dir="rtl">٥. <a name="SECTION5"></a>فائل اس پیکیج میں شامل</div>

<div dir="rtl">مندرجہ ذیل اس سکرپٹ کے ذخیرہ کردہ کاپی میں شامل کیا گیا ہے کہ آپ ان فائلوں کے مقصد کی ایک مختصر وضاحت کے ساتھ ساتھ، یہ ڈاؤن لوڈ، جب تمام فائلوں کی ایک فہرست ہے.<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline;">تفصیل</div> | <div dir="rtl" style="display:inline;">فائل</div>
----|----
&nbsp; <div dir="rtl" style="display:inline;">دستاویزی ڈائریکٹری (مختلف فائلوں پر مشتمل ہے).</div> | /_docs/
&nbsp; <div dir="rtl" style="display:inline;">عربی دستاویزات.</div> | /_docs/readme.ar.md
&nbsp; <div dir="rtl" style="display:inline;">جرمن دستاویزات.</div> | /_docs/readme.de.md
&nbsp; <div dir="rtl" style="display:inline;">انگریزی دستاویزات.</div> | /_docs/readme.en.md
&nbsp; <div dir="rtl" style="display:inline;">ہسپانوی دستاویزات.</div> | /_docs/readme.es.md
&nbsp; <div dir="rtl" style="display:inline;">فرانسیسی دستاویزات.</div> | /_docs/readme.fr.md
&nbsp; <div dir="rtl" style="display:inline;">انڈونیشیا دستاویزات.</div> | /_docs/readme.id.md
&nbsp; <div dir="rtl" style="display:inline;">اطالوی دستاویزات.</div> | /_docs/readme.it.md
&nbsp; <div dir="rtl" style="display:inline;">جاپانی دستاویزات.</div> | /_docs/readme.ja.md
&nbsp; <div dir="rtl" style="display:inline;">کوریا دستاویزات.</div> | /_docs/readme.ko.md
&nbsp; <div dir="rtl" style="display:inline;">ڈچ دستاویزات.</div> | /_docs/readme.nl.md
&nbsp; <div dir="rtl" style="display:inline;">پرتگالی دستاویزات.</div> | /_docs/readme.pt.md
&nbsp; <div dir="rtl" style="display:inline;">روسی دستاویزات.</div> | /_docs/readme.ru.md
&nbsp; <div dir="rtl" style="display:inline;">اردو دستاویزات.</div> | /_docs/readme.ur.md
&nbsp; <div dir="rtl" style="display:inline;">ویتنامی دستاویزات.</div> | /_docs/readme.vi.md
&nbsp; <div dir="rtl" style="display:inline;">چینی (روایتی) دستاویزات.</div> | /_docs/readme.zh-TW.md
&nbsp; <div dir="rtl" style="display:inline;">چینی (آسان کردہ) دستاویزات.</div> | /_docs/readme.zh.md
&nbsp; <div dir="rtl" style="display:inline;">والٹ ڈائریکٹری (مختلف فائلوں پر مشتمل ہے).</div> | /vault/
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے اثاثے.</div> | /vault/fe_assets/
&nbsp; <div dir="rtl" style="display:inline;">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/fe_assets/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ایک HTML سانچے اکاؤنٹس صفحہ.</div> | /vault/fe_assets/_accounts.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ایک HTML سانچے اکاؤنٹس صفحہ.</div> | /vault/fe_assets/_accounts_row.html
&nbsp; <div dir="rtl" style="display:inline;">CIDR کیلکولیٹر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_cidr_calc.html
&nbsp; <div dir="rtl" style="display:inline;">CIDR کیلکولیٹر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_cidr_calc_row.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں ترتیب کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_config.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں ترتیب کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_config_row.html
&nbsp; <div dir="rtl" style="display:inline;">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files.html
&nbsp; <div dir="rtl" style="display:inline;">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files_edit.html
&nbsp; <div dir="rtl" style="display:inline;">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files_rename.html
&nbsp; <div dir="rtl" style="display:inline;">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files_row.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے ہوم پیج کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_home.html
&nbsp; <div dir="rtl" style="display:inline;">IP ٹیسٹ کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_ip_test.html
&nbsp; <div dir="rtl" style="display:inline;">IP ٹیسٹ کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_ip_test_row.html
&nbsp; <div dir="rtl" style="display:inline;">IP باخبر رہنے کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_ip_tracking.html
&nbsp; <div dir="rtl" style="display:inline;">IP باخبر رہنے کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_ip_tracking_row.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں لاگ ان کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_login.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر لاگز صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_logs.html
&nbsp; <div dir="rtl" style="display:inline;">مکمل رسائی کے ساتھ ان لوگوں کے لئے سامنے کے آخر نیویگیشن روابط کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_nav_complete_access.html
&nbsp; <div dir="rtl" style="display:inline;">لاگز کے ساتھ ان لوگوں کے لئے سامنے کے آخر نیویگیشن روابط کے لئے ایک HTML سانچے، صرف تک رسائی.</div> | /vault/fe_assets/_nav_logs_access_only.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں اپ ڈیٹس صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_updates.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں اپ ڈیٹس صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_updates_row.html
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے سی ایس ایس سٹائل شیٹ.</div> | /vault/fe_assets/frontend.css
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ڈیٹا بیس (اکاؤنٹ کی معلومات، سیشن کی معلومات، اور کیشے پر مشتمل ہے؛ سامنے کے آخر میں فعال اور استعمال کیا جاتا ہے تو صرف پیدا).</div> | /vault/fe_assets/frontend.dat
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے اہم HTML سانچے کی فائل.</div> | /vault/fe_assets/frontend.html
&nbsp; <div dir="rtl" style="display:inline;">CIDRAM زبان کے اعداد و شمار پر مشتمل ہے.</div> | /vault/lang/
&nbsp; <div dir="rtl" style="display:inline;">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/lang/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے عربی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ar.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے عربی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ar.fe.php
&nbsp; <div dir="rtl" style="display:inline;">عربی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ar.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے جرمن زبان کے اعداد و شمار.</div> | /vault/lang/lang.de.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے جرمن زبان کے اعداد و شمار.</div> | /vault/lang/lang.de.fe.php
&nbsp; <div dir="rtl" style="display:inline;">جرمن زبان کے اعداد و شمار.</div> | /vault/lang/lang.de.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے انگریزی زبان کے اعداد و شمار.</div> | /vault/lang/lang.en.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے انگریزی زبان کے اعداد و شمار.</div> | /vault/lang/lang.en.fe.php
&nbsp; <div dir="rtl" style="display:inline;">انگریزی زبان کے اعداد و شمار.</div> | /vault/lang/lang.en.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے ہسپانوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.es.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ہسپانوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.es.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ہسپانوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.es.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے فرانسیسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.fr.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے فرانسیسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.fr.fe.php
&nbsp; <div dir="rtl" style="display:inline;">فرانسیسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.fr.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے ہندی زبان کے اعداد و شمار.</div> | /vault/lang/lang.hi.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ہندی زبان کے اعداد و شمار.</div> | /vault/lang/lang.hi.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ہندی زبان کے اعداد و شمار.</div> | /vault/lang/lang.hi.php
&nbsp; <div dir="rtl" style="display:inline;">CLI لئے انڈونیشی زبان کے اعداد و شمار.</div> | /vault/lang/lang.id.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے انڈونیشی زبان کے اعداد و شمار.</div> | /vault/lang/lang.id.fe.php
&nbsp; <div dir="rtl" style="display:inline;">انڈونیشی زبان کے اعداد و شمار.</div> | /vault/lang/lang.id.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے اطالوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.it.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے اطالوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.it.fe.php
&nbsp; <div dir="rtl" style="display:inline;">اطالوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.it.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے جاپانی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ja.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے جاپانی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ja.fe.php
&nbsp; <div dir="rtl" style="display:inline;">جاپانی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ja.php
&nbsp; <div dir="rtl" style="display:inline;">CLI لیے کوریائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ko.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے کوریائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ko.fe.php
&nbsp; <div dir="rtl" style="display:inline;">کورین زبان کے اعداد و شمار.</div> | /vault/lang/lang.ko.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے ڈچ زبان کے اعداد و شمار.</div> | /vault/lang/lang.nl.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ڈچ زبان کے اعداد و شمار.</div> | /vault/lang/lang.nl.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ڈچ زبان کے اعداد و شمار.</div> | /vault/lang/lang.nl.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے پرتگالی زبان کے اعداد و شمار.</div> | /vault/lang/lang.pt.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے پرتگالی زبان کے اعداد و شمار.</div> | /vault/lang/lang.pt.fe.php
&nbsp; <div dir="rtl" style="display:inline;">پرتگالی زبان کے اعداد و شمار.</div> | /vault/lang/lang.pt.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے روسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ru.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے روسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ru.fe.php
&nbsp; <div dir="rtl" style="display:inline;">روسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ru.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے تھائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.th.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے تھائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.th.fe.php
&nbsp; <div dir="rtl" style="display:inline;">تھائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.th.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے ترکی زبان کے اعداد و شمار.</div> | /vault/lang/lang.tr.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ترکی زبان کے اعداد و شمار.</div> | /vault/lang/lang.tr.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ترکی زبان کے اعداد و شمار.</div> | /vault/lang/lang.tr.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے اردو زبان کے اعداد و شمار.</div> | /vault/lang/lang.ur.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے اردو زبان کے اعداد و شمار.</div> | /vault/lang/lang.ur.fe.php
&nbsp; <div dir="rtl" style="display:inline;">اردو زبان کے اعداد و شمار.</div> | /vault/lang/lang.ur.php
&nbsp; <div dir="rtl" style="display:inline;">CLI لئے ویتنامی زبان کے اعداد و شمار.</div> | /vault/lang/lang.vi.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے ویتنامی زبان کے اعداد و شمار.</div> | /vault/lang/lang.vi.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ویتنامی زبان کے اعداد و شمار.</div> | /vault/lang/lang.vi.php
&nbsp; <div dir="rtl" style="display:inline;">CLI کے لئے چینی (روایتی) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh-tw.cli.php
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں کے لئے چینی (روایتی) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh-tw.fe.php
&nbsp; <div dir="rtl" style="display:inline;">چینی (روایتی) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh-tw.php
&nbsp; <div dir="rtl" style="display:inline;">چینی (آسان کردہ) CLI کے لئے زبان کو ڈیٹا کے.</div> | /vault/lang/lang.zh.cli.php
&nbsp; <div dir="rtl" style="display:inline;">چینی کے سامنے کے آخر کے لئے (آسان کردہ) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh.fe.php
&nbsp; <div dir="rtl" style="display:inline;">چینی (آسان کردہ) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh.php
&nbsp; <div dir="rtl" style="display:inline;">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">کیشے کے اعداد و شمار.</div> | /vault/cache.dat
&nbsp; <div dir="rtl" style="display:inline;">Macmathan طرف سے فراہم اختیاری ملک blocklists سے متعلق معلومات پر مشتمل ہے؛ اپ ڈیٹ کی طرف سے استعمال کیا جاتا ہے سامنے کے آخر کی طرف سے فراہم کی خاصیت.</div> | /vault/cidramblocklists.dat
&nbsp; <div dir="rtl" style="display:inline;">CLI ہینڈلر.</div> | /vault/cli.php
&nbsp; <div dir="rtl" style="display:inline;">CIDRAM کے مختلف اجزاء سے متعلق معلومات پر مشتمل ہے؛ اپ ڈیٹ کی طرف سے استعمال کیا جاتا ہے سامنے کے آخر کی طرف سے فراہم کی خاصیت.</div> | /vault/components.dat
&nbsp; <div dir="rtl" style="display:inline;">کنفگریشن فائل؛ CIDRAM کے تمام ترتیب کے اختیارات، کیا کرنا ہے یہ کہہ رہا ہے اور صحیح طریقے سے کام کرنے کے طریقے پر مشتمل ہے (چالو کرنے کا نام تبدیل).</div> | /vault/config.ini.RenameMe
&nbsp; <div dir="rtl" style="display:inline;">کنفگریشن ہینڈلر.</div> | /vault/config.php
&nbsp; <div dir="rtl" style="display:inline;">کنفگریشن ڈیفالٹس فائل؛ CIDRAM لئے پہلے سے طے شدہ ترتیب کے اقدار پر مشتمل ہے.</div> | /vault/config.yaml
&nbsp; <div dir="rtl" style="display:inline;">سامنے کے آخر میں ہینڈلر.</div> | /vault/frontend.php
&nbsp; <div dir="rtl" style="display:inline;">افعال فائل (ضروری).</div> | /vault/functions.php
&nbsp; <div dir="rtl" style="display:inline;">قبول کر لیا hashes کی ایک فہرست پر مشتمل ہے (ہیتی خصوصیت کرنا مناسب؛ صرف reCAPTCHA کے خصوصیت فعال ہے تو پیدا کیا).</div> | /vault/hashes.dat
&nbsp; <div dir="rtl" style="display:inline;">Icons کے ہینڈلر (سامنے کے آخر میں فائل مینیجر کی طرف سے استعمال کیا جاتا).</div> | /vault/icons.php
&nbsp; <div dir="rtl" style="display:inline;">ائل (CIDRAM کی پروا نہ کرے جس کے دستخط حصوں کی وضاحت کرنے کے لئے استعمال) کو نظر انداز.</div> | /vault/ignore.dat
&nbsp; <div dir="rtl" style="display:inline;">IP بائ پاس کی ایک فہرست پر مشتمل ہے (ہیتی خصوصیت کرنا مناسب؛ صرف reCAPTCHA کے خصوصیت فعال ہے تو پیدا کیا).</div> | /vault/ipbypass.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv4 کی دستخط فائل (ناپسندیدہ کلاؤڈ سروسز اور غیر انسانی endpoints کے).</div> | /vault/ipv4.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv4 کی دستخط فائل (bogon/martian کی CIDRs).</div> | /vault/ipv4_bogons.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv4 کی اپنی مرضی کے دستخط فائل (چالو کرنے کا نام تبدیل).</div> | /vault/ipv4_custom.dat.RenameMe
&nbsp; <div dir="rtl" style="display:inline;">IPv4 کی دستخط فائل (خطرناک اور سپام آئی ایس پیز).</div> | /vault/ipv4_isps.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv4 کی دستخط فائل (کے لئے پراکسی جنگ لڑ، وپ، اور دیگر متفرق ناپسندیدہ خدمات CIDRs).</div> | /vault/ipv4_other.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv6 کی دستخط فائل (ناپسندیدہ کلاؤڈ سروسز اور غیر انسانی endpoints کے).</div> | /vault/ipv6.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv6 کی دستخط فائل (bogon/martian کی CIDRs).</div> | /vault/ipv6_bogons.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv6 کی اپنی مرضی کے دستخط فائل (چالو کرنے کا نام تبدیل).</div> | /vault/ipv6_custom.dat.RenameMe
&nbsp; <div dir="rtl" style="display:inline;">IPv6 کی دستخط فائل (خطرناک اور سپام آئی ایس پیز).</div> | /vault/ipv6_isps.dat
&nbsp; <div dir="rtl" style="display:inline;">IPv6 کی دستخط فائل (کے لئے پراکسی جنگ لڑ، وپ، اور دیگر متفرق ناپسندیدہ خدمات CIDRs).</div> | /vault/ipv6_other.dat
&nbsp; <div dir="rtl" style="display:inline;">زبان ہینڈلر.</div> | /vault/lang.php
&nbsp; <div dir="rtl" style="display:inline;">CIDRAM ماڈیولز سے متعلق معلومات پر مشتمل ہے؛ اپ ڈیٹ کی طرف سے استعمال کیا جاتا ہے سامنے کے آخر کی طرف سے فراہم کی خاصیت.</div> | /vault/modules.dat
&nbsp; <div dir="rtl" style="display:inline;">آؤٹ پٹ جنریٹر.</div> | /vault/outgen.php
&nbsp; <div dir="rtl" style="display:inline;">PHP 5.4.X کے لئے Polyfills (PHP 5.4.X پیچھے کی طرف مطابقت کے لئے ضروری؛ محفوظ نئے پی ایچ پی ورژن کے لئے حذف کرنا).</div> | /vault/php5.4.x.php
&nbsp; <div dir="rtl" style="display:inline;">reCAPTCHA کے ماڈیول.</div> | /vault/recaptcha.php
&nbsp; <div dir="rtl" style="display:inline;">اپنی مرضی کے قوانین AS6939 لئے دائر.</div> | /vault/rules_as6939.php
&nbsp; <div dir="rtl" style="display:inline;">اپنی مرضی کے قوانین نرم پرت کے لئے دائر.</div> | /vault/rules_softlayer.php
&nbsp; <div dir="rtl" style="display:inline;">اپنی مرضی کے قوانین میں کچھ مخصوص CIDRs لئے دائر.</div> | /vault/rules_specific.php
&nbsp; <div dir="rtl" style="display:inline;">سالٹ فائل (کچھ پردیی فعالیت کی طرف سے استعمال کیا جاتا؛ صرف ضرورت پڑنے پر پیدا).</div> | /vault/salt.dat
&nbsp; <div dir="rtl" style="display:inline;">سانچہ فائل؛ CIDRAM پیداوار جنریٹر کی طرف سے تیار HTML پیداوار کے لئے سانچہ.</div> | /vault/template.html
&nbsp; <div dir="rtl" style="display:inline;">سانچہ فائل؛ CIDRAM پیداوار جنریٹر کی طرف سے تیار HTML پیداوار کے لئے سانچہ.</div> | /vault/template_custom.html
&nbsp; <div dir="rtl" style="display:inline;">A GitHub کے منصوبے فائل (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /.gitattributes
&nbsp; <div dir="rtl" style="display:inline;">مختلف ورژن کے درمیان سکرپٹ کی گئی تبدیلیوں کا ایک ریکارڈ (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /Changelog.txt
&nbsp; <div dir="rtl" style="display:inline;">کمپوزر / Packagist معلومات (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /composer.json
&nbsp; <div dir="rtl" style="display:inline;">اس منصوبے میں شراکت کے لئے کس طرح کے بارے میں معلومات.</div> | /CONTRIBUTING.md
&nbsp; <div dir="rtl" style="display:inline;">GNU/GPLv2 اجازت نامے کی ایک نقل (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /LICENSE.txt
&nbsp; <div dir="rtl" style="display:inline;">لوڈر. اس سے آپ میں hooking ہونا چاہیے رہے ہیں کیا ہوتا ہے (ضروری)!</div> | /loader.php
&nbsp; <div dir="rtl" style="display:inline;">پروجیکٹ کے خلاصے کی معلومات.</div> | /README.md
&nbsp; <div dir="rtl" style="display:inline;">ایک ASP.NET کنفیگریشن فائل (اس مثال میں، ایونٹ میں غیر مجاز ذرائع سکرپٹ ASP.NET ٹیکنالوجیز کی بنیاد پر ایک سرور پر نصب کیا جاتا ہے کہ کی طرف سے حاصل کیا جا رہا ہے سے "/vault" ڈائریکٹری کی حفاظت کے لئے).</div> | /web.config

---


### <div dir="rtl">٦. <a name="SECTION6"></a>ترتیب کے اختیارات</div>
<div dir="rtl">ندرجہ ذیل ان ہدایات کے مقصد کی وضاحت کے ساتھ ساتھ، "config.ini" ترتیب فائل میں CIDRAM کو دستیاب ہدایات کی ایک فہرست ہے.<br /><br /></div>

#### <div dir="rtl">"general" (قسم)<br /></div>
<div dir="rtl">جنرل CIDRAM کنفیگریشن.<br /><br /></div>

<div dir="rtl">"logfile"<br /></div>
<div dir="rtl"><ul>
 <li>تمام بلاک کر تک رسائی کی کوششوں کو لاگ ان کرنے کے لئے انسانی قابل مطالعہ فائل. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے خالی چھوڑ دیں.</li>
</ul></div>

<div dir="rtl">"logfileApache"<br /></div>
<div dir="rtl"><ul>
 <li>تمام بلاک کر تک رسائی کی کوششوں کو لاگ ان کرنے کے لئے اپاچی طرز فائل. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے کو خالی چھوڑ.</li>
</ul></div>

<div dir="rtl">"logfileSerialized"<br /></div>
<div dir="rtl"><ul>
 <li>تمام بلاک کر تک رسائی کی کوششوں کو لاگ ان کرنے کے لئے serialized کی فائل. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے کو خالی چھوڑ.</li>
</ul></div>

<div dir="rtl"><em>مفید ٹپ: "{yyyy}" مکمل سال کے لئے، "{yy}" مختصر سال کے لئے، "{mm}": اگر آپ چاہتے ہیں تو آپ کے نام میں ان کو شامل کرکے آپ لاگ مسلیں کے ناموں کو تاریخ / وقت کی معلومات شامل کر سکتے ہیں مہینے کے لئے، دن کے لئے، "{hh}" گھنٹے کیلئے "{dd}" (ذیل کی مثالیں دیکھ).</em><br /><br /></div>

```
 logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'
 logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'
 logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'
```

<div dir="rtl">"truncate"<br /></div>
<div dir="rtl"><ul>
 <li>وہ ایک خاص سائز تک پہنچنے میں جب صاف لاگ مسلیں؟ ویلیو میں B/KB/MB/GB/TB زیادہ سے زیادہ سائز ہے. جب 0KB، وہ غیر معینہ مدت تک ترقی کر سکتا ہے (پہلے سے طے). نوٹ: واحد فائلوں پر لاگو ہوتا ہے! فائلیں اجتماعی غور نہیں کر رہے ہیں.</ul></div>

<div dir="rtl">"timeOffset"<br /></div>
<div dir="rtl"><ul>
 <li>آپ کے سرور کے وقت آپ کے مقامی وقت کے مماثل نہیں ہے تو، آپ کو آپ کی ضروریات کے مطابق CIDRAM طرف سے پیدا تاریخ / وقت کی معلومات کو ایڈجسٹ کرنے کے لئے یہاں آفسیٹ ایک وضاحت کر سکتے ہیں. یہ عام طور پر یہ کرنا ہمیشہ ممکن نہیں ہے، اور تو، اس اختیار کو یہاں فراہم کی جاتی ہے (جیسا محدود مشترکہ ہوسٹنگ فراہم کرنے والے کے ساتھ کام کرتے وقت کے طور پر) آپ "php.ini" فائل میں ٹائم زون ہدایت کو ایڈجسٹ کرنے کی بجائے سفارش، لیکن کبھی کبھی رہا ہے. آف سیٹ منٹ میں ہے.<br /></li>
 <li>مثال (ایک گھنٹے کا اضافہ کرنے کے لئے):</li>
</ul></div>

`timeOffset=60`

<div dir="rtl">"timeFormat"<br /></div>
<div dir="rtl"><ul>
 <li>تاریخ کی شکل CIDRAM طرف سے استعمال کیا. پہلے سے طے شدہ:</li>
</ul></div>

`{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`

<div dir="rtl">"ipaddr"<br /></div>
<div dir="rtl"><ul>
 <li>کہاں درخواستوں منسلک کرنے کے IP ایڈریس کو تلاش کرنے کے لئے؟ (جیسا CloudFlare کے اور پسند کرتا ہے کے طور پر خدمات کے لئے مفید). پہلے سے طے شدہ = REMOTE_ADDR. انتباہ: جب تک کہ آپ کو پتہ ہے تم کیا کر رہے ہو اس کو تبدیل نہ کریں!</li>
</ul></div>

<div dir="rtl">"forbid_on_block"<br /></div>
<div dir="rtl"><ul>
 <li>کون ہیڈرز CIDRAM درخواستوں کو مسدود کرنے میں، جب کے ساتھ جواب دینا چاہئے؟ جھوٹی / 200 = 200 OK [ڈیفالٹ]؛ سچے / 403 = 403 حرام؛ 503 = 503 سروس دستیاب نہیں ہے</li>
</ul></div>

<div dir="rtl">"silent_mode"<br /></div>
<div dir="rtl"><ul>
 <li>خاموشی CIDRAM چاہئے "رسائی نہیں ہوئی" کے صفحے کی نمائش سے بلاک رسائی کی کوششوں کو ری ڈائریکٹ کرنے کے بجائے؟ ہاں تو، کو بلاک کر تک رسائی کی کوششوں کو ری ڈائریکٹ کرنے کے محل وقوع کی وضاحت. کوئی تو اس متغیر خالی چھوڑ دیں.</li>
</ul></div>

<div dir="rtl">"lang"<br /></div>
<div dir="rtl"><ul>
 <li>CIDRAM لئے پہلے سے طے شدہ زبان کی وضاحت.</li>
</ul></div>

<div dir="rtl">"emailaddr"<br /></div>
<div dir="rtl"><ul>
 <li>اگر آپ چاہیں تو آپ کو یہاں ایک ای میل ایڈریس فراہم کر سکتے ہیں انہیں ان کی صورت میں کے لئے حمایت اور / یا مدد کے لئے رابطہ کے ایک مرکز کے طور پر استعمال کرنے کے لئے غلطی سے یا غلطی سے بند کیا جا رہا ہے، صارفین کو دی جائے کرنے کے لئے جب وہ بلاک کر رہے ہیں. انتباہ: جو بھی ای میل پتہ آپ کو یہاں کی فراہمی سب سے زیادہ یقینی طور پر اس کو یہاں استعمال کیا جا رہا کے دوران اسپیم بوٹس اور scrapers کی طرف سے حاصل کیا جائے گا، اور تو، یہ ہے کہ آپ کو یہاں ایک ای میل ایڈریس فراہم کرنے کے لئے انتخاب کرتے ہیں تو آپ کو یقینی بنانے کے کہ سفارش کی سختی سے ایسا ای میل ایڈریس آپ یہاں فراہمی ایک ڈسپوزایبل ایڈریس اور / یا آپ کو (دوسرے الفاظ میں، آپ کو شاید نہیں آپ کے بنیادی ذاتی یا بنیادی کاروبار کے ای میل پتوں کا استعمال کرنا چاہتے ہیں) کو spammed ہونے میں کوئی اعتراض نہیں ہے کہ ایک ایڈریس ہے</li>
</ul></div>

<div dir="rtl">"disable_cli"<br /></div>
<div dir="rtl"><ul>
 <li>CLI موڈ کو غیر فعال کریں؟ CLI موڈ ڈیفالٹ کی طرف سے چالو حالت میں ہے، لیکن کبھی کبھی بعض جانچ کے آلات (جیسے PHPUnit کے طور پر، مثال کے طور پر) اور دیگر CLI کی بنیاد پر ایپلی کیشنز کے ساتھ مداخلت کر سکتے ہیں. آپ CLI موڈ کو غیر فعال کرنے کی ضرورت نہیں ہے تو، آپ کو اس ہدایت کو نظر انداز کرنا چاہئے. جھوٹی = CLI موڈ [طے شدہ] فعال؛ سچا = غیر فعال CLI موڈ.</li>
</ul></div>

<div dir="rtl">"disable_frontend"<br /></div>
<div dir="rtl"><ul>
 <li>سامنے کے آخر تک رسائی کو غیر فعال کریں؟ سامنے کے آخر میں رسائی CIDRAM زیادہ انتظام بنا سکتے ہیں، لیکن یہ بھی بہت ہے، ایک زبردست حفاظتی خطرہ ہو سکتا ہے. یہ جب بھی ممکن ہو واپس کے آخر کے ذریعے CIDRAM منظم کرنے کی سفارش کی جاتی ہے، لیکن سامنے کے آخر میں رسائی ممکن نہیں ہے جب کے لئے فراہم کی جاتی ہے. تمہیں اس کی ضرورت ہے جب تک کہ اس کو معذور رکھیں. جھوٹی = سامنے کے آخر میں رسائی کو فعال کریں؛ سچا = غیر فعال سامنے کے آخر میں رسائی [ڈیفالٹ].</li>
</ul></div>

<div dir="rtl">"max_login_attempts"<br /></div>
<div dir="rtl"><ul>
 <li>لاگ ان کوششوں کی زیادہ سے زیادہ تعداد (سامنے کے آخر میں). پہلے سے طے شدہ = 5.</li>
</ul></div>

<div dir="rtl">"FrontEndLog"<br /></div>
<div dir="rtl"><ul>
 <li>سامنے کے آخر میں لاگ ان کوششوں لاگنگ کے لئے دائر. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے کو خالی چھوڑ.</li>
</ul></div>

<div dir="rtl">"ban_override"<br /></div>
<div dir="rtl"><ul>
 <li>"forbid_on_block" کی جگہ لے لے، جب "infraction_limit" حد سے تجاوز کر رہا ہے؟ زیرکر کب: التواء درخواستوں ایک خالی صفحہ (سانچے فائلوں کا استعمال نہیں کر رہے ہیں) واپس جائیں. 200 = جگہ لے لے نہیں ہے [طے شدہ]؛ کے ساتھ "403 حرام" 403 = جگہ لے لے؛ کے ساتھ "503 سروس دستیاب نہیں" 503 = جگہ لے لے.</li>
</ul></div>

<div dir="rtl">"log_banned_ips"<br /></div>
<div dir="rtl"><ul>
 <li>لاگ مسلیں میں کالعدم آئی پی ایس سے مسدود درخواستوں شامل کریں؟ سچا = جی ہاں [ڈیفالٹ]؛ جھوٹی = نمبر.</li>
</ul></div>

<div dir="rtl">"default_dns"<br /></div>
<div dir="rtl"><ul>
 <li>میزبان نام لک اپ کے لئے استعمال کرنے کے لئے DNS سرورز کی کوما ختم ہونے والی فہرست. پہلے سے طے شدہ = "8.8.8.8,8.8.4.4" (گوگل DNS). انتباہ: جب تک کہ آپ کو پتہ ہے تم کیا کر رہے ہو اس کو تبدیل نہ کریں!</li>
</ul></div>

<div dir="rtl">"search_engine_verification"<br /></div>
<div dir="rtl"><ul>
 <li>تلاش کے انجن کی طرف سے درخواستوں کی تصدیق کرنے کی کوشش؟ تلاش کے انجن کی توثیق کرنے سے کہ وہ خلاف ورزی کی حد (ویب سائٹ سے تلاش کے انجن پر پابندی عائد عام طور پر آپ کی تلاش کے انجن کی درجہ بندی، SEO، وغیرہ پر منفی اثر پڑے گا) تجاوز کا ایک نتیجہ کے طور پر پابندی عائد نہیں کیا جائے گا یقینی بناتا ہے. تصدیق کی جب، تلاش کے انجن معمول فی کے طور پر بلاک کیا جا سکتا ہے، لیکن پابندی عائد نہیں کی گئی. کی توثیق نہیں کی ہے، تو یہ ان کے لئے خلاف ورزی کی حد سے تجاوز کرنے کے نتیجے کے طور پر پابندی عائد کی جائے کرنے کے لئے ممکن ہے. اس کے علاوہ، تلاش کے انجن کی توثیق کی جعلی تلاش کے انجن کی درخواستوں کے خلاف اور (اس طرح کی درخواستوں کی تلاش کے انجن کی توثیق فعال ہے جب بلاک کر دیا جائے گا) سرچ انجن کے طور پر ویش ممکنہ طور پر بدنیتی پر مبنی اداروں کے خلاف تحفظ فراہم کرتا ہے. سچا = سرچ انجن توثیق [ڈیفالٹ] فعال؛ جھوٹی = غیر فعال تلاش کے انجن کی توثیق کی.</li>
</ul></div>

<div dir="rtl">"protect_frontend"<br /></div>
<div dir="rtl"><ul>
 <li>متعین کرتا ہے جو عام طور پر CIDRAM طرف سے فراہم کردہ تحفظات سامنے کے آخر پر لاگو کیا جانا چاہئے یا نہیں. سچا = جی ہاں [ڈیفالٹ]؛ جھوٹی = کوئی.</li>
</ul></div>

<div dir="rtl">"disable_webfonts"<br /></div>
<div dir="rtl"><ul>
 <li>webfonts کے غیر فعال کریں؟ سچا = جی ہاں؛ جھوٹی = کوئی [طے شدہ].</li>
</ul></div>

#### <div dir="rtl">"signatures" (قسم)<br /></div>
<div dir="rtl">دستخط کی ترتیب.<br /><br /></div>

<div dir="rtl">"ipv4"<br /></div>
<div dir="rtl"><ul>
 <li>IPv4 کی دستخط کی ایک فہرست فائلوں کہ CIDRAM، کا تجزیہ کرنے کی کوشش کرنا چاہئے کوما سے ختم ہونے والی. آپ یہاں اندراجات کا اضافہ آپ CIDRAM میں اضافی IPv4 کی دستخط کی فائلوں کو شامل کرنے کے لئے چاہتے ہیں تو کر سکتے ہیں.</li>
</ul></div>

<div dir="rtl">"ipv6"<br /></div>
<div dir="rtl"><ul>
 <li>IPv6 کی دستخط کی ایک فہرست فائلوں کہ CIDRAM، کا تجزیہ کرنے کی کوشش کرنا چاہئے کوما سے ختم ہونے والی. آپ یہاں اندراجات کا اضافہ آپ CIDRAM میں اضافی IPv6 کی دستخط کی فائلوں کو شامل کرنے کے لئے چاہتے ہیں تو کر سکتے ہیں.</li>
</ul></div>

<div dir="rtl">"block_cloud"<br /></div>
<div dir="rtl"><ul>
 <li>بلاک CIDRs webhosting کے / کلاؤڈ سروسز سے تعلق رکھنے والے کے طور پر شناخت؟ آپ کو آپ کی ویب سائٹ سے ایک API سروس آپریٹ یا اگر آپ دوسری ویب سائٹس کو اپنی ویب سائٹ سے رابطہ قائم کرنے کی توقع ہے تو، تو اس جھوٹے کے لئے مقرر کیا جانا چاہئے. آپ ایسا نہیں کرتے، تو پھر، اس ہدایت صحیح پر سیٹ کیا جانا چاہئے.</li>
</ul></div>

<div dir="rtl">"block_bogons"<br /></div>
<div dir="rtl"><ul>
 <li>بلاک bogon/martian کی CIDRs؟ آپ لوکل ہوسٹ سے، یا اپنے LAN سے اپنے مقامی نیٹ ورک کے اندر سے اپنی ویب سائٹ پر کنکشن، توقع ہے، اس ہدایت کے جھوٹے پر مقرر کیا جائے چاہئے. اگر آپ ان میں ایسے کنکشنوں کی توقع نہیں ہے، تو اس ہدایت صحیح پر سیٹ کیا جانا چاہئے.</li>
</ul></div>

<div dir="rtl">"block_generic"<br /></div>
<div dir="rtl"><ul>
 <li>بلاک CIDRs عام طور پر کی blacklisting لئے سفارش؟ یہ دیگر زیادہ مخصوص دستخط کی اقسام میں سے کسی کا حصہ ہونے کے طور پر نشان نہیں ہیں کہ کسی بھی دستخطوں پر محیط ہے.</li>
</ul></div>

<div dir="rtl">"block_proxies"<br /></div>
<div dir="rtl"><ul>
 <li>بلاک CIDRs پراکسی خدمات سے تعلق رکھنے والے کے طور پر شناخت؟ آپ صارفین گمنام پراکسی خدمات سے آپ کی ویب سائٹ تک رسائی حاصل کرنے کے قابل ہو جائے کی ضرورت ہوتی ہے تو، اس کے جھوٹے پر مقرر کیا جائے چاہئے. دوسری صورت میں، آپ کو گمنام پراکسی جنگ لڑ کی ضرورت نہیں ہے تو، اس ہدایت صحیح پر تحفظ کو بہتر بنانے کا ایک ذریعہ کے طور پر مقرر کیا جانا چاہئے.</li>
</ul></div>

<div dir="rtl">"block_spam"<br /></div>
<div dir="rtl"><ul>
 <li>بلاک CIDRs سپیم کے لئے اعلی خطرے ہونے کے طور پر شناخت کیا؟ ایسا کرنے جب آپ کو مسائل کا سامنا ہوتا ہے جب تک، عام طور پر، یہ ہمیشہ سچ کے لئے مقرر کیا جانا چاہئے.</li>
</ul></div>

<div dir="rtl">"modules"<br /></div>
<div dir="rtl"><ul>
 <li>ماڈیول فائلوں کی ایک فہرست کوما سے ختم ہونے والی، IPv4 کی / IPv6 دستخط جانچ پڑتال کے بعد لوڈ کرنے کے لئے.</li>
</ul></div>

<div dir="rtl">"default_tracktime"<br /></div>
<div dir="rtl"><ul>
 <li>ماڈیولز کی طرف سے پابندی لگا دی آئی پی ایس کے ٹریک کرنے سیکنڈ کتنے. پہلے سے طے شدہ = 604800 (1 ہفتہ).</li>
</ul></div>

<div dir="rtl">"infraction_limit"<br /></div>
<div dir="rtl"><ul>
 <li>انحرافات کی زیادہ سے زیادہ تعداد ایک IP اس سے پہلے کیا جاتا ہے IP باخبر رہنے کے کی طرف سے پابندی کا اطلاق کرنے کی اجازت ہے. پہلے سے طے شدہ = 10.</li>
</ul></div>

<div dir="rtl">"track_mode"<br /></div>
<div dir="rtl"><ul>
 <li>انحرافات شمار کب کیا جانا چاہئے؟ جھوٹی = آئی پی ایس کے ماڈیول کی طرف سے بلاک کر رہے ہیں جب. سچا = آئی پی ایس کے کسی بھی وجہ سے بلاک کر رہے ہیں جب.</li>
</ul></div>

#### <div dir="rtl">"recaptcha" (قسم)<br /></div>
<div dir="rtl">اختیاری، آپ، ایک reCAPTCHA مثال کو مکمل اگر آپ ایسا کرنا چاہتے ہیں تو کی راہ کی طرف سے "رسائی نہیں ہوئی" کے صفحے کو نظرانداز کرنے کا ایک طریقہ کے ساتھ صارفین کو فراہم کر سکتے ہیں. یہ ان حالات میں جہاں ہم مکمل طور پر یقین ہے کہ ایک درخواست میں ایک مشین یا ایک انسان سے شروع ہوا ہے یا نہیں نہیں ہو میں جھوٹے مثبت کے ساتھ منسلک خطرات میں سے کچھ کم کرنے میں مدد کر سکتے ہیں.<br /><br /></div>

<div dir="rtl">آخر میں صارفین کو نظرانداز کرنے کے لئے "رسائی نہیں ہوئی" کے لئے ایک راستہ فراہم کرنے کے ساتھ منسلک خطرات کی وجہ سے صفحہ، عام طور پر، میں اس خصوصیت کو چالو کرنے کے خلاف مشورہ آپ محسوس کرتے ہیں جب تک کہ ایسا کرنا ضروری ہو گا. صورت حال یہ ضروری ہو سکتا ہے جہاں: آپ کی ویب سائٹ آپ کی ویب سائٹ تک رسائی حاصل کرنے کی ضرورت ہے کہ گاہکوں / صارفین ہیں تو، اور اس پر سمجھوتہ نہیں کیا جا سکتا کہ کچھ ہے، لیکن اگر ان گاہکوں / صارفین ہوا ایک دشمن نیٹ ورک سے منسلک کرنے جا کرنے کے لئے ہے تو کہ ممکنہ طور پر بھی ناپسندیدہ ٹریفک لے جانے، اور اس ناپسندیدہ ٹریفک مسدود ہو سکتا ہے یہ بھی ان لوگوں کو خاص طور پر جیت نہیں حالات میں، پر سمجھوتہ نہیں کیا جا سکتا کہ کچھ ہے، reCAPTCHA کے خصوصیت ضروری گاہکوں / صارفین کی اجازت دی ہے کے ایک ذریعہ کے طور پر ہاتھ میں آ سکتا ، ایک ہی نیٹ ورک سے ناپسندیدہ ٹریفک باہر رکھتے ہوئے. یہ ہے کہ، اگرچہ کہا دیا ایک کیپچا کے مطلوبہ مقصد انسانوں اور غیر انسانوں کے درمیان تمیز کرنے کے لئے ہے کہ، reCAPTCHA کے خصوصیت ہم اس ناپسندیدہ ٹریفک غیر انسانی ہے کہ فرض کرنا ہو تو ان کی کوئی جیت حالات میں صرف کی مدد کرے گا (مثال کے طور ، اسپیم بوٹس، سکراپارس، hacktools، خود کار ٹریفک)، ہونے ناپسندیدہ انسانی ٹریفک کی مخالفت کے طور (جیسے انسانی spammers کو، ہیکروں، اسی ET رحمہ اللہ تعالی).<br /><br /></div>

<div dir="rtl">ایک "site key" اور ایک "secret key" (reCAPTCHA استعمال کرتے ہوئے کے لئے ضروری) حاصل کرنے کے لئے، براہ مہربانی پر جائیں: <a href="https://developers.google.com/recaptcha/">https://developers.google.com/recaptcha/</a><br /><br /></div>

<div dir="rtl">"usemode"<br /></div>
<div dir="rtl"><ul>
 <li>وضاحت کرتا CIDRAM reCAPTCHA کے استعمال کرنا چاہئے کہ کس طرح.</li>
 <li>0 = reCAPTCHA کے مکمل طور پر غیر فعال کر دیا (پہلے سے مقررشدہ) ہے.</li>
 <li>1 = reCAPTCHA کے تمام دستخطوں کیلئے فعال ہے.</li>
 <li>2 = reCAPTCHA کے طور دستخطی فائلوں کے اندر اندر reCAPTCHA کے فعال خاص نشان لگا حصوں سے تعلق رکھنے والے دستخطوں کے لیے آپ کو چالو حالت میں ہے.</li>
 <li>(کسی اور قدر 0 کے طور پر اسی طرح میں علاج کیا جائے گا).</li>
</ul></div>

<div dir="rtl">"lockip"<br /></div>
<div dir="rtl"><ul>
 <li>متعین کرتا ہیشز مخصوص آئی پی ایس کو بند کر دیا جانا چاہئے یا نہیں. جھوٹی = کوکیز اور ہیشز ایک سے زیادہ آئی پی ایس (پہلے سے مقررشدہ) بھر میں استعمال کیا جا سکتا. سچا = کوکیز اور ہیشز ایک سے زیادہ آئی پی ایس کے اس پار نہیں کیا جا سکتا (کوکیز / ہیشز آئی پی ایس کو بند کر دیا جاتا).</li>
 <li>نوٹ: یاد "صارفین" اس قیمت کے لحاظ سے مختلف ہے کے لئے اس طریقہ کار کی وجہ سے "lockip" قدر نظر انداز کر دیا جاتا ہے جب "lockuser" جھوٹی ہے.</li>
</ul></div>

<div dir="rtl">"lockuser"<br /></div>
<div dir="rtl"><ul>
 <li>ایک reCAPTCHA مثال کی کامیاب تکمیل کے مخصوص صارفین کے لئے بند کر دیا جانا چاہئے کہ آیا تعین کرتی ہے. جھوٹی = ایک reCAPTCHA مثال کی کامیاب تکمیل reCAPTCHA کے مثال کو مکمل صارف کی طرف سے استعمال کیا جاتا ہے کہ کے طور پر ایک ہی IP سے شروع ہونے والے تمام درخواستوں کو رسائی فراہم کرے گا؛ کوکیز اور ہیشز نہیں استعمال کیا جاتا ہے؛ اس کے بجائے، ایک IP وائٹ لسٹ کا استعمال کیا جائے گا. سچا = ایک reCAPTCHA مثال صرف reCAPTCHA کے مثال کو مکمل صارف تک رسائی کی اجازت دے گا کی کامیاب تکمیل؛ کوکیز اور ہیشز صارف کو یاد کرنے کے لئے استعمال کر رہے ہیں؛ ایک IP وائٹ لسٹ نہیں استعمال کیا جاتا ہے (ڈیفالٹ).</li>
</ul></div>

<div dir="rtl">"sitekey"<br /></div>
<div dir="rtl"><ul>
 <li>"site key" کے طور پر ایک ہی ہونا چاہئے. یہ reCAPTCHA ڈیش بورڈ میں پایا جا سکتا ہے.</li>
</ul></div>

<div dir="rtl">"secret"<br /></div>
<div dir="rtl"><ul>
 <li>"secret key" کے طور پر ایک ہی ہونا چاہئے. یہ reCAPTCHA ڈیش بورڈ میں پایا جا سکتا ہے.</li>
</ul></div>

<div dir="rtl">"expiry"<br /></div>
<div dir="rtl"><ul>
 <li>جب "lockuser" سچ (ڈیفالٹ) ہے، ایک صارف کو کامیابی کے مستقبل صفحے درخواستوں کے لئے، ایک reCAPTCHA مثال گزر چکی ہے جب یاد کرنے کے لئے ہے، CIDRAM اسی ہیش کہ استعمال کے ایک داخلی ریکارڈ سے میل جو ایک ہیش پر مشتمل ایک معیاری HTTP کوکی نکالتا؛ مستقبل صفحے درخواستوں کسی صارف نے پہلے پہلے سے ہی ایک reCAPTCHA مثال گزر چکی ہے کہ توثیق کرنے کے لئے ان کے لئے اسی ہیشز استعمال کریں گے. جب "lockuser" جھوٹی ہے، ایک IP وائٹ لسٹ درخواستوں باؤنڈ درخواستوں کی آئی پی سے اجازت کی جانی چاہئے یا نہیں کا تعین کرنے کے لئے استعمال کیا جاتا ہے؛ جب reCAPTCHA کے مثال کامیابی سے منظور کیا جاتا لکھے اس وائٹ لسٹ میں شامل کر رہے ہیں. کتنے گھنٹے کے لئے ان کوکیز، hashes اور وائٹ لسٹ اندراجات درست رہنا چاہئے؟ پہلے سے طے شدہ = 720 (1 ماہ).</li>
</ul></div>

<div dir="rtl">"logfile"<br /></div>
<div dir="rtl"><ul>
 <li>تمام reCAPTCHA کے کوششوں لاگ؟ اگر ہاں، logfile پر کے لئے استعمال کرنے کا نام کی وضاحت. کوئی تو اس متغیر خالی چھوڑ دیں.</li>
</ul></div>

<div dir="rtl"><em>مفید ٹپ: "{yyyy}" مکمل سال کے لئے، "{yy}" مختصر سال کے لئے، "{mm}": اگر آپ چاہتے ہیں تو آپ کے نام میں ان کو شامل کرکے آپ لاگ مسلیں کے ناموں کو تاریخ / وقت کی معلومات شامل کر سکتے ہیں مہینے کے لئے، دن کے لئے، "{hh}" گھنٹے کیلئے "{dd}" (ذیل کی مثالیں دیکھ).</em><br /><br /></div>

`logfile='recaptcha.{yyyy}-{mm}-{dd}-{hh}.txt`

#### <div dir="rtl">"template_data" (قسم)<br /></div>
<div dir="rtl">سانچوں اور موضوعات کے لئے ہدایات / متغیر.<br /><br /></div>

<div dir="rtl">"رسائی نہیں ہوئی" کے صفحے پیدا کرنے کے لئے استعمال HTML پیداوار سے متعلق ہے. آپ CIDRAM لئے اپنی مرضی کے موضوعات کا استعمال کرتے ہوئے کر رہے ہیں، ایچ ٹی ایم ایل کی پیداوار "template_custom.html" فائل سے کیے جاتا ہے، اور دوسری صورت میں، HTML پیداوار "template.html" فائل سے کیے جاتا ہے. ترتیب فائل کے اس شعبہ کو لکھا تغیر اسی متغیر ڈیٹا کے ساتھ ایچ ٹی ایم ایل کی پیداوار کے اندر اندر پایا گھوبگھرالی بریکٹ طرف circumfixed کوئی بھی متغیرہ کے ناموں کی جگہ کی راہ کی طرف HTML پیداوار میں پارس کر رہے ہیں. مثال کے طور پر، جہاں foo="bar" بار کے کسی بھی مثال <p>{foo}</p> HTML پیداوار کے اندر اندر پایا بن جائے گا <p>bar</p>.<br /><br /></div>

<div dir="rtl">"css_url"<br /></div>
<div dir="rtl"><ul>
 <li>ڈیفالٹ تھیم کے لئے سانچے کی فائل اندرونی سی ایس ایس خصوصیات کا استعمال، جبکہ اپنی مرضی کے موضوعات کے لئے سانچے کی فائل، خارجی سی ایس ایس خصوصیات کا استعمال. اپنی مرضی کے موضوعات کے لئے سانچے کی فائل کو استعمال کرنے CIDRAM ہدایت کرنے کے لئے، "css_url" متغیر کا استعمال کرتے ہوئے آپ کی اپنی مرضی کے موضوع کی سی ایس ایس فائلوں کے عوامی HTTP ایڈریس کی وضاحت. آپ کو اس متغیر خالی چھوڑ تو، CIDRAM ڈیفالٹ تھیم کے لئے سانچے کی فائل کو استعمال کریں گے</li>
</ul></div>

---


### <div dir="rtl">٧. <a name="SECTION7"></a>دستخط فارمیٹ</div>

#### <div dir="rtl">٧.٠ مبادیات<br /><br /></div>

<div dir="rtl">CIDRAM طرف سے استعمال دستخط کی شکل اور ساخت کی ایک وضاحت دو اپنی مرضی کے دستخط فائلوں کے دونوں کے اندر سادہ ٹیکسٹ میں دستاویزی پایا جا سکتا ہے. CIDRAM کے دستخط کی شکل اور ساخت کے بارے میں مزید جاننے کے لئے کہ دستاویزات سے رجوع کریں.<br /><br /></div>

<div dir="rtl">"xxx.xxx.xxx.xxx/yy [فنکشن] [پرم]": تمام IPv4 کی دستخط کی شکل کی پیروی.<br /></div>
<div dir="rtl"><ul>
 <li>"xxx.xxx.xxx.xxx" CIDR بلاک (بلاک میں ابتدائی IP ایڈریس کی آکٹیٹ) کے آغاز کی نمائندگی کرتا ہے.</li>
 <li>"yy" CIDR بلاک سائز [١-٣٢] نمائندگی کرتا ہے.</li>
 <li>"[فنکشن]" سکرپٹ سگنیچر (دستخط شمار کیا جانا چاہئے کہ کس طرح) کے ساتھ کیا کیا ہدایات.</li>
 <li>"[پرم]" کی نمائندگی کرتا ہے جو کچھ بھی اضافی معلومات "طرف (فنکشن) کی ضرورت ہوسکتی ہے".</li>
</ul></div>

<div dir="rtl">"xxxx:xxxx:xxxx:xxxx::xxxx/yy [فنکشن] [پرم]" تمام IPv6 کی دستخط کی شکل کی پیروی.<br /></div>
<div dir="rtl"><ul>
 <li>"xxxx:xxxx:xxxx:xxxx::xxxx" CIDR بلاک کے آغاز (بلاک میں ابتدائی IP ایڈریس کی آکٹیٹ) نمائندگی کرتا ہے. مکمل سنکیتن اور مختصر سنکیتن دونوں قابل قبول ہیں (اور ہر ایک IPv6 کی سنکیتن کے مناسب اور متعلقہ معیار پر عمل کرنا ضروری ہے، لیکن ایک رعایت کے ساتھ: ایک IPv6 کی ایڈریس مخفف کے ساتھ اس سکرپٹ کے لئے ایک دستخط میں استعمال کرتے ہیں، کی وجہ سے میں جس طرح کرنے کے لئے شروع نہیں کر سکتی "0 :: 1 / 128" طور مثلا،" ایک دستخط میں استعمال کیا جاتا ہے جب :: 1 / 128" کا اظہار کیا جانا چاہئے، اور ":: 0 / 128"" 0 کے طور پر اظہار، جس CIDRs سکرپٹ کی طرف سے دوبارہ تعمیر کر رہے ہیں :: / 128").</li>
 <li>"yy" CIDR بلاک سائز [1-128] نمائندگی کرتا ہے.</li>
 <li>"(فنکشن)" سکرپٹ سگنیچر (دستخط شمار کیا جانا چاہئے کہ کس طرح) کے ساتھ کیا کیا ہدایات.</li>
 <li>"[پرم]" کی نمائندگی کرتا ہے جو کچھ بھی اضافی معلومات "طرف (فنکشن) کی ضرورت ہوسکتی ہے".</li>
</ul></div>

<div dir="rtl">ہ دستخط کے CIDRAM یونیکس طرز نیولائنز ("%0A"، یا "\n") کا استعمال کرنا چاہئے کے لئے فائلوں! دوسری قسم / نیولائنز کے سٹائل (جیسے ونڈوز "%0D%0A" یا "\r\n" نیولائنز، میک "%0D" یا" \r" نیولائنز، وغیرہ) استعمال کیا جا سکتا ہے، لیکن ترجیح نہیں ہیں. غیر یونیکس طرز نیولائنز سکرپٹ طرف یونیکس طرز نیولائنز کو معمول کی جائے گی.<br /><br /></div>

<div dir="rtl">عین مطابق اور درست CIDR سنکیتن کی ضرورت ہے، دوسری صورت سکرپٹ دستخط کو تسلیم نہیں کریں گے. مزید برآں، اس سکرپٹ کی تمام CIDR دستخط ایک IP ایڈریس جن IP نمبر، اس کی CIDR بلاک سائز (مثلا طرف سے نمائندگی آپ "11،127 کرنا" 10.128.0.0" سے تمام آئی پی ایس کو بلاک کرنا چاہتے تھے تو بلاک ڈویژن میں یکساں طور پر تقسیم کر سکتے ہیں کے ساتھ شروع ہونا چاہئے .255.255"، "10.128.0.0 / 8" سکرپٹ کی طرف سے تسلیم نہیں کیا جائے گا، لیکن" 10.128.0.0 / 9" اور "11.0.0.0 / 9" مل کر میں استعمال کیا جاتا ہے، سکرپٹ کی طرف سے تسلیم کیا جائے گا).<br /><br /></div>

<div dir="rtl">دستخط میں کوئی بھی چیز اس وجہ سے جس کا مطلب آپ کو محفوظ طریقے سے ان کو توڑنے کے بغیر اور اسکرپٹ کو توڑنے کے بغیر آپ کے دستخط فائلوں میں چاہتا ہوں کہ کسی بھی غیر دستخط کے اعداد و شمار کو ڈال کر سکتے ہیں، کو نظر انداز کر دیا جائے گا ایک دستخط کے طور پر اور نہ ہی سکرپٹ کی طرف سے دستخط کے متعلق نحو کے طور پر تسلیم نہیں فائلوں. تبصرے کے دستخط فائلوں میں قابل قبول ہیں، اور کوئی خاص فارمیٹنگ ان کے لئے کی ضرورت ہے. تبصرے کے لئے شیل طرز hashing کے ترجیح دی جاتی ہے، لیکن نافذ نہیں؛ مکمل طور پر قابل، یہ آپ کے تبصرے کے لئے شیل طرز hashing کے استعمال کرنے کا انتخاب کرتے ہیں یا نہیں اسکرپٹ کو کوئی فرق نہیں پڑتا، لیکن شیل طرز hashing کے استعمال کر IDEs کے اور سادہ ٹیکسٹ ایڈیٹرز صحیح دستخط کی فائلوں کے مختلف حصوں کو اجاگر کرنے میں مدد ملتی ہے (اور اس طرح، شیل طرز میں ترمیم کرتے ہوئے hashing کے ایک بصری امداد کے طور پر مدد کر سکتے ہیں).<br /><br /></div>

<div dir="rtl">"(فنکشن)" کی ممکنہ اقدار مندرجہ ذیل ہیں:<br /></div>
<div dir="rtl"><ul>
 <li>Run</li>
 <li>Whitelist</li>
 <li>Greylist</li>
 <li>Deny</li>
</ul></div>

<div dir="rtl">تو "Run" استعمال کیا جاتا ہے، دستخط شروع ہوجاتا ہے جب، سکرپٹ پھانسی کے لئے ایک بیرونی پی ایچ پی اسکرپٹ، کی طرف سے مخصوص ہے (ایک "require_once" بیان کرتے ہوئے) کی کوشش کریں گے" [پرم] "قدر (کام کر ڈائرکٹری ہونا چاہئے" /vault/ "اسکرپٹ کی ڈائریکٹری؛ ذیل کی مثالیں ملاحظہ کریں).<br /><br /></div>

`127.0.0.0/8 Run example.php`

<div dir="rtl">یہ کچھ آئی پی ایڈریس اور CIDRs کوڈ کے لئے ایک خاص PHP چلانے کے لئے مفید ہو سکتا ہے.<br /><br /></div>

<div dir="rtl">تو "Whitelist" استعمال کیا جاتا ہے، دستخط شروع ہوجاتا ہے جب اسکرپٹ تمام detections کر (کسی detections کر ہوئی ہے تو) دوبارہ ترتیب دے گا اور ٹیسٹ کی تقریب کو توڑنے. "[پرم]" نظر انداز کر دیا جاتا ہے. اس تقریب کا پتہ چلا جا رہا ہے سے ایک مخصوص IP یا CIDR وائٹ لسٹ کے برابر ہے.<br /><br /></div>

`127.0.0.1/32 Whitelist`

<div dir="rtl">تو "Greylist" استعمال کیا جاتا ہے، دستخط شروع ہوجاتا ہے جب اسکرپٹ تمام detections کر (کسی detections کر ہوئی ہے تو) دوبارہ ترتیب دے گا اور پروسیسنگ جاری رکھنے کے لئے اگلے کے دستخط کی فائل کو چھوڑ دیں. "[پرم]" نظر انداز کر دیا جاتا ہے.

`127.0.0.1/32 Greylist`

<div dir="rtl">سگنیچر شروع ہوجاتا ہے جب "Deny" استعمال کیا جاتا ہے،، کوئی وائٹ لسٹ کے دستخط سنبھالنے دی IP ایڈریس اور / یا دی CIDR کے لئے متحرک کیا گیا ہے تو، محفوظ صفحے کی رسائی نہیں دی جائے گی. "Deny" کیا آپ واقعی ایک IP ایڈریس اور / یا CIDR رینج کو بلاک کرنے کے لئے استعمال کرنا چاہتے ہیں کریں گے کیا ہے. کوئی بھی دستخط متحرک کر رہے ہیں جب کے استعمال بنانے کے کہ "Deny"، "رسائی نہیں ہوئی" اسکرپٹ کا صفحہ پیدا کیا جائے گا اور ہلاک محفوظ صفحے کی درخواست.<br /><br /></div>

<div dir="rtl">"[پرم]" "Deny" کی طرف سے قبول کی قیمت، "رسائی نہیں ہوئی" کے صفحے کی پیداوار میں پارس کیا جائے گا کی تردید کی جا رہی مطلوبہ صفحہ تک ان کی رسائی کے لئے حوالہ دیا وجہ کے طور پر کلائنٹ / صارف کے لئے فراہم کی. یہ آپ کو ان کے (کچھ بھی، کافی چاہئے یہاں تک کہ ایک سادہ "میں آپ کو اپنی ویب سائٹ پر چاہتے ہیں نہیں ہے")، یا آشلپی الفاظ کی ایک چھوٹی سی مٹھی بھر کے ایک سے فراہم بلاک کرنے کے لئے منتخب کیا ہے یہی وجہ ہے کہ یا تو ایک مختصر اور سادہ قید کی سزا، کی وضاحت ہو سکتا ہے سکرپٹ کی طرف سے استعمال کیا ہے تو کہ میں کیوں کلائنٹ / صارف مسدود کر دیا گیا ہے ایک پہلے سے تیار وضاحت کے ساتھ سکرپٹ کی طرف سے تبدیل کیا جائے گا.<br /><br /></div>

<div dir="rtl">پہلے سے تیار وضاحتوں L10N حمایت حاصل ہے اور زبان آپ کو سکرپٹ کی ترتیب کے "lang" ہدایت کرنے کی وضاحت کی بنیاد پر سکرپٹ کی طرف سے فراہم کیا جا سکتا. کے علاوہ، آپ کو نظر انداز کی بنیاد پر دستخط "Deny" کرنا سکرپٹ کو ہدایت کر سکتے ہیں ان کے "[پرم]" قدر سکرپٹ کی ترتیب کی طرف سے مخصوص ہدایات کے ذریعے (وہ ان آشلپی الفاظ استعمال کر رہے ہیں) (ہر آشلپی لفظ ایک اسی ہدایت کی ہے یا تو کرنے کے لئے اسی دستخط عملدرآمد یا ان کو نظر انداز کرنے کی). "[پرم]" اقدار، ان آشلپی الفاظ استعمال کرتے ہیں کہ نہیں تاہم L10N حمایت کی ضرورت نہیں ہے اور اس وجہ سے سکرپٹ کی طرف سے فراہم نہیں کیا جائے گا، اور اس کے علاوہ، سکرپٹ کی ترتیب کی طرف سے براہ راست نینترنیی نہیں ہیں آپ آشلپی الفاظ یہ ہیں:<br /></div>
<div dir="rtl"><ul>
 <li>Bogon</li>
 <li>Cloud</li>
 <li>Generic</li>
 <li>Proxy</li>
 <li>Spam</li>
</ul></div>

#### <div dir="rtl">٧.١ ٹیگز<br /><br /></div>

<div dir="rtl">آپ کو انفرادی حصوں میں آپ اپنی مرضی کے دستخط کو تقسیم کرنا چاہتے ہیں تو، آپ کو آپ کے دستخط کے سیکشن کے نام کے ساتھ ساتھ فوری طور پر ہر سیکشن کے دستخط کے بعد ایک "سیکشن ٹیگ" انہوں نے مزید کہا کی طرف سے سکرپٹ کے لئے ان کے انفرادی حصوں کی شناخت کر سکتے ہیں (ذیل کی مثال ملاحظہ کریں).<br /><br /></div>

```
# سیکشن 1.
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud
4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
6.7.8.9/32 Deny Proxy
Tag: سیکشن 1
```

<div dir="rtl">سیکشن ٹیگنگ توڑنے اور یقینی بنانے کے لئے ٹیگز غلط طریقے سے دستخط کی فائلوں میں پہلے سے دستخط کے حصوں کو شناخت نہیں کر رہے ہیں کہ، صرف آپ کے ٹیگ اور آپ کے شروع کے دستخط حصوں کے درمیان کم از کم دو مسلسل نیولائنز سے ہیں اس بات کا یقین. کوئی غیر ٹیگ شدہ دستخط "IPv4 کی" یا "IPv6 کی" (دستخط کی اقسام کو متحرک کیا جا رہا ہے جس پر منحصر ہے) خواہ کو فطری گا.<br /><br /></div>

```
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud

4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
Tag: سیکشن 1
```

<div dir="rtl">اوپر کی مثال میں "1.2.3.4/32" اور "2.3.4.5/32" "IPv4" کی کے طور پر ٹیگ کیا جائے گا، جبکہ "4.5.6.7/32" اور "5.6.7.8/32" "سیکشن 1" کے طور پر ٹیگ کیا جائے گا.<br /><br /></div>

<div dir="rtl">آپ دستخط سیکشن ٹیگز کو اسی انداز میں، کچھ وقت کے بعد ختم کرنا چاہتے ہیں تو، آپ کو متعین کرنے کی ایک "ختم ہونے ٹیگ" استعمال دستخط درست نہیں رہے چاہئے جب سکتا. ختم ہونے ٹیگز شکل "YYYY.MM.DD" استعمال کرتے ہیں (ذیل کی مثال دیکھیں).<br /><br /></div>

```
# سیکشن 1.
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Expires: 2016.12.31
```

<div dir="rtl">دفعہ ٹیگ اور ختم ہونے ٹیگز مل کر میں استعمال کیا جا سکتا ہے، اور دونوں (ذیل مثال دیکھیں) اختیاری ہیں.<br /><br /></div>

```
# Example Section.
1.2.3.4/32 Deny Generic
Tag: Example Section
Expires: 2016.12.31
```

#### <div dir="rtl">٧.٢ YAML<br /><br /></div>

#### <div dir="rtl">٧.٢.٠ YAML مبادیات<br /><br /></div>

<div dir="rtl">مکمل طور پر اختیاری (یعنی آپ اسے استعمال کرتے ہیں تو آپ کا انتخاب ہے) YAML نشانات استعمال کرتے ہوئے، اور ترتیب میں سے اکثر کا فائدہ اٹھانے کے قابل ہے.<br /><br /></div>

<div dir="rtl">CIDRAM میں، تین ڈیشز ("---") کا استعمال کرتے ہوئے تعین کیا YAML جاتا ہے، اور وہ دو نئے لائنوں کا استعمال کرتے ہوئے ختم. مندرجہ ذیل مثال:<br /><br /></div>

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

##### <div dir="rtl">٧.٢.١ کس طرح "خاص نشان" reCAPTCHA کے ساتھ استعمال کریں کے لئے دستخط قسموں<br /><br /></div>

<div dir="rtl">جب "usemode" 0 یا 1 ہے، دستخط حصوں (وہ پہلے یا reCAPTCHA کے، اس ترتیب کے لحاظ سے استعمال نہیں کرے گا کرے گا کیونکہ) reCAPTCHA کے ساتھ استعمال کے لئے "خاص طور پر نشان زد" کرنے کی ضرورت نہیں ہے.<br /><br /></div>

<div dir="rtl">جب "usemode" 2 ہے، "خاص نشان" reCAPTCHA کے ساتھ استعمال کے لئے دستخط حصوں، ایک اندراج ہے کہ دستخط کے حصے کے لیے YAML طبقہ میں (ذیل کی مثال ملاحظہ کریں) شامل ہے کرنے کے لئے.<br /><br /></div>

```
# یہ حصہ reCAPTCHA کے استعمال کریں گے.
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Tag: reCAPTCHA-Enabled
---
recaptcha:
 enabled: true
```

<div dir="rtl">نوٹ: ایک reCAPTCHA مثال صرف (یا تو کے ساتھ 2 کے طور پر "usemode" کے طور پر 1، یا "usemode" "چالو حالت میں" کے طور پر سچ کے ساتھ) تو reCAPTCHA کے چالو حالت میں ہے صارف کو پیش کیا جائے گا، اور بالکل ایک دستخطی متحرک کیا گیا ہے (کوئی زیادہ ، کم نہیں؛ ایک سے زیادہ دستخط متحرک کر رہے ہیں تو، ایک reCAPTCHA مثال پیش کیا جائے نہیں کرے گا).<br /><br /></div>

#### <div dir="rtl">٧.٣ معاون<br /><br /></div>

<div dir="rtl">کے علاوہ، آپ CIDRAM مکمل طور پر دستخط کی فائلوں میں سے کسی کے اندر کچھ مخصوص حصوں کو نظر انداز کرنا چاہتے ہیں تو، آپ "ignore.dat" فائل ہے جس میں حصوں کو نظر انداز کرنے کی وضاحت کرنے کے لئے استعمال کر سکتے ہیں. ایک نئی لائن پر، لکھنا "Ignore"، ایک کی جگہ کے بعد، آپ کو CIDRAM نظر انداز کرنا (ذیل کی مثال ملاحظہ کریں) چاہتے ہیں کہ سیکشن کے نام کے بعد<br /><br /></div>

```
Ignore سیکشن 1
```

<div dir="rtl">مزید معلومات کے لئے اپنی مرضی کے دستخط فائلوں کا حوالہ لیں.<br /><br /></div>

---


### <div dir="rtl">٨. <a name="SECTION8">اکثر پوچھے گئے سوالات (FAQ)</div>

#### <div dir="rtl">ایک "دستخط" کیا ہے؟<br /><br /></div>

<div dir="rtl">CIDRAM کے تناظر میں، اعداد و شمار کے مخصوص کچھ ہم کے لئے تلاش کر رہے ہیں اس کی شناخت کے لئے استعمال کیا جاتا ہے کے لئے ایک "دستخط" مراد، عام طور پر ایک IP ایڈریس یا CIDR، CIDRAM لئے کچھ ہدایات کے ساتھ (یہ مقابلوں جب ہم کے لئے تلاش کر رہے ہیں کیا جواب دینے کا بہترین طریقہ، وغیرہ). CIDRAM لئے ایک مخصوص دستخط کی کچھ اس طرح دکھائی دیتی ہے:<br /><br /></div>

`1.2.3.4/32 Deny Generic`

Often (but not always), signatures will bundled together in groups, forming "signature sections", often accompanied by comments, markup, and/or related metadata that can be used to provide additional context for the signatures and/or further instruction.

#### <div dir="rtl"><a name="WHAT_IS_A_CIDR"></a>ایک "CIDR" کیا ہے؟<br /><br /></div>

"CIDR" is an acronym for "Classless Inter-Domain Routing" *[[1](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing), [2](http://whatismyipaddress.com/cidr)]*, and it's this acronym that's used as part of the name for this package, "CIDRAM", which is an acronym for "Classless Inter-Domain Routing Access Manager".

However, in the context of CIDRAM (such as, within this documentation, within discussions relating to CIDRAM, or within the CIDRAM language data), whenever a "CIDR" (singular) or "CIDRs" (plural) is mentioned or referred to (and thus whereby we use these words as nouns in their own right, as opposed to as acronyms), what's intended and meant by this is a subnet (or subnets), expressed using CIDR notation. The reason that CIDR (or CIDRs) is used instead of subnet (or subnets) is to make it clear that it's specifically subnets expressed using CIDR notation that's being referred to (because CIDR notation is just one of several different ways that subnets can be expressed). CIDRAM could, therefore, be considered a "subnet access manager".

Although this dual meaning of "CIDR" may present some ambiguity in some cases, this explanation, along with the context provided, should help to resolve such ambiguity.

#### <div dir="rtl">ایک "جھوٹی مثبت" سے کیا مراد ہے؟<br /><br /></div>

<div dir="rtl">اصطلاح "جھوٹی مثبت" (* متبادل کے طور پر: "جھوٹی مثبت غلطی"؛ "جھوٹے الارم" *)، بیان بہت صرف، اور ایک عام سیاق و سباق میں، ایک کی حالت کے لئے جانچ جب، استعمال کیا جاتا ہے کہ ٹیسٹ کے نتائج کا حوالہ دیتے ہیں کے لئے، نتائج مثبت ہیں جب (یعنی حالت "مثبت" یا "سچ" ہونے کا تعین کیا جاتا ہے)، لیکن بننے کی توقع کی جاتی ہے (یا ہونا چاہیئے) منفی (یعنی حالت، حقیقت میں، "منفی"، یا "جھوٹے"). A "جھوٹی مثبت" مثل غور کیا جا سکتا کے لئے "رونا بھیڑیا" (جس حالت تجربہ کیا جا رہا، حالت "جھوٹے" کہ میں ریوڑ کے قریب کوئی بھیڑیا ہے، اور شرط کے طور پر رپورٹ کیا جاتا ہے ریوڑ کے قریب ایک بھیڑیا ہے کہ آیا ہے "بھیڑیا، بھیڑیا" بلا کی راہ کی طرف چرواہا کی طرف سے "مثبت")، یا طبی جانچ میں حالات جس میں ایک مریض، کچھ بیماری یا مرض ہونے حقیقت میں، وہ ایسی کوئی بیماری یا مرض ہے جب کے طور پر تشخیص کی جاتی ہے کے مطابق.<br /><br /></div>

<div dir="rtl">ایک شرط کے لئے جانچ جب متعلقہ نتائج "سچ مثبت" کی اصطلاحات کا استعمال کرتے ہوئے، "سچ منفی" اور "جھوٹے منفی" بیان کیا جا سکتا ہے. A "سچ مثبت" جب ٹیسٹ کے نتائج اور حالت کی اصل ریاست دونوں حقیقی (یا "مثبت")، اور ایک "حقیقی منفی" ہیں سے مراد ہے سے مراد ہے جب ٹیسٹ کے نتائج اور کی اصل ریاست شرط ہیں دونوں جھوٹے ہیں (یا "منفی")؛ A "سچ مثبت" یا "سچ منفی" ایک "صحیح اندازہ" سمجھا جاتا ہے. ایک "جھوٹی مثبت" کے برعکس ایک "جھوٹے منفی" ہے؛ A "جھوٹے منفی" سے ٹیسٹ کے نتائج منفی ہیں، جب (یعنی حالت "منفی"، یا "جھوٹے" ہونے کا تعین کیا جاتا ہے)، لیکن بننے کی توقع کی جاتی ہے (یا ہونا چاہیئے) مراد مثبت (یعنی، حالت، حقیقت میں، "مثبت" یا "سچ") ہے.<br /><br /></div>

<div dir="rtl">CIDRAM کے تناظر میں، ان شرائط جسے انہوں بلاک CIDRAM کے دستخط اور کیا / کا حوالہ دیتے ہیں. ایک IP ایڈریس، برا فرسودہ یا غلط دستخطوں کی وجہ CIDRAM بلاکس، لیکن ایسا نہیں کیا جب چاہئے ہے، یا یہ غلط وجوہات کی بناء پر ایسا کرتا ہے جب، ہم نے ایک "جھوٹی مثبت" کے طور پر اس ایونٹ کا حوالہ دیتے ہیں. CIDRAM ایک IP ایڈریس جو، کی وجہ سے غیر متوقع خطرات سے، بلاک کر دیا گیا ہے چاہئے لاپتہ اس کے دستخط میں دستخط یا کمی کو بلاک کرنے میں ناکام ہونے پر، ہم نے ایک "یاد کا پتہ لگانے" (ایک "جھوٹے منفی" کے مطابق ہوتا ہے) کے طور پر اس واقعہ کا حوالہ دیتے ہیں.<br /><br /></div>

<div dir="rtl">یہ مندرجہ ذیل ٹیبل کی طرف سے بیان کیا جا سکتا ہے:<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline;">CIDRAM چاہئے <strong>نہیں</strong> ایک IP ایڈریس بلاک</div> | &nbsp; <div dir="rtl" style="display:inline;">CIDRAM ایک IP ایڈریس مسدود کرنا <strong>چاہئے</strong></div> | &nbsp;
---|---|---
&nbsp; <div dir="rtl" style="display:inline;">یہ سچ ہے کہ منفی (صحیح اندازہ)</div> | &nbsp; <div dir="rtl" style="display:inline;">فوت شدہ کا پتہ لگانے (جھوٹے منفی کے مطابق)</div> | <div dir="rtl" style="display:inline;">CIDRAM <strong>نہیں</strong> بلاک ایک IP ایڈریس کراسکتا</div>
&nbsp; <div dir="rtl" style="display:inline;"><strong>جھوٹی مثبت</strong></div> | &nbsp; <div dir="rtl" style="display:inline;">یہ سچ ہے کہ مثبت (صحیح اندازہ)</div> | &nbsp; <div dir="rtl" style="display:inline;">CIDRAM <strong>ہے</strong> ایک IP ایڈریس بلاک</div>

<div dir="rtl">بلاک تمام ممالک CIDRAM کر سکتا ہوں؟<br /><br /></div>

<div dir="rtl">جی ہاں. اس مقصد کو حاصل کرنے کے لئے سب سے آسان طریقہ Macmathan طرف سے فراہم اختیاری ملک blocklists کے کچھ نصب کرنے کے لئے ہو جائے گا. <strong><a href="https://macmathan.info/blocklists">ڈاؤن لوڈ، اتارنا صفحے اختیاری blocklists</a></strong> آپ سے ان کا براہ راست ڈاؤن لوڈ کر کے، معذور رہنے کا سامنے کے آخر میں کے لئے ترجیح دیتے ہیں تو یہ سامنے کے آخر میں اپ ڈیٹ کے صفحے سے کچھ آسان براہ راست کلکس کے ساتھ کیا جا سکتا ہے، یا، والٹ پر اپ لوڈ، اور متعلقہ ترتیب ہدایات میں ان کے نام کا حوالہ دیتے ہوئے.<br /><br /></div>

<div dir="rtl">دستخط کیسے بیشتر اپ ڈیٹ کر رہے ہیں؟<br /><br /></div>

<div dir="rtl">اپ ڈیٹ فریکوئنسی سوال میں دستخط کی فائلوں پر منحصر ہوتی ہے. CIDRAM دستخط کی فائلوں کے لئے تمام حاکم عام طور پر اپ ڈیٹ کرنے کے لئے ممکن ہے کے طور پر کے طور پر ان کے دستخط رکھنے کی کوشش کرتے ہیں، لیکن ہم سب کے طور پر مختلف دیگر وعدوں، اس منصوبے سے باہر ہماری زندگی ہے، اور ہم میں سے کوئی اس کو مالی طور پر معاوضہ رہے ہیں (یعنی، ادا کی ) منصوبے پر ہماری کوششوں کے لئے ایک عین مطابق اپ ڈیٹ کے شیڈول کی ضمانت نہیں کیا جا سکتا. ان کو اپ ڈیٹ کرنے کے لئے کافی وقت نہیں ہے جب بھی، اور عام طور پر، حاکم ضرورت پر اور حدود کے درمیان پائے جاتے تبدیلیاں کس طرح اکثر کی بنیاد پر ترجیح دینے کی کوشش کریں عام طور پر، دستخطوں کو اپ ڈیٹ کر رہے ہیں. اگر آپ کو کوئی پیشکش کرنے کو تیار ہیں تو اس سلسلے میں معاونت ہمیشہ تعریف کی ہے.<br /><br /></div>

<div dir="rtl">CIDRAM استعمال کرتے ہوئے میں ایک مسئلہ کا سامنا کرنا پڑا ہے اور میں اس کے بارے میں کیا پتہ نہیں ہے! مدد کریں!</div>
<div dir="rtl"><ul>
 <li>آپ نے سافٹ ویئر کا تازہ ترین ورژن استعمال کر رہے ہیں؟ آپ کو آپ کے دستخط فائلوں کا تازہ ترین ورژن استعمال کر رہے ہیں؟ ان دو سوالوں کی یا تو کرنے کے لئے جواب نہیں ہے تو، سب سے پہلے سب کچھ کو اپ ڈیٹ کرنے کی کوشش کریں، اور چاہے وہ مسئلہ برقرار رہتا ہے چیک کریں. یہ برقرار رہتا ہے، پڑھنے جاری رکھیں.</li>
 <li>اگر آپ کو تمام دستاویزات کے ذریعے کی جانچ پڑتال کی ہے؟ اگر نہیں، تو براہ مہربانی. مسئلہ دستاویزات استعمال کر حل نہیں کیا جا سکتا ہے، تو پڑھنے جاری رکھیں.</li>
 <li>اگر آپ کو <strong><a href="https://github.com/Maikuolan/CIDRAM/issues">مسائل صفحے</strong></a> جانچ پڑتال کی ہے، دیکھنا چاہے مسئلہ پہلے ذکر کیا گیا ہے؟ اس سے پہلے ذکر کیا گیا ہے تو، چاہے وہ کسی بھی تجاویز، خیالات، اور / یا کے حل فراہم کیا گیا جانچ اور مسئلہ حل کرنے کی کوشش کرنے کے لئے ضروری کے مطابق عمل کریں.</li>
 <li>اگر آپ کو <strong><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=61">Spambot سیکورٹی کی طرف سے فراہم CIDRAM حمایت فورم</a></strong>، دیکھنا چاہے مسئلہ پہلے ذکر کیا گیا ہے کی جانچ پڑتال کی ہے؟ اس سے پہلے ذکر کیا گیا ہے تو، چاہے وہ کسی بھی تجاویز، خیالات، اور / یا کے حل فراہم کیا گیا جانچ اور مسئلہ حل کرنے کی کوشش کرنے کے لئے ضروری کے مطابق عمل کریں.</li>
 <li>مسئلہ اب بھی برقرار رہتا ہے تو، ہم سے مسائل کے صفحے پر ایک نیا مسئلہ پیدا کرنے کی طرف سے یا حمایت فورم پر ایک نئی بحث شروع ہونے والے کی طرف سے اس کے بارے میں مطلع کریں.</li>
</ul></div>

<div dir="rtl">میں نے دورہ کرنا چاہتے ہیں کہ ایک ویب سائٹ سے CIDRAM کی طرف سے بلاک کیا گیا ہے! مدد کریں!<br /><br /></div>

<div dir="rtl">CIDRAM ویب سائٹ کے مالکان ناپسندیدہ ٹریفک کو بلاک کرنے کے لئے ایک ذریعہ فراہم کرتا ہے، لیکن یہ وہ CIDRAM استعمال کرنا چاہتے ہیں کہ کس طرح اپنے لئے فیصلہ کرنے کے لئے ویب سائٹ کے مالکان کی ذمہ داری ہے. کے دستخط سے متعلق جھوٹی مثبت عام طور CIDRAM ساتھ شامل فائلوں کی صورت میں، تصحیح بنایا جا سکتا ہے، لیکن مخصوص ویب سائٹس سے غیر مسدود ہونے کے حوالے میں، آپ کے سوال میں ویب سائٹس کے مالکان کے ساتھ کہ اپ لینے کی ضرورت پڑے گی. مقدمات جہاں تصحیح کم سے کم، بنائے جاتے ہیں میں، وہ مثال ہے، وہ ان کی تنصیب ترمیم شدہ گئے ہیں جہاں کے لئے، اس طرح کے طور پر ان کے دستخط فائلوں اور / یا تنصیب، اور دیگر مقدمات میں (اپ ڈیٹ کرنے کی ضرورت ہو گی، ان کی اپنی مرضی کے دستخط پیدا ، وغیرہ)، کو حل کرنے کی ذمہ داری آپ کا مسئلہ مکمل طور پر ان کی ہے، اور ہمارے قابو سے باہر مکمل طور پر ہے.<br /><br /></div>

<div dir="rtl">میں 5.4.0 سے زیادہ پرانے ایک پی ایچ پی ورژن کے ساتھ CIDRAM استعمال کرنا چاہتے ہیں؛ کیا آپ مدد کر سکتے ہیں؟<br /><br /></div>

<div dir="rtl">نمبر PHP 5.4.0 2014 میں سرکاری EOL ("زندگی کے اختتام") تک پہنچ گئی، اور توسیع کی سیکورٹی کی حمایت کی اس تحریر کی وجہ 2015. میں ختم کیا گیا تھا، یہ 2017 ہے اور PHP 7.1.0 پہلے سے ہی دستیاب ہے. اس وقت، حمایت PHP 5.4.0 اور تمام دستیاب جدید تر پی ایچ پی ورژن کے ساتھ CIDRAM استعمال کرنے کے لئے فراہم کی جاتی ہے، لیکن آپ کو کسی بھی بڑی عمر کے پی ایچ پی ورژن کے ساتھ CIDRAM استعمال کرنے کی کوشش کرتے ہیں، مدد فراہم نہیں کی جائے گی.<br /><br /></div>

<div dir="rtl">میں نے ایک سے زیادہ ڈومینز کی حفاظت کے لئے ایک واحد CIDRAM تنصیب کا استعمال کر سکتا ہوں؟<br /><br /></div>

<div dir="rtl">Yes. CIDRAM installations are not naturally locked to specific domains, and can therefore be used to protect multiple domains. Generally, we refer to CIDRAM installations protecting only one domain as "single-domain installations", and we refer to CIDRAM installations protecting multiple domains and/or sub-domains as "multi-domain installations". If you operate a multi-domain installation and need to use different sets of signature files for different domains, or need CIDRAM to be configured differently for different domains, it's possible to do this. After loading the configuration file (`config.ini`), CIDRAM will check for the existence of a "configuration overrides file" specific to the domain (or sub-domain) being requested (`the-domain-being-requested.tld.config.ini`), and if found, any configuration values defined by the configuration overrides file will be used for the execution instance instead of the configuration values defined by the configuration file. Configuration overrides files are identical to the configuration file, and at your discretion, may contain either the entirety of all configuration directives available to CIDRAM, or whichever small subsection required which differs from the values normally defined by the configuration file. Configuration overrides files are named according to the domain that they are intended for (so, for example, if you need a configuration overrides file for the domain, `http://www.some-domain.tld/`, its configuration overrides file should be named as `some-domain.tld.config.ini`, and should be placed within the vault alongside the configuration file, `config.ini`). The domain name for the execution instance is derived from the `HTTP_HOST` header of the request; "www" is ignored.<br /><br /></div>

---


<div dir="rtl">آخری تازہ کاری: 7 مئی 2017 (2017.05.07).</div>
