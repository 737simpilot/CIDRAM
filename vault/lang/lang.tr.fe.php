<?php
/**
 * This file is a part of the CIDRAM package.
 * Homepage: https://cidram.github.io/
 *
 * CIDRAM COPYRIGHT 2016 and beyond by Caleb Mazalevskis (Maikuolan).
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Turkish language data for the front-end (last modified: 2017.10.15).
 */

/** Prevents execution from outside of CIDRAM. */
if (!defined('CIDRAM')) {
    die('[CIDRAM] This should not be accessed directly.');
}

$CIDRAM['lang']['bNav_home_logout'] = '<a href="?">Ana Sayfa</a> | <a href="?cidram-page=logout">Çıkış</a>';
$CIDRAM['lang']['bNav_logout'] = '<a href="?cidram-page=logout">Çıkış</a>';
$CIDRAM['lang']['config_general_ban_override'] = '"infraction_limit" aşıldığında "forbid_on_block"u geçersiz kıl? Geçersiz kılarken: Engellenen istekler boş bir sayfa verir (şablon dosyaları kullanılmaz). 200 = [Varsayılan] değerini geçersiz kılmayın; 403 = "403 Yasak" ile geçersiz kıl; 503 = "503 Hizmet kullanılamıyor" ile geçersiz kılın.';
$CIDRAM['lang']['config_general_default_algo'] = 'Gelecekteki tüm şifreler ve oturumlar için hangi algoritmayı kullanacağını tanımlar. Options: PASSWORD_DEFAULT (varsayılan), PASSWORD_BCRYPT, PASSWORD_ARGON2I (PHP >= 7.2.0 gerektirir).';
$CIDRAM['lang']['config_general_default_dns'] = 'Ana makine adı aramalarda kullanılacak virgülle ayrılmış DNS sunucuları listesi. Varsayılan = "8.8.8.8,8.8.4.4" (Google DNS). UYARI: Ne yaptığınızı bilmiyorsanız bunu değiştirmeyin!';
$CIDRAM['lang']['config_general_disable_cli'] = 'CLI modunu devre dışı bırak? CLI modu varsayılan olarak etkindir, ancak bazen bazı test araçlarına (örneğin PHPUnit) ve diğer CLI tabanlı uygulamalara müdahale edebilir. CLI modunu devre dışı bırakmanız gerekmiyorsa, bu direktif görmezden almalısınız. False = CLI modunu etkinleştir [Varsayılan]; True = CLI modunu devre dışı bırak.';
$CIDRAM['lang']['config_general_disable_frontend'] = 'Ön uç erişimini devre dışı bırak? Ön uç erişimi CIDRAM\'ın daha yönetilebilir hale getirebilir, ancak potansiyel bir güvenlik riski de oluşturabilir. CIDRAM\'ın mümkün olduğunda arka ucundan yönetmesi önerilir, ancak kolaylık sağlamak için ön uç erişimi sağlanmıştır. İhtiyacınız olmadıkça devre dışı bırakın. False = Ön uç erişimini etkinleştir; True = Ön uç erişimini devre dışı bırak [Varsayılan].';
$CIDRAM['lang']['config_general_disable_webfonts'] = 'Webfontlarını devre dışı bırak? Doğru/True = Evet; Yanlış/False = Hayır [Varsayılan].';
$CIDRAM['lang']['config_general_emailaddr'] = 'İsterseniz, kullanıcıları engellediğinde verilecek bir e-posta adresi sağlayabilirsiniz, yanlışlıkla engellendikleri zaman destek için sizinle iletişim kurabilmeleri için. UYARI: Burada tedarik ettiğiniz e-posta adresiniz kesinlikle spambotlar ve sıyırıcılar tarafından edinilecektir. Bu nedenle, tek kullanımlık veya önemsiz bir e-posta adresini seçmeniz kesinlikle önerilir (diğer bir deyişle, büyük olasılıkla birincil kişisel veya birincil iş e-posta adreslerinizi kullanmak istemiyorsunuzdur).';
$CIDRAM['lang']['config_general_emailaddr_display_style'] = 'E-posta adresinin kullanıcılara sunulmasını nasıl tercih ederdiniz?';
$CIDRAM['lang']['config_general_forbid_on_block'] = 'İstekleri engellerken CIDRAM hangi üstbilgilerle karşılık vermeli?';
$CIDRAM['lang']['config_general_FrontEndLog'] = 'Ön uç giriş denemelerini kaydetmek için kullanılan dosya. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$CIDRAM['lang']['config_general_ipaddr'] = 'Bağlama isteklerinin IP adresi nerede bulunur? (Cloudflare ve benzeri hizmetler için yararlıdır). Varsayılan = REMOTE_ADDR. UYARI: Ne yaptığınızı bilmiyorsanız bunu değiştirmeyin!';
$CIDRAM['lang']['config_general_lang'] = 'CIDRAM için varsayılan dili belirleyin.';
$CIDRAM['lang']['config_general_logfile'] = 'Engellenen tüm erişim girişimlerini kaydetmek için insanlar tarafından okunabilir dosya. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$CIDRAM['lang']['config_general_logfileApache'] = 'Engellenen tüm erişim girişimlerini kaydetmek için Apache tarzı dosya. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$CIDRAM['lang']['config_general_logfileSerialized'] = 'Engellenen tüm erişim girişimlerini kaydetmek için seri haline getirilmiş dosya. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$CIDRAM['lang']['config_general_log_banned_ips'] = 'Yasaklanmış IP\'lerden engellenen istekleri günlük dosyalarına dahil et? Doğru/True = Evet [Varsayılan]; Yanlış/False = Hayır.';
$CIDRAM['lang']['config_general_maintenance_mode'] = 'Bakım modunu etkinleştirilsin mi? Doğru/True = Evet; Yanlış/False = Hayır [Varsayılan]. Ön uç haricindeki her şeyi devre dışı bırakır. Bazen CMS\'nizi, çerçeveleri vb. güncellenirken yararlıdır.';
$CIDRAM['lang']['config_general_max_login_attempts'] = 'Maksimum giriş denemesi sayısı.';
$CIDRAM['lang']['config_general_numbers'] = 'Numaraların görüntülenmesini nasıl tercih edersiniz? Size en uygun görünen örneği seçin.';
$CIDRAM['lang']['config_general_protect_frontend'] = 'Normal olarak CIDRAM tarafından sağlanan korumaların ön uça uygulanıp uygulanmayacağını belirtir. Doğru/True = Evet [Varsayılan]; Yanlış/False = Hayır.';
$CIDRAM['lang']['config_general_search_engine_verification'] = 'Arama motorlarından gelen istekleri doğrulamaya çalışın? Arama motorlarını doğrulamak, ihlal sınırını aşmanın bir sonucu olarak yasaklanmamasını sağlar (sitenizdeki arama motorlarını yasaklamak genellikle arama motoru sıralaması, SEO, vb. üzerinde olumsuz bir etki yapar). Doğrulandığı zaman, arama motorları normal olarak engellenebilir, ancak yasaklanmaz. Doğrulanmadığı zaman ise, ihlal sınırının aşılmasının bir sonucu olarak yasaklanmaları mümkündür. Buna ek olarak, arama motoru doğrulaması, sahte arama motoru isteklerine ve arama motorları kılığına bürünen potansiyel olarak kötü amaçlı varlıklara karşı koruma sağlar (arama motoru doğrulama etkinleştirildiğinde bu tür istekler engellenir). Doğru/True = Arama motoru doğrulamasını etkinleştir [Varsayılan]; Yanlış/False = Arama motoru doğrulamasını devre dışı bırakın.';
$CIDRAM['lang']['config_general_silent_mode'] = 'CIDRAM, "Erişim Reddedildi" sayfasını göstermek yerine, engellenen erişim girişimlerini sessizce yönlendirmeli mi? Yanıt evet ise, engellenen erişim girişimleri için yeniden yönlendirilecek konumu belirtin. Yanıt hayır ise, bu değişkeni boş bırakın.';
$CIDRAM['lang']['config_general_statistics'] = 'CIDRAM kullanım istatistiklerini takip et? Doğru/True = Evet; Yanlış/False = Hayır [Varsayılan].';
$CIDRAM['lang']['config_general_timeFormat'] = 'CIDRAM tarafından kullanılan tarih/saat gösterimi biçimi. İsteğe bağlı olarak ek seçenekler eklenebilir.';
$CIDRAM['lang']['config_general_timeOffset'] = 'Dakika cinsinden zaman dilimi farkı.';
$CIDRAM['lang']['config_general_timezone'] = 'Zaman diliminiz.';
$CIDRAM['lang']['config_general_truncate'] = 'Belirli bir boyuta ulaştığında günlük dosyalarını kesin? Değer, bir günlük dosyasının kesilmeden önce büyüyebileceği B/KB/MB/GB/TB cinsinden maksimum boyuttur. Varsayılan 0KB değeri, kesmeyi devre dışı bırakır (günlük dosyaları sınırsız büyüyebilir). Not: Tek tek kayıt dosyaları için geçerlidir! Günlük dosyalarının boyutu toplam olarak alınmaz.';
$CIDRAM['lang']['config_recaptcha_expiry'] = 'reCAPTCHA örneklerini hatırlamak için saat sayısı.';
$CIDRAM['lang']['config_recaptcha_lockip'] = 'reCAPTCHA\'yı IP\'lere kilitle?';
$CIDRAM['lang']['config_recaptcha_lockuser'] = 'reCAPTCHA kullanıcılara kilitle?';
$CIDRAM['lang']['config_recaptcha_logfile'] = 'Tüm reCAPTCHA denemelerini günlüğe yaz? Yanıt evet ise, günlük dosyası için kullanılacak adı belirtin. Yanıt hayır ise, bu değişkeni boş bırakın.';
$CIDRAM['lang']['config_recaptcha_secret'] = 'Bu değer, reCAPTCHA gösterge tablosunda bulunabilen reCAPTCHA\'nızın "secret key"na karşılık gelmelidir.';
$CIDRAM['lang']['config_recaptcha_sitekey'] = 'Bu değer, reCAPTCHA gösterge tablosunda bulunabilen reCAPTCHA\'nızın "site key"na karşılık gelmelidir.';
$CIDRAM['lang']['config_recaptcha_usemode'] = 'CIDRAM\'ın reCAPTCHA\'yi nasıl kullanması gerektiğini tanımlar (belgelere bakın).';
$CIDRAM['lang']['config_signatures_block_bogons'] = 'Bogon/martian CIDR\'leri engelleyin? Sitenize yerel ağınızdan, yerel hizmet bilgisayarından veya yerel ağınızdan bağlantılar bekliyorsanız, bu yönerge yanlış (false) değerine ayarlanmalıdır. Bu tür bağlantıları beklemiyorsanız, bu yönerge doğru (true) olmalıdır.';
$CIDRAM['lang']['config_signatures_block_cloud'] = 'Webhosting/bulut hizmetlerine ait olarak tanımlanan CIDR\'leri engelle? Sitenizden bir API hizmeti işletiyorsanız veya diğer web sitelerinin web sitenize bağlanmasını bekliyorsanız, bu yanlışa (false) ayarlanmalıdır. Aksi takdirde, bu yönergenin doğruya (true) ayarlanması gerekir.';
$CIDRAM['lang']['config_signatures_block_generic'] = 'Çoğu zaman kara liste için tavsiye edilen CIDR\'ler engelle? Bu, diğer daha belirgin imza kategorilerinin herhangi birinin parçası olarak işaretlenmeyen tüm imzaları kapsar.';
$CIDRAM['lang']['config_signatures_block_proxies'] = 'Aracı site hizmetlerine ait olduğu saptanan CIDRleri engelle? Kullanıcıların, sitenize anonim aracı site servislerinden erişebilmelerini istiyorsanız, bu, yanlışa (false) ayarlanmalıdır. Aksi takdirde, anonim aracı sitelere gereksinim duymuyorsanız, bu yönergenin güvenliği artırmak için doğruya (true) ayarlanması gerekir.';
$CIDRAM['lang']['config_signatures_block_spam'] = 'Yüksek riskli çöp posta olarak sahtanan CIDR\'leri enğelle? Bunu yaparken sorun yaşamıyorsanız, genelde bu daima doğruya (true) ayarlanmalıdır.';
$CIDRAM['lang']['config_signatures_default_tracktime'] = 'Modüller tarafından yasaklanan IP\'leri izlemek için kaç saniye. Varsayılan = 604800 (1 hafta).';
$CIDRAM['lang']['config_signatures_infraction_limit'] = 'IP izlemesi tarafından yasaklanmadan önce bir IPnin uğrayacağı maksimum ihlal sayısı. Varsayılan = 10.';
$CIDRAM['lang']['config_signatures_ipv4'] = 'Virgülle sınırlı, CIDRAM\'ın ayrıştırmaya çalıştığı IPv4 imza dosyalarının bir listesi.';
$CIDRAM['lang']['config_signatures_ipv6'] = 'Virgülle sınırlı, CIDRAM\'ın ayrıştırmaya çalıştığı IPv6 imza dosyalarının bir listesi.';
$CIDRAM['lang']['config_signatures_modules'] = 'Virgülle sınırlı, IPv4/IPv6 imzalarını kontrol ettikten sonra yüklenecek modül dosyalarının bir listesi.';
$CIDRAM['lang']['config_signatures_track_mode'] = 'İhlaller ne zaman sayılmalıdır? Yanlış/False = IP\'ler modüller tarafından engellendiğinde. Doğru/True = Herhangi bir nedenle IP\'ler engellendiğinde.';
$CIDRAM['lang']['config_template_data_css_url'] = 'Özel temalar için CSS dosyası URL\'si.';
$CIDRAM['lang']['config_template_data_Magnification'] = 'Yazı tipi büyütme. Varsayılan = 1.';
$CIDRAM['lang']['config_template_data_theme'] = 'CIDRAM için kullanılacak varsayılan tema.';
$CIDRAM['lang']['Extended Description: Bypasses'] = 'Varsayılan imza bypass\'lar, normalde ana paketle birlikte verilir.';
$CIDRAM['lang']['Extended Description: CIDRAM'] = 'Ana paket (hariç imzalar, belgeler, ve yapılandırma).';
$CIDRAM['lang']['field_activate'] = 'Etkinleştir';
$CIDRAM['lang']['field_banned'] = 'Yasaklandı';
$CIDRAM['lang']['field_blocked'] = 'Engellendi';
$CIDRAM['lang']['field_clear'] = 'Temiz';
$CIDRAM['lang']['field_clear_all'] = 'Hepsini temizle';
$CIDRAM['lang']['field_clickable_link'] = 'Tıklanabilir bağlantı';
$CIDRAM['lang']['field_component'] = 'Bileşen';
$CIDRAM['lang']['field_create_new_account'] = 'Yeni Hesap Oluştur';
$CIDRAM['lang']['field_deactivate'] = 'Devre dışı bırak';
$CIDRAM['lang']['field_delete_account'] = 'Hesabı sil';
$CIDRAM['lang']['field_delete_file'] = 'Sil';
$CIDRAM['lang']['field_download_file'] = 'İndir';
$CIDRAM['lang']['field_edit_file'] = 'Düzenle';
$CIDRAM['lang']['field_expiry'] = 'Bitim süresi';
$CIDRAM['lang']['field_false'] = 'False (Yanlış)';
$CIDRAM['lang']['field_file'] = 'Dosya';
$CIDRAM['lang']['field_filename'] = 'Dosya adı: ';
$CIDRAM['lang']['field_filetype_directory'] = 'Rehber';
$CIDRAM['lang']['field_filetype_info'] = '{EXT} Dosya';
$CIDRAM['lang']['field_filetype_unknown'] = 'Bilinmiyor';
$CIDRAM['lang']['field_first_seen'] = 'İlk Görülen';
$CIDRAM['lang']['field_infractions'] = 'İhlaller';
$CIDRAM['lang']['field_install'] = 'Yükle';
$CIDRAM['lang']['field_ip_address'] = 'İP Adresi';
$CIDRAM['lang']['field_latest_version'] = 'En son sürüm';
$CIDRAM['lang']['field_log_in'] = 'Oturum Aç';
$CIDRAM['lang']['field_new_name'] = 'Yeni isim:';
$CIDRAM['lang']['field_nonclickable_text'] = 'Tıklanmayan metin';
$CIDRAM['lang']['field_ok'] = 'Tamam';
$CIDRAM['lang']['field_options'] = 'Seçenekler';
$CIDRAM['lang']['field_password'] = 'Parola';
$CIDRAM['lang']['field_permissions'] = 'İzinler';
$CIDRAM['lang']['field_range'] = 'Aralık (İlk – Son)';
$CIDRAM['lang']['field_rename_file'] = 'Adını değiştirmek';
$CIDRAM['lang']['field_reset'] = 'Sıfırla';
$CIDRAM['lang']['field_set_new_password'] = 'Yeni Şifre Oluştur';
$CIDRAM['lang']['field_size'] = 'Toplam Boyut: ';
$CIDRAM['lang']['field_size_bytes'] = 'bayt';
$CIDRAM['lang']['field_size_GB'] = 'GB';
$CIDRAM['lang']['field_size_KB'] = 'KB';
$CIDRAM['lang']['field_size_MB'] = 'MB';
$CIDRAM['lang']['field_size_TB'] = 'TB';
$CIDRAM['lang']['field_status'] = 'Durum';
$CIDRAM['lang']['field_system_timezone'] = 'Sistem varsayılan saat dilimini kullanın.';
$CIDRAM['lang']['field_tracking'] = 'İzleme';
$CIDRAM['lang']['field_true'] = 'True (Doğru)';
$CIDRAM['lang']['field_uninstall'] = 'Kaldır';
$CIDRAM['lang']['field_update'] = 'Güncelle';
$CIDRAM['lang']['field_update_all'] = 'Tümünü güncelle';
$CIDRAM['lang']['field_upload_file'] = 'Yeni dosya yükle';
$CIDRAM['lang']['field_username'] = 'Kullanıcı adı';
$CIDRAM['lang']['field_your_version'] = 'Sürümünüz';
$CIDRAM['lang']['header_login'] = 'Devam etmek için lütfen giriş yapınız.';
$CIDRAM['lang']['label_active_config_file'] = 'Etkin yapılandırma dosyası: ';
$CIDRAM['lang']['label_banned'] = 'Yasaklı talepler';
$CIDRAM['lang']['label_blocked'] = 'Engellenen talepler';
$CIDRAM['lang']['label_branch'] = 'Branşı en yeni kararlı:';
$CIDRAM['lang']['label_cidram'] = 'Kullanılan CIDRAM sürümü:';
$CIDRAM['lang']['label_false_positive_risk'] = 'Yalancı pozitif risk: ';
$CIDRAM['lang']['label_fmgr_cache_data'] = 'Önbellek verileri ve geçici dosyalar';
$CIDRAM['lang']['label_fmgr_disk_usage'] = 'CIDRAM disk kullanımı: ';
$CIDRAM['lang']['label_fmgr_free_space'] = 'Boş disk alanı: ';
$CIDRAM['lang']['label_fmgr_total_disk_usage'] = 'Toplam disk kullanımı: ';
$CIDRAM['lang']['label_fmgr_total_space'] = 'Toplam disk alanı: ';
$CIDRAM['lang']['label_fmgr_updates_metadata'] = 'Bileşen güncellemeleri meta verileri';
$CIDRAM['lang']['label_hide'] = 'Saklamak';
$CIDRAM['lang']['label_os'] = 'Kullanılan işletim sistemi:';
$CIDRAM['lang']['label_other'] = 'Diğer';
$CIDRAM['lang']['label_other-ActiveIPv4'] = 'Etkin IPv4 imza dosyaları';
$CIDRAM['lang']['label_other-ActiveIPv6'] = 'Etkin IPv6 imza dosyaları';
$CIDRAM['lang']['label_other-ActiveModules'] = 'Aktif modüller';
$CIDRAM['lang']['label_other-Since'] = 'Başlangıç tarihi';
$CIDRAM['lang']['label_php'] = 'Kullanılan PHP sürümü:';
$CIDRAM['lang']['label_reCAPTCHA'] = 'reCAPTCHA denemeler';
$CIDRAM['lang']['label_results'] = 'Sonuçlar (%s giriş – %s reddedildi – %s kabul edildi – %s birleşti – %s çıktı):';
$CIDRAM['lang']['label_sapi'] = 'Kullanılan SAPI:';
$CIDRAM['lang']['label_show'] = 'Göstermek';
$CIDRAM['lang']['label_stable'] = 'En yeni kararlı:';
$CIDRAM['lang']['label_sysinfo'] = 'Sistem bilgisi:';
$CIDRAM['lang']['label_total'] = 'Toplam';
$CIDRAM['lang']['label_unstable'] = 'En yeni kararsız:';
$CIDRAM['lang']['link_accounts'] = 'Hesaplar';
$CIDRAM['lang']['link_cidr_calc'] = 'CIDR Hesaplayıcı';
$CIDRAM['lang']['link_config'] = 'Yapılandırma';
$CIDRAM['lang']['link_documentation'] = 'Belgeler';
$CIDRAM['lang']['link_file_manager'] = 'Dosya Yöneticisi';
$CIDRAM['lang']['link_home'] = 'Ana Sayfa';
$CIDRAM['lang']['link_ip_aggregator'] = 'IP Toplayıcı';
$CIDRAM['lang']['link_ip_test'] = 'IP Testi';
$CIDRAM['lang']['link_ip_tracking'] = 'IP İzleme';
$CIDRAM['lang']['link_logs'] = 'Kayıtlar';
$CIDRAM['lang']['link_statistics'] = 'İstatistik';
$CIDRAM['lang']['link_textmode'] = 'Metin biçimlendirme: <a href="%1$sfalse">Basit</a> – <a href="%1$strue">Süslü</a>';
$CIDRAM['lang']['link_updates'] = 'Güncellemeler';
$CIDRAM['lang']['logs_logfile_doesnt_exist'] = 'Seçilen günlük dosyası yok!';
$CIDRAM['lang']['logs_no_logfiles_available'] = 'Günlük dosyası yok.';
$CIDRAM['lang']['logs_no_logfile_selected'] = 'Hiçbir günlük dosyası seçilmedi.';
$CIDRAM['lang']['max_login_attempts_exceeded'] = 'Maksimum giriş denemesi aşıldı; Erişim reddedildi.';
$CIDRAM['lang']['Name: Bypasses'] = 'Varsayılan imza bypass\'lar.';
$CIDRAM['lang']['Name: IPv4'] = 'IPv4 imzaları dosyası (istenmeyen bulut servislerini ve insan olmayan uç noktaları).';
$CIDRAM['lang']['Name: IPv4-Bogons'] = 'IPv4 imzaları dosyası (Bogon/Martıyen CIDR\'leri).';
$CIDRAM['lang']['Name: IPv4-ISPs'] = 'IPv4 imzaları dosyası (tehlikeli ve spam gönderen ISS\'ler).';
$CIDRAM['lang']['Name: IPv4-Other'] = 'IPv4 imzaları dosyası (yakınlık/proxy, VPN ve diğer çeşitli istenmeyen hizmetler için CIDR\'ler).';
$CIDRAM['lang']['Name: IPv6'] = 'IPv6 imzaları dosyası (istenmeyen bulut servislerini ve insan olmayan uç noktaları).';
$CIDRAM['lang']['Name: IPv6-Bogons'] = 'IPv6 imzaları dosyası (Bogon/Martıyen CIDR\'leri).';
$CIDRAM['lang']['Name: IPv6-ISPs'] = 'IPv6 imzaları dosyası (tehlikeli ve spam gönderen ISS\'ler).';
$CIDRAM['lang']['Name: IPv6-Other'] = 'IPv6 imzaları dosyası (yakınlık/proxy, VPN ve diğer çeşitli istenmeyen hizmetler için CIDR\'ler).';
$CIDRAM['lang']['previewer_days'] = 'Günler';
$CIDRAM['lang']['previewer_hours'] = 'Saatler';
$CIDRAM['lang']['previewer_minutes'] = 'Dakikalar';
$CIDRAM['lang']['previewer_months'] = 'Aylar';
$CIDRAM['lang']['previewer_seconds'] = 'Saniyeler';
$CIDRAM['lang']['previewer_weeks'] = 'Haftalar';
$CIDRAM['lang']['previewer_years'] = 'Yıllar';
$CIDRAM['lang']['response_accounts_already_exists'] = 'Bu kullanıcı adıyla bir hesap zaten var!';
$CIDRAM['lang']['response_accounts_created'] = 'Hesap başarıyla oluşturuldu!';
$CIDRAM['lang']['response_accounts_deleted'] = 'Hesap başarıyla silindi!';
$CIDRAM['lang']['response_accounts_doesnt_exist'] = 'Bu hesap mevcut değil.';
$CIDRAM['lang']['response_accounts_password_updated'] = 'Şifre başarıyla güncellendi!';
$CIDRAM['lang']['response_activated'] = 'Başarıyla etkinleştirildi.';
$CIDRAM['lang']['response_activation_failed'] = 'Etkinleştirilemedi!';
$CIDRAM['lang']['response_checksum_error'] = 'Checksum hatası! Dosya reddedildi!';
$CIDRAM['lang']['response_component_successfully_installed'] = 'Bileşen başarıyla yüklendi.';
$CIDRAM['lang']['response_component_successfully_uninstalled'] = 'Bileşen başarıyla kaldırıldı.';
$CIDRAM['lang']['response_component_successfully_updated'] = 'Bileşen başarıyla güncellendi.';
$CIDRAM['lang']['response_component_uninstall_error'] = 'Bileşeni kaldırmaya çalışırken bir hata oluştu.';
$CIDRAM['lang']['response_configuration_updated'] = 'Yapılandırma başarıyla güncellendi.';
$CIDRAM['lang']['response_deactivated'] = 'Başarıyla devre dışı bırakıldı.';
$CIDRAM['lang']['response_deactivation_failed'] = 'Devre dışı bırakılamadı!';
$CIDRAM['lang']['response_delete_error'] = 'Silinemedi!';
$CIDRAM['lang']['response_directory_deleted'] = 'Dizin başarıyla silindi!';
$CIDRAM['lang']['response_directory_renamed'] = 'Dizin başarıyla yeniden adlandırıldı!';
$CIDRAM['lang']['response_error'] = 'Hata';
$CIDRAM['lang']['response_failed_to_install'] = 'Yükleme başarısız!';
$CIDRAM['lang']['response_failed_to_update'] = 'Güncelleme başarısız!';
$CIDRAM['lang']['response_file_deleted'] = 'Dosya başarıyla silindi!';
$CIDRAM['lang']['response_file_edited'] = 'Dosya başarıyla değiştirildi!';
$CIDRAM['lang']['response_file_renamed'] = 'Dosya başarıyla yeniden adlandırıldı!';
$CIDRAM['lang']['response_file_uploaded'] = 'Dosya başarıyla yüklendi!';
$CIDRAM['lang']['response_login_invalid_password'] = 'Giriş başarısız! Geçersiz parola!';
$CIDRAM['lang']['response_login_invalid_username'] = 'Giriş başarısız! Kullanıcı adı yok!';
$CIDRAM['lang']['response_login_password_field_empty'] = 'Parola alanı boş!';
$CIDRAM['lang']['response_login_username_field_empty'] = 'Kullanıcı adı alanı boş!';
$CIDRAM['lang']['response_no'] = 'Hayır';
$CIDRAM['lang']['response_rename_error'] = 'Yeniden adlandırılamadı!';
$CIDRAM['lang']['response_statistics_cleared'] = 'İstatistikler temizlendi.';
$CIDRAM['lang']['response_tracking_cleared'] = 'İzleme temizlendi.';
$CIDRAM['lang']['response_updates_already_up_to_date'] = 'Zaten güncel.';
$CIDRAM['lang']['response_updates_not_installed'] = 'Bileşen yüklü değil!';
$CIDRAM['lang']['response_updates_not_installed_php'] = 'Bileşen yüklü değil (PHP {V} gerektirir)!';
$CIDRAM['lang']['response_updates_outdated'] = 'Eski!';
$CIDRAM['lang']['response_updates_outdated_manually'] = 'Eski (lütfen manuel olarak güncelleyin)!';
$CIDRAM['lang']['response_updates_outdated_php_version'] = 'Eski (PHP {V} gerektirir)!';
$CIDRAM['lang']['response_updates_unable_to_determine'] = 'Belirlenemedi.';
$CIDRAM['lang']['response_upload_error'] = 'Yüklenemedi!';
$CIDRAM['lang']['response_yes'] = 'Evet';
$CIDRAM['lang']['state_complete_access'] = 'Tam erişim';
$CIDRAM['lang']['state_component_is_active'] = 'Bileşen aktiftir.';
$CIDRAM['lang']['state_component_is_inactive'] = 'Bileşen etkin değil.';
$CIDRAM['lang']['state_component_is_provisional'] = 'Bileşen geçicidir.';
$CIDRAM['lang']['state_default_password'] = 'Uyarı: Varsayılan şifreyi kullanıyor!';
$CIDRAM['lang']['state_loadtime'] = 'Sayfa isteği <span class="txtRd">%s</span> saniye içinde tamamlandı.';
$CIDRAM['lang']['state_logged_in'] = 'Giriş yapıldı.';
$CIDRAM['lang']['state_logs_access_only'] = 'Sadece girişleri kaydeder';
$CIDRAM['lang']['state_maintenance_mode'] = 'Uyarı: Bakım modu etkin!';
$CIDRAM['lang']['state_password_not_valid'] = 'Uyarı: Bu hesap geçerli bir şifre kullanmıyor!';
$CIDRAM['lang']['state_risk_high'] = 'Yüksek';
$CIDRAM['lang']['state_risk_low'] = 'Düşük';
$CIDRAM['lang']['state_risk_medium'] = 'Orta';
$CIDRAM['lang']['state_tracking'] = 'Şu anda %s IP izleme.';
$CIDRAM['lang']['switch-hide-non-outdated-set-false'] = 'Eskimiş olmayanları gizleme';
$CIDRAM['lang']['switch-hide-non-outdated-set-true'] = 'Eskimiş olmayanları gizle';
$CIDRAM['lang']['switch-hide-unused-set-false'] = 'Kullanılmayanları gizleme';
$CIDRAM['lang']['switch-hide-unused-set-true'] = 'Kullanılmayanları gizle';
$CIDRAM['lang']['switch-tracking-blocked-already-set-false'] = 'İmza dosyalarına karşı kontrol etmeyin';
$CIDRAM['lang']['switch-tracking-blocked-already-set-true'] = 'İmza dosyalarına karşı kontrol edin';
$CIDRAM['lang']['switch-tracking-hide-banned-blocked-set-false'] = 'Yasaklanmış/engellenen IP\'leri gizleme';
$CIDRAM['lang']['switch-tracking-hide-banned-blocked-set-true'] = 'Yasaklanmış/engellenen IP\'leri gizle';
$CIDRAM['lang']['tip_accounts'] = 'Merhaba, {username}.<br />Hesaplar sayfası, CIDRAM ön ucuna kimin erişebileceğini kontrol etmenizi mümkün kılar.';
$CIDRAM['lang']['tip_cidr_calc'] = 'Merhaba, {username}.<br />CIDR hesaplayıcısı, bir IP adresinin faktörünün hangi CIDR\'lerin olduğunu hesaplamanızı mümkün kılar.';
$CIDRAM['lang']['tip_config'] = 'Merhaba, {username}.<br />Yapılandırma sayfası, CIDRAM için yapılandırmayı ön uçtan değiştirmenizi mümkün kılar.';
$CIDRAM['lang']['tip_donate'] = 'CIDRAM ücretsiz olarak sunulmaktadır, ancak projeye bağış yapmak isterseniz, bağış düğmesini tıklayarak bunu yapabilirsiniz.';
$CIDRAM['lang']['tip_enter_ips_here'] = 'IP\'leri buraya girin.';
$CIDRAM['lang']['tip_enter_ip_here'] = 'IP\'yi buraya girin.';
$CIDRAM['lang']['tip_file_manager'] = 'Merhaba, {username}.<br />Dosya yöneticisi dosyalarınızı silmenizi, düzenlemenizi, yüklemenizi ve indirmenizi sağlar. Dikkatli kullanın (kurulumunuzu bununla bozabilirsiniz).';
$CIDRAM['lang']['tip_home'] = 'Merhaba, {username}.<br />Bu, CIDRAM ön uçunun ana sayfasıdır. Devam etmek için soldaki gezinme menüsünden bir bağlantı seçin.';
$CIDRAM['lang']['tip_ip_aggregator'] = 'Merhaba, {username}.<br />IP toplayıcı IP\'leri ve CIDR\'leri olabildiğince az şekilde ifade etmenizi sağlar. Birleştirilecek verileri girin ve "Tamam" düğmesine basın.';
$CIDRAM['lang']['tip_ip_test'] = 'Merhaba, {username}.<br />IP test sayfası, şu anda yüklü olan imzalarla IP adreslerinin engellenip engellenmediğini test etmenizi sağlar.';
$CIDRAM['lang']['tip_ip_tracking'] = 'Merhaba, {username}.<br />IP izleme sayfası, IP adreslerinin izleme durumunu kontrol etmenizi, hangilerinin yasak olduğunu kontrol etmenizi ve isterseniz bunların yasaklanmasını/izlemensini kaldırmanızı kontrol etmenizi sağlar.';
$CIDRAM['lang']['tip_login'] = 'Varsayılan kullanıcı adı: <span class="txtRd">admin</span> – Varsayılan şifre: <span class="txtRd">password</span>';
$CIDRAM['lang']['tip_logs'] = 'Merhaba, {username}.<br />Bu günlük dosyasının içeriğini görüntülemek için aşağıdaki listeden bir günlük dosyası seçin.';
$CIDRAM['lang']['tip_see_the_documentation'] = 'Çeşitli yapılandırma yönergeleri ve amaçlarıyla ilgili bilgi için <a href="https://github.com/CIDRAM/CIDRAM/blob/master/_docs/readme.en.md#SECTION6">belgelere</a> bakın.';
$CIDRAM['lang']['tip_statistics'] = 'Merhaba, {username}.<br />Bu sayfada, CIDRAM kurulumunuzla ilgili bazı temel kullanım istatistikleri gösterilmektedir.';
$CIDRAM['lang']['tip_statistics_disabled'] = 'Not: İstatistik izleme şu anda devre dışı, ancak yapılandırma sayfası aracılığıyla etkinleştirilebilir.';
$CIDRAM['lang']['tip_updates'] = 'Merhaba, {username}.<br />Güncellemeler sayfası, CIDRAM\'ın çeşitli bileşenlerini (çekirdek paket, imzalar, L10N dosyaları vb.) yüklemenizi, kaldırmanızı ve güncellemenizi sağlar.';
$CIDRAM['lang']['title_accounts'] = 'CIDRAM – Hesaplar';
$CIDRAM['lang']['title_cidr_calc'] = 'CIDRAM – CIDR Hesaplayıcı';
$CIDRAM['lang']['title_config'] = 'CIDRAM – Yapılandırma';
$CIDRAM['lang']['title_file_manager'] = 'CIDRAM – Dosya Yöneticisi';
$CIDRAM['lang']['title_home'] = 'CIDRAM – Ana Sayfa';
$CIDRAM['lang']['title_ip_aggregator'] = 'CIDRAM – IP Toplayıcı';
$CIDRAM['lang']['title_ip_test'] = 'CIDRAM – IP Testi';
$CIDRAM['lang']['title_ip_tracking'] = 'CIDRAM – IP İzleme';
$CIDRAM['lang']['title_login'] = 'CIDRAM – Giriş';
$CIDRAM['lang']['title_logs'] = 'CIDRAM – Kayıtlar';
$CIDRAM['lang']['title_statistics'] = 'CIDRAM – İstatistik';
$CIDRAM['lang']['title_updates'] = 'CIDRAM – Güncellemeler';
$CIDRAM['lang']['warning'] = 'Uyarılar:';
$CIDRAM['lang']['warning_php_1'] = 'PHP sürümünüz aktif olarak desteklenmiyor! Güncelleme önerilir!';
$CIDRAM['lang']['warning_php_2'] = 'PHP sürümünüz ağır savunmasız! Güncelleme önerilir!';
$CIDRAM['lang']['warning_signatures_1'] = 'Hiçbir imza dosyası aktif değil!';

