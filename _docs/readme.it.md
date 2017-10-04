## Documentazione per CIDRAM (Italiano).

### Contenuti
- 1. [PREAMBOLO](#SECTION1)
- 2. [COME INSTALLARE](#SECTION2)
- 3. [COME USARE](#SECTION3)
- 4. [GESTIONE FRONT-END](#SECTION4)
- 5. [FILE INCLUSI IN QUESTO PACCHETTO](#SECTION5)
- 6. [OPZIONI DI CONFIGURAZIONE](#SECTION6)
- 7. [FIRMA FORMATO](#SECTION7)
- 8. [DOMANDE FREQUENTI (FAQ)](#SECTION8)

*Nota per quanto riguarda le traduzioni: In caso di errori (per esempio, discrepanze tra le traduzioni, errori di battitura, ecc), la versione Inglese del README è considerata la versione originale e autorevole. Se trovate errori, il vostro aiuto a correggerli sarebbe il benvenuto.*

---


### 1. <a name="SECTION1"></a>PREAMBOLO

CIDRAM (Classless Inter-Domain Routing Access Manager) è uno script PHP progettato per proteggere i siti web bloccando le richieste provenienti da indirizzi IP considerati come fonti di traffico indesiderato, includendo (ma non limitato a) il traffico proveniente da punti d'accesso non umani, servizi cloud, spambots, scrapers, ecc. Questo è possibile calcolando i possibili CIDR degli indirizzi IP forniti da richieste in entrata e poi confrontando questi possibili CIDR contro i suoi file di firme (queste file di firme contengono liste di CIDR di indirizzi IP considerati come fonti di traffico indesiderato); Se vengono trovati riscontri, le richieste sono bloccate.

*(Vedere: [Che cos'è un "CIDR"?](#WHAT_IS_A_CIDR)).*

CIDRAM COPYRIGHT 2016 e oltre GNU/GPLv2 Caleb M (Maikuolan).

Questo script è un software "libero"; è possibile ridistribuirlo e/o modificarlo sotto i termini della GNU General Public License come pubblicato dalla Free Software Foundation; o la versione 2 della licenza, o (a propria scelta) una versione successiva. Questo script è distribuito nella speranza che possa essere utile, ma SENZA ALCUNA GARANZIA; senza neppure la implicita garanzia di COMMERCIABILITÀ o IDONEITÀ PER UN PARTICOLARE SCOPO. Vedere la GNU General Public License per ulteriori dettagli, situato nella `LICENSE.txt` file e disponibili anche da:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Questo documento ed il pacchetto associato ad esso possono essere scaricati liberamente da [GitHub](https://cidram.github.io/).

---


### 2. <a name="SECTION2"></a>COME INSTALLARE

#### 2.0 INSTALLAZIONE MANUALE

1) Continuando la lettura, si suppone che hai già scaricato una copia dello script, decompresso il contenuto e lo hai collocato da qualche parte sul tuo terminale. Da qui, ti consigliamo di determinare dove sulla macchina o CMS si desidera inserire quei contenuti. Una cartella come `/public_html/cidram/` o simile (sebbene, non è importante quale si sceglie, purché sia qualcosa di sicuro e che ti soddisfi) sarà sufficiente. *Prima di iniziare il caricamento, continua a leggere..*

2) Rinomina `config.ini.RenameMe` in `config.ini` (situato nella cartella `vault`), e facoltativamente (fortemente consigliata per gli utenti avanzati, ma non è consigliata per i principianti o per gli inesperti) aprirlo e impostare le opzioni come meglio si crede, in qualsiasi modo risulti appropriato per la vostra particolare configurazione (questo file contiene tutte le direttive disponibili per CIDRAM; sopra ogni opzione dovrebbe esserci un breve commento di documentazione che descrive ciò che fa e ciò a cui serve). Salvare il file, chiudere.

3) Carica i contenuti (CIDRAM e i suoi file) nella cartella che avete scelto in precedenza (non è necessario includere i file `*.txt`/`*.md`, ma in generale, si dovrebbe caricare tutto).

4) Impostate i permessi (CHMOD) della cartella `vault` a "755" (se ci sono problemi si può provare "777", ma questo è meno sicuro). La cartella principale che comprende i contenuti (quella scelta in precedenza), solitamente, può essere lasciato solo, ma lo stato CHMOD dovrebbe essere controllato se hai avuto problemi di autorizzazioni in passato sul vostro sistema (di default, dovrebbe essere qualcosa simile a "755").

5) Successivamente, sarà necessario "collegare" CIDRAM al vostro sistema o CMS. Ci sono diversi modi in cui è possibile collegare script come CIDRAM al vostro sistema o CMS, ma il più semplice è di inserire lo script all'inizio di un file del vostro sistema o CMS (quello che generalmente sarà caricato ogni volta che qualcuno accede a una pagina attraverso il vostro sito) utilizzando un comando `require` o `include`. Solitamente, questo file è memorizzato in una cartella, ad esempio `/includes`, `/assets` o `/functions`, e spesso può essere chiamato come `init.php`, `common_functions.php`, `functions.php` o simili. Scegliete accuratamente questo file tra quelli che compongono il vostro sistema o CMS; nel caso in cui trovate difficoltà nel determinare questo file, visitate la pagina di problemi/issues di CIDRAM per ricevere assistenza. Per fare ciò [utilizzare `require` o `include`], inserire la seguente riga di codice in cima al core file identificato in precedenza, sostituendo la stringa contenuta all'interno delle virgolette con l'indirizzo esatto del file `loader.php` (l'indirizzo locale, non l'indirizzo HTTP; sarà simile all'indirizzo citato in precedenza).

`<?php require '/user_name/public_html/cidram/loader.php'; ?>`

Salvare il file, chiudere, caricare di nuovo.

-- IN ALTERNATIVA --

Se stai usando un web server Apache e se si ha accesso al file `php.ini`, è possibile utilizzare la direttiva `auto_prepend_file` per pre-caricare CIDRAM ogni volta che viene effettuata una qualsiasi richiesta PHP. Qualcosa come:

`auto_prepend_file = "/user_name/public_html/cidram/loader.php"`

O questo nel `.htaccess` file:

`php_value auto_prepend_file "/user_name/public_html/cidram/loader.php"`

6) Questo è tutto! :-)

#### 2.1 INSTALLARE CON COMPOSER

[CIDRAM è registrata con Packagist](https://packagist.org/packages/cidram/cidram), e così, se si ha familiarità con Composer, è possibile utilizzare Composer per l'installazione di CIDRAM (è comunque necessario intervenire sul file di configurazione e includere `loader.php`; vedere "Installazione manuale" passi 2 e 5).

`composer require cidram/cidram`

#### 2.2 INSTALLARE PER WORDPRESS

Se si desidera utilizzare CIDRAM con WordPress, è possibile ignorare tutte le istruzioni di cui sopra. [CIDRAM è registrato come un plugin con il database dei plugin di WordPress](https://wordpress.org/plugins/cidram/), ed è possibile installare CIDRAM direttamente dalla pagina dei Plugin. È possibile installarlo nello stesso modo di qualsiasi altro plugin, e non sono necessari altri interventi. Proprio come con gli altri metodi di installazione, è possibile personalizzare l'installazione modificando il contenuto del file `config.ini` o utilizzando la pagina di configurazione del front-end. Se si attiva il front-end per CIDRAM e si aggiorna CIDRAM utilizzando la pagina degli aggiornamenti, questo si sincronizza automaticamente con le informazioni sulla versione del plugin visualizzate nella pagina dei plugin.

*Avvertimento: L'aggiornamento di CIDRAM tramite il dashboard dei plugin provoca un'installazione pulita! Se hai personalizzato l'installazione (cambiato la tua configurazione, installati i moduli, ecc), queste personalizzazioni verranno perse quando si aggiorna tramite la pagina dei plugin! I file di registro verranno persi anche quando vengono aggiornati tramite la pagina dei plugin! Per preservare i file di registro e le personalizzazioni, aggiorna tramite la pagina di aggiornamenti del front-end per CIDRAM.*

---


### 3. <a name="SECTION3"></a>COME USARE

CIDRAM dovrebbe bloccare automaticamente le richieste indesiderate al suo sito senza richiedere alcuna assistenza manuale, a parte la sua installazione iniziale.

L'aggiornamento avviene manualmente, ed è possibile personalizzare la sua configurazione e quali CIDR devono essere bloccati,  modificando il vostro file di configurazione e/o file di firme.

Se si incontrano dei falsi positivi, per favore, contattatemi e fatemelo sapere. *(Vedere: [Che cosa è un "falso positivo"?](#WHAT_IS_A_FALSE_POSITIVE)).*

---


### 4. <a name="SECTION4"></a>GESTIONE FRONT-END

#### 4.0 QUAL È IL FRONT-END.

Il front-end fornisce un modo conveniente e facile da mantenere, gestire e aggiornare l'installazione CIDRAM. È possibile visualizzare, condividere e scaricare file di log attraverso la pagina di log, è possibile modificare la configurazione attraverso la pagina di configurazione, è possibile installare e disinstallare i componenti attraverso la pagina degli aggiornamenti, e si può caricare, scaricare e modificare i file nel vault tramite il file manager.

Il front-end è disabilitato per impostazione predefinita al fine di prevenire l'accesso non autorizzato (l'accesso non autorizzato potrebbe avere conseguenze significative per il vostro sito e la sua sicurezza). Istruzioni per l'abilitazione si sono compresi sotto di questo paragrafo.

#### 4.1 COME ATTIVARE IL FRONT-END.

1) Trova la direttiva `disable_frontend` dentro `config.ini`, e impostarlo su `false` (sarà `true` per impostazione predefinita).

2) Accedi `loader.php` dal browser (per esempio, `http://localhost/cidram/loader.php`).

3) Accedi con il nome utente e la password predefinita (admin/password).

Nota: Dopo aver effettuato l'accesso per la prima volta, al fine di impedire l'accesso non autorizzato al front-end, si dovrebbe cambiare immediatamente il nome utente e la password! Questo è molto importante, perché è possibile caricare codice PHP arbitrario al suo sito web attraverso il front-end.

#### 4.2 COME UTILIZZARE IL FRONT-END.

Le istruzioni sono fornite su ciascuna pagina del front-end, per spiegare il modo corretto di usarlo e la sua destinazione. Se avete bisogno di ulteriori spiegazioni o qualsiasi assistenza speciale, si prega di contattare il supporto. In alternativa, ci sono alcuni video disponibili su YouTube, che potrebbero aiutare per mezzo di dimostrazione.


---


### 5. <a name="SECTION5"></a>FILE INCLUSI IN QUESTO PACCHETTO

Il seguente è un elenco di tutti i file che dovrebbero essere incluso nella archiviato copia di questo script quando si scaricalo, qualsiasi di file che potrebbero potenzialmente essere creato come risultato della vostra utilizzando questo script, insieme con una breve descrizione di ciò che tutti questi file sono per.

File | Descrizione
----|----
/_docs/ | Documentazione cartella (contiene vari file).
/_docs/readme.ar.md | Documentazione Arabo.
/_docs/readme.de.md | Documentazione Tedesco.
/_docs/readme.en.md | Documentazione Inglese.
/_docs/readme.es.md | Documentazione Spagnolo.
/_docs/readme.fr.md | Documentazione Francese.
/_docs/readme.id.md | Documentazione Indonesiano.
/_docs/readme.it.md | Documentazione Italiano.
/_docs/readme.ja.md | Documentazione Giapponese.
/_docs/readme.ko.md | Documentazione Coreana.
/_docs/readme.nl.md | Documentazione Olandese.
/_docs/readme.pt.md | Documentazione Portoghese.
/_docs/readme.ru.md | Documentazione Russo.
/_docs/readme.ur.md | Documentazione Urdu.
/_docs/readme.vi.md | Documentazione Vietnamita.
/_docs/readme.zh-TW.md | Documentazione Cinese (tradizionale).
/_docs/readme.zh.md | Documentazione Cinese (semplificato).
/vault/ | La vault cartella (contiene vari file).
/vault/fe_assets/ | Dati front-end.
/vault/fe_assets/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/fe_assets/_accounts.html | Un modello HTML per il front-end pagina utenti.
/vault/fe_assets/_accounts_row.html | Un modello HTML per il front-end pagina utenti.
/vault/fe_assets/_cidr_calc.html | Un modello HTML per la calcolatrice CIDR.
/vault/fe_assets/_cidr_calc_row.html | Un modello HTML per la calcolatrice CIDR.
/vault/fe_assets/_config.html | Un modello HTML per il front-end pagina di configurazione.
/vault/fe_assets/_config_row.html | Un modello HTML per il front-end pagina di configurazione.
/vault/fe_assets/_files.html | Un modello HTML per il file manager.
/vault/fe_assets/_files_edit.html | Un modello HTML per il file manager.
/vault/fe_assets/_files_rename.html | Un modello HTML per il file manager.
/vault/fe_assets/_files_row.html | Un modello HTML per il file manager.
/vault/fe_assets/_home.html | Un modello HTML per il front-end pagina principale.
/vault/fe_assets/_ip_aggregator.html | Un modello HTML per l'aggregatore IP.
/vault/fe_assets/_ip_test.html | Un modello HTML per la pagina per il test IP.
/vault/fe_assets/_ip_test_row.html | Un modello HTML per la pagina per il test IP.
/vault/fe_assets/_ip_tracking.html | Un modello HTML per la pagina di monitoraggio IP.
/vault/fe_assets/_ip_tracking_row.html | Un modello HTML per la pagina di monitoraggio IP.
/vault/fe_assets/_login.html | Un modello HTML per il front-end pagina di accedi.
/vault/fe_assets/_logs.html | Un modello HTML per il front-end pagina per i file di log.
/vault/fe_assets/_nav_complete_access.html | Un modello HTML per i link di navigazione del front-end, per quelli con accesso completo.
/vault/fe_assets/_nav_logs_access_only.html | Un modello HTML per i link di navigazione del front-end, per quelli con accesso solo per i log.
/vault/fe_assets/_updates.html | Un modello HTML per il front-end pagina degli aggiornamenti.
/vault/fe_assets/_updates_row.html | Un modello HTML per il front-end pagina degli aggiornamenti.
/vault/fe_assets/frontend.css | Foglio di stile CSS per il front-end.
/vault/fe_assets/frontend.dat | Database per il front-end (contiene informazioni utenti, informazioni sessioni, e la cache; generato solo se il front-end è attivata e utilizzata).
/vault/fe_assets/frontend.html | Il file modello HTML principale per il front-end.
/vault/fe_assets/icons.php | Gestore dell'icone (utilizzata dal file manager del front-end).
/vault/fe_assets/pips.php | Gestore delle pips (utilizzata dal file manager del front-end).
/vault/lang/ | Contiene dati linguistici.
/vault/lang/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/lang/lang.ar.cli.php | Dati linguistici Araba per CLI.
/vault/lang/lang.ar.fe.php | Dati linguistici Araba per il front-end.
/vault/lang/lang.ar.php | Dati linguistici Araba.
/vault/lang/lang.bn.cli.php | Dati linguistici Bengalese per CLI.
/vault/lang/lang.bn.fe.php | Dati linguistici Bengalese per il front-end.
/vault/lang/lang.bn.php | Dati linguistici Bengalese.
/vault/lang/lang.de.cli.php | Dati linguistici Tedesca per CLI.
/vault/lang/lang.de.fe.php | Dati linguistici Tedesca per il front-end.
/vault/lang/lang.de.php | Dati linguistici Tedesca.
/vault/lang/lang.en.cli.php | Dati linguistici Inglese per CLI.
/vault/lang/lang.en.fe.php | Dati linguistici Inglese per il front-end.
/vault/lang/lang.en.php | Dati linguistici Inglese.
/vault/lang/lang.es.cli.php | Dati linguistici Spagnola per CLI.
/vault/lang/lang.es.fe.php | Dati linguistici Spagnola per il front-end.
/vault/lang/lang.es.php | Dati linguistici Spagnola.
/vault/lang/lang.fr.cli.php | Dati linguistici Francese per CLI.
/vault/lang/lang.fr.fe.php | Dati linguistici Francese per il front-end.
/vault/lang/lang.fr.php | Dati linguistici Francese.
/vault/lang/lang.hi.cli.php | Dati linguistici Hindi per CLI.
/vault/lang/lang.hi.fe.php | Dati linguistici Hindi per il front-end.
/vault/lang/lang.hi.php | Dati linguistici Hindi.
/vault/lang/lang.id.cli.php | Dati linguistici Indonesiana per CLI.
/vault/lang/lang.id.fe.php | Dati linguistici Indonesiana per il front-end.
/vault/lang/lang.id.php | Dati linguistici Indonesiana.
/vault/lang/lang.it.cli.php | Dati linguistici Italiana per CLI.
/vault/lang/lang.it.fe.php | Dati linguistici Italiana per il front-end.
/vault/lang/lang.it.php | Dati linguistici Italiana.
/vault/lang/lang.ja.cli.php | Dati linguistici Giapponese per CLI.
/vault/lang/lang.ja.fe.php | Dati linguistici Giapponese per il front-end.
/vault/lang/lang.ja.php | Dati linguistici Giapponese.
/vault/lang/lang.ko.cli.php | Dati linguistici Coreana per CLI.
/vault/lang/lang.ko.fe.php | Dati linguistici Coreana per il front-end.
/vault/lang/lang.ko.php | Dati linguistici Coreana.
/vault/lang/lang.nl.cli.php | Dati linguistici Olandese per CLI.
/vault/lang/lang.nl.fe.php | Dati linguistici Olandese per il front-end.
/vault/lang/lang.nl.php | Dati linguistici Olandese.
/vault/lang/lang.pt.cli.php | Dati linguistici Portoghese per CLI.
/vault/lang/lang.pt.fe.php | Dati linguistici Portoghese per il front-end.
/vault/lang/lang.pt.php | Dati linguistici Portoghese.
/vault/lang/lang.ru.cli.php | Dati linguistici Russa per CLI.
/vault/lang/lang.ru.fe.php | Dati linguistici Russa per il front-end.
/vault/lang/lang.ru.php | Dati linguistici Russa.
/vault/lang/lang.th.cli.php | Dati linguistici Tailandese per CLI.
/vault/lang/lang.th.fe.php | Dati linguistici Tailandese per il front-end.
/vault/lang/lang.th.php | Dati linguistici Tailandese.
/vault/lang/lang.tr.cli.php | Dati linguistici Turco per CLI.
/vault/lang/lang.tr.fe.php | Dati linguistici Turco per il front-end.
/vault/lang/lang.tr.php | Dati linguistici Turco.
/vault/lang/lang.ur.cli.php | Dati linguistici Urdu per CLI.
/vault/lang/lang.ur.fe.php | Dati linguistici Urdu per il front-end.
/vault/lang/lang.ur.php | Dati linguistici Urdu.
/vault/lang/lang.vi.cli.php | Dati linguistici Vietnamita per CLI.
/vault/lang/lang.vi.fe.php | Dati linguistici Vietnamita per il front-end.
/vault/lang/lang.vi.php | Dati linguistici Vietnamita.
/vault/lang/lang.zh-tw.cli.php | Dati linguistici Cinese (tradizionale) per CLI.
/vault/lang/lang.zh-tw.fe.php | Dati linguistici Cinese (tradizionale) per il front-end.
/vault/lang/lang.zh-tw.php | Dati linguistici Cinese (tradizionale).
/vault/lang/lang.zh.cli.php | Dati linguistici Cinese (semplificata) per CLI.
/vault/lang/lang.zh.fe.php | Dati linguistici Cinese (semplificata) per il front-end.
/vault/lang/lang.zh.php | Dati linguistici Cinese (semplificata).
/vault/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/.travis.php | Utilizzato da Travis CI per il test (non richiesto per il corretto funzionamento dello script).
/vault/.travis.yml | Utilizzato da Travis CI per il test (non richiesto per il corretto funzionamento dello script).
/vault/aggregator.php | Aggregatore IP.
/vault/cache.dat | Cache data.
/vault/cidramblocklists.dat | Contiene informazioni relative alle liste opzionali per il bloccando di paesi forniti da Macmathan; Utilizzato dalla funzionalità aggiornamenti forniti dal front-end.
/vault/cli.php | Gestore di CLI.
/vault/components.dat | Contiene informazioni relative ai vari componenti di CIDRAM; Utilizzato dalla funzionalità aggiornamenti forniti dal front-end.
/vault/config.ini.RenameMe | File di configurazione; Contiene tutte l'opzioni di configurazione per CIDRAM, dicendogli cosa fare e come operare correttamente (rinomina per attivare).
/vault/config.php | Gestore di configurazione.
/vault/config.yaml | File di valori predefiniti per la configurazione; Contiene valori predefiniti per la configurazione di CIDRAM.
/vault/frontend.php | Gestore del front-end.
/vault/functions.php | File di funzioni.
/vault/hashes.dat | Contiene una lista di hash accettati (pertinente alla funzione di reCAPTCHA; solo generato se la funzione di reCAPTCHA è abilitato).
/vault/ignore.dat | File ignorati (utilizzato per specificare quali sezioni firma CIDRAM dovrebbe ignorare).
/vault/ipbypass.dat | Contiene un elenco di bypass IP (pertinente alla funzione di reCAPTCHA; solo generato se la funzione di reCAPTCHA è abilitato).
/vault/ipv4.dat | File di firme per IPv4 (servizi cloud indesiderate e punti finali non umani).
/vault/ipv4_bogons.dat | File di firme per IPv4 (bogon/marziano CIDRs).
/vault/ipv4_custom.dat.RenameMe | File di firme per IPv4 personalizzato (rinomina per attivare).
/vault/ipv4_isps.dat | File di firme per IPv4 (ISP pericolosi e spam incline).
/vault/ipv4_other.dat | File di firme per IPv4 (CIDRs per i proxy, VPN e altri vari servizi indesiderati).
/vault/ipv6.dat | File di firme per IPv6 (servizi cloud indesiderate e punti finali non umani).
/vault/ipv6_bogons.dat | File di firme per IPv6 (bogon/marziano CIDRs).
/vault/ipv6_custom.dat.RenameMe | File di firme per IPv6 personalizzato (rinomina per attivare).
/vault/ipv6_isps.dat | File di firme per IPv6 (ISP pericolosi e spam incline).
/vault/ipv6_other.dat | File di firme per IPv6 (CIDRs per i proxy, VPN e altri vari servizi indesiderati).
/vault/lang.php | Dati linguistici.
/vault/modules.dat | Contiene informazioni relative ai vari moduli per CIDRAM; Utilizzato dalla funzionalità aggiornamenti forniti dal front-end.
/vault/outgen.php | Generatore di output.
/vault/php5.4.x.php | Polyfills per PHP 5.4.X (necessaria per la retrocompatibilità di PHP 5.4.X; è sicuro di cancellare per le versioni più recenti di PHP).
/vault/recaptcha.php | Modulo reCAPTCHA.
/vault/rules_as6939.php | File di regole personalizzate per AS6939.
/vault/rules_softlayer.php | File di regole personalizzate per Soft Layer.
/vault/rules_specific.php | File di regole personalizzate per alcune CIDR specifiche.
/vault/salt.dat | File di salt (usato da alcune funzionalità periferica; solo generato se richiesto).
/vault/template_custom.html | File di modello; Modello per l'output HTML prodotto dal generatore di output per CIDRAM.
/vault/template_default.html | File di modello; Modello per l'output HTML prodotto dal generatore di output per CIDRAM.
/vault/themes.dat | File di temi; Utilizzato dalla funzionalità aggiornamenti forniti dal front-end.
/.gitattributes | Un file del GitHub progetto (non richiesto per il corretto funzionamento dello script).
/Changelog.txt | Un record delle modifiche apportate allo script tra diverse versioni (non richiesto per il corretto funzionamento dello script).
/composer.json | Composer/Packagist informazioni (non richiesto per il corretto funzionamento dello script).
/CONTRIBUTING.md | Informazioni su come contribuire al progetto.
/LICENSE.txt | Una copia della GNU/GPLv2 licenza (non richiesto per il corretto funzionamento dello script).
/loader.php | Caricatore/Loader. Questo è il file si collegare alla vostra sistema (essenziale)!
/README.md | Informazioni di riepilogo del progetto.
/web.config | Un ASP.NET file di configurazione (in questo caso, a proteggere la `/vault` cartella da l'acceso di non autorizzate origini nel caso che lo script è installato su un server basata su ASP.NET tecnologie).

---


### 6. <a name="SECTION6"></a>OPZIONI DI CONFIGURAZIONE
Il seguente è un elenco di variabili trovate nelle `config.ini` file di configurazione di CIDRAM, insieme con una descrizione del loro scopo e funzione.

#### "general" (Categoria)
Generale configurazione per CIDRAM.

"logfile"
- Un file leggibile dagli umani per la registrazione di tutti i tentativi di accesso bloccati. Specificare un nome di file, o lasciare vuoto per disabilitare.

"logfileApache"
- Un file nello stile di apache per la registrazione di tutti i tentativi di accesso bloccati. Specificare un nome di file, o lasciare vuoto per disabilitare.

"logfileSerialized"
- Un file serializzato per la registrazione di tutti i tentativi di accesso bloccati. Specificare un nome di file, o lasciare vuoto per disabilitare.

*Consiglio utile: Se vuoi, è possibile aggiungere data/ora informazioni per i nomi dei file per la registrazione par includendo queste nel nome: `{yyyy}` per l'anno completo, `{yy}` per l'anno abbreviato, `{mm}` per mese, `{dd}` per giorno, `{hh}` per ora.*

*Esempi:*
- *`logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- Troncare i file di log quando raggiungono una determinata dimensione? Il valore è la dimensione massima in B/KB/MB/GB/TB che un file di log può crescere prima di essere troncato. Il valore predefinito di 0KB disattiva il troncamento (i file di log possono crescere indefinitamente). Nota: Si applica ai singoli file di log! La dimensione dei file di log non viene considerata collettivamente.

"timeOffset"
- Se il tempo del server non corrisponde l'ora locale, è possibile specificare un offset qui per regolare le informazioni di data/tempo generato da CIDRAM in base alle proprie esigenze. È generalmente raccomandato invece, regolare à la direttiva fuso orario nel file `php.ini`, ma a volte (come ad esempio quando si lavora con i fornitori di hosting condiviso limitati) questo non è sempre possibile fare, e così, questa opzione è fornito qui. Offset è in minuti.
- Esempio (per aggiungere un'ora): `timeOffset=60`

"timeFormat"
- Il formato della data/ora di notazione usata da CIDRAM. Predefinito = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- Dove trovare l'indirizzo IP di collegamento richiesta? (Utile per servizi come Cloudflare e simili). Predefinito = REMOTE_ADDR. AVVISO: Non modificare questa se non sai quello che stai facendo!

"forbid_on_block"
- Quale intestazioni dovrebbe CIDRAM rispondere con quando bloccano le richieste? False/200 = 200 OK [Predefinito]; True/403 = 403 Forbidden (Proibito); 503 = 503 Service unavailable (Servizio non disponibile).

"silent_mode"
- CIDRAM dovrebbe reindirizzare silenziosamente tutti i tentativi di accesso bloccati invece di visualizzare la pagina "Accesso Negato"? Se si, specificare la localizzazione di reindirizzare i tentativi di accesso bloccati. Se no, lasciare questo variabile vuoto.

"lang"
- Specifica la lingua predefinita per CIDRAM.

"numbers"
- Specifica come visualizzare i numeri.

"emailaddr"
- Se si desidera, è possibile fornire un indirizzo email qui a dare utenti quando sono bloccati, per loro di utilizzare come punto di contatto per supporto e/o assistenza per il caso di che vengano bloccate per errore. AVVERTIMENTO: Qualunque sia l'indirizzo email si fornisce qui sarà certamente acquisito dal spambots e raschietti/scrapers nel corso del suo essere usato qui, e così, è fortemente raccomandato che se si sceglie di fornire un indirizzo email qui, che si assicurare che l'indirizzo email si fornisce qui è un indirizzo monouso e/o un indirizzo che si non ti dispiace essere spammato (in altre parole, probabilmente si non vuole usare il personale primaria o commerciale primaria indirizzi email).

"emailaddr_display_style"
- Come preferisci che l'indirizzo email venga presentato agli utenti? "default" = Link cliccabile. "noclick" = Testo non cliccabile.

"disable_cli"
- Disabilita CLI? Modalità CLI è abilitato per predefinito, ma a volte può interferire con alcuni strumenti di test (come PHPUnit, per esempio) e altre applicazioni basate su CLI. Se non è necessario disattivare la modalità CLI, si dovrebbe ignorare questa direttiva. False = Abilita CLI [Predefinito]; True = Disabilita CLI.

"disable_frontend"
- Disabilita l'accesso front-end? L'accesso front-end può rendere CIDRAM più gestibile, ma può anche essere un potenziale rischio per la sicurezza. Si consiglia di gestire CIDRAM attraverso il back-end, quando possibile, ma l'accesso front-end è previsto per quando non è possibile. Mantenerlo disabilitato tranne se hai bisogno. False = Abilita l'accesso front-end; True = Disabilita l'accesso front-end [Predefinito].

"max_login_attempts"
- Numero massimo di tentativi di accesso (front-end). Predefinito = 5.

"FrontEndLog"
- File per la registrazione di l'accesso front-end tentativi di accesso. Specificare un nome di file, o lasciare vuoto per disabilitare.

"ban_override"
- Sostituire "forbid_on_block" quando "infraction_limit" è superato? Quando si sostituisce: Richieste bloccate restituire una pagina vuota (file di modello non vengono utilizzati). 200 = Non sostituire [Predefinito]; 403 = Sostituire con "403 Forbidden"; 503 = Sostituire con "503 Service unavailable".

"log_banned_ips"
- Includi richieste bloccate da IP vietati nei file di log? True = Sì [Predefinito]; False = No.

"default_dns"
- Un elenco delimitato con virgole di server DNS da utilizzare per le ricerche dei nomi di host. Predefinito = "8.8.8.8,8.8.4.4" (Google DNS). AVVISO: Non modificare questa se non sai quello che stai facendo!

"search_engine_verification"
- Tentativo di verificare le richieste dai motori di ricerca? Verifica motori di ricerca assicura che non saranno vietate a seguito del superamento del limite infrazione (vieta dei motori di ricerca dal vostro sito web di solito hanno un effetto negativo sul vostro posizionamento sui motori di ricerca, SEO, ecc). Quando verificato, i motori di ricerca possono essere bloccati come al solito, ma non saranno vietate. Quando non verificato, è possibile per loro di essere vietate a seguito del superamento del limite infrazione. Inoltre, verifica dei motori di ricerca fornisce una protezione contro le richieste dei motori di ricerca falso e contro le entità potenzialmente dannosi mascherato da motori di ricerca (tali richieste verranno bloccate quando la verifica dei motori di ricerca è attivato). True = Attiva la verifica dei motori di ricerca [Predefinito]; False = Disattiva la verifica dei motori di ricerca.

"protect_frontend"
- Specifica se le protezioni normalmente fornite da CIDRAM devono essere applicati al front-end. True = Sì [Predefinito]; False = No.

"disable_webfonts"
- Disabilita webfonts? True = Sì; False = No [Predefinito].

"maintenance_mode"
- Abilita la modalità di manutenzione? True = Sì; False = No [Predefinito]. Disattiva tutto tranne il front-end. A volte utile per l'aggiornamento del CMS, dei framework, ecc.

"default_algo"
- Definisce quale algoritmo da utilizzare per tutte le password e le sessioni in futuro. Opzioni: PASSWORD_DEFAULT (predefinito), PASSWORD_BCRYPT, PASSWORD_ARGON2I (richiede PHP >= 7.2.0).

"statistics"
- Monitorare le statistiche di utilizzo di CIDRAM? True = Sì; False = No [Predefinito].

#### "signatures" (Categoria)
Configurazione per firme.

"ipv4"
- Un elenco dei file di firma IPv4 che CIDRAM dovrebbe tentare di utilizzare, delimitati da virgole. È possibile aggiungere voci qui se si desidera includere ulteriori file di firma IPv4 per CIDRAM.

"ipv6"
- Un elenco dei file di firma IPv6 che CIDRAM dovrebbe tentare di utilizzare, delimitati da virgole. È possibile aggiungere voci qui se si desidera includere ulteriori file di firma IPv6 per CIDRAM.

"block_cloud"
- Bloccare CIDRs identificato come appartenente alla servizi webhosting/cloud? Se si utilizza un servizio di API dal suo sito o se si aspetta altri siti a collegare al suo sito, questa direttiva deve essere impostata su false. Se non, questa direttiva deve essere impostata su true.

"block_bogons"
- Bloccare bogone/marziano CIDRs? Se aspetta i collegamenti al suo sito dall'interno della rete locale, da localhost, o dalla LAN, questa direttiva deve essere impostata su false. Se si non aspetta queste tali connessioni, questa direttiva deve essere impostata su true.

"block_generic"
- Bloccare CIDRs generalmente consigliato per la lista nera? Questo copre qualsiasi firme che non sono contrassegnate come parte del qualsiasi delle altre più specifiche categorie di firme.

"block_proxies"
- Bloccare CIDRs identificato come appartenente alla servizi proxy? Se si richiede che gli utenti siano in grado di accedere al suo sito web dai servizi di proxy anonimi, questa direttiva deve essere impostata su false. Altrimenti, se non si richiede proxy anonimi, questa direttiva deve essere impostata su true come un mezzo per migliorare la sicurezza.

"block_spam"
- Bloccare CIDRs identificati come alto rischio per spam? A meno che si sperimentare problemi quando si fa così, generalmente, questo dovrebbe essere sempre impostata su true.

"modules"
- Un elenco di file moduli da caricare dopo l'esecuzione delle firme IPv4/IPv6, delimitati da virgole.

"default_tracktime"
- Quanti secondi per monitorare IP vietati dai moduli. Predefinito = 604800 (1 settimana).

"infraction_limit"
- Numero massimo di infrazioni un IP è permesso di incorrere prima di essere vietato dal monitoraggio IP. Predefinito = 10.

"track_mode"
- Quando devono infrazioni essere contati? False = Quando IP sono bloccati da moduli. True = Quando IP sono bloccati per qualsiasi motivo.

#### "recaptcha" (Categoria)
Se vuoi, è possibile fornire agli utenti un modo per bypassare la pagina di "Accesso Negato" attraverso il completamento di un'istanza di reCAPTCHA. Questo può aiutare a mitigare alcuni dei rischi associati con i falsi positivi in quelle situazioni in cui non siamo del tutto sicuri se una richiesta ha avuto origine da una macchina o di un essere umano.

A causa dei rischi connessi con fornendo un modo per gli utenti di bypassare la pagina di "Accesso Negato", generalmente, vorrei consigliare contro l'attivazione di questa funzione a meno che si sente che sia necessario farlo. Situazioni in cui sarebbe necessario: Se il vostro sito ha clienti/utenti che hanno bisogno di avere accesso al vostro sito web, e se questo è qualcosa che non può essere compromessa sulla, ma se quei clienti/utenti capita di essere di collegamento da una rete ostile che potenzialmente potrebbero essere anche trasportare il traffico indesiderato, e bloccando il traffico indesiderato è anche qualcosa che non può essere compromessa sulla, in quelle particolari situazioni senza possibilità di vittoria, la funzione di reCAPTCHA potrebbe rivelarsi utile come mezzo di permettere ai clienti/utenti desiderabili, mentre tenendo fuori il traffico indesiderato dalla stessa rete. Detto questo, però, dato che la destinazione di un CAPTCHA è quello di distinguere tra esseri umani e non-umani, la funzione di reCAPTCHA aiuterebbe solo in queste situazioni senza possibilità di vittoria se vogliamo supporre che questo traffico indesiderato è non-umano (per esempio, spambots, raschietti, incidere strumenti, traffico automatizzato), invece di essere il traffico umano indesiderato (come ad esempio gli spammer umani, hackers, e altri).

Per ottenere una "site key" e una "secret key" (necessaria per l'utilizzo di reCAPTCHA), vai al: [https://developers.google.com/recaptcha/](https://developers.google.com/recaptcha/)

"usemode"
- Definisce come CIDRAM dovrebbe usare reCAPTCHA.
- 0 = reCAPTCHA è completamente disabilitata (predefinito).
- 1 = reCAPTCHA è abilitato per tutte le firme.
- 2 = reCAPTCHA è abilitata solo per le firme appartenenti alle sezioni appositamente contrassegnati come reCAPTCHA abilitati all'interno dei file di firma.
- (Qualsiasi altro valore sarà trattata nello stesso modo come 0).

"lockip"
- Specifica se hash dovrebbero essere obbligati a specifici indirizzi IP. False = I cookie e gli hash POSSONO essere utilizzati di più indirizzi IP (predefinito). True = I cookie e gli hash NON possono essere utilizzati di più indirizzi IP (cookie/hash sono obbligati a l'IP).
- Nota: Il valore di "lockip" viene ignorato quando "lockuser" è false, a causa che il meccanismo per ricordare "utenti" differisce a seconda di questo valore.

"lockuser"
- Specifica se il completamento di un'istanza di reCAPTCHA deve essere obbligati a utenti specifici. False = Il completamento con successo di un'istanza di reCAPTCHA concederà l'accesso a tutte le richieste provenienti dallo stesso IP come quello utilizzato dall'utente completando l'istanza di reCAPTCHA; I cookie e gli hash non sono utilizzati; Invece, un IP whitelist verrà utilizzata. True = Il completamento con successo di un'istanza di reCAPTCHA sarà solo concedere l'accesso all'utente completando l'istanza di reCAPTCHA; I cookie e gli hash vengono utilizzati per ricordare all'utente; Un IP whitelist non viene utilizzato (predefinito).

"sitekey"
- Questo valore deve corrispondere alla "site key" per il vostro reCAPTCHA, che può essere trovato all'interno del cruscotto di reCAPTCHA.

"secret"
- Questo valore deve corrispondere alla "secret key" per il vostro reCAPTCHA, che può essere trovato all'interno del cruscotto di reCAPTCHA.

"expiry"
- Quando "lockuser" è true (predefinito), al fine di ricordare quando un utente ha superato con successo un'istanza di reCAPTCHA, per richieste di pagina futuri, CIDRAM genera un cookie HTTP standard contenente un hash che corrisponde ad un record interno contenente lo stesso hash; Future richieste per pagine utilizzerà questi hash corrispondenti per autenticare che un utente ha precedentemente già superato un'istanza di reCAPTCHA. Quando "lockuser" è false, un IP whitelist viene utilizzato per stabilire se le richieste dovrebbero essere autorizzate dall'IP di richieste in entrata; IP sono aggiunti a questa whitelist quando l'istanza di reCAPTCHA è superato con successo. Per quante ore dovrebbe questi cookies, hash e gli articoli della whitelist rimane valida? Predefinito = 720 (1 mese).

"logfile"
- Registrare tutti i tentativi per reCAPTCHA? Se sì, specificare il nome da usare per il file di registrazione. Se non, lasciare questo variabile vuoto.

*Consiglio utile: Se vuoi, è possibile aggiungere data/ora informazioni per i nomi dei file per la registrazione par includendo queste nel nome: `{yyyy}` per l'anno completo, `{yy}` per l'anno abbreviato, `{mm}` per mese, `{dd}` per giorno, `{hh}` per ora.*

*Esempi:*
- *`logfile='recaptcha.{yyyy}-{mm}-{dd}-{hh}.txt'`*

#### "template_data" (Categoria)
Direttive/Variabili per modelli e temi.

Si riferisce al HTML utilizzato per generare la pagina "Accesso Negato". Se stai usando temi personalizzati per CIDRAM, prodotti HTML è provenienti da file `template_custom.html`, e altrimenti, prodotti HTML è provenienti da file `template.html`. Variabili scritte a questa sezione del file di configurazione sono parsato per il prodotti HTML per mezzo di sostituendo tutti i nomi di variabili circondati da parentesi graffe trovato all'interno il prodotti HTML con la corrispondente dati di quelli variabili. Per esempio, dove `foo="bar"`, qualsiasi istanza di `<p>{foo}</p>` trovato all'interno il prodotti HTML diventerà `<p>bar</p>`.

"theme"
- Tema predefinito da utilizzare per CIDRAM.

"Magnification"
- Ingrandimento del carattere. Predefinito = 1.

"css_url"
- Il modello file per i temi personalizzati utilizzi esterni CSS proprietà, mentre il modello file per i temi personalizzati utilizzi interni CSS proprietà. Per istruire CIDRAM di utilizzare il modello file per i temi personalizzati, specificare l'indirizzo pubblico HTTP dei CSS file dei suoi tema personalizzato utilizzando la variabile `css_url`. Se si lascia questo variabile come vuoto, CIDRAM utilizzerà il modello file per il predefinito tema.

---


### 7. <a name="SECTION7"></a>FIRMA FORMATO

*Guarda anche:*
- *[Che cosa è una "firma"?](#WHAT_IS_A_SIGNATURE)*

#### 7.0 NOZIONI DI BASE

Una descrizione del formato e la struttura delle firme utilizzate da CIDRAM può essere trovato documentato in testo semplice entro una delle due file di firma personalizzati. Si prega di fare riferimento a tale documentazione per saperne di più sul formato e la struttura delle firme di CIDRAM.

Tutte le firme IPv4 seguono il formato: `xxx.xxx.xxx.xxx/yy [Function] [Param]`.
- `xxx.xxx.xxx.xxx` rappresenta l'inizio del blocco CIDR (gli ottetti dell'indirizzo IP iniziale nel blocco).
- `yy` rappresenta la dimensione del blocco CIDR [1-32].
- `[Function]` indica al script di cosa fare con la firma (come la firma dovrebbe essere considerata).
- `[Param]` rappresenta qualsiasi ulteriore informazione può essere richiesta di `[Function]`.

Tutte le firme IPv6 seguono il formato: `xxxx:xxxx:xxxx:xxxx::xxxx/yy [Function] [Param]`.
- `xxxx:xxxx:xxxx:xxxx::xxxx` rappresenta l'inizio del blocco CIDR (gli ottetti dell'indirizzo IP iniziale nel blocco). Notazione completa e la notazione abbreviata sono entrambi accettabili (e ognuno DEVE seguire gli standard adeguati e pertinenti di notazione IPv6, ma con una sola eccezione: un indirizzo IPv6 non può mai iniziare con l'abbreviazione quando usato in una firma per questo script, dovuto al modo in cui CIDRs vengono ricostruite dallo script; Per esempio, `::1/128` dovrebbe essere espresso, quando utilizzato in una firma, come `0::1/128`, e `::0/128` espresso come `0::/128`).
- `yy` rappresenta la dimensione del blocco CIDR [1-128].
- `[Function]` indica al script di cosa fare con la firma (come la firma dovrebbe essere considerata).
- `[Param]` rappresenta qualsiasi ulteriore informazione può essere richiesta di `[Function]`.

I file di firma per CIDRAM DOVREBBE utilizzare interruzioni di riga in stile Unix (`%0A`, o `\n`)! Altri tipi / stili di interruzioni di riga (per esempio, Windows `%0D%0A` o `\r\n` interruzioni di riga, Mac `%0D` o `\r` interruzioni di riga, ecc) PUÒ essere usato, ma NON sono da preferire. Interruzioni di riga che non sono in stile Unix sarà normalizzato a interruzioni di riga in stile Unix dallo script.

Precisa e corretta notazione CIDR è richiesta, altrimenti lo script non riconoscerà le firme. Inoltre, tutte le firme CIDR di questo script DEVE iniziare con un indirizzo IP il cui numero IP può dividere in modo uniforme nella divisione blocco rappresentato dal suo dimensione del blocco CIDR (per esempio, se si desidera bloccare tutti gli IP da `10.128.0.0` a `11.127.255.255`, `10.128.0.0/8` NON sarebbe riconosciuta dallo script, ma `10.128.0.0/9` e `11.0.0.0/9` usato insieme, SAREBBE riconosciuta dallo script).

Qualsiasi cosa ciò che nei file di firme non riconosciuto come firma né come sintassi connessi alle firme dallo script saranno IGNORATI, significa quindi che si può tranquillamente inserire qualsiasi dati che si desidera nei file di firme senza romperle e senza rompere lo script. I commenti sono accettabili nei file di firme, senza qualsiasi formattazione speciale richiesto per loro. Hashing in stile di Shell per i commenti è preferito, ma non forzata; Funzionalmente, non fa alcuna differenza per lo script anche se non si sceglie di utilizzare hashing in stile di Shell per i commenti, ma usando hashing in stile di Shell aiuta IDE ed editor di testo normale ad evidenziare correttamente le varie parti dei file di firme (e così, hashing in stile di Shell può aiutare come un aiuto visivo durante la modifica).

I valori possibili di `[Function]` sono le seguenti:
- Run
- Whitelist
- Greylist
- Deny

Se viene utilizzato "Run", quando la firma viene attivato, lo script tenterà di eseguire (utilizzando un statement `require_once`) uno script PHP esterna, specificato dal valore di `[Param]` (la directory di lavoro dovrebbe essere la directory dello script, "/vault/").

Esempio: `127.0.0.0/8 Run example.php`

Questo può essere utile se si desidera eseguire del codice PHP specifiche per alcuni IP e/o CIDR specifici.

Se viene utilizzato "Whitelist", quando la firma viene attivato, lo script si resetta tutti i rilevamenti (se c'è stato rilevamenti) e rompere la funzione di test. `[Param]` viene ignorato. Questa funzione garantisce che un particolare IP o CIDR non sarà rilevato.

Esempio: `127.0.0.1/32 Whitelist`

Se viene utilizzato "Greylist", quando la firma viene attivato, lo script si resetta tutti i rilevamenti (se c'è stato rilevamenti) e passare al file di firme successivo per continuare l'elaborazione. `[Param]` viene ignorato.

Esempio: `127.0.0.1/32 Greylist`

Se viene utilizzato "Deny", quando la firma viene attivato, supponendo che non firma whitelist è stato attivato per il dato indirizzo IP e/o dato CIDR, l'accesso alla pagina protetta sarà negato. "Deny" xxx è ciò che si desidera utilizzare per bloccare effettivamente un indirizzo IP e/o gamma CIDR. Quando qualsiasi firme vengono attivati che fanno uso di "Deny", il "Accesso Negato" pagina dello script sarà generato e la richiesta alla pagina protetta sarà ucciso.

Il valore di `[Param]` accettato da "Deny" sarà parsato per l'output della "Accesso Negato" pagina, fornito al cliente/utente come la ragione citata per il loro accesso alla pagina richiesta essere negata. Può essere una frase breve e semplice, spiegando il motivo per cui hai scelto di bloccarli (qualsiasi cosa dovrebbe essere sufficiente, anche un semplice "io non ti voglio sul mio sito"), o uno di una piccola manciata di parole brevi fornita dallo script, che se usato, sarà sostituito dallo script con una spiegazione pre-preparati del perché il cliente/utente è stato bloccato.

Le spiegazioni pre-preparati hanno il supporto L10N e può essere tradotto dallo script in base alla lingua specificata alla direttiva di configurazione dello script, `lang`. Inoltre, è possibile indicare lo script di ignorare le firme "Deny" in base al loro valore di `[Param]` (se si sta utilizzando queste brevi parole) tramite le direttive specificata dalla configurazione dello script (ogni parola breve ha un corrispondente direttiva al elaborare le firme corrispondenti o di ignorarle). I valori di `[Param]` che non utilizzare questi brevi parole, però, non hanno il supporto L10N e quindi NON sarà tradotto dallo script, e inoltre, non sono controllabili direttamente dalla configurazione dello script.

Le parole brevi disponibili sono:
- Bogon
- Cloud
- Generic
- Proxy
- Spam

#### 7.1 ETICHETTE

Se si desidera dividere le vostre firme personalizzate in singole sezioni, è possibile identificare queste singole sezioni per lo script per aggiungendo un "etichetta sezione" subito dopo le firme di ogni sezione, insieme con il nome della sezione di firme (vedere l'esempio cui seguito).

```
# Sezione 1.
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud
4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
6.7.8.9/32 Deny Proxy
Tag: Sezione 1
```

Per rompere l'etichetta della sezione e per assicurare che l'etichetta non sono identificati erroneamente alle sezioni di firme da prima nelle file di firme, semplicemente assicurare che ci sono almeno due interruzioni di riga consecutivi tra l'etichetta e le sezioni di firme precedenti. Qualsiasi firme senza un'etichetta saranno etichettato come "IPv4" o "IPv6" per predefinito (dipendente sui quali tipi di firme vengono attivati).

```
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud

4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
Tag: Sezione 1
```

Nell'esempio sopra `1.2.3.4/32` e `2.3.4.5/32` saranno etichettato come "IPv4", mentre `4.5.6.7/32` e `5.6.7.8/32` saranno etichettato come "Sezione 1".

Se si desidera firme per scadono dopo un certo tempo, in modo analogo all'etichette sezione, è possibile utilizzare un "etichetta scadenza" per specificare quando le firme dovrebbero cessano di essere validi. Etichette scadenza usano il formato "AAAA.MM.GG" (vedere l'esempio cui seguito).

```
# Sezione 1.
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Expires: 2016.12.31
```

Etichette sezione ed etichette scadenza possono essere utilizzati insieme, ed entrambi sono opzionali (vedere l'esempio cui seguito).

```
# Sezione Esempio.
1.2.3.4/32 Deny Generic
Tag: Sezione Esempio
Expires: 2016.12.31
```

#### 7.2 YAML

##### 7.2.0 YAML BASI

Una forma semplificata di YAML markup può essere utilizzato in file di firma al fine di definire comportamenti e le impostazioni specifiche per singole sezioni di firma. Questo può essere utile se si desidera che il valore delle vostre direttive di configurazione di differire sulla base delle singole firme e sezioni di firma (per esempio; se si desidera fornire un indirizzo e-mail per i biglietti di supporto per tutti gli utenti bloccati da una firma particolare, ma non desidera fornire un indirizzo e-mail per i biglietti di supporto per utenti bloccati con qualsiasi altro firme; se si desidera che alcune firme specifiche per innescare una reindirizzamento di pagina; se si desidera contrassegnare una sezione di firma per l'utilizzo con reCAPTCHA; se si desidera registrare i tentativi di accesso bloccati in file separati sulla base delle singole firme e/o sezioni di firma).

L'utilizzo di YAML markup nei file di firma è del tutto facoltativo (cioè, si può usare se si desidera farlo, ma non è richiesto a farlo), ed è in grado di sfruttare la maggior parte (ma non tutto) delle direttive di configurazione.

Nota: Implementazione di YAML markup in CIDRAM è molto semplice e molto limitato; Esso è destinato a soddisfare i requisiti specifici per CIDRAM in modo che ha la familiarità di YAML markup, ma non segue né è conforme alle specifiche tecniche (e quindi non si comporterà nello stesso modo come implementazioni più approfonditi altrove, e potrebbe non essere appropriato per altri progetti altrove).

In CIDRAM, segmenti di YAML markup vengono identificati allo script da tre trattini ("---"), e terminare al fianco dei loro contenenti sezioni di firma mediante due interruzioni di riga. Un tipico segmento di YAML markup all'interno di una sezione di firme consiste di tre trattini su una riga subito dopo l'elenco dei CIDRs e qualsiasi etichette, seguito da una lista bidimensionale delle chiave-valore coppie (prima dimensione, categorie di direttive di configurazione; seconda dimensione, direttive di configurazione) per i quali direttive di configurazione devono essere modificati (e in cui valori) ogniqualvolta una firma all'interno di tale sezione di firme viene innescato (vedere gli esempi qui sotto).

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

##### 7.2.1 COME "APPOSITAMENTE CONTRASSEGNARE" SEZIONI DI FIRMA PER L'UTILIZZO CON reCAPTCHA

Quando "usemode" è 0 o 1, sezioni di firma non hanno bisogno di essere "appositamente contrassegnato" per l'utilizzo con reCAPTCHA (perché già userà o non userà reCAPTCHA, (dipende da questa impostazione).

Quando "usemode" è 2, a "appositamente contrassegnare" sezioni di firma per l'utilizzo con, una voce è incluso nel segmento di YAML per tale sezione di firme (vedere l'esempio cui seguito).

```
# Questa sezione userà reCAPTCHA.
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Tag: reCAPTCHA-Enabled
---
recaptcha:
 enabled: true
```

Nota: Un istanza di reCAPTCHA sarà solo essere offerto all'utente se reCAPTCHA è attivato (sia con "usemode" come 1, o "usemode" come 2 con "enabled" come true), e se esattamente UN firma è stato attivato (né più, né meno; se più firme sono attivati, un'istanza di reCAPTCHA NON sarà offerto).

#### 7.3 AUSILIARIO

In aggiunta, se si desidera CIDRAM di ignorare completamente alcune sezioni specifiche in qualsiasi una delle file di firma, è possibile utilizzare il file `ignore.dat` per specificare quali sezioni a ignorare. In una nuova riga, scivere `Ignore`, seguito da uno spazio, seguito dal nome della sezione che si desidera CIDRAM a ignorare (vedere l'esempio cui seguito).

```
Ignore Sezione 1
```

Fare riferimento ai file di firme personalizzati per ulteriori informazioni.

---


### 8. <a name="SECTION8"></a>DOMANDE FREQUENTI (FAQ)

#### <a name="WHAT_IS_A_SIGNATURE"></a>Che cos'è una "firma"?

Nel contesto di CIDRAM, una "firma" si riferisce a dati che fungono da indicatore/identificatore per qualcosa di specifico che stiamo cercando, di solito un indirizzo IP o CIDR, e include alcune istruzioni per CIDRAM, dicendogli il modo migliore per rispondere quando incontra quello che stiamo cercando. Una firma tipica per CIDRAM sembra qualcosa di simile:

`1.2.3.4/32 Deny Generic`

Spesso (ma non sempre), le firme verranno raggruppate in gruppi, formando "sezioni di firma", spesso accompagnati da commenti, markup e/o metadati correlati che possono essere utilizzati per fornire contesto aggiuntivo per le firme e/o ulteriori istruzioni.

#### <a name="WHAT_IS_A_CIDR"></a>Che cos'è un "CIDR"?

"CIDR" è un acronimo di "Classless Inter-Domain Routing" *[[1](https://it.wikipedia.org/wiki/Supernetting#CIDR), [2](http://whatismyipaddress.com/cidr)]* (talvolta noto come "supernetting"), ed è questo acronimo che viene utilizzato come parte del nome di questo pacchetto, "CIDRAM", di cui che è un acronimo di "Classless Inter-Domain Routing Access Manager".

Tuttavia, nel contesto di CIDRAM (ad esempio, all'interno di questa documentazione, nelle discussioni relative a CIDRAM, o all'interno dei dati linguistici di CIDRAM), ogni volta che viene menzionato o riferito un "CIDR" (singolare) o "CIDRs" (plurale), e quindi per cui noi usiamo queste parole come nomi a loro diritto (al contrario di come acronimi), ciò che è inteso e significato da questa è una sottorete/sottoreti (o subnet/subnets), espresso utilizzando la notazione CIDR. Il motivo per cui vengono utilizzati CIDR/CIDRs anziché sottorete/sottoreti (o subnet/subnets) è quello di rendere chiaro che è specificamente le sottoreti espresse utilizzando la notazione CIDR a cui si fa riferimento (perché la notazione CIDR è solo uno dei diversi modi in cui le sottoreti possono essere espresse). CIDRAM potrebbe quindi essere considerato un "subnet access manager" o un "gestore di accesso per le sottoreti".

Anche se questo duplice significato di "CIDR" può presentare qualche ambiguità in alcuni casi, questa spiegazione, insieme al contesto fornito, dovrebbe contribuire a risolvere tale ambiguità.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>Che cosa è un "falso positivo"?

Il termine "falso positivo" (*in alternativa: "errore di falso positivo"; "falso allarme"*; Inglese: *false positive*; *false positive error*; *false alarm*), descritto molto semplicemente, e in un contesto generalizzato, viene utilizzato quando si analizza una condizione, per riferirsi ai risultati di tale analisi, quando i risultati sono positivi (cioè, la condizione è determinata a essere "positivo", o "vero"), ma dovrebbero essere (o avrebbe dovuto essere) negativo (cioè, la condizione, in realtà, è "negativo", o "falso"). Un "falso positivo" potrebbe essere considerato analogo a "piangendo lupo" (dove la condizione di essere analizzato è se c'è un lupo nei pressi della mandria, la condizione è "falso" in che non c'è nessun lupo nei pressi della mandria, e la condizione viene segnalato come "positivo" dal pastore per mezzo di chiamando "lupo, lupo"), o analogo a situazioni di test medici dove un paziente viene diagnosticato una malattia, quando in realtà, non hanno qualsiasi malattia.

Risultati correlati quando si analizza una condizione può essere descritto utilizzando i termini "vero positivo", "vero negativo" e "falso negativo". Un "vero positivo" si riferisce a quando i risultati dell'analisi e lo stato attuale della condizione sono entrambi vero (o "positivo"), e un "vero negativo" si riferisce a quando i risultati dell'analisi e lo stato attuale della condizione sono entrambe falso (o "negativo"); Un "vero positivo" o un "vero negativo" è considerato una "inferenza corretta". L'antitesi di un "falso positivo" è un "falso negativo"; Un "falso negativo" si riferisce a quando i risultati dell'analisi sono negativo (cioè, la condizione è determinata a essere "negativo", o "falso"), ma dovrebbero essere (o avrebbe dovuto essere) positivo (cioè, la condizione, in realtà, è "positivo", o "vero").

Nel contesto di CIDRAM, questi termini si riferiscono alle firme di CIDRAM e che cosa/chi bloccano. Quando CIDRAM si blocca un indirizzo IP a causa di firme male, obsoleti o errati, ma non avrebbe dovuto fare così, o quando lo fa per le ragioni sbagliate, ci riferiamo a questo evento come un "falso positivo". Quando CIDRAM non riesce a bloccare un indirizzo IP che avrebbe dovuto essere bloccato, a causa delle minacce impreviste, firme mancante o carenze nelle sue firme, ci riferiamo a questo evento come una "rivelazione mancante" o "missed detection" (che è analoga ad un "falso negativo").

Questo può essere riassunta dalla seguente tabella:

&nbsp; | CIDRAM *NON* dovrebbe bloccare un indirizzo IP | CIDRAM *DOVREBBE* bloccare un indirizzo IP
---|---|---
CIDRAM *NON* bloccare un indirizzo IP | Vero negativo (inferenza corretta) | Rivelazione mancante (analogous to falso negativo)
CIDRAM *FA* bloccare un indirizzo IP | __Falso positivo__ | Vero positivo (inferenza corretta)

#### Può CIDRAM blocchi interi paesi?

Sì. Il modo più semplice per raggiungere questo obiettivo sarebbe quella di installare alcune delle liste opzionali per il bloccando di paesi forniti da Macmathan. Questo può essere fatto direttamente dalla pagina degli aggiornamenti situato nel front-end, o, se si preferisce per il front-end di rimanere disabile, da scaricandoli direttamente dalla **[pagina per il scaricando delle liste opzionali per il bloccando di paesi](https://macmathan.info/blocklists)**, caricandoli alla vault, e citando i loro nomi nelle direttive di configurazione rilevanti.

#### Con quale frequenza vengono aggiornate le firme?

Frequenza di aggiornamento varia a seconda delle file di firma in questione. Tutti i manutentori per i file di firma per CIDRAM in genere cercano di mantenere i loro firme aggiornato il più possibile, ma a causa di tutti noi abbiamo diversi altri impegni, la nostra vita al di fuori del progetto, e a causa di nessuno di noi sono finanziariamente compensato (o pagato) per i nostri sforzi sul progetto, un calendario di aggiornamento preciso non può essere garantita. In genere, le firme vengono aggiornati ogni volta che c'è abbastanza tempo per aggiornarli, e generalmente, manutentori cercano di dare la priorità sulla base di necessità e su come spesso i cambiamenti si verificano tra le gamme. L'assistenza è sempre apprezzato se siete disposti a offrire qualsiasi.

#### Ho incontrato un problema durante l'utilizzo CIDRAM e non so che cosa fare al riguardo! Aiutami!

- Si sta utilizzando la versione più recente del software? Si sta utilizzando le ultime versioni dei file di firma? Se la risposta a una di queste due domande è no, provare ad aggiornare tutto prima, e verificare se il problema persiste. Se persiste, continuare a leggere.
- Hai controllato attraverso tutta la documentazione? In caso non fatto, si prega di farlo. Se il problema non può essere risolto utilizzando la documentazione, continuare a leggere.
- Hai controllato la **[pagina dei problemi](https://github.com/CIDRAM/CIDRAM/issues)**, per vedere se il problema è stato accennato prima? Se è stato accennato prima, verificare se sono stati forniti qualsiasi suggerimenti, idee, e/o soluzioni, e seguire come necessario per cercare di risolvere il problema.
- Hai controllato il **[forum di supporto per CIDRAM fornito da Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=61)**, per vedere se il problema è stato accennato prima? Se è stato accennato prima, verificare se sono stati forniti qualsiasi suggerimenti, idee, e/o soluzioni, e seguire come necessario per cercare di risolvere il problema.
- Se il problema persiste, fatecelo sapere su di esso con la creazione di una nuova discussione sulla pagina dei problemi o sul forum di supporto.

#### CIDRAM mi ha bloccato da un sito web che voglio visitare! Aiutami!

CIDRAM fornisce un mezzo per proprietari di siti web per bloccare il traffico indesiderato, ma è la responsabilità dei proprietari di siti web di decidere per se stessi come vogliono usare CIDRAM. Nel caso dei falsi positivi relativi alla firma file normalmente incluso con CIDRAM, correzioni possono essere fatte, ma per essere sbloccato da siti web specifici, è necessario prendere quella con i proprietari dei siti web in questione. Nei casi in cui vengono effettuate correzioni, almeno, avranno bisogno di aggiornare i propri file di firma e/o installazione, e in altri casi (come ad esempio, dove hanno modificato il loro installazione, creato le proprie firme personalizzate, ecc), la responsabilità di risolvere il problema è tutto loro, ed è completamente al di fuori del nostro controllo.

#### Voglio usare CIDRAM con una versione di PHP più vecchio di 5.4.0; Puoi aiutami?

No. PHP 5.4.0 raggiunto EoL ("End of Life", o fine della vita) ufficiale nel 2014, e il supporto di sicurezza esteso è stato terminato nel 2015. Come della stesura di questo, è il 2017, e PHP 7.1.0 è già disponibile. In questo momento, il supporto è fornito per l'utilizzo di CIDRAM con PHP 5.4.0 e tutte le versioni di PHP più recenti disponibili, ma se si tenta di utilizzare CIDRAM con le versioni di PHP più vecchie, supporto non sarà fornito.

*Guarda anche: [Grafici di Compatibilità](https://maikuolan.github.io/Compatibility-Charts/).*

#### Posso utilizzare un'installazione singola di CIDRAM per proteggere più domini?

Sì. Le installazioni di CIDRAM non sono naturalmente legato a domini specifici, e quindi possono essere utilizzati per proteggere più domini. Generalmente, ci riferiamo alle installazioni di CIDRAM che proteggono un solo dominio come "installazioni per singolo dominio", e ci riferiamo a installazioni di CIDRAM che proteggono più domini e/o sottodomini come "installazioni per più domini". Se si esegue un'installazione per più domini e bisogno utilizzare diversi set di file di firma per diversi domini, o bisogno che CIDRAM essere configurato in modo diverso per diversi domini, è possibile farlo. Dopo aver caricato il file di configurazione (`config.ini`), CIDRAM verifica l'esistenza di un "file di sovrascrittura per la configurazione" specifico del dominio (o sottodominio) che viene richiesto (`il-dominio-che-viene-richiesto.tld.config.ini`), e se trovati, tutti i valori di configurazione definiti dal file di sovrascrittura per la configurazione verranno utilizzati per l'istanza di esecuzione invece dei valori di configurazione definiti dal file di configurazione. I file di sovrascrittura per la configurazione sono identiche al file di configurazione, e a vostra discrezione, può contenere l'insieme di tutte le direttive di configurazione disponibili a CIDRAM, o qualsiasi piccola sottosezione richiesta che differisca dai valori normalmente definiti dal file di configurazione. I file di sovrascrittura per la configurazione sono chiamati in base al dominio a cui sono destinati (così, per esempio, se hai bisogno di un file di sovrascrittura per la configurazione per il dominio, `http://www.some-domain.tld/`, la sua file di sovrascrittura per la configurazione deve essere denominato come `some-domain.tld.config.ini`, e deve essere collocato all'interno della vault insieme al file di configurazione, `config.ini`). Il nome di dominio per l'istanza di esecuzione è derivato dall'intestazione `HTTP_HOST` della richiesta; "www" viene ignorato.

#### Non voglio perdere tempo con l'installazione di questo e farlo funzionare con il mio sito web; Posso pagarti per farlo per me?

Forse. Ciò è considerato caso per caso. Dicci cosa hai bisogno, quello che stai offrendo, e ti dirà se possiamo aiutare.

#### Posso assumere voi o uno degli sviluppatori di questo progetto per lavori privati?

*Vedi sopra.*

#### Ho bisogno di modifiche specialistiche, personalizzazioni, ecc; Puoi aiutare?

*Vedi sopra.*

#### Sono uno sviluppatore, un designer di siti web o un programmatore. Posso accettare o offrire lavori relativi a questo progetto?

Sì. La nostra licenza non vieta questo.

#### Voglio contribuire al progetto; Posso farlo?

Sì. I contributi al progetto sono molto graditi. Per ulteriori informazioni, vedere "CONTRIBUTING.md".

#### Valori consigliati per "ipaddr".

Valore | Utilizzando
---|---
`HTTP_INCAP_CLIENT_IP` | Proxy inverso Incapsula.
`HTTP_CF_CONNECTING_IP` | Proxy inverso Cloudflare.
`CF-Connecting-IP` | Proxy inverso Cloudflare (alternativa; se il precedente non funziona).
`HTTP_X_FORWARDED_FOR` | Proxy inverso Cloudbric.
`X-Forwarded-For` | [Proxy inverso Squid](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Definito dalla configurazione del server.* | [Proxy inverso Nginx](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Nessun proxy inverso (valore predefinito).

---


Ultimo Aggiornamento: 3 Ottobre 2017 (2017.10.03).
