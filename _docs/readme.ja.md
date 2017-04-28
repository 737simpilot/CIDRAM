## CIDRAMのドキュメンテーション（日本語）。

### 目次
- 1. [序文](#SECTION1)
- 2. [インストール方法](#SECTION2)
- 3. [使用方法](#SECTION3)
- 4. [フロントエンドの管理](#SECTION4)
- 5. [本パッケージに含まれるファイル](#SECTION5)
- 6. [設定オプション](#SECTION6)
- 7. [シグネチャ（署名）フォーマット](#SECTION7)
- 8. [よくある質問（FAQ）](#SECTION8)

*翻訳についての注意： エラーが発生した場合（例えば、翻訳の間の不一致、タイプミス、等等）、READMEの英語版が原本と権威のバージョンであると考えられます。 誤りを見つけた場合は、それらを修正するにご協力を歓迎されるだろう。*

---


### 1. <a name="SECTION1"></a>序文

CIDRAM（シドラム、クラスレス・ドメイン間・ルーティング・アクセス・マネージャー 『Classless Inter-Domain Routing Access Manager』）は、PHPスクリプトです。 ウェブサイトを保護するように設計されて、ＩＰアドレス（望ましくないトラフィックのあるソースとみなします）から、発信要求をブロックすることによって（ヒト以外のアクセスエンドポイント、クラウドサービス、スパムロボット、スクレーパー、等）。 ＩＰアドレスの可能ＣＩＤＲを計算することにより、ＣＩＤＲは、そのシグネチャファイルと比較することができます（これらのシグネチャファイルは不要なIPアドレスに対応するCIDRのリストが含まれています）； 一致が見つかった場合、要求はブロックされます。

*(参照する： [「ＣＩＤＲ」とは何ですか？](#WHAT_IS_A_CIDR)).*

CIDRAM著作権2016とGNU一般公衆ライセンスv2を超える権利について： Caleb M (Maikuolan)著。

本スクリプトはフリーウェアです。フリーソフトウェア財団発行のGNU一般公衆ライセンス・バージョン２（またはそれ以降のバージョン）に従い、再配布ならびに加工が可能です。 配布の目的は、役に立つことを願ってのものですが、『保証はなく、また商品性や特定の目的に適合するのを示唆するものでもありません』。 『LICENSE.txt』にある『GNU General Public License』（一般ライセンス）を参照して下さい。 以下のURLからも閲覧できます：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

本ドキュメントならびに関連パッケージ、[GitHub](https://github.com/Maikuolan/CIDRAM/)からダウンロードできます。

---


### 2. <a name="SECTION2"></a>インストール方法

#### 2.0 手動インストール

1) 本項を読んでいるということから、アーカイブ・スクリプトのローカルマシンへのダウンロードと解凍は終了していると考えます。 ホストあるいはCMSに`/public_html/cidram/`のようなディレクトリを作り、ローカルマシンからそこにコンテンツをアップロードするのが次のステップです。アップロード先のディレクトリ名や場所については、安全でさえあれば、もちろん制約などはありませんので、自由に決めて下さい。

2) `config.ini`に`config.ini.RenameMe`の名前を変更します（`vault`の内側に位置する）。 オプションの修正のため（初心者には推奨できませんが、経験が豊富なユーザーには強く推奨します）、それを開いて下さい（本ファイルはCIDRAMが利用可能なディレクティブを含んでおり、それぞれのオプションについての機能と目的に関した簡単な説明があります）。 セットアップ環境にあわせて、適当な修正を行いファイルを保存して下さい。

3) コンテンツ（CIDRAM本体とファイル）を先に定めたディレクトリにアップロードします。 （`*.txt`や`*.md`ファイルはアップロードの必要はありませんが、大抵は全てをアップロードしてもらって構いません）。

4) `vault`ディレクトリは「７５５」にアクセス権変更します（問題がある場合は、「７７７」を試すことができます；これは、しかし、安全ではありません）。 コンテンツをアップロードしたディレクトリそのものは、通常特に何もする必要ありませんが、過去にパーミッションで問題があった場合、CHMODのステータスは確認しておくと良いでしょう。 （デフォルトでは「７５５」が一般的です）。

5) 次に、システム内あるいはCMSにCIDRAMをフックします。方法はいくつかありますが、最も容易なのは、`require`や`include`でスクリプトをシステム内またはCMSのコアファイルの最初の部分に記載する方法です。（コアファイルとは、サイト内のどのページにアクセスがあっても必ずロードされるファイルのことです）。 一般的には、`/includes`や`/assets`や`/functions`のようなディレクトリ内のファイルで、`init.php`、`common_functions.php`、`functions.php`といったファイル名が付けられています。実際にどのファイルなのかは、見つけてもうらう必要があります。 よく分からない場合は、CIDRAMサポートフォーラムを参照するか、またはGitHubのでCIDRAMの問題のページ、あるいはお知らせください（CMS情報必須）。 私自身を含め、ユーザーの中に類似のCMSを扱った経験があれば、何かしらのサポートを提供できます。コアファイルが見つかったなら、「`require`か`include`を使って」以下のコードをファイルの先頭に挿入して下さい。 ただし、クォーテーションマークで囲まれた部分は`loader.php`ファイルの正確なアドレス（HTTPアドレスでなく、ローカルなアドレス。前述のvaultのアドレスに類似）に置き換えます。

`<?php require '/user_name/public_html/cidram/loader.php'; ?>`

ファイルを保存して閉じ、再アップロードします。

-- 他の手法 --

Apacheウェブサーバーを利用していて、かつ`php.ini`を編集できるようであれば、`auto_prepend_file`ディレクティブを使って、PHPリクエストがあった場合にはいつもCIDRAMを先頭に追加するようにすることも可能です。以下に例を挙げます。

`auto_prepend_file = "/user_name/public_html/cidram/loader.php"`

あるいは、`.htaccess` において：

`php_value auto_prepend_file "/user_name/public_html/cidram/loader.php"`

6) インストールは完了しました。 :-)

#### 2.1 COMPOSERを使用してインストールする

[CIDRAMはPackagistに登録されています](https://packagist.org/packages/maikuolan/cidram)。 Composerを使い慣れている場合は、Composerを使用してCIDRAMをインストールできます （あなたはまだ設定とフックを準備する必要があります； 「手動インストール」の手順2と5を参照してください）。

`composer require maikuolan/cidram`

#### 2.2 WORDPRESSためにインストールする

WordPressでCIDRAMを使用する場合は、上記の手順をすべて無視することができます。 [CIDRAMは、WordPressプラグインデータベースにプラグインとして登録されています](https://wordpress.org/plugins/cidram/)。 プラグインダッシュボードからCIDRAMを直接インストールできます。 他のプラグインと同じ方法でインストールでき、追加手順は不要です。 他のインストール方法と同じように、`config.ini`ファイルの内容を変更してまたはフロントエンドのコンフィギュレーションページを使用してインストールをカスタマイズすることができます。 フロントエンドのアップデート・ページでCIDRAMを更新すると、プラグインバージョン情報がWordPressに自動的に同期されます。

---


### 3. <a name="SECTION3"></a>使用方法

CIDRAMは自動的に望ましくない要求をブロックする必要があります；支援が必要とされていません（インストールを除きます）。

更新（アップデイト）は手動で行われています。 あなたの設定ファイルを変更することによって、構成設定をカスタマイズすることができます。 あなたのシグネチャファイルを変更することによって、ＣＩＤＲがブロックされて変更することができます。

誤検出（偽陽性）や新種の疑わしきものに遭遇した、関することについては何でもお知らせ下さい。

---


### 4. <a name="SECTION4"></a>フロントエンドの管理

#### 4.0 フロントエンドは何です。

フロントエンドは、CIDRAMのインストールを維持、管理、更新するための便利で簡単な方法を提供します。 ログページを使用してログファイルを表示、共有、ダウンロードすることができます、コンフィギュレーションページでコンフィギュレーションを変更できます、アップデートページを使用してコンポーネントをインストールおよびアンインストールできます、そして、ファイル・マネージャーを使用してvault「ボールト」内のファイルをアップロード、ダウンロード、および変更することができます。

不正アクセスを防止するため、フロントエンドはデフォルトで無効になっています （不正アクセスがウェブサイトとそのセキュリティに重大な影響を与える可能性があります）。 それを可能にするための指示は、このパラグラフの下に含まれています。

#### 4.1 フロントエンドを有効にする方法。

1) `config.ini`の中にある`disable_frontend`ディレクティブを探します、それを「true」に設定します （デフォルトでは「false」です）。

2) ブラウザから`loader.php`にアクセスしてください （例えば、`http://localhost/cidram/loader.php`）。

3) デフォルトのユーザー名とパスワードでログインする （admin/password）。

注意： あなたが初めてログインした後、フロントエンドへの不正アクセスを防ぐために、あなたはすぐにユーザー名とパスワードを変更する必要があります！ これは非常に重要です、なぜなら、フロントエンドから任意のPHPコードをあなたのウェブサイトにアップロードすることができるからです。

#### 4.2 フロントエンドの使い方。

フロントエンドの各ページには、目的の説明とその使用方法の説明があります。 詳しい説明や特別な支援が必要な場合は、サポートにお問い合わせください。 また、デモを提供するYouTube上で利用可能な動画もあります。


---


### 5. <a name="SECTION5"></a>本パッケージに含まれるファイル

以下はアーカイブから一括ダウンロードされるファイルのリスト、ならびにスクリプト使用により作成されるファイルとこれらのファイルが何のためかという簡単な説明です。

ファイル | 説明
----|----
/_docs/ | ドキュメンテーション用のディレクトリです（様々なファイルを含みます）。
/_docs/readme.ar.md | アラビア語ドキュメンテーション。
/_docs/readme.de.md | ドイツ語ドキュメンテーション。
/_docs/readme.en.md | 英語ドキュメンテーション。
/_docs/readme.es.md | スペイン語ドキュメンテーション。
/_docs/readme.fr.md | フランス語ドキュメンテーション。
/_docs/readme.id.md | インドネシア語ドキュメンテーション。
/_docs/readme.it.md | 伊語ドキュメンテーション。
/_docs/readme.ja.md | 日本語ドキュメンテーション。
/_docs/readme.ko.md | 韓国語ドキュメンテーション。
/_docs/readme.nl.md | オランダ語ドキュメンテーション。
/_docs/readme.pt.md | ポルトガル語ドキュメンテーション。
/_docs/readme.ru.md | ロシア語ドキュメンテーション。
/_docs/readme.ur.md | ウルドゥー語ドキュメンテーション。
/_docs/readme.vi.md | ベトナム語ドキュメンテーション。
/_docs/readme.zh-TW.md | 繁体字中国語ドキュメンテーション。
/_docs/readme.zh.md | 簡体字中国語ドキュメンテーション。
/vault/ | ヴォルト・ディレクトリ（様々なファイルを含んでいます）。
/vault/fe_assets/ | フロントエンド資産。
/vault/fe_assets/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/fe_assets/_accounts.html | フロントエンドのアカウント・ページのＨＴＭＬテンプレート。
/vault/fe_assets/_accounts_row.html | フロントエンドのアカウント・ページのＨＴＭＬテンプレート。
/vault/fe_assets/_cidr_calc.html | ＣＩＤＲ計算機のＨＴＭＬテンプレート。
/vault/fe_assets/_cidr_calc_row.html | ＣＩＤＲ計算機のＨＴＭＬテンプレート。
/vault/fe_assets/_config.html | フロントエンドのコンフィギュレーションページのＨＴＭＬテンプレート。
/vault/fe_assets/_config_row.html | フロントエンドのコンフィギュレーションページのＨＴＭＬテンプレート。
/vault/fe_assets/_files.html | ファイル・マネージャのＨＴＭＬテンプレート。
/vault/fe_assets/_files_edit.html | ファイル・マネージャのＨＴＭＬテンプレート。
/vault/fe_assets/_files_rename.html | ファイル・マネージャのＨＴＭＬテンプレート。
/vault/fe_assets/_files_row.html | ファイル・マネージャのＨＴＭＬテンプレート。
/vault/fe_assets/_home.html | フロントエンドのホームページのＨＴＭＬテンプレート。
/vault/fe_assets/_ip_test.html | ＩＰテストページのＨＴＭＬテンプレート。
/vault/fe_assets/_ip_test_row.html | ＩＰテストページのＨＴＭＬテンプレート。
/vault/fe_assets/_ip_tracking.html | ＩＰトラッキング・ページのＨＴＭＬテンプレート。
/vault/fe_assets/_ip_tracking_row.html | ＩＰトラッキング・ページのＨＴＭＬテンプレート。
/vault/fe_assets/_login.html | フロントエンドのログインページのＨＴＭＬテンプレート。
/vault/fe_assets/_logs.html | フロントエンドのロゴスページのＨＴＭＬテンプレート。
/vault/fe_assets/_nav_complete_access.html | フロントエンドのナビゲーションリンクのＨＴＭＬテンプレート、は完全なアクセスのためのものです。
/vault/fe_assets/_nav_logs_access_only.html | フロントエンドのナビゲーションリンクのＨＴＭＬテンプレート、はログのみにアクセスのためのものです。
/vault/fe_assets/_updates.html | フロントエンドのアップデート・ページのＨＴＭＬテンプレート。
/vault/fe_assets/_updates_row.html | フロントエンドのアップデート・ページのＨＴＭＬテンプレート。
/vault/fe_assets/frontend.css | フロントエンドのＣＳＳスタイルシート。
/vault/fe_assets/frontend.dat | フロントエンドのデータベース（アカウント情報とセッション情報とキャッシュが含まれています； フロントエンドが有効になっているときに作成）。
/vault/fe_assets/frontend.html | フロントエンドのメインテンプレートファイル。
/vault/lang/ | CIDRAMの言語データを含んでいます。
/vault/lang/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/lang/lang.ar.cli.php | ＣＬＩのアラビア語言語データ。
/vault/lang/lang.ar.fe.php | フロントエンドのアラビア語言語データ。
/vault/lang/lang.ar.php | アラビア語言語データ。
/vault/lang/lang.de.cli.php | ＣＬＩのドイツ語言語データ。
/vault/lang/lang.de.fe.php | フロントエンドのドイツ語言語データ。
/vault/lang/lang.de.php | ドイツ語言語データ。
/vault/lang/lang.en.cli.php | ＣＬＩの英語言語データ。
/vault/lang/lang.en.fe.php | フロントエンドの英語言語データ。
/vault/lang/lang.en.php | 英語言語データ。
/vault/lang/lang.es.cli.php | ＣＬＩのスペイン語言語データ。
/vault/lang/lang.es.fe.php | フロントエンドのスペイン語言語データ。
/vault/lang/lang.es.php | スペイン語言語データ。
/vault/lang/lang.fr.cli.php | ＣＬＩのフランス語言語データ。
/vault/lang/lang.fr.fe.php | フロントエンドのフランス語言語データ。
/vault/lang/lang.fr.php | フランス語言語データ。
/vault/lang/lang.id.cli.php | ＣＬＩのインドネシア語言語データ。
/vault/lang/lang.id.fe.php | フロントエンドのインドネシア語言語データ。
/vault/lang/lang.id.php | インドネシア語言語データ。
/vault/lang/lang.it.cli.php | ＣＬＩの伊語言語データ。
/vault/lang/lang.it.fe.php | フロントエンドの伊語言語データ。
/vault/lang/lang.it.php | 伊語言語データ。
/vault/lang/lang.ja.cli.php | ＣＬＩの日本語言語データ。
/vault/lang/lang.ja.fe.php | フロントエンドの日本語言語データ。
/vault/lang/lang.ja.php | 日本語言語データ。
/vault/lang/lang.ko.cli.php | ＣＬＩの韓国語言語データ。
/vault/lang/lang.ko.fe.php | フロントエンドの韓国語言語データ。
/vault/lang/lang.ko.php | 韓国語言語データ。
/vault/lang/lang.nl.cli.php | ＣＬＩのオランダ語言語データ。
/vault/lang/lang.nl.fe.php | フロントエンドのオランダ語言語データ。
/vault/lang/lang.nl.php | オランダ語言語データ。
/vault/lang/lang.pt.cli.php | ＣＬＩのポルトガル語言語データ。
/vault/lang/lang.pt.fe.php | フロントエンドのポルトガル語言語データ。
/vault/lang/lang.pt.php | ポルトガル語言語データ。
/vault/lang/lang.ru.cli.php | ＣＬＩのロシア語言語データ。
/vault/lang/lang.ru.fe.php | フロントエンドのロシア語言語データ。
/vault/lang/lang.ru.php | ロシア語言語データ。
/vault/lang/lang.th.cli.php | ＣＬＩのタイ語言語データ。
/vault/lang/lang.th.fe.php | フロントエンドのタイ語言語データ。
/vault/lang/lang.th.php | タイ語言語データ。
/vault/lang/lang.tr.cli.php | ＣＬＩのトルコ語言語データ。
/vault/lang/lang.tr.fe.php | フロントエンドのトルコ語言語データ。
/vault/lang/lang.tr.php | トルコ語言語データ。
/vault/lang/lang.ur.cli.php | ＣＬＩのウルドゥー語言語データ。
/vault/lang/lang.ur.fe.php | フロントエンドのウルドゥー語言語データ。
/vault/lang/lang.ur.php | ウルドゥー語言語データ。
/vault/lang/lang.vi.cli.php | ＣＬＩのベトナム語言語データ。
/vault/lang/lang.vi.fe.php | フロントエンドのベトナム語言語データ。
/vault/lang/lang.vi.php | ベトナム語言語データ。
/vault/lang/lang.zh-tw.cli.php | ＣＬＩの繁体字中国語言語データ。
/vault/lang/lang.zh-tw.fe.php | フロントエンドの繁体字中国語言語データ。
/vault/lang/lang.zh-tw.php | 繁体字中国語言語データ。
/vault/lang/lang.zh.cli.php | ＣＬＩの簡体字中国語言語データ。
/vault/lang/lang.zh.fe.php | フロントエンドの簡体字中国語言語データ。
/vault/lang/lang.zh.php | 簡体字中国語言語データ。
/vault/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/cache.dat | キャッシュ・データ。
/vault/cidramblocklists.dat | Macmathanが提供する国オプショナルブロックリスト。 アップデート機能で使用（フロントエンドが提供します）。
/vault/cli.php | CLIハンドラ。
/vault/components.dat | CIDRAMのコンポーネント情報が含まれています。 アップデート機能で使用（フロントエンドが提供します）。
/vault/config.ini.RenameMe | CIDRAM設定ファイル； CIDRAMの全オプション設定を記載しています。 それぞれのオプションの機能と動作手法の説明です（アクティブにするために名前を変更します）。
/vault/config.php | コンフィギュレーション・ハンドラ。
/vault/config.yaml | 設定・デフォルトス・ファイル；CIDRAMのデフォルト設定値が含まれます。
/vault/frontend.php | フロントエンド・ハンドラ。
/vault/functions.php | 機能ファイル（本質的ファイル）。
/vault/hashes.dat | 受け入れられているハッシュのリスト（reCAPTCHAの機能に関連します；のみreCAPTCHAの機能が有効になっている場合に生成）。
/vault/icons.php | アイコン・ハンドラ（フロント・エンド・ファイル・マネージャによって使用される）。
/vault/ignore.dat | 無視ファイル（これはシグネチャセクション無視します）。
/vault/ipbypass.dat | ＩＰバイパスの一覧（reCAPTCHAの機能に関連します；のみreCAPTCHAの機能が有効になっている場合に生成）。
/vault/ipv4.dat | ＩＰｖ４のシグネチャファイル （不要なクラウドサービスと非人のエンドポイント）。
/vault/ipv4_bogons.dat | ＩＰｖ４のシグネチャファイル （ボゴン/火星ＣＩＤＲ）。
/vault/ipv4_custom.dat.RenameMe | ＩＰｖ４のカスタムシグネチャファイル（アクティブにするために名前を変更します）。
/vault/ipv4_isps.dat | ＩＰｖ４のシグネチャファイル （スパマーを持つ危険なＩＳＰ）。
/vault/ipv4_other.dat | ＩＰｖ４のシグネチャファイル （プロキシ、VPN、およびその他の不要なサービスのＣＩＤＲ）。
/vault/ipv6.dat | ＩＰｖ６のシグネチャファイル （不要なクラウドサービスと非人のエンドポイント）。
/vault/ipv6_bogons.dat | ＩＰｖ６のシグネチャファイル （ボゴン/火星ＣＩＤＲ）。
/vault/ipv6_custom.dat.RenameMe | ＩＰｖ６のカスタムシグネチャファイル（アクティブにするために名前を変更します）。
/vault/ipv6_isps.dat | ＩＰｖ６のシグネチャファイル （スパマーを持つ危険なＩＳＰ）。
/vault/ipv6_other.dat | ＩＰｖ６のシグネチャファイル （プロキシ、VPN、およびその他の不要なサービスのＣＩＤＲ）。
/vault/lang.php | 言語・ハンドラ。
/vault/modules.dat | CIDRAMのモジュール情報が含まれています； アップデート機能で使用（フロントエンドが提供します）。
/vault/outgen.php | 出力発生器。
/vault/php5.4.x.php | PHP 5.4.X ポリフィル （PHP 5.4.X の下位互換性のために必要です； より新しいPHPバージョンのために、削除しても安全です）。
/vault/recaptcha.php | reCAPTCHAのモジュール。
/vault/rules_as6939.php | カスタムルールは、AS6939のためのファイル。
/vault/rules_softlayer.php | カスタムルールは、Soft Layerのためのファイル。
/vault/rules_specific.php | カスタムルールは、いくつかの特定のＣＩＤＲのためのファイル。
/vault/salt.dat | ソルトファイル（一部の周辺機能によって使用されます；必要な場合にのみ生成）。
/vault/template.html | CIDRAMテンプレートファイル； CIDRAMがファイルアップロードをブロックした際に作成されるメッセージのＨＴＭＬ出力用テンプレート（アップローダーが表示するメッセージ）。
/vault/template_custom.html | CIDRAMテンプレートファイル； CIDRAMがファイルアップロードをブロックした際に作成されるメッセージのＨＴＭＬ出力用テンプレート（アップローダーが表示するメッセージ）。
/.gitattributes | GitHubのプロジェクトファイル（機能には関係のないファイルです）。
/Changelog.txt | バージョンによる違いを記録したものです（機能には関係のないファイルです）。
/composer.json | Composer/Packagist情報（機能には関係のないファイルです）。
/CONTRIBUTING.md | プロジェクトに貢献する方法について。
/LICENSE.txt | GNU/GPLv2のライセンスのコピー（機能には関係のないファイルです）。
/loader.php | ローダー・ファイルです。主要スクリプトのロード、アップロード等を行います。フックするのはまさにこれです（本質的ファイル）！
/README.md | プロジェクト概要情報。
/web.config | ASP.NET設定ファイルです（スクリプトがASP.NETテクノロジーを基礎とするサーバーにインストールされた時に`/vault`ディレクトリを権限のないソースによるアクセスから保護するためです）。

---


### 6. <a name="SECTION6"></a>設定オプション
以下は`config.ini`設定ファイルにある変数ならびにその目的と機能のリストです。

#### "general" （全般、カテゴリー）
全般的な設定。

"logfile" （ログ・ファイル）
- アクセス試行阻止の記録、人間によって読み取り可能。 ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

"logfileApache" （ログ・ファイル・アパッチ）
- アクセス試行阻止の記録、Apacheスタイル。 ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

"logfileSerialized" （ログ・ファイル・シリアライズ）
- アクセス試行阻止の記録、シリアル化されました。 ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

*有用な先端： あなたがしたい場合は、ログファイルの名前に日付/時刻情報を付加することができます、名前にこれらを含めることで:完全な年のため`{yyyy}`、省略された年のため`{yy}`、月`{mm}`、日`{dd}`、時間`{hh}`。*

*例:*
- *`logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate" （トランケート）
- ログファイルが一定のサイズに達したら切り詰めますか？ 値は、ログファイルが切り捨てられる前に大きくなる可能性があるＢ/ＫＢ/ＭＢ/ＧＢ/ＴＢ単位の最大サイズです。 デフォルト値の０ＫＢは切り捨てを無効にします （ログファイルは無期限に拡張できます）。 注：個々のログファイルに適用されます。 ログファイルのサイズは一括して考慮されません。

"timeOffset" （タイム・オフセット）
- お使いのサーバの時刻は、ローカル時刻と一致しない場合、あなたのニーズに応じて、時間を調整するために、あなたはここにオフセットを指定することができます。 しかし、その代わりに、一般的にタイムゾーンディレクティブ（あなたの`php.ini`ファイルで）を調整ーることをお勧めします、でも時々（といった、限ら共有ホスティングプロバイダでの作業時）これは何をすることは必ずしも可能ではありません、したがって、このオプションは、ここで提供されています。 オフセット分であります。
- 例（１時間を追加します）：`timeOffset=60`

"timeFormat"
- CIDRAMで使用される日付表記形式。 Default（デフォルト設定） = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr" （アイピーアドレス）
- 接続要求のＩＰアドレスをどこで見つけるべきかについて（Cloudflareのようなサービスに対して有効）。 Default（デフォルト設定） = REMOTE_ADDR。 注意： あなたが何をしているのか、分からない限り、これを変更しないでください。

"forbid_on_block" （フォービッド・オン・ブロック）
- 何ヘッダー使用する必要がありますか（要求をブロックしたとき）？ `false`（偽）/200 = 200 OK （Default/デフォルルト）； `true`（真）/403 = 403 Forbidden （４０３禁止されている）； 503 = 503 Service unavailable （５０３サービス利用不可）。

"silent_mode" （サイレント・モード）
- 「アクセス拒否」ページを表示する代わりに、CIDRAMはブロックされたアクセス試行を自動的にリダイレクトする必要がありますか？ はいの場合は、リダイレクトの場所を指定します。いいえの場合は、この変数を空白のままにします。

"lang" （ラング）
- CIDRAMのデフォルト言語を設定します。

"emailaddr" （Ｅメール・アドレス）
- ここにＥメールアドレスを入力して、ユーザーがブロックされているときにユーザーに送信することができます。 これはサポートと支援に使用できます（誤ってブロックされた場合、等）。 警告： ここに入力された電子Ｅメールアドレスは、おそらくスパムロボットによって取得されます。 ここで提供される電子Ｅメールアドレスは、すべて使い捨てにすることを強く推奨します（例えば、プライマリ個人アドレスまたはビジネスアドレスを使用しない、等）。

"disable_cli" （ディスエイブル・シーエルアイ）
- ＣＬＩモードを無効にするか？ ＣＬＩモード（シーエルアイ・モード）はデフォルトでは有効になっていますが、テストツール（PHPUnit等）やＣＬＩベースのアプリケーションと干渉しあう可能性が無いとは言い切れません。 ＣＬＩモードを無効にする必要がなければ、このデレクティブは無視してもらって結構です。 `false`（偽） = ＣＬＩモードを有効にします（Default/デフォルルト）； `true`（真） = ＣＬＩモードを無効にします。

"disable_frontend" （ディスエイブル・フロントエンド）
- フロントエンドへのアクセスを無効にするか？ フロントエンドへのアクセスは、CIDRAMをより管理しやすくすることができます。 前記、それはまた、潜在的なセキュリティリスクになる可能性があります。 バックエンドを経由して管理することをお勧めします、しかし、これが不可能な場合、フロントエンドへのアクセスが提供され。 あなたがそれを必要としない限り、それを無効にします。 `false`（偽） = フロントエンドへのアクセスを有効にします； `true`（真） = フロントエンドへのアクセスを無効にします（Default/デフォルルト）。

"max_login_attempts" （マクス・ログイン・アテンプト）
- ログイン試行の最大回数（フロントエンド）。 Default（デフォルト設定） = ５。

"FrontEndLog" （フロントエンド・ログ）
- フロントエンド・ログインの試みを記録するためのファイル。 ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

"ban_override" （バン・オーバーライド）
- 「infraction_limit」を超えたときに「forbid_on_block」を上書きしますか？ 上書きするとき：ブロックされた要求は空白のページを返します（テンプレートファイルは使用されません）。 ２００ = 上書きしない（Default/デフォルルト）； ４０３ = 「403 Forbidden」で上書きする； ５０３ = 「503 Service unavailable」で上書きする。

"log_banned_ips" （ログ・バンド・アイピーズ）
- 禁止されたＩＰからブロックされた要求をログファイルに含めますか？ True = はい （Default/デフォルルト）； False = いいえ。

"default_dns" （ディフォールト・ディーエンエス）
- ホスト名検索に使用する、ＤＮＳ（ドメイン・ネーム・システム）サーバーのカンマ区切りリスト。 Default（デフォルルト） = "8.8.8.8,8.8.4.4" （Google DNS）。 注意： あなたが何をしているのか、分からない限り、これを変更しないでください。

"search_engine_verification" （サーチ・エンジン・ベリフィケーション）
- 検索エンジンからのリクエストを確認する必要がありますか？ 検索エンジンを確認することで、違反の最大数を超えたために検索エンジンが禁止されないことが保証されます （検索エンジンを禁止することは、通常、検索エンジンランキング、ＳＥＯなどに悪影響を及ぼします）。 確認されると、検索エンジンがブロックされることがありますが、しかしは禁止されません。 検証されていない場合は、違反の最大を超えた結果、禁止される可能性があります。 さらに、検索エンジンの検証は、詐称された検索エンジンから保護します （これらのリクエストはブロックされます）。 True = 検索エンジンの検証を有効にする （Default/デフォルルト）； False = 検索エンジンの検証を無効にする。

"protect_frontend" （プロテクト・フロントエンド）
- CIDRAMによって通常提供される保護をフロントエンドに適用するかどうかを指定します。 True = はい （Default/デフォルルト）； False = いいえ。

"disable_webfonts" （ディスエイブル・ウェブフォンツ）
- ウェブフォンツを無効にしますか？ True = はい； False = いいえ （Default/デフォルルト）。

#### "signatures" （シグネチャーズ、カテゴリ）
シグネチャの設定。

"ipv4" （アイピーブイ４）
- ＩＰｖ４のシグネチャファイルのリスト（CIDRAMは、これを使用します）。 これは、カンマで区切られています。 必要に応じて、項目を追加することができます。

"ipv6" （アイピーブイ６）
- ＩＰｖ６のシグネチャファイルのリスト（CIDRAMは、これを使用します）。 これは、カンマで区切られています。 必要に応じて、項目を追加することができます。

"block_cloud" （ブロック・クラウド）
- クラウドサービスからのＣＩＤＲをブロックする必要がありますか？ あなたのウェブサイトからのＡＰＩサービスを操作する場合、または、あなたがウェブサイトツーサイト接続が予想される場合、これはfalseに設定する必要があります。 ない場合は、これをtrueに設定する必要があります。

"block_bogons" （ブロック・ぼごん）
- 火星の\ぼごんからのＣＩＤＲをブロックする必要がありますか？ あなたがローカルホストから、またはお使いのＬＡＮから、ローカルネットワーク内からの接続を受信した場合、これはfalseに設定する必要があります。 ない場合は、これをtrueに設定する必要があります。

"block_generic" （ブロック・ジェネリック）
- 一般的なＣＩＤＲをブロックする必要がありますか？ （他のオプションに固有ではないもの）。

"block_proxies" （ブロック・プロキシ）
- プロキシサービスからのＣＩＤＲをブロックする必要がありますか？ 匿名プロキシサービスが必要な場合は、これをfalseに設定する必要があります。ない場合は、セキュリティを向上させるために、これをtrueに設定する必要があります。

"block_spam" （ブロック・スパム）
- スパムのため、ＣＩＤＲをブロックする必要がありますか？ 問題がある場合を除き、一般的には、これをtrueに設定する必要があります。

"modules" （モジュールス）
- ＩＰｖ４/ＩＰｖ６シグネチャをチェックした後にロードするモジュールファイルのリスト。 これは、カンマで区切られています。

"default_tracktime" （デフォルト・トラックタイム）
- モジュールによって禁止されているＩＰを追跡する秒数。 Default（デフォルト設定） = ６０４８００（１週間）。

"infraction_limit" （インフラクション・リミット）
- ＩＰがＩＰトラッキングによって禁止される前に発生することが、許される違反の最大数。 Default（デフォルト設定） = １０。

"track_mode" （トラック・モード）
- 違反はいつカウントされるべきですか？ False = ＩＰがモジュールによってブロックされている場合。 True = なんでもの理由でＩＰがブロックされた場合。

#### "recaptcha" （リーキャプチャ、カテゴリ）
ユーザーにとって、reCAPTCHAインスタンスを完成させることによって、「アクセス拒否」ページをバイパスする方法を提供することができます。 これは、偽陽性に関連するいくつかのリスクを緩和するのに役立ちます （要求が機械または人間から、生じたものであるかどうかは不明である場合）。

「アクセス拒否」ページをバイパスすることに伴うリスクがあります。 このため、一般的に、必要な場合を除いて、この機能を有効にすることはお勧めしません。 それが必要な状況： ユーザーはあなたのウェブサイトにアクセスする必要があります、しかし、彼らは敵対的なネットワークから接続しています、そして、これは交渉できません； ユーザーはアクセスが必要です、敵対的なネットワークを拒絶する必要がある（何をすべきか？！）。。 このような状況では、reCAPTCHA機能が役立つ可能性があります： ユーザーはアクセス権を持つことができます； 不要なトラフィックをフィルタリングすることができます（一般的に）。 人間以外のトラフィックに対しても有効です（例えば、スパムロボット、スクレーパー、ハックツール、自動交通、など）、しかし、人間のトラフィックにあまり役に立たない（例えば、人間のスパマー、ハッカー、その他）。

「site key」および「secret key」を得るために（reCAPTCHAのを使用するために必要）、このリンクをクリックしてください： [https://developers.google.com/recaptcha/](https://developers.google.com/recaptcha/)

"usemode" （ユース・モード）
- reCAPTCHAをCIDRAMで使用する方法。
- ０ = reCAPTCHAは、無効になっています（Default/デフォルルト）。
- １ = reCAPTCHAは、すべてのためにシグネチャが有効になっています。
- ２ = 特別にマークされたセクションの場合のみ、reCAPTCHAが有効になります。
- （それ以外の値は０と等価です）。

"lockip" （ロック・ＩＰ）
- reCAPTCHAをＩＰにロックしますか？ False = クッキーとハッシュは複数のＩＰで使用できます（Default/デフォルルト）。 True = クッキーとハッシュは複数のＩＰで使用できません（クッキーとハッシュはIPにロックされています）。
- 注意： 「lockuser」が「false」の場合、「lockip」の値は無視されます。 これは、ユーザーを覚えておくメカニズムがこの値に依存するためです。

"lockuser" （ロック・ユーザー）
- reCAPTCHAをユーザーにロックしますか？ False = reCAPTCHAの完了により、責任あるＩＰ（注：ユーザーではない）から発信されたすべてのリクエストへのアクセスが許可されます； クッキーとハッシュは使用されていません； ＩＰホワイトリストが使用されます。 True = reCAPTCHAの完了により、責任あるユーザー（注：ＩＰではない）から発信されたすべてのリクエストへのアクセスが許可されます； クッキーとハッシュはユーザーを思い出すために使用されます； ＩＰホワイトリストは使用されません（Default/デフォルルト）。

"sitekey" （サイト・キー）
- この値は、あなたのreCAPTCHAのための「site key」に対応している必要があり； これは、reCAPTCHAのダッシュボードの中に見つけることができます。

"secret" （シークレット）
- この値は、あなたのreCAPTCHAのための「secret key」に対応している必要があり； これは、reCAPTCHAのダッシュボードの中に見つけることができます。

"expiry" （シークレット）
- 「lockuser」が「true」とき（Default「デフォルルト」）、reCAPTCHAインスタンスの合格/不合格態を覚えておくために、将来のページリクエスト用、CIDRAMは、ハッシュを含む標準のHTTP Cookieを生成します； このハッシュは、同じハッシュを含む内部レコードに対応します； 将来のページリクエストでは、対応するハッシュを使用して合格/不合格の状態を認証します。 「lockuser」が「false」とき、要求を許可する必要があるかどうかを判断するために、ＩＰホワイトリストが使用されます； reCAPTCHAインスタンスが正常に渡されると、このホワイトリストにエントリが追加されます。 これらのクッキー、ハッシュ、ホワイトリストのエントリは何時間有効であるべきですか？ Default（デフォルルト） = ７２０（１ヶ月）。

"logfile" （ログ・ファイル）
- reCAPTCHA試行の記録。 ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

*有用な先端： あなたがしたい場合は、ログファイルの名前に日付/時刻情報を付加することができます、名前にこれらを含めることで:完全な年のため`{yyyy}`、省略された年のため`{yy}`、月`{mm}`、日`{dd}`、時間`{hh}`。*

*例:*
- *`logfile='recaptcha.{yyyy}-{mm}-{dd}-{hh}.txt'`*

#### "template_data" （テンプレート・データ、カテゴリ）
テンプレートとテーマ用のディレクティブと変数。

テンプレートのデータは、ユーザーに向けてアクセス拒否のメッセージをＨＴＭＬ形式でアウトプットする際に使用されます。 カスタムテーマを使っている場合は`template_custom.html`を使用して、そうでない場合は`template.html`を使用してＨＴＭＬアウトプットが生成されます。 設定ファイル内にあるこのセクション用の変数は、ＨＴＭＬアウトプットのために解析され、で囲まれた変数名は対応する変数データに置き換えられます。 例えば`foo="bar"`とすると、ＨＴＭＬアウトプット内の`<p>{foo}</p>`は`<p>bar</p>`となります。

"css_url" （シーエスエス・ユーアールエル）
- カスタムテーマ用のテンプレートファイルは、外部ＣＳＳプロパティーを使っています。 一方、デフォルトテーマは内部ＣＳＳです。 カスタムテーマを適用するためには、ＣＳＳファイルのパブリックＨＴＴＰアドレスを"css_url"変数を使って指定して下さい。 この変数が空白であれば、デフォルトテーマが適用されます。

---


### 7. <a name="SECTION7"></a>シグネチャ（署名）フォーマット

#### 7.0 基本原則

CIDRAMで使用されるシグネチャの形式と構造の説明は、カスタム・シグネチャ・ファイル内に記載されています。 詳細については、ドキュメントを参照してください。

すべてのＩＰｖ４シグネチャはこの形式に従います： `xxx.xxx.xxx.xxx/yy 「機能」 「パラメータ」`
- `xxx.xxx.xxx.xxx`は、ＣＩＤＲブロックの先頭を表します（ブロックの最初のＩＰアドレスのオクテット）。
- `yy`は、ブロックサイズを表します（１ー３２）。
- `「機能」`は、スクリプトにシグネチャの処理方法を指示します。
- `「パラメータ」`は、`「機能」`で必要、な追加情報を表します。

すべてのＩＰｖ６シグネチャはこの形式に従います： `xxxx:xxxx:xxxx:xxxx::xxxx/yy 「機能」 「パラメータ」`
- `xxxx:xxxx:xxxx:xxxx::xxxx`は、ＣＩＤＲブロックの先頭を表します（ブロックの最初のＩＰアドレスのオクテット）。 完全表記と省略表記の両方が可能です。 彼らはＩＰｖ６仕様に準拠する必要があります、1つの例外を除いて： CIDRAMでは、ＩＰｖ６アドレスは省略で始めることはできません。 例えば： `::1/128`は`0::1/128`、そして`::0/128`は`0::/128`と表す必要があります。
- `yy`は、ブロックサイズを表します（１ー１２８）。
- `「機能」`は、スクリプトにシグネチャの処理方法を指示します。
- `「パラメータ」`は、`「機能」`で必要、な追加情報を表します。

シグネチャファイルの改行はUnix標準を使用すべきです （`%0A`、`\n`）。 他の標準も使用できますが、推奨されません （例えば、Windowsの`%0D%0A`、`\r\n`、Macの`%0D`、`\r`、等）。 非UNIX改行は正規化されます。

正確で正しいＣＩＤＲ表記が必要です。 スクリプトは、不正確な表記（または、不正確な表記を伴うシグネチャ）を認識しません。 さらに、すべてのＣＩＤＲは、均等に割り切れる必要があります（例えば、`10.128.0.0`から`11.127.255.255`までのすべてをブロックしたい場合、`10.128.0.0/8`はスクリプトによって認識されません、しかし、`10.128.0.0/9`と`11.0.0.0/9`を組み合わせて使用するとは、スクリプトによって認識されます）。

スクリプトによって認識されないシグネチャファイル内のものは無視されます。 つまり、シグネチャファイルを破損することなく、ほぼすべてのデータをシグネチャファイルに安全に入れることができます。 シグネチャファイルのコメントは受け入れ可能です。 特殊な書式設定は必要ありません。 シェル形式のハッシュが推奨されますが、強制はされません（シェルスタイルのハッシングは、IDEやプレーンテキストエディタに役立ちます）。

「機能」の可能な値：
- Run
- Whitelist
- Greylist
- Deny

「Run」を使用すると、シグネチャがトリガーされると、スクリプトは`require_once`ステートメントによって（`「パラメータ」`値で指定されます）外部のPHPスクリプトの実行を試みます。 作業ディレクトリは「`/vault/`」ディレクトリです。

例： `127.0.0.0/8 Run example.php`

特定のＩＰ/ＣＩＤＲに対して特定のPHPコードを実行する場合に便利です。

「Whitelist」を使用すると、シグネチャがトリガーされると、スクリプトはすべての検出をリセットします（何かの検出があった場合）、テスト機能を終了します。 `「パラメータ」`は無視されます。 これは、ＩＰまたはＣＩＤＲをホワイトリストに登録するのと同じです。

例： `127.0.0.1/32 Whitelist`

「Greylist」を使用すると、シグネチャがトリガーされると、スクリプトはすべての検出をリセットします（何かの検出があった場合）、処理を続行するために次のシグネチャファイルにスキップする。 `「パラメータ」`は無視されます。

例： `127.0.0.1/32 Greylist`

「Deny」を使用すると、シグネチャがトリガーされると、保護されたページへのアクセスは拒否されます（ＩＰ/ＣＩＤＲがホワイトリストに登録されていない場合）。 「Deny」は、実際にＩＰアドレスとＣＩＤＲの範囲をブロックするために使用するものです。 「Deny」を使用するシグネチャがトリガーされると、「アクセス拒否」ページが生成され、保護されたページへのリクエストが終了します。

「Deny」によって受け入れられた`「パラメータ」`値は、「アクセス拒否」ページ出力に処理されます、要求されたページへのアクセスが拒否された理由として、クライアント/ユーザーに提供されます。 それは短くて簡単な文章にすることができます（なぜそれらをブロックすることを選択したのか説明するために）。 また、略語とすることもできます（事前準備された説明をクライアント/ユーザに提供する）。

あらかじめ用意された説明にはL10Nのサポートがあり、スクリプトで翻訳することができます。 翻訳は、スクリプト構成の`lang`ディレクティブを使用して指定した言語に基づいて行われます。 さらに、これらの短縮形の単語を使用している場合、`「パラメータ」`値に基づいて 「Deny」シグネチャを無視するようスクリプトに指示できます。 これは、スクリプト設定で指定されたディレクティブを介して行われます（それぞれの省略形に対応するディレクティブがあります）。 ただし、他の`「パラメータ」`値にはL10Nがサポートされていません（したがって、他の値は翻訳されません、そして構成によって制御可能ではない）。

略語：
- Bogon
- Cloud
- Generic
- Proxy
- Spam

#### 7.1 タグ

セクション名と「セクションタグ」を追加することにより、スクリプトに対する個々のセクションを識別することができます（以下の例を参照してください）。

```
# セクション１。
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud
4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
6.7.8.9/32 Deny Proxy
Tag: セクション１
```

セクションタグを終了し、シグネチャセクションが誤って識別されないようにするには、タグと前のセクションの間に少なくとも２つの改行が連続していることを確認してください。 タグなしシグネチャは、デフォルトで「ＩＰｖ４」または「ＩＰｖ６」のいずれかになります（どのタイプのシグネチャがトリガされているかに応じて）。

```
1.2.3.4/32 Deny Bogon
2.3.4.5/32 Deny Cloud

4.5.6.7/32 Deny Generic
5.6.7.8/32 Deny Spam
Tag: セクション１
```

上記の例で、`1.2.3.4/32`と`2.3.4.5/32`は、「ＩＰｖ４」でタグ付けされま；す一方、`4.5.6.7/32`と`5.6.7.8/32`は、「セクション１」でタグ付けされま。

「期限のタグ」を使用して、シグネチャの有効期限を指定することができます。 期限切れのタグがこの形式を使用します： 「年年年年.月月.日日」 （以下の例を参照してください）。

```
# セクション１。
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Expires: 2016.12.31
```

セクションタグと期限切れタグを組み合わせて使用することができ；両方はオプションです（以下の例を参照してください）。

```
# 例セクション.
1.2.3.4/32 Deny Generic
Tag: 例セクション
Expires: 2016.12.31
```

#### 7.2 YAML

##### 7.2.0 YAML基本原則

セクション固有の設定を定義するために、シンプルな形式のYAMLマークアップをシグネチャファイルで使用することができます。 これは、異なるシグネチャセクションに対して異なる設定を行う場合に便利です （例えば： サポートチケットのＥメールアドレスを指定したい場合は、しかし特定のセクションのみ； 特定のシグネチャでページリダイレクトをトリガーしたい場合は； reCAPTCHAで使用するためにシグネチャセクションをマークしたい場合は； 個々のシグネチャに基づいて、そして/または、シグネチャセクションに基づいて、ブロックされたアクセス試行を別々のファイルに記録したい場合は）。

シグネチャファイルでのYAMLマークアップの使用はオプションです（即ち、あなたが望むならそれを使うことができますが、そうする必要はありません）。 大部分の（しかしすべてではない）構成ディレクティブを活用することができます。

注意： CIDRAMにおけるYAMLマークアップの実装は非常に単純化されており、非常に制限されています。 これは、YAMLマークアップに精通した方法で、しかし公式仕様書に従ったり準拠したりすることはない、CIDRAMに固有の要件を満たすことを意図しています（他の実装と同じように動作しない可能性があり、そして他のプロジェクトには適していない可能性があります）。

CIDRAMでは、YAMLマークアップセグメントはスクリプトに対して３つのダッシュで（「---」）識別されます。 YAMLマークアップセグメントは、二重改行によってシグネチャセクションと一緒に終了します。 典型的なセグメントは、ＣＩＤＲとタグのリストの直後の行に３つのダッシュで構成され、続いて２次元のキーと値のペアのリストが続きます。 （１番目のディメンションは、設定ディレクティブのカテゴリです；２番目のディメンションは、設定ディレクティブです）。 以下の例を参照してください。

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

##### 7.2.1 reCAPTCHAで使用するためにシグネチャセクションをマークする方法。

「usemode」が０または１の場合、reCAPTCHAで使用するために、シグネチャセクションをマークする必要はありません（reCAPTCHAを使用するかどうかは既に決定されているためです）。

「usemode」が２の場合、reCAPTCHAで使用するためにシグネチャセクションをマークするには、そのシグネチャセクションのYAMLマーカーセグメントを含めてください（以下の例を参照してください）。

```
# このセクションでは、reCAPTCHAのを使用します。
1.2.3.4/32 Deny Generic
2.3.4.5/32 Deny Generic
Tag: reCAPTCHA-Enabled
---
recaptcha:
 enabled: true
```

注意： reCAPTCHAインスタンスは、reCAPTCHAが有効な場合にのみユーザーに提供されます（「usemode」が１のとき、または、「usemode」が２と「enabled」が「true」のとき）、そして、厳密に１つのシグネチャがトリガされた場合（より大きい数ない、より小さい数ない；複数のシグネチャがトリガーされた場合、reCAPTCHAインスタンスは提供されません）。

#### 7.3 補助

さらに、CIDRAMに特定のシグネチャセクションを完全に無視させたい場合、「`ignore.dat`」ファイルを使用して、無視するセクションを指定することができます。 新しい行に`Ignore`と書いてください、次に、スペース、次に、CIDRAMが無視するセクションの名前（以下の例を参照してください）。

```
Ignore セクション１
```

詳細については、カスタムシグネチャファイルを参照してください。

---


### 8. <a name="SECTION8"></a>よくある質問（FAQ）

#### 「シグネチャ」とは何ですか？

In the context of CIDRAM, a "signature" refers to data that acts as an indicator/identifier for something specific that we're looking for, usually an IP address or CIDR, and includes some instruction for CIDRAM, telling it the best way to respond when it encounters what we're looking for. A typical signature for CIDRAM looks something like this:

`1.2.3.4/32 Deny Generic`

Often (but not always), signatures will bundled together in groups, forming "signature sections", often accompanied by comments, markup, and/or related metadata that can be used to provide additional context for the signatures and/or further instruction.

#### <a name="WHAT_IS_A_CIDR"></a>「ＣＩＤＲ」とは何ですか？

"CIDR" is an acronym for "Classless Inter-Domain Routing" *[[1](https://ja.wikipedia.org/wiki/Classless_Inter-Domain_Routing), [2](http://whatismyipaddress.com/cidr)]*, and it's this acronym that's used as part of the name for this package, "CIDRAM", which is an acronym for "Classless Inter-Domain Routing Access Manager".

However, in the context of CIDRAM (such as, within this documentation, within discussions relating to CIDRAM, or within the CIDRAM language data), whenever a "CIDR" (singular) or "CIDRs" (plural) is mentioned or referred to (and thus whereby we use these words as nouns in their own right, as opposed to as acronyms), what's intended and meant by this is a subnet (or subnets), expressed using CIDR notation. The reason that CIDR (or CIDRs) is used instead of subnet (or subnets) is to make it clear that it's specifically subnets expressed using CIDR notation that's being referred to (because CIDR notation is just one of several different ways that subnets can be expressed). CIDRAM could, therefore, be considered a "subnet access manager".

Although this dual meaning of "CIDR" may present some ambiguity in some cases, this explanation, along with the context provided, should help to resolve such ambiguity.

#### 「偽陽性」とは何ですか？

一般化された文脈で簡単に説明、条件の状態をテストするときに、結果を参照する目的で、用語「偽陽性」（*または：偽陽性のエラー、虚報；* 英語： *false positive*; *false positive error*; *false alarm*）の意味は、結果は「陽性」のようです、しかし結果は間違いです（即ち、真の条件は「陽性/真」とみなされます、しかしそれは本当に「陰性/偽」です）。 「偽陽性」は「泣く狼」に類似していると考えることができます（その状態は群の近くに狼がいるかどうかである、真の条件は「偽/陰性」です、群れの近くに狼がないからです、しかし条件は「真/陽性」として報告されます、羊飼いが「狼！狼！」を叫んだからです）、または、医療検査に類似、患者が誤って診断されたとき。

いくつかの関連する用語は、「真陽性」、「真陰性」、と「偽陰性」です。 これらの用語が示す意味： 「真陽性」の意味は、テスト結果と真の条件が真です（即ち、「陽性」です）。 「真陰性」の意味は、テスト結果と真の条件が偽です（即ち、「陰性」です）。 「真陽性」と「真陰性」は「正しい推論」とみなされます。 「偽陽性」の反対は「偽陰性」です。 「偽陰性」の意味は、テスト結果が偽です（即ち、「陰性」です）、しかし、真の条件が本当に真です（即ち、「陽性」です）； 両方テスト結果と真の条件、が「真/陽性」すべきであるはずです。

CIDRAMの文脈で、これらの用語は、CIDRAMのシグネチャとそれらがブロックするものを指します。 CIDRAMが誤ってＩＰアドレスをブロックすると（例えば、不正確なシグネチャ、時代遅れのシグネチャなどによる）、我々はこのイベント「偽陽性」のを呼び出します。 CIDRAMがＩＰアドレスをブロックできなかった場合（例えば、予期せぬ脅威、シグネチャの欠落などによる）、我々はこのイベント「不在検出」のを呼び出します（「偽陰性」のアナログです）。

これは、以下の表に要約することができます。

&nbsp; | CIDRAMは、ＩＰアドレスをブロック必要がありません | CIDRAMは、ＩＰアドレスをブロック必要があります
---|---|---
CIDRAMは、ＩＰアドレスをブロックしません | 真陰性（正しい推論） | 不在検出（それは「偽陰性」と同じです）
CIDRAMは、ＩＰアドレスをブロックします | __偽陽性__ | 真陽性（正しい推論）

#### CIDRAMは国全体をブロックできますか？

はい。 これを達成する最も簡単な方法は、Macmathanが提供する国オプショナルブロックリストのいくつかをインストールします。 これはフロントエンドのアップデート・ページから直接行うことができます。 あるいは、フロントエンドを無効のままにしたい場合は、 **[国オプショナルブロックリストのダウンロードページ](https://macmathan.info/blocklists)** からダウンロードできます。 ダウンロード後、それらをvaultにアップロードする, 関連する設定ディレクティブで名前を挙げてください。

#### シグネチャはどれくらいの頻度でアップデイトされますか？

アップデイト頻度は、シグネチャファイルによって異なります。 CIDRAMのシグネチャファイルのすべてのメンテナーが頻繁にアップデイトを試みる、しかし、私たちの皆様には、他にもさまざまなコミットメントがあり、私たちはプロジェクトの外で生活しており、と誰も財政的に補償されていない、したがって、正確なアップデイトスケジュールは保証されません。 一般に、十分な時間があればシグネチャがアップデイトされます。 メンテナーは必要性と範囲間の変化の頻度に基づいて優先順位をつけようとする。 あなたが何かを提供できるのであれば、援助は常に高く評価されます。

#### CIDRAMを使用しているときに問題が発生しましたが、何をすべきかわかりません！ 助けてください！

- あなたは最新のソフトウェアバージョンを使用していますか？ あなたは最新のシグネチャファイルバージョンを使用していますか？ そうでない場合は、まずすべてをアップデイトしてください。 問題が解決しないかどうかをチェックしてください。 それが続く場合は、読んでください。
- あなたはドキュメンテーションをチェックしましたか？ もしそうでなければ、そうしてください。 ドキュメンテーションを使用して問題を解決できない場合は、引き続き読んでください。
- **[イシュー・ページ](https://github.com/Maikuolan/CIDRAM/issues)** をチェックしましたか？ 問題が以前に言及されているかどうかをチェックしてください。 提案、アイデア、ソリューションが提供されたかどうかをチェックしてください。
- **[Spambot Securityが提供するCIDRAMサポート・フォーラム](http://www.spambotsecurity.com/forum/viewforum.php?f=61)** をチェックしましたか？ 問題が以前に言及されているかどうかをチェックしてください。 提案、アイデア、ソリューションが提供されたかどうかをチェックしてください。
- 問題が解決しない場合は、教えてください。 イシュー・ページまたはサポート・フォーラムに関する新しいディスカッションを作成する。

#### 私はCIDRAMによってウェブサイトからブロックされています！ 助けてください！

CIDRAMは、ウェブサイト所有者が望ましくないトラフィックをブロックする手段を提供します、しかし、ウェブサイト所有者は、その使用方法を決定する必要があります。 シグネチャファイルに誤検出がある場合、訂正を行うことができる、しかし、 特定のウェブサイトからブロック解除されていることに関して、あなたはウェブサイト所有者に連絡する必要があります。 修正が行われると、更新が必要になります。 それ以外の場合は、問題を解決するのは彼らの責任です。 カスタム化と個人的な選択は、私たちのコントロールを完全に超えています。

#### 5.4.0より古いPHPバージョンでCIDRAMを使用したいと思います； 手伝ってくれますか？

いいえ。 PHP 5.4.0は2014年に公式EoL（「End of Life」/人生の終わり）に達しました。 長期的なセキュリティサポートは2015年に終了しました。 現在、それは2017であり、PHP 7.1.0はすでに利用可能です。 現在、PHP 5.4.0およびすべてのより新しいPHPバージョンでCIDRAMを使用するためのサポートが提供されています。 より古いPHPバージョンのサポートは提供されていません。

#### 複数のドメインを保護するために１つのCIDRAMインストールを使用できますか？

Yes. CIDRAM installations are not naturally locked to specific domains, and can therefore be used to protect multiple domains. Generally, we refer to CIDRAM installations protecting only one domain as "single-domain installations", and we refer to CIDRAM installations protecting multiple domains and/or sub-domains as "multi-domain installations". If you operate a multi-domain installation and need to use different sets of signature files for different domains, or need CIDRAM to be configured differently for different domains, it's possible to do this. After loading the configuration file (`config.ini`), CIDRAM will check for the existence of a "configuration overrides file" specific to the domain (or sub-domain) being requested (`the-domain-being-requested.tld.config.ini`), and if found, any configuration values defined by the configuration overrides file will be used for the execution instance instead of the configuration values defined by the configuration file. Configuration overrides files are identical to the configuration file, and at your discretion, may contain either the entirety of all configuration directives available to CIDRAM, or whichever small subsection required which differs from the values normally defined by the configuration file. Configuration overrides files are named according to the domain that they are intended for (so, for example, if you need a configuration overrides file for the domain, `http://www.some-domain.tld/`, its configuration overrides file should be named as `some-domain.tld.config.ini`, and should be placed within the vault alongside the configuration file, `config.ini`). The domain name for the execution instance is derived from the `HTTP_HOST` header of the request; "www" is ignored.

---


最終アップデート： 2017年4月28日。