$CIDRAM['lang']['info_some_useful_links'] = 'Bazı kullanışlı bağlantılar:<ul>
            <li><a href="https://github.com/CIDRAM/CIDRAM/issues">CIDRAM Sorunları @ GitHub</a> – CIDRAM için sorunlar sayfası (destek, yardım, vb.).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=61">CIDRAM @ Spambot Security</a> – CIDRAM için tartışma forumu (destek, yardım vb.).</li>
            <li><a href="https://wordpress.org/plugins/cidram/">CIDRAM @ WordPress.org</a> – CIDRAM için WordPress eklentisi.</li>
            <li><a href="https://sourceforge.net/projects/cidram/">CIDRAM @ SourceForge</a> – CIDRAM için alternatif karşıdan yükleme aynası.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Web sitelerini güvenli hale getirmek için basit web yöneticisi araçlarından oluşan bir koleksiyon.</li>
            <li><a href="https://macmathan.info/blocklists">MacMathan.info Aralık Blokları</a> – Herhangi bir istenmeyen ülkenin web sitenize erişmesini engellemek için CIDRAM\'a eklenebilen isteğe bağlı aralık blokları içerir.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">International PHP Group @ Facebook</a> – PHP öğrenme kaynakları ve tartışmalar.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP öğrenme kaynakları ve tartışmalar.</li>
            <li><a href="http://bgp.he.net/">Hurricane Electric BGP Toolkit</a> – ASN\'lerden CIDR\'ler alın, ASN ilişkilerini belirleyin, ağ adlarına dayalı ASN\'leri keşfedin.</li>
            <li><a href="https://www.stopforumspam.com/forum/">Forum @ Stop Forum Spam</a> – Forum spamını durdurmayla ilgili faydalı forum.</li>
            <li><a href="https://radar.qrator.net/">Radar by Qrator</a> – ASN\'lerin bağlantısını kontrol etmek için yararlı araç ve ASN\'ler hakkında çeşitli diğer bilgiler.</li>
            <li><a href="http://www.ipdeny.com/ipblocks/">IPdeny IP ülke blokları</a> – Ülke çapında imzalar üretmek için harika ve tam bir hizmet.</li>
            <li><a href="https://www.google.com/transparencyreport/safebrowsing/malware/">Google Malware Dashboard</a> – ASN\'ler için kötü amaçlı yazılım enfeksiyonu oranları ile ilgili raporları görüntüler.</li>
            <li><a href="https://www.spamhaus.org/statistics/botnet-asn/">Spamhaus Projesi</a> – ASN\'ler için botnet enfeksiyon oranları ile ilgili raporları görüntüler.</li>
            <li><a href="https://www.abuseat.org/public/asn.html">Abuseat.org\'un Kompozit Engelleme Listesi</a> – ASN\'ler için botnet enfeksiyon oranları ile ilgili raporları görüntüler.</li>
            <li><a href="https://abuseipdb.com/">AbuseIPDB</a> – Bilinen kötü amaçlı IP\'lerin veritabanını korur; IP\'leri denetlemek ve raporlamak için bir API sağlar.</li>
            <li><a href="https://www.megarbl.net/index.php">MegaRBL.net</a> – Bilinen spam göndericilerinin listelerini sağlar; IP/ASN spam etkinliklerini kontrol etmek için yararlıdır.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Güvenlik Açığı Tabloları</a> – Çeşitli paketler (PHP, HHVM, vb.) güvenli/güvensiz sürümlerini listeler.</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Uyumluluk Tabloları</a> – Çeşitli paketler (CIDRAM, phpMussel, vb.) için uyumluluk bilgilerini listeler.</li>
        </ul>';
