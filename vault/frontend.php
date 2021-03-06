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
 * This file: Front-end handler (last modified: 2018.09.02).
 */

/** Prevents execution from outside of CIDRAM. */
if (!defined('CIDRAM')) {
    die('[CIDRAM] This should not be accessed directly.');
}

/** Kill the script if the front-end functions file doesn't exist. */
if (!file_exists($CIDRAM['Vault'] . 'frontend_functions.php')) {
    header('Content-Type: text/plain');
    die('[CIDRAM] Front-end functions file missing! Please reinstall CIDRAM.');
}
/** Load the front-end functions file. */
require $CIDRAM['Vault'] . 'frontend_functions.php';

/** Load PHPMailer classes if they've been installed. */
if (file_exists($CIDRAM['Vault'] . '/phpmailer/PHPMailer.php')) {
    require $CIDRAM['Vault'] . '/phpmailer/PHPMailer.php';
    require $CIDRAM['Vault'] . '/phpmailer/Exception.php';
    require $CIDRAM['Vault'] . '/phpmailer/OAuth.php';
    require $CIDRAM['Vault'] . '/phpmailer/POP3.php';
    require $CIDRAM['Vault'] . '/phpmailer/SMTP.php';
}

/** Set page selector if not already set. */
if (empty($CIDRAM['QueryVars']['cidram-page'])) {
    $CIDRAM['QueryVars']['cidram-page'] = '';
}

/** Populate common front-end variables. */
$CIDRAM['FE'] = [

    /** Main front-end HTML template file. */
    'Template' => $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('frontend.html')),

    /** Populated by front-end JavaScript data as per needed. */
    'JS' => '',

    /** Populated by any other header data required for the request (usually nothing). */
    'OtherHead' => '',

    /** Default password hash ("password"). */
    'DefaultPassword' => '$2y$10$FPF5Im9MELEvF5AYuuRMSO.QKoYVpsiu1YU9aDClgrU57XtLof/dK',

    /** Current default language. */
    'FE_Lang' => $CIDRAM['Config']['general']['lang'],

    /** Font magnification. */
    'Magnification' => $CIDRAM['Config']['template_data']['Magnification'],

    /** Warns if maintenance mode is enabled. */
    'MaintenanceWarning' => (
        $CIDRAM['Config']['general']['maintenance_mode']
    ) ? "\n<div class=\"center\"><span class=\"txtRd\">" . $CIDRAM['lang']['state_maintenance_mode'] . '</span></div><hr />' : '',

    /** Define active configuration file. */
    'ActiveConfigFile' => !empty($CIDRAM['Overrides']) ? $CIDRAM['Domain'] . '.config.ini' : 'config.ini',

    /** Current time and date. */
    'DateTime' => $CIDRAM['TimeFormat']($CIDRAM['Now'], $CIDRAM['Config']['general']['timeFormat']),

    /** How the script identifies itself. */
    'ScriptIdent' => $CIDRAM['ScriptIdent'],

    /** Current default theme. */
    'theme' => $CIDRAM['Config']['template_data']['theme'],

    /** List of front-end users will be populated here. */
    'UserList' => "\n",

    /** List of front-end sessions will be populated here. */
    'SessionList' => "\n",

    /** Cache data will be populated here. */
    'Cache' => "\n",

    /**
     * The current user state.
     * -1 = Attempted and failed to log in.
     * 0 = Not logged in.
     * 1 = Logged in.
     * 2 = Logged in, but awaiting two-factor authentication.
     */
    'UserState' => 0,

    /** Taken from either $_POST['username'] or $_COOKIE['CIDRAM-ADMIN'] (the username claimed by the client). */
    'UserRaw' => '',

    /**
     * User permissions.
     * 0 = Not logged in, or awaiting two-factor authentication.
     * 1 = Complete access.
     * 2 = Logs access only.
     * 3 = Cronable.
     */
    'Permissions' => 0,

    /** Will be populated by messages reflecting the current request state. */
    'state_msg' => '',

    /** Will be populated by the current session data. */
    'ThisSession' => '',

    /** Will be populated by either [Log Out] or [Home | Log Out] links. */
    'bNav' => '&nbsp;',

    /** State reflecting whether the current request is cronable. */
    'CronMode' => !empty($_POST['CronMode']),

    /** The user agent of the current request. */
    'UA' => empty($_SERVER['HTTP_USER_AGENT']) ? '' : $_SERVER['HTTP_USER_AGENT'],

    /** The IP address of the current request. */
    'YourIP' => empty($_SERVER[$CIDRAM['IPAddr']]) ? '' : $_SERVER[$CIDRAM['IPAddr']],

    /** Asynchronous mode. */
    'ASYNC' => !empty($_POST['ASYNC']),

    /** Will be populated by the page title. */
    'FE_Title' => ''

];

/** Fetch pips data. */
$CIDRAM['Pips_Path'] = $CIDRAM['GetAssetPath']('pips.php', true);
if (!empty($CIDRAM['Pips_Path']) && is_readable($CIDRAM['Pips_Path'])) {
    require $CIDRAM['Pips_Path'];
}

/** Handle webfonts. */
if (empty($CIDRAM['Config']['general']['disable_webfonts'])) {
    $CIDRAM['FE']['Template'] = str_replace(['<!-- WebFont Begin -->', '<!-- WebFont End -->'], '', $CIDRAM['FE']['Template']);
} else {
    $CIDRAM['WebFontPos'] = [
        'Begin' => strpos($CIDRAM['FE']['Template'], '<!-- WebFont Begin -->'),
        'End' => strpos($CIDRAM['FE']['Template'], '<!-- WebFont End -->')
    ];
    $CIDRAM['FE']['Template'] = substr(
        $CIDRAM['FE']['Template'], 0, $CIDRAM['WebFontPos']['Begin']
    ) . substr(
        $CIDRAM['FE']['Template'], $CIDRAM['WebFontPos']['End'] + 20
    );
    unset($CIDRAM['WebFontPos']);
}

/** A fix for correctly displaying LTR/RTL text. */
if (empty($CIDRAM['lang']['textDir']) || $CIDRAM['lang']['textDir'] !== 'rtl') {
    $CIDRAM['lang']['textDir'] = 'ltr';
    $CIDRAM['FE']['FE_Align'] = 'left';
    $CIDRAM['FE']['FE_Align_Reverse'] = 'right';
    $CIDRAM['FE']['PIP_Input'] = $CIDRAM['FE']['PIP_Right'];
    $CIDRAM['FE']['Gradient_Degree'] = 90;
    $CIDRAM['FE']['Half_Border'] = 'solid solid none none';
} else {
    $CIDRAM['FE']['FE_Align'] = 'right';
    $CIDRAM['FE']['FE_Align_Reverse'] = 'left';
    $CIDRAM['FE']['PIP_Input'] = $CIDRAM['FE']['PIP_Left'];
    $CIDRAM['FE']['Gradient_Degree'] = 270;
    $CIDRAM['FE']['Half_Border'] = 'solid none none solid';
}

/** A simple passthru for non-private theme images and related data. */
if (!empty($CIDRAM['QueryVars']['cidram-asset'])) {

    $CIDRAM['Success'] = false;

    if (
        $CIDRAM['FileManager-PathSecurityCheck']($CIDRAM['QueryVars']['cidram-asset']) &&
        !preg_match('~[^\da-z._]~i', $CIDRAM['QueryVars']['cidram-asset'])
    ) {
        $CIDRAM['ThisAsset'] = $CIDRAM['GetAssetPath']($CIDRAM['QueryVars']['cidram-asset'], true);
        if (
            $CIDRAM['ThisAsset'] &&
            is_readable($CIDRAM['ThisAsset']) &&
            ($CIDRAM['ThisAssetDel'] = strrpos($CIDRAM['ThisAsset'], '.')) !== false
        ) {
            $CIDRAM['ThisAssetType'] = strtolower(substr($CIDRAM['ThisAsset'], $CIDRAM['ThisAssetDel'] + 1));
            if ($CIDRAM['ThisAssetType'] === 'jpeg') {
                $CIDRAM['ThisAssetType'] = 'jpg';
            }
            if (preg_match('/^(gif|jpg|png|webp)$/', $CIDRAM['ThisAssetType'])) {
                /** Set asset mime-type (images). */
                header('Content-Type: image/' . $CIDRAM['ThisAssetType']);
                $CIDRAM['Success'] = true;
            } elseif ($CIDRAM['ThisAssetType'] === 'js') {
                /** Set asset mime-type (JavaScript). */
                header('Content-Type: text/javascript');
                $CIDRAM['Success'] = true;
            }
            if ($CIDRAM['Success']) {
                if (!empty($CIDRAM['QueryVars']['theme'])) {
                    /** Prevents needlessly reloading static assets. */
                    header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($CIDRAM['ThisAsset'])));
                }
                /** Send asset data. */
                echo $CIDRAM['ReadFile']($CIDRAM['ThisAsset']);
            }
        }
    }

    if ($CIDRAM['Success']) {
        die;
    }
    unset($CIDRAM['ThisAssetType'], $CIDRAM['ThisAssetDel'], $CIDRAM['ThisAsset'], $CIDRAM['Success']);

}

/** A simple passthru for the front-end CSS. */
if ($CIDRAM['QueryVars']['cidram-page'] === 'css') {
    $CIDRAM['AssetPath'] = $CIDRAM['GetAssetPath']('frontend.css');
    /** Sets mime-type. */
    header('Content-Type: text/css');
    if (!empty($CIDRAM['QueryVars']['theme'])) {
        /** Prevents needlessly reloading static assets. */
        header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($CIDRAM['AssetPath'])));
    }
    /** Sends asset data. */
    echo $CIDRAM['ParseVars']($CIDRAM['lang'] + $CIDRAM['FE'], $CIDRAM['ReadFile']($CIDRAM['AssetPath']));
    die;
}

/** A simple passthru for the favicon. */
if ($CIDRAM['QueryVars']['cidram-page'] === 'favicon') {
    header('Content-Type: image/gif');
    echo base64_decode($CIDRAM['favicon']);
    die;
}

/** Set form target if not already set. */
$CIDRAM['FE']['FormTarget'] = empty($_POST['cidram-form-target']) ? '' : $_POST['cidram-form-target'];

/** Fetch user list, sessions list and the front-end cache. */
if (file_exists($CIDRAM['Vault'] . 'fe_assets/frontend.dat')) {
    $CIDRAM['FE']['FrontEndData'] = $CIDRAM['ReadFile']($CIDRAM['Vault'] . 'fe_assets/frontend.dat');
    $CIDRAM['FE']['Rebuild'] = false;
} else {
    $CIDRAM['FE']['FrontEndData'] = "USERS\n-----\nYWRtaW4=," . $CIDRAM['FE']['DefaultPassword'] . ",1\n\nSESSIONS\n--------\n\nCACHE\n-----\n";
    $CIDRAM['FE']['Rebuild'] = true;
}
$CIDRAM['FE']['UserListPos'] = strpos($CIDRAM['FE']['FrontEndData'], "USERS\n-----\n");
$CIDRAM['FE']['SessionListPos'] = strpos($CIDRAM['FE']['FrontEndData'], "SESSIONS\n--------\n");
$CIDRAM['FE']['CachePos'] = strpos($CIDRAM['FE']['FrontEndData'], "CACHE\n-----\n");
if ($CIDRAM['FE']['UserListPos'] !== false) {
    $CIDRAM['FE']['UserList'] = substr(
        $CIDRAM['FE']['FrontEndData'],
        $CIDRAM['FE']['UserListPos'] + 11,
        $CIDRAM['FE']['SessionListPos'] - $CIDRAM['FE']['UserListPos'] - 12
    );
}
if ($CIDRAM['FE']['SessionListPos'] !== false) {
    $CIDRAM['FE']['SessionList'] = substr(
        $CIDRAM['FE']['FrontEndData'],
        $CIDRAM['FE']['SessionListPos'] + 17,
        $CIDRAM['FE']['CachePos'] - $CIDRAM['FE']['SessionListPos'] - 18
    );
}
if ($CIDRAM['FE']['CachePos'] !== false) {
    $CIDRAM['FE']['Cache'] = substr(
        $CIDRAM['FE']['FrontEndData'],
        $CIDRAM['FE']['CachePos'] + 11
    );
}

/** Clear expired sessions. */
$CIDRAM['ClearExpired']($CIDRAM['FE']['SessionList'], $CIDRAM['FE']['Rebuild']);

/** Clear expired cache entries. */
$CIDRAM['ClearExpired']($CIDRAM['FE']['Cache'], $CIDRAM['FE']['Rebuild']);

/** Brute-force security check. */
if (($CIDRAM['LoginAttempts'] = (int)$CIDRAM['FECacheGet'](
    $CIDRAM['FE']['Cache'], 'LoginAttempts' . $_SERVER[$CIDRAM['IPAddr']]
)) && ($CIDRAM['LoginAttempts'] >= $CIDRAM['Config']['general']['max_login_attempts'])) {
    header('Content-Type: text/plain');
    die('[CIDRAM] ' . $CIDRAM['lang']['max_login_attempts_exceeded']);
}

/** Brute-force security check (2FA). */
if (($CIDRAM['Failed2FA'] = (int)$CIDRAM['FECacheGet'](
    $CIDRAM['FE']['Cache'], 'Failed2FA' . $_SERVER[$CIDRAM['IPAddr']]
)) && ($CIDRAM['Failed2FA'] >= $CIDRAM['Config']['general']['max_login_attempts'])) {
    header('Content-Type: text/plain');
    die('[CIDRAM] ' . $CIDRAM['lang']['max_login_attempts_exceeded']);
}

/** Attempt to log in the user. */
if ($CIDRAM['FE']['FormTarget'] === 'login' || $CIDRAM['FE']['CronMode']) {
    if (!empty($_POST['username']) && empty($_POST['password'])) {
        $CIDRAM['FE']['UserState'] = -1;
        $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_login_password_field_empty'];
    } elseif (empty($_POST['username']) && !empty($_POST['password'])) {
        $CIDRAM['FE']['UserState'] = -1;
        $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_login_username_field_empty'];
    } elseif (!empty($_POST['username']) && !empty($_POST['password'])) {

        $CIDRAM['FE']['UserState'] = -1;
        $CIDRAM['FE']['UserRaw'] = $_POST['username'];
        $CIDRAM['FE']['User'] = base64_encode($CIDRAM['FE']['UserRaw']);
        $CIDRAM['FE']['UserPos'] = strpos($CIDRAM['FE']['UserList'], "\n" . $CIDRAM['FE']['User'] . ',');

        if ($CIDRAM['FE']['UserPos'] !== false) {
            $CIDRAM['FE']['UserOffset'] = $CIDRAM['FE']['UserPos'] + strlen($CIDRAM['FE']['User']) + 2;
            $CIDRAM['FE']['Password'] = substr(
                $CIDRAM['FE']['UserList'],
                $CIDRAM['FE']['UserOffset'],
                strpos($CIDRAM['FE']['UserList'], "\n", $CIDRAM['FE']['UserOffset']) - $CIDRAM['FE']['UserOffset']
            );
            $CIDRAM['FE']['Permissions'] = (int)substr($CIDRAM['FE']['Password'], -1);
            $CIDRAM['FE']['Password'] = substr($CIDRAM['FE']['Password'], 0, -2);
            if (password_verify($_POST['password'], $CIDRAM['FE']['Password'])) {
                $CIDRAM['FECacheRemove'](
                    $CIDRAM['FE']['Cache'], $CIDRAM['FE']['Rebuild'], 'LoginAttempts' . $_SERVER[$CIDRAM['IPAddr']]
                );
                if (($CIDRAM['FE']['Permissions'] === 3 && (
                    !$CIDRAM['FE']['CronMode'] || substr($CIDRAM['FE']['UA'], 0, 10) !== 'Cronable v'
                )) || !($CIDRAM['FE']['Permissions'] > 0 && $CIDRAM['FE']['Permissions'] <= 3)) {
                    $CIDRAM['FE']['Permissions'] = 0;
                    $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_login_wrong_endpoint'];
                } else {
                    if (!$CIDRAM['FE']['CronMode']) {
                        $CIDRAM['FE']['SessionKey'] = md5($CIDRAM['GenerateSalt']());
                        $CIDRAM['FE']['Cookie'] = $_POST['username'] . $CIDRAM['FE']['SessionKey'];
                        setcookie('CIDRAM-ADMIN', $CIDRAM['FE']['Cookie'], $CIDRAM['Now'] + 604800, '/', $CIDRAM['HTTP_HOST'], false, true);
                        $CIDRAM['FE']['ThisSession'] = $CIDRAM['FE']['User'] . ',' . password_hash(
                            $CIDRAM['FE']['SessionKey'], $CIDRAM['DefaultAlgo']
                        ) . ',' . ($CIDRAM['Now'] + 604800) . "\n";
                        $CIDRAM['FE']['SessionList'] .= $CIDRAM['FE']['ThisSession'];

                        /** Prepare 2FA email. */
                        if ($CIDRAM['Config']['PHPMailer']['Enable2FA'] && preg_match('~^.+@.+$~', $CIDRAM['FE']['UserRaw'])) {
                            $CIDRAM['2FA-State'] = ['Number' => $CIDRAM['2FA-Number']()];
                            $CIDRAM['2FA-State']['Hash'] = password_hash($CIDRAM['2FA-State']['Number'], $CIDRAM['DefaultAlgo']);
                            $CIDRAM['FECacheAdd'](
                                $CIDRAM['FE']['Cache'],
                                $CIDRAM['FE']['Rebuild'],
                                '2FA-State:' . $CIDRAM['FE']['Cookie'],
                                '0' . $CIDRAM['2FA-State']['Hash'],
                                $CIDRAM['Now'] + 600
                            );
                            $CIDRAM['2FA-State']['Template'] = sprintf(
                                $CIDRAM['lang']['msg_template_2fa'],
                                $CIDRAM['FE']['UserRaw'],
                                $CIDRAM['2FA-State']['Number']
                            );
                            if (preg_match('~^[^<>]+<[^<>]+>$~', $CIDRAM['FE']['UserRaw'])) {
                                $CIDRAM['2FA-State']['Name'] = trim(preg_replace('~^([^<>]+)<[^<>]+>$~', '\1', $CIDRAM['FE']['UserRaw']));
                                $CIDRAM['2FA-State']['Address'] = trim(preg_replace('~^[^<>]+<([^<>]+)>$~', '\1', $CIDRAM['FE']['UserRaw']));
                            } else {
                                $CIDRAM['2FA-State']['Name'] = trim($CIDRAM['FE']['UserRaw']);
                                $CIDRAM['2FA-State']['Address'] = $CIDRAM['2FA-State']['Name'];
                            }
                            $CIDRAM['SendEmail'](
                                [['Name' => $CIDRAM['2FA-State']['Name'], 'Address' => $CIDRAM['2FA-State']['Address']]],
                                $CIDRAM['lang']['msg_subject_2fa'],
                                $CIDRAM['2FA-State']['Template'],
                                strip_tags($CIDRAM['2FA-State']['Template'])
                            );
                            $CIDRAM['FE']['UserState'] = 2;
                            unset($CIDRAM['2FA-State']);
                        } else {
                            $CIDRAM['FE']['UserState'] = 1;
                        }

                    }
                    if ($CIDRAM['FE']['UserState'] !== 1) {
                        $CIDRAM['FE']['Permissions'] = 0;
                    }
                    $CIDRAM['FE']['Rebuild'] = true;
                }
            } else {
                $CIDRAM['FE']['Permissions'] = 0;
                $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_login_invalid_password'];
            }
        } else {
            $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_login_invalid_username'];
        }

    }

    if ($CIDRAM['FE']['state_msg']) {
        $CIDRAM['LoginAttempts']++;
        $CIDRAM['TimeToAdd'] = ($CIDRAM['LoginAttempts'] > 4) ? ($CIDRAM['LoginAttempts'] - 4) * 86400 : 86400;
        $CIDRAM['FECacheAdd'](
            $CIDRAM['FE']['Cache'],
            $CIDRAM['FE']['Rebuild'],
            'LoginAttempts' . $_SERVER[$CIDRAM['IPAddr']],
            $CIDRAM['LoginAttempts'],
            $CIDRAM['Now'] + $CIDRAM['TimeToAdd']
        );
        if ($CIDRAM['Config']['general']['FrontEndLog']) {
            $CIDRAM['LoggerMessage'] = $CIDRAM['FE']['state_msg'];
        }
        if (!$CIDRAM['FE']['CronMode']) {
            $CIDRAM['FE']['state_msg'] = '<div class="txtRd">' . $CIDRAM['FE']['state_msg'] . '<br /><br /></div>';
        }
    } elseif ($CIDRAM['Config']['general']['FrontEndLog']) {
        $CIDRAM['LoggerMessage'] = (
            $CIDRAM['Config']['PHPMailer']['Enable2FA'] &&
            $CIDRAM['FE']['Permissions'] === 0
        ) ? $CIDRAM['lang']['state_logged_in_2fa_pending'] : $CIDRAM['lang']['state_logged_in'];
    }

    /** Handle front-end logging. */
    $CIDRAM['FELogger']($_SERVER[$CIDRAM['IPAddr']], (
        empty($_POST['username']) ? '' : $_POST['username']
    ), empty($CIDRAM['LoggerMessage']) ? '' : $CIDRAM['LoggerMessage']);
    unset($CIDRAM['LoggerMessage']);
}

/** Determine whether the user has logged in. */
elseif (!empty($_COOKIE['CIDRAM-ADMIN'])) {

    $CIDRAM['FE']['UserState'] = -1;
    $CIDRAM['FE']['SessionKey'] = substr($_COOKIE['CIDRAM-ADMIN'], -32);
    $CIDRAM['FE']['UserRaw'] = substr($_COOKIE['CIDRAM-ADMIN'], 0, -32);
    $CIDRAM['FE']['User'] = base64_encode($CIDRAM['FE']['UserRaw']);
    $CIDRAM['FE']['SessionOffset'] = 0;

    if (!empty($CIDRAM['FE']['SessionKey']) && !empty($CIDRAM['FE']['User'])) {
        $CIDRAM['FE']['UserLen'] = strlen($CIDRAM['FE']['User']);
        while (($CIDRAM['FE']['SessionPos'] = strpos(
            $CIDRAM['FE']['SessionList'],
            "\n" . $CIDRAM['FE']['User'],
            $CIDRAM['FE']['SessionOffset']
        )) !== false) {
            $CIDRAM['FE']['SessionOffset'] = $CIDRAM['FE']['SessionPos'] + $CIDRAM['FE']['UserLen'] + 2;
            $CIDRAM['FE']['SessionEntry'] = substr(
                $CIDRAM['FE']['SessionList'],
                $CIDRAM['FE']['SessionOffset'],
                $CIDRAM['ZeroMin'](strpos(
                    $CIDRAM['FE']['SessionList'], "\n", $CIDRAM['FE']['SessionOffset']
                ), $CIDRAM['FE']['SessionOffset'] * -1)
            );
            $CIDRAM['FE']['SEDelimiter'] = strrpos($CIDRAM['FE']['SessionEntry'], ',');
            if ($CIDRAM['FE']['SEDelimiter'] !== false) {
                $CIDRAM['FE']['Expiry'] = (int)substr($CIDRAM['FE']['SessionEntry'], $CIDRAM['FE']['SEDelimiter'] + 1);
                $CIDRAM['FE']['UserHash'] = substr($CIDRAM['FE']['SessionEntry'], 0, $CIDRAM['FE']['SEDelimiter']);
            }
            if (
                !empty($CIDRAM['FE']['Expiry']) &&
                !empty($CIDRAM['FE']['UserHash']) &&
                ($CIDRAM['FE']['Expiry'] > $CIDRAM['Now']) &&
                password_verify($CIDRAM['FE']['SessionKey'], $CIDRAM['FE']['UserHash'])
            ) {
                $CIDRAM['FE']['UserPos'] = strpos($CIDRAM['FE']['UserList'], "\n" . $CIDRAM['FE']['User'] . ',');
                if ($CIDRAM['FE']['UserPos'] !== false) {
                    $CIDRAM['FE']['ThisSession'] = $CIDRAM['FE']['User'] . ',' . $CIDRAM['FE']['SessionEntry'] . "\n";
                    $CIDRAM['FE']['UserOffset'] = $CIDRAM['FE']['UserPos'] + $CIDRAM['FE']['UserLen'] + 2;
                    $CIDRAM['FE']['Permissions'] = (int)substr(substr(
                        $CIDRAM['FE']['UserList'],
                        $CIDRAM['FE']['UserOffset'],
                        strpos($CIDRAM['FE']['UserList'], "\n", $CIDRAM['FE']['UserOffset']) - $CIDRAM['FE']['UserOffset']
                    ), -1);

                    /** Handle 2FA stuff here. */
                    if ($CIDRAM['Config']['PHPMailer']['Enable2FA'] && preg_match('~^.+@.+$~', $CIDRAM['FE']['UserRaw'])) {
                        $CIDRAM['2FA-State'] = $CIDRAM['FECacheGet'](
                            $CIDRAM['FE']['Cache'],
                            '2FA-State:' . $_COOKIE['CIDRAM-ADMIN']
                        );
                        $CIDRAM['FE']['UserState'] = ((int)$CIDRAM['2FA-State'] === 1) ? 1 : 2;
                        if ($CIDRAM['FE']['UserState'] === 2 && $CIDRAM['FE']['FormTarget'] === '2fa' && !empty($_POST['2fa'])) {

                            /** User has submitted a 2FA code. Attempt to verify it. */
                            if (password_verify($_POST['2fa'], substr($CIDRAM['2FA-State'], 1))) {
                                $CIDRAM['FECacheAdd'](
                                    $CIDRAM['FE']['Cache'],
                                    $CIDRAM['FE']['Rebuild'],
                                    '2FA-State:' . $_COOKIE['CIDRAM-ADMIN'],
                                    '1',
                                    $CIDRAM['Now'] + 604800
                                );
                                $CIDRAM['FE']['UserState'] = 1;
                            }

                        }
                        unset($CIDRAM['2FA-State']);
                    } else {
                        $CIDRAM['FE']['UserState'] = 1;
                    }

                    /** Revert permissions if not authenticated. */
                    if ($CIDRAM['FE']['UserState'] !== 1) {
                        $CIDRAM['FE']['Permissions'] = 0;
                    }
                }
                break;
            }
        }
    }

    /** In case of 2FA form submission. */
    if ($CIDRAM['FE']['FormTarget'] === '2fa' && !empty($_POST['2fa'])) {
        if ($CIDRAM['FE']['UserState'] === 2) {
            $CIDRAM['Failed2FA']++;
            $CIDRAM['TimeToAdd'] = ($CIDRAM['Failed2FA'] > 4) ? ($CIDRAM['Failed2FA'] - 4) * 86400 : 86400;
            $CIDRAM['FECacheAdd'](
                $CIDRAM['FE']['Cache'],
                $CIDRAM['FE']['Rebuild'],
                'Failed2FA' . $_SERVER[$CIDRAM['IPAddr']],
                $CIDRAM['Failed2FA'],
                $CIDRAM['Now'] + $CIDRAM['TimeToAdd']
            );
            if ($CIDRAM['Config']['general']['FrontEndLog']) {
                $CIDRAM['FELogger']($_SERVER[$CIDRAM['IPAddr']], $CIDRAM['FE']['UserRaw'], $CIDRAM['lang']['response_2fa_invalid']);
            }
            $CIDRAM['FE']['state_msg'] = '<div class="txtRd">' . $CIDRAM['lang']['response_2fa_invalid'] . '<br /><br /></div>';
        } else {
            $CIDRAM['FECacheRemove'](
                $CIDRAM['FE']['Cache'], $CIDRAM['FE']['Rebuild'], 'Failed2FA' . $_SERVER[$CIDRAM['IPAddr']]
            );
            if ($CIDRAM['Config']['general']['FrontEndLog']) {
                $CIDRAM['FELogger']($_SERVER[$CIDRAM['IPAddr']], $CIDRAM['FE']['UserRaw'], $CIDRAM['lang']['response_2fa_valid']);
            }
        }
    }

}

/** The user is attempting an asynchronous request without adequate permissions. */
if ($CIDRAM['FE']['UserState'] !== 1 && $CIDRAM['FE']['ASYNC']) {
    header('HTTP/1.0 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    header('Status: 403 Forbidden');
    die($CIDRAM['lang']['state_async_deny']);
}

/** Only execute this code block for users that are logged in or awaiting two-factor authentication. */
if (($CIDRAM['FE']['UserState'] === 1 || $CIDRAM['FE']['UserState'] === 2) && !$CIDRAM['FE']['CronMode']) {

    if ($CIDRAM['QueryVars']['cidram-page'] === 'logout') {

        /** Log out the user. */
        $CIDRAM['FE']['SessionList'] = str_ireplace($CIDRAM['FE']['ThisSession'], '', $CIDRAM['FE']['SessionList']);
        $CIDRAM['FE']['ThisSession'] = '';
        $CIDRAM['FE']['Rebuild'] = true;
        $CIDRAM['FE']['UserState'] = 0;
        $CIDRAM['FE']['Permissions'] = 0;
        setcookie('CIDRAM-ADMIN', '', -1, '/', $CIDRAM['HTTP_HOST'], false, true);
        $CIDRAM['FECacheRemove']($CIDRAM['FE']['Cache'], $CIDRAM['FE']['Rebuild'], '2FA-State:' . $_COOKIE['CIDRAM-ADMIN']);
        $CIDRAM['FELogger']($_SERVER[$CIDRAM['IPAddr']], $CIDRAM['FE']['UserRaw'], $CIDRAM['lang']['state_logged_out']);

    }

    /** If the user has complete access. */
    if ($CIDRAM['FE']['Permissions'] === 1) {

        $CIDRAM['FE']['nav'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_nav_complete_access.html'))
        );

    /** If the user has logs access only. */
    } elseif ($CIDRAM['FE']['Permissions'] === 2) {

        $CIDRAM['FE']['nav'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_nav_logs_access_only.html'))
        );

    }

}

$CIDRAM['FE']['bNavBR'] = ($CIDRAM['FE']['UserState'] === 1) ? '<br /><br />' : '<br />';

/** The user hasn't logged in, or hasn't authenticated yet. */
if ($CIDRAM['FE']['UserState'] !== 1 && !$CIDRAM['FE']['CronMode']) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_login'], $CIDRAM['lang']['tip_login'], false);

    if ($CIDRAM['FE']['UserState'] === 2) {

        /** Provide an option for the user to log out instead, if they'd prefer. */
        $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_logout'];

        /** Show them the two-factor authentication page. */
        $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_2fa.html'))
        );

    } else {

        /** Show them the login page. */
        $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_login.html'))
        );

    }

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/**
 * The user has logged in, but hasn't selected anything to view. Show them the
 * front-end home page.
 */
elseif ($CIDRAM['QueryVars']['cidram-page'] === '' && !$CIDRAM['FE']['CronMode']) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_home'], $CIDRAM['lang']['tip_home'], false);

    /** CIDRAM version used. */
    $CIDRAM['FE']['ScriptVersion'] = $CIDRAM['ScriptVersion'];

    /** PHP version used. */
    $CIDRAM['FE']['info_php'] = PHP_VERSION;

    /** SAPI used. */
    $CIDRAM['FE']['info_sapi'] = php_sapi_name();

    /** Operating system used. */
    $CIDRAM['FE']['info_os'] = php_uname();

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_logout'];

    /** Build repository backup locations information. */
    $CIDRAM['FE']['BackupLocations'] = implode(' | ', [
        '<a href="https://bitbucket.org/Maikuolan/cidram">BitBucket</a>',
        '<a href="https://sourceforge.net/projects/cidram/">SourceForge</a>'
    ]);

    /** Where to find remote version information? */
    $CIDRAM['RemoteVerPath'] = 'https://raw.githubusercontent.com/Maikuolan/Compatibility-Charts/gh-pages/';

    /** Fetch remote CIDRAM version information and cache it if necessary. */
    if (($CIDRAM['Remote-YAML-CIDRAM'] = $CIDRAM['FECacheGet']($CIDRAM['FE']['Cache'], 'cidram-ver.yaml')) === false) {
        $CIDRAM['Remote-YAML-CIDRAM'] = $CIDRAM['Request']($CIDRAM['RemoteVerPath'] . 'cidram-ver.yaml', false, 8);
        $CIDRAM['FECacheAdd']($CIDRAM['FE']['Cache'], $CIDRAM['FE']['Rebuild'], 'cidram-ver.yaml', $CIDRAM['Remote-YAML-CIDRAM'] ?: '-', $CIDRAM['Now'] + 86400);
    }

    /** Process remote CIDRAM version information. */
    if (empty($CIDRAM['Remote-YAML-CIDRAM'])) {

        /** CIDRAM latest stable. */
        $CIDRAM['FE']['info_cidram_stable'] = $CIDRAM['lang']['response_error'];
        /** CIDRAM latest unstable. */
        $CIDRAM['FE']['info_cidram_unstable'] = $CIDRAM['lang']['response_error'];
        /** CIDRAM branch latest stable. */
        $CIDRAM['FE']['info_cidram_branch'] = $CIDRAM['lang']['response_error'];

    } else {

        $CIDRAM['Remote-YAML-CIDRAM-Array'] = [];
        $CIDRAM['YAML']($CIDRAM['Remote-YAML-CIDRAM'], $CIDRAM['Remote-YAML-CIDRAM-Array']);

        /** CIDRAM latest stable. */
        $CIDRAM['FE']['info_cidram_stable'] = empty($CIDRAM['Remote-YAML-CIDRAM-Array']['Stable']) ?
            $CIDRAM['lang']['response_error'] : $CIDRAM['Remote-YAML-CIDRAM-Array']['Stable'];
        /** CIDRAM latest unstable. */
        $CIDRAM['FE']['info_cidram_unstable'] = empty($CIDRAM['Remote-YAML-CIDRAM-Array']['Unstable']) ?
            $CIDRAM['lang']['response_error'] : $CIDRAM['Remote-YAML-CIDRAM-Array']['Unstable'];
        /** CIDRAM branch latest stable. */
        if ($CIDRAM['ThisBranch'] = substr($CIDRAM['FE']['ScriptVersion'], 0, strpos($CIDRAM['FE']['ScriptVersion'], '.') ?: 0)) {
            $CIDRAM['ThisBranch'] = 'v' . ($CIDRAM['ThisBranch'] ?: 1);
            $CIDRAM['FE']['info_cidram_branch'] = empty($CIDRAM['Remote-YAML-CIDRAM-Array']['Branch'][$CIDRAM['ThisBranch']]['Latest']) ?
                $CIDRAM['lang']['response_error'] : $CIDRAM['Remote-YAML-CIDRAM-Array']['Branch'][$CIDRAM['ThisBranch']]['Latest'];
        } else {
            $CIDRAM['FE']['info_php_branch'] = $CIDRAM['lang']['response_error'];
        }

    }

    /** Cleanup. */
    unset($CIDRAM['Remote-YAML-CIDRAM-Array'], $CIDRAM['Remote-YAML-CIDRAM']);

    /** Fetch remote PHP version information and cache it if necessary. */
    if (($CIDRAM['Remote-YAML-PHP'] = $CIDRAM['FECacheGet']($CIDRAM['FE']['Cache'], 'php-ver.yaml')) === false) {
        $CIDRAM['Remote-YAML-PHP'] = $CIDRAM['Request']($CIDRAM['RemoteVerPath'] . 'php-ver.yaml', false, 8);
        $CIDRAM['FECacheAdd']($CIDRAM['FE']['Cache'], $CIDRAM['FE']['Rebuild'], 'php-ver.yaml', $CIDRAM['Remote-YAML-PHP'] ?: '-', $CIDRAM['Now'] + 86400);
    }

    /** Process remote PHP version information. */
    if (empty($CIDRAM['Remote-YAML-PHP'])) {

        /** PHP latest stable. */
        $CIDRAM['FE']['info_php_stable'] = $CIDRAM['lang']['response_error'];
        /** PHP latest unstable. */
        $CIDRAM['FE']['info_php_unstable'] = $CIDRAM['lang']['response_error'];
        /** PHP branch latest stable. */
        $CIDRAM['FE']['info_php_branch'] = $CIDRAM['lang']['response_error'];

    } else {

        $CIDRAM['Remote-YAML-PHP-Array'] = [];
        $CIDRAM['YAML']($CIDRAM['Remote-YAML-PHP'], $CIDRAM['Remote-YAML-PHP-Array']);

        /** PHP latest stable. */
        $CIDRAM['FE']['info_php_stable'] = empty($CIDRAM['Remote-YAML-PHP-Array']['Stable']) ?
            $CIDRAM['lang']['response_error'] : $CIDRAM['Remote-YAML-PHP-Array']['Stable'];
        /** PHP latest unstable. */
        $CIDRAM['FE']['info_php_unstable'] = empty($CIDRAM['Remote-YAML-PHP-Array']['Unstable']) ?
            $CIDRAM['lang']['response_error'] : $CIDRAM['Remote-YAML-PHP-Array']['Unstable'];
        /** PHP branch latest stable. */
        if ($CIDRAM['ThisBranch'] = substr(PHP_VERSION, 0, strpos(PHP_VERSION, '.') ?: 0)) {
            $CIDRAM['ThisBranch'] .= substr(PHP_VERSION, strlen($CIDRAM['ThisBranch']) + 1, strpos(PHP_VERSION, '.', strlen($CIDRAM['ThisBranch'])) ?: 0);
            $CIDRAM['ThisBranch'] = 'php' . $CIDRAM['ThisBranch'];
            $CIDRAM['FE']['info_php_branch'] = empty($CIDRAM['Remote-YAML-PHP-Array']['Branch'][$CIDRAM['ThisBranch']]['Latest']) ?
                $CIDRAM['lang']['response_error'] : $CIDRAM['Remote-YAML-PHP-Array']['Branch'][$CIDRAM['ThisBranch']]['Latest'];
            $CIDRAM['ForceVersionWarning'] = (!empty($CIDRAM['Remote-YAML-PHP-Array']['Branch'][$CIDRAM['ThisBranch']]['WarnMin']) && (
                $CIDRAM['Remote-YAML-PHP-Array']['Branch'][$CIDRAM['ThisBranch']]['WarnMin'] === '*' ||
                $CIDRAM['VersionCompare'](PHP_VERSION, $CIDRAM['Remote-YAML-PHP-Array']['Branch'][$CIDRAM['ThisBranch']]['WarnMin'])
            ));
        } else {
            $CIDRAM['FE']['info_php_branch'] = $CIDRAM['lang']['response_error'];
        }

    }

    /** Cleanup. */
    unset($CIDRAM['Remote-YAML-PHP-Array'], $CIDRAM['Remote-YAML-PHP'], $CIDRAM['ThisBranch'], $CIDRAM['RemoteVerPath']);

    /** Process warnings. */
    $CIDRAM['FE']['Warnings'] = '';
    if (($CIDRAM['FE']['VersionWarning'] = $CIDRAM['VersionWarning']()) > 0) {
        if ($CIDRAM['FE']['VersionWarning'] >= 2) {
            $CIDRAM['FE']['VersionWarning'] = $CIDRAM['FE']['VersionWarning'] % 2;
            $CIDRAM['FE']['Warnings'] .= '<li><a href="https://www.cvedetails.com/version-list/74/128/1/PHP-PHP.html">' . $CIDRAM['lang']['warning_php_2'] . '</a></li>';
        }
        if ($CIDRAM['FE']['VersionWarning'] >= 1) {
            $CIDRAM['FE']['Warnings'] .= '<li><a href="https://secure.php.net/supported-versions.php">' . $CIDRAM['lang']['warning_php_1'] . '</a></li>';
        }
    }
    if (empty($CIDRAM['Config']['signatures']['ipv4']) && empty($CIDRAM['Config']['signatures']['ipv6'])) {
        $CIDRAM['FE']['Warnings'] .= '<li>' . $CIDRAM['lang']['warning_signatures_1'] . '</li>';
    }
    if ($CIDRAM['FE']['Warnings']) {
        $CIDRAM['FE']['Warnings'] = '<hr />' . $CIDRAM['lang']['warning'] . '<br /><div class="txtRd"><ul>' . $CIDRAM['FE']['Warnings'] . '</ul></div>';
    }

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_home.html'))
    );

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** A simple passthru for the file manager icons. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'icon' && $CIDRAM['FE']['Permissions'] === 1) {

    if (
        !empty($CIDRAM['QueryVars']['file']) &&
        $CIDRAM['FileManager-PathSecurityCheck']($CIDRAM['QueryVars']['file']) &&
        file_exists($CIDRAM['Vault'] . $CIDRAM['QueryVars']['file']) &&
        is_readable($CIDRAM['Vault'] . $CIDRAM['QueryVars']['file'])
    ) {
        header('Content-Type: image/x-icon');
        echo $CIDRAM['ReadFile']($CIDRAM['Vault'] . $CIDRAM['QueryVars']['file']);
    }

    elseif (!empty($CIDRAM['QueryVars']['icon'])) {

        $CIDRAM['Icons_Handler_Path'] = $CIDRAM['GetAssetPath']('icons.php');
        if (is_readable($CIDRAM['Icons_Handler_Path'])) {

            /** Fetch file manager icons data. */
            require $CIDRAM['Icons_Handler_Path'];

            /** Set mime-type. */
            header('Content-Type: image/gif');

            /** Prevents needlessly reloading static assets. */
            if (!empty($CIDRAM['QueryVars']['theme'])) {
                header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($CIDRAM['Icons_Handler_Path'])));
            }

            /** Send icon data. */
            if (!empty($CIDRAM['Icons'][$CIDRAM['QueryVars']['icon']])) {
                echo gzinflate(base64_decode($CIDRAM['Icons'][$CIDRAM['QueryVars']['icon']]));
            } elseif (!empty($CIDRAM['Icons']['unknown'])) {
                echo gzinflate(base64_decode($CIDRAM['Icons']['unknown']));
            }

        }

    }

    die;

}

/** A simple passthru for the flags CSS. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'flags' && $CIDRAM['FE']['Permissions'] && file_exists($CIDRAM['Vault'] . 'fe_assets/flags.css')) {
    /** Sets mime-type. */
    header('Content-Type: text/css');
    /** Prevents needlessly reloading static assets. */
    header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($CIDRAM['Vault'] . 'fe_assets/flags.css')));
    /** Sends asset data. */
    echo $CIDRAM['ReadFile']($CIDRAM['Vault'] . 'fe_assets/flags.css');
    die;
}

/** Accounts. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'accounts' && $CIDRAM['FE']['Permissions'] === 1) {

    /** $_POST overrides for mobile display. */
    if (!empty($_POST['username']) && !empty($_POST['do_mob']) && (!empty($_POST['password_mob']) || $_POST['do_mob'] == 'delete-account')) {
        $_POST['do'] = $_POST['do_mob'];
    }
    if (empty($_POST['username']) && !empty($_POST['username_mob'])) {
        $_POST['username'] = $_POST['username_mob'];
    }
    if (empty($_POST['permissions']) && !empty($_POST['permissions_mob'])) {
        $_POST['permissions'] = $_POST['permissions_mob'];
    }
    if (empty($_POST['password']) && !empty($_POST['password_mob'])) {
        $_POST['password'] = $_POST['password_mob'];
    }

    /** A form has been submitted. */
    if ($CIDRAM['FE']['FormTarget'] === 'accounts' && !empty($_POST['do'])) {

        /** Create a new account. */
        if ($_POST['do'] === 'create-account' && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['permissions'])) {
            $CIDRAM['FE']['NewUser'] = $_POST['username'];
            $CIDRAM['FE']['NewPass'] = password_hash($_POST['password'], $CIDRAM['DefaultAlgo']);
            $CIDRAM['FE']['NewPerm'] = (int)$_POST['permissions'];
            $CIDRAM['FE']['NewUserB64'] = base64_encode($_POST['username']);
            if (strpos($CIDRAM['FE']['UserList'], "\n" . $CIDRAM['FE']['NewUserB64'] . ',') !== false) {
                $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_accounts_already_exists'];
            } else {
                $CIDRAM['AccountsArray'] = [
                    'Iterate' => 0,
                    'Count' => 1,
                    'ByName' => [$CIDRAM['FE']['NewUser'] =>
                        $CIDRAM['FE']['NewUserB64'] . ',' .
                        $CIDRAM['FE']['NewPass'] . ',' .
                        $CIDRAM['FE']['NewPerm'] . "\n"
                    ]
                ];
                $CIDRAM['FE']['NewLineOffset'] = 0;
                while (($CIDRAM['FE']['NewLinePos'] = strpos(
                    $CIDRAM['FE']['UserList'], "\n", $CIDRAM['FE']['NewLineOffset'] + 1
                )) !== false) {
                    $CIDRAM['FE']['NewLine'] = substr(
                        $CIDRAM['FE']['UserList'],
                        $CIDRAM['FE']['NewLineOffset'] + 1,
                        $CIDRAM['FE']['NewLinePos'] - $CIDRAM['FE']['NewLineOffset']
                    );
                    $CIDRAM['RowInfo'] = explode(',', $CIDRAM['FE']['NewLine'], 3);
                    $CIDRAM['RowInfo'] = base64_decode($CIDRAM['RowInfo'][0]);
                    $CIDRAM['AccountsArray']['ByName'][$CIDRAM['RowInfo']] = $CIDRAM['FE']['NewLine'];
                    $CIDRAM['FE']['NewLineOffset'] = $CIDRAM['FE']['NewLinePos'];
                }
                ksort($CIDRAM['AccountsArray']['ByName']);
                $CIDRAM['FE']['UserList'] = "\n" . implode('', $CIDRAM['AccountsArray']['ByName']);
                $CIDRAM['FE']['Rebuild'] = true;
                unset($CIDRAM['AccountsArray']);
                $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_accounts_created'];
            }
        }

        /** Delete an account. */
        if ($_POST['do'] === 'delete-account' && !empty($_POST['username'])) {
            $CIDRAM['FE']['User64'] = base64_encode($_POST['username']);
            $CIDRAM['FE']['UserLinePos'] = strpos($CIDRAM['FE']['UserList'], "\n" . $CIDRAM['FE']['User64'] . ',');
            if ($CIDRAM['FE']['UserLinePos'] === false) {
                $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_accounts_doesnt_exist'];
            } else {
                $CIDRAM['FE']['UserLineEndPos'] = strpos($CIDRAM['FE']['UserList'], "\n", $CIDRAM['FE']['UserLinePos'] + 1);
                if ($CIDRAM['FE']['UserLineEndPos'] !== false) {
                    $CIDRAM['FE']['UserLine'] = substr(
                        $CIDRAM['FE']['UserList'],
                        $CIDRAM['FE']['UserLinePos'] + 1,
                        $CIDRAM['FE']['UserLineEndPos'] - $CIDRAM['FE']['UserLinePos']
                    );
                    $CIDRAM['FE']['UserList'] = str_replace($CIDRAM['FE']['UserLine'], '', $CIDRAM['FE']['UserList']);
                    $CIDRAM['FE']['Rebuild'] = true;
                    $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_accounts_deleted'];
                }
            }
            $CIDRAM['FE']['UserLinePos'] = strpos($CIDRAM['FE']['SessionList'], "\n" . $CIDRAM['FE']['User64'] . ',');
            if ($CIDRAM['FE']['UserLinePos'] !== false) {
                $CIDRAM['FE']['UserLineEndPos'] = strpos($CIDRAM['FE']['SessionList'], "\n", $CIDRAM['FE']['UserLinePos'] + 1);
                if ($CIDRAM['FE']['UserLineEndPos'] !== false) {
                    $CIDRAM['FE']['SessionLine'] = substr(
                        $CIDRAM['FE']['SessionList'],
                        $CIDRAM['FE']['UserLinePos'] + 1,
                        $CIDRAM['FE']['UserLineEndPos'] - $CIDRAM['FE']['UserLinePos']
                    );
                    $CIDRAM['FE']['SessionList'] = str_replace($CIDRAM['FE']['SessionLine'], '', $CIDRAM['FE']['SessionList']);
                    $CIDRAM['FE']['Rebuild'] = true;
                }
            }
        }

        /** Update an account password. */
        if ($_POST['do'] === 'update-password' && !empty($_POST['username']) && !empty($_POST['password'])) {
            $CIDRAM['FE']['User64'] = base64_encode($_POST['username']);
            $CIDRAM['FE']['NewPass'] = password_hash($_POST['password'], $CIDRAM['DefaultAlgo']);
            $CIDRAM['FE']['UserLinePos'] = strpos($CIDRAM['FE']['UserList'], "\n" . $CIDRAM['FE']['User64'] . ',');
            if ($CIDRAM['FE']['UserLinePos'] === false) {
                $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_accounts_doesnt_exist'];
            } else {
                $CIDRAM['FE']['UserLineEndPos'] = strpos($CIDRAM['FE']['UserList'], "\n", $CIDRAM['FE']['UserLinePos'] + 1);
                if ($CIDRAM['FE']['UserLineEndPos'] !== false) {
                    $CIDRAM['FE']['UserLine'] = substr(
                        $CIDRAM['FE']['UserList'],
                        $CIDRAM['FE']['UserLinePos'] + 1,
                        $CIDRAM['FE']['UserLineEndPos'] - $CIDRAM['FE']['UserLinePos']
                    );
                    $CIDRAM['FE']['UserPerm'] = substr($CIDRAM['FE']['UserLine'], -2, 1);
                    $CIDRAM['FE']['NewUserLine'] =
                        $CIDRAM['FE']['User64'] . ',' .
                        $CIDRAM['FE']['NewPass'] . ',' .
                        $CIDRAM['FE']['UserPerm'] . "\n";
                    $CIDRAM['FE']['UserList'] = str_replace($CIDRAM['FE']['UserLine'], $CIDRAM['FE']['NewUserLine'], $CIDRAM['FE']['UserList']);
                    $CIDRAM['FE']['Rebuild'] = true;
                    $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_accounts_password_updated'];
                }
            }
        }

    }

    if (!$CIDRAM['FE']['ASYNC']) {

        /** Page initial prepwork. */
        $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_accounts'], $CIDRAM['lang']['tip_accounts']);

        /** Append async globals. */
        $CIDRAM['FE']['JS'] .= sprintf(
            'window[%3$s]=\'accounts\';function acc(e,d,i,t){var o=function(e){%4$se)' .
            '},a=function(){%4$s\'%1$s\')};window.username=%2$s(e).value,window.passw' .
            'ord=%2$s(d).value,window.do=%2$s(t).value,\'delete-account\'==window.do&' .
            '&$(\'POST\',\'\',[%3$s,\'username\',\'password\',\'do\'],a,function(e){%' .
            '4$se),hideid(i)},o),\'update-password\'==window.do&&$(\'POST\',\'\',[%3$' .
            's,\'username\',\'password\',\'do\'],a,o,o)}' . "\n",
            $CIDRAM['lang']['state_loading'],
            'document.getElementById',
            "'cidram-form-target'",
            "w('stateMsg',"
        );

        $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

        $CIDRAM['FE']['AccountsRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_accounts_row.html'));
        $CIDRAM['FE']['Accounts'] = '';
        $CIDRAM['FE']['NewLineOffset'] = 0;

        while (($CIDRAM['FE']['NewLinePos'] = strpos(
            $CIDRAM['FE']['UserList'], "\n", $CIDRAM['FE']['NewLineOffset'] + 1
        )) !== false) {
            $CIDRAM['FE']['NewLine'] = substr(
                $CIDRAM['FE']['UserList'],
                $CIDRAM['FE']['NewLineOffset'] + 1,
                $CIDRAM['FE']['NewLinePos'] - $CIDRAM['FE']['NewLineOffset'] - 1
            );
            $CIDRAM['RowInfo'] = ['DelPos' => strpos($CIDRAM['FE']['NewLine'], ','), 'AccWarnings' => ''];
            $CIDRAM['RowInfo']['AccUsername'] = substr($CIDRAM['FE']['NewLine'], 0, $CIDRAM['RowInfo']['DelPos']);
            $CIDRAM['RowInfo']['AccPassword'] = substr($CIDRAM['FE']['NewLine'], $CIDRAM['RowInfo']['DelPos'] + 1);
            $CIDRAM['RowInfo']['AccPermissions'] = (int)substr($CIDRAM['RowInfo']['AccPassword'], -1);
            if ($CIDRAM['RowInfo']['AccPermissions'] === 1) {
                $CIDRAM['RowInfo']['AccPermissions'] = $CIDRAM['lang']['state_complete_access'];
            } elseif ($CIDRAM['RowInfo']['AccPermissions'] === 2) {
                $CIDRAM['RowInfo']['AccPermissions'] = $CIDRAM['lang']['state_logs_access_only'];
            } elseif ($CIDRAM['RowInfo']['AccPermissions'] === 3) {
                $CIDRAM['RowInfo']['AccPermissions'] = 'Cronable';
            } else {
                $CIDRAM['RowInfo']['AccPermissions'] = $CIDRAM['lang']['response_error'];
            }
            $CIDRAM['RowInfo']['AccPassword'] = substr($CIDRAM['RowInfo']['AccPassword'], 0, -2);
            if ($CIDRAM['RowInfo']['AccPassword'] === $CIDRAM['FE']['DefaultPassword']) {
                $CIDRAM['RowInfo']['AccWarnings'] .= '<br /><div class="txtRd">' . $CIDRAM['lang']['state_default_password'] . '</div>';
            } elseif ((
                strlen($CIDRAM['RowInfo']['AccPassword']) !== 60 && strlen($CIDRAM['RowInfo']['AccPassword']) !== 96
            ) || (
                strlen($CIDRAM['RowInfo']['AccPassword']) === 60 && !preg_match('/^\$2.\$\d\d\$/', $CIDRAM['RowInfo']['AccPassword'])
            ) || (
                strlen($CIDRAM['RowInfo']['AccPassword']) === 96 && !preg_match('/^\$argon2i\$/', $CIDRAM['RowInfo']['AccPassword'])
            )) {
                $CIDRAM['RowInfo']['AccWarnings'] .= '<br /><div class="txtRd">' . $CIDRAM['lang']['state_password_not_valid'] . '</div>';
            }
            if (strrpos($CIDRAM['FE']['SessionList'], "\n" . $CIDRAM['RowInfo']['AccUsername'] . ',') !== false) {
                $CIDRAM['RowInfo']['AccWarnings'] .= '<br /><div class="txtGn">' . $CIDRAM['lang']['state_logged_in'] . '</div>';
            }
            $CIDRAM['RowInfo']['AccID'] = bin2hex($CIDRAM['RowInfo']['AccUsername']);
            $CIDRAM['RowInfo']['AccUsername'] = htmlentities(base64_decode($CIDRAM['RowInfo']['AccUsername']));
            $CIDRAM['FE']['NewLineOffset'] = $CIDRAM['FE']['NewLinePos'];
            $CIDRAM['FE']['Accounts'] .= $CIDRAM['ParseVars'](
                $CIDRAM['lang'] + $CIDRAM['RowInfo'], $CIDRAM['FE']['AccountsRow']
            );
        }
        unset($CIDRAM['RowInfo']);

    }

    if ($CIDRAM['FE']['ASYNC']) {
        /** Send output (async). */
        echo $CIDRAM['FE']['state_msg'];
    } else {

        /** Parse output. */
        $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_accounts.html'))
        );

        /** Send output. */
        echo $CIDRAM['SendOutput']();

    }

}

/** Configuration. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'config' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_config'], $CIDRAM['lang']['tip_config']);

    /** Append number localisation JS. */
    $CIDRAM['FE']['JS'] .= $CIDRAM['Number_L10N_JS']() . "\n";

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Directive template. */
    $CIDRAM['FE']['ConfigRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_config_row.html'));

    /** Indexes. */
    $CIDRAM['FE']['Indexes'] = '            ';

    /** Generate entries for display and regenerate configuration if any changes were submitted. */
    $CIDRAM['FE']['ConfigFields'] = $CIDRAM['RegenerateConfig'] = '';
    $CIDRAM['ConfigModified'] = (!empty($CIDRAM['QueryVars']['updated']) && $CIDRAM['QueryVars']['updated'] === 'true');
    foreach ($CIDRAM['Config']['Config Defaults'] as $CIDRAM['CatKey'] => $CIDRAM['CatValue']) {
        if (!is_array($CIDRAM['CatValue'])) {
            continue;
        }
        $CIDRAM['RegenerateConfig'] .= '[' . $CIDRAM['CatKey'] . "]\r\n\r\n";
        $CIDRAM['FE']['ConfigFields'] .= sprintf(
                '<table><tr><td class="ng2"><div id="%1$s-container" class="s">' .
                '<a id="%1$s-showlink" href="#%1$s-container" onclick="javascript:showid(\'%1$s-hidelink\');showid(\'%1$s-ihidelink\');hideid(\'%1$s-showlink\');hideid(\'%1$s-ishowlink\');show(\'%1$s-index\');show(\'%1$s-row\')">%1$s +</a>' .
                '<a id="%1$s-hidelink" %2$s href="javascript:void(0);" onclick="javascript:showid(\'%1$s-showlink\');showid(\'%1$s-ishowlink\');hideid(\'%1$s-hidelink\');hideid(\'%1$s-ihidelink\');hide(\'%1$s-index\');hide(\'%1$s-row\')">%1$s -</a>' .
                "</div></td></tr></table>\n<span class=\"%1\$s-row\" %2\$s><table>\n",
            $CIDRAM['CatKey'],
            'style="display:none"'
        );
        $CIDRAM['FE']['Indexes'] .= sprintf(
            '<a id="%1$s-ishowlink" href="#%1$s-container" onclick="javascript:showid(\'%1$s-hidelink\');showid(\'%1$s-ihidelink\');hideid(\'%1$s-showlink\');hideid(\'%1$s-ishowlink\');show(\'%1$s-index\');show(\'%1$s-row\')">%1$s +</a>' .
            '<a id="%1$s-ihidelink" style="display:none" href="javascript:void(0);" onclick="javascript:showid(\'%1$s-showlink\');showid(\'%1$s-ishowlink\');hideid(\'%1$s-hidelink\');hideid(\'%1$s-ihidelink\');hide(\'%1$s-index\');hide(\'%1$s-row\')">%1$s -</a>' .
            "<br /><br />\n            ",
            $CIDRAM['CatKey']
        );
        foreach ($CIDRAM['CatValue'] as $CIDRAM['DirKey'] => $CIDRAM['DirValue']) {
            $CIDRAM['ThisDir'] = ['FieldOut' => '', 'CatKey' => $CIDRAM['CatKey']];
            if (empty($CIDRAM['DirValue']['type']) || !isset($CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']])) {
                continue;
            }
            $CIDRAM['ThisDir']['DirLangKey'] = 'config_' . $CIDRAM['CatKey'] . '_' . $CIDRAM['DirKey'];
            $CIDRAM['ThisDir']['DirName'] = $CIDRAM['CatKey'] . '-&gt;' . $CIDRAM['DirKey'];
            $CIDRAM['FE']['Indexes'] .= '<span class="' . $CIDRAM['CatKey'] . '-index" style="display:none"><a href="#' . $CIDRAM['ThisDir']['DirLangKey'] . '">' . $CIDRAM['ThisDir']['DirName'] . "</a><br /><br /></span>\n            ";
            $CIDRAM['ThisDir']['DirLang'] = !empty(
                $CIDRAM['lang'][$CIDRAM['ThisDir']['DirLangKey']]
            ) ? $CIDRAM['lang'][$CIDRAM['ThisDir']['DirLangKey']] : (
                !empty($CIDRAM['lang']['config_' . $CIDRAM['CatKey']]) ? $CIDRAM['lang']['config_' . $CIDRAM['CatKey']] : $CIDRAM['lang']['response_error']
            );
            if (!empty($CIDRAM['DirValue']['experimental'])) {
                $CIDRAM['ThisDir']['DirLang'] = '<code class="exp">' . $CIDRAM['lang']['config_experimental'] . '</code> ' . $CIDRAM['ThisDir']['DirLang'];
            }
            $CIDRAM['RegenerateConfig'] .= '; ' . wordwrap(strip_tags($CIDRAM['ThisDir']['DirLang']), 77, "\r\n; ") . "\r\n";
            if (isset($_POST[$CIDRAM['ThisDir']['DirLangKey']])) {
                if ($CIDRAM['DirValue']['type'] === 'kb' || $CIDRAM['DirValue']['type'] === 'string' || $CIDRAM['DirValue']['type'] === 'timezone' || $CIDRAM['DirValue']['type'] === 'int' || $CIDRAM['DirValue']['type'] === 'real' || $CIDRAM['DirValue']['type'] === 'bool') {
                    $CIDRAM['AutoType']($_POST[$CIDRAM['ThisDir']['DirLangKey']], $CIDRAM['DirValue']['type']);
                }
                if (
                    !preg_match('/[^\x20-\xff"\']/', $_POST[$CIDRAM['ThisDir']['DirLangKey']]) && (
                        !isset($CIDRAM['DirValue']['choices']) || isset($CIDRAM['DirValue']['choices'][$_POST[$CIDRAM['ThisDir']['DirLangKey']]])
                    )
                ) {
                    $CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] = $_POST[$CIDRAM['ThisDir']['DirLangKey']];
                    $CIDRAM['ConfigModified'] = true;
                }
            }
            if ($CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] === true) {
                $CIDRAM['RegenerateConfig'] .= $CIDRAM['DirKey'] . "=true\r\n\r\n";
            } elseif ($CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] === false) {
                $CIDRAM['RegenerateConfig'] .= $CIDRAM['DirKey'] . "=false\r\n\r\n";
            } elseif ($CIDRAM['DirValue']['type'] === 'int' || $CIDRAM['DirValue']['type'] === 'real') {
                $CIDRAM['RegenerateConfig'] .= $CIDRAM['DirKey'] . '=' . $CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] . "\r\n\r\n";
            } else {
                $CIDRAM['RegenerateConfig'] .= $CIDRAM['DirKey'] . '=\'' . $CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] . "'\r\n\r\n";
            }
            if (isset($CIDRAM['DirValue']['preview'])) {
                $CIDRAM['ThisDir']['Preview'] = ' = <span id="' . $CIDRAM['ThisDir']['DirLangKey'] . '_preview"></span>';
                $CIDRAM['ThisDir']['Trigger'] = ' onchange="javascript:' . $CIDRAM['ThisDir']['DirLangKey'] . '_function();" onkeyup="javascript:' . $CIDRAM['ThisDir']['DirLangKey'] . '_function();"';
                if ($CIDRAM['DirValue']['preview'] === 'kb') {
                    $CIDRAM['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var e=%7$s?%7$s(' .
                            '\'%1$s_field\').value:%8$s&&!%7$s?%8$s.%1$s_field.value:\'\',z=e.replace' .
                            '(/o$/i,\'b\').substr(-2).toLowerCase(),y=\'kb\'==z?1:\'mb\'==z?1024:\'gb' .
                            '\'==z?1048576:\'tb\'==z?1073741824:\'b\'==e.substr(-1)?.0009765625:1,e=e' .
                            '.replace(/[^0-9]*$/i,\'\'),e=isNaN(e)?0:e*y,t=0>e?\'0 %2$s\':1>e?nft((10' .
                            '24*e).toFixed(0))+\' %2$s\':1024>e?nft((1*e).toFixed(2))+\' %3$s\':10485' .
                            '76>e?nft((e/1024).toFixed(2))+\' %4$s\':1073741824>e?nft((e/1048576).toF' .
                            'ixed(2))+\' %5$s\':nft((e/1073741824).toFixed(2))+\' %6$s\';%7$s?%7$s(\'' .
                            '%1$s_preview\').innerHTML=t:%8$s&&!%7$s?%8$s.%1$s_preview.innerHTML=t:\'' .
                            '\'};%1$s_function();</script>',
                        $CIDRAM['ThisDir']['DirLangKey'],
                        $CIDRAM['Plural'](0, $CIDRAM['lang']['field_size_bytes']),
                        $CIDRAM['lang']['field_size_KB'],
                        $CIDRAM['lang']['field_size_MB'],
                        $CIDRAM['lang']['field_size_GB'],
                        $CIDRAM['lang']['field_size_TB'],
                        'document.getElementById',
                        'document.all'
                    );
                } elseif ($CIDRAM['DirValue']['preview'] === 'seconds') {
                    $CIDRAM['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=%9$s?%9$s(' .
                            '\'%1$s_field\').value:%10$s&&!%9$s?%10$s.%1$s_field.value:\'\',e=isNaN(t' .
                            ')?0:0>t?t*-1:t,n=e?Math.floor(e/31536e3):0,e=e?e-31536e3*n:0,o=e?Math.fl' .
                            'oor(e/2592e3):0,e=e-2592e3*o,l=e?Math.floor(e/604800):0,e=e-604800*l,r=e' .
                            '?Math.floor(e/86400):0,e=e-86400*r,d=e?Math.floor(e/3600):0,e=e-3600*d,i' .
                            '=e?Math.floor(e/60):0,e=e-60*i,f=e?Math.floor(1*e):0,a=nft(n.toString())' .
                            '+\' %2$s – \'+nft(o.toString())+\' %3$s – \'+nft(l.toString())+\' %4$s –' .
                            ' \'+nft(r.toString())+\' %5$s – \'+nft(d.toString())+\' %6$s – \'+nft(i.' .
                            'toString())+\' %7$s – \'+nft(f.toString())+\' %8$s\';%9$s?%9$s(\'%1$s_pr' .
                            'eview\').innerHTML=a:%10$s&&!%9$s?%10$s.%1$s_preview.innerHTML=a:\'\'}' .
                            '%1$s_function();</script>',
                        $CIDRAM['ThisDir']['DirLangKey'],
                        $CIDRAM['lang']['previewer_years'],
                        $CIDRAM['lang']['previewer_months'],
                        $CIDRAM['lang']['previewer_weeks'],
                        $CIDRAM['lang']['previewer_days'],
                        $CIDRAM['lang']['previewer_hours'],
                        $CIDRAM['lang']['previewer_minutes'],
                        $CIDRAM['lang']['previewer_seconds'],
                        'document.getElementById',
                        'document.all'
                    );
                } elseif ($CIDRAM['DirValue']['preview'] === 'minutes') {
                    $CIDRAM['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=%9$s?%9$s(' .
                            '\'%1$s_field\').value:%10$s&&!%9$s?%10$s.%1$s_field.value:\'\',e=isNaN(t' .
                            ')?0:0>t?t*-1:t,n=e?Math.floor(e/525600):0,e=e?e-525600*n:0,o=e?Math.floo' .
                            'r(e/43200):0,e=e-43200*o,l=e?Math.floor(e/10080):0,e=e-10080*l,r=e?Math.' .
                            'floor(e/1440):0,e=e-1440*r,d=e?Math.floor(e/60):0,e=e-60*d,i=e?Math.floo' .
                            'r(e*1):0,e=e-i,f=e?Math.floor(60*e):0,a=nft(n.toString())+\' %2$s – \'+n' .
                            'ft(o.toString())+\' %3$s – \'+nft(l.toString())+\' %4$s – \'+nft(r.toStr' .
                            'ing())+\' %5$s – \'+nft(d.toString())+\' %6$s – \'+nft(i.toString())+\' ' .
                            '%7$s – \'+nft(f.toString())+\' %8$s\';%9$s?%9$s(\'%1$s_preview\').innerH' .
                            'TML=a:%10$s&&!%9$s?%10$s.%1$s_preview.innerHTML=a:\'\'}%1$s_function();<' .
                            '/script>',
                        $CIDRAM['ThisDir']['DirLangKey'],
                        $CIDRAM['lang']['previewer_years'],
                        $CIDRAM['lang']['previewer_months'],
                        $CIDRAM['lang']['previewer_weeks'],
                        $CIDRAM['lang']['previewer_days'],
                        $CIDRAM['lang']['previewer_hours'],
                        $CIDRAM['lang']['previewer_minutes'],
                        $CIDRAM['lang']['previewer_seconds'],
                        'document.getElementById',
                        'document.all'
                    );
                } elseif ($CIDRAM['DirValue']['preview'] === 'hours') {
                    $CIDRAM['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=%9$s?%9$s(' .
                            '\'%1$s_field\').value:%10$s&&!%9$s?%10$s.%1$s_field.value:\'\',e=isNaN(t' .
                            ')?0:0>t?t*-1:t,n=e?Math.floor(e/8760):0,e=e?e-8760*n:0,o=e?Math.floor(e/' .
                            '720):0,e=e-720*o,l=e?Math.floor(e/168):0,e=e-168*l,r=e?Math.floor(e/24):' .
                            '0,e=e-24*r,d=e?Math.floor(e*1):0,e=e-d,i=e?Math.floor(60*e):0,e=e-(i/60)' .
                            ',f=e?Math.floor(3600*e):0,a=nft(n.toString())+\' %2$s – \'+nft(o.toStrin' .
                            'g())+\' %3$s – \'+nft(l.toString())+\' %4$s – \'+nft(r.toString())+\' ' .
                            '%5$s – \'+nft(d.toString())+\' %6$s – \'+nft(i.toString())+\' %7$s – \'+' .
                            'nft(f.toString())+\' %8$s\';%9$s?%9$s(\'%1$s_preview\').innerHTML=a:' .
                            '%10$s&&!%9$s?%10$s.%1$s_preview.innerHTML=a:\'\'}%1$s_function();</script>',
                        $CIDRAM['ThisDir']['DirLangKey'],
                        $CIDRAM['lang']['previewer_years'],
                        $CIDRAM['lang']['previewer_months'],
                        $CIDRAM['lang']['previewer_weeks'],
                        $CIDRAM['lang']['previewer_days'],
                        $CIDRAM['lang']['previewer_hours'],
                        $CIDRAM['lang']['previewer_minutes'],
                        $CIDRAM['lang']['previewer_seconds'],
                        'document.getElementById',
                        'document.all'
                    );
                }
            } else {
                $CIDRAM['ThisDir']['Preview'] = $CIDRAM['ThisDir']['Trigger'] = '';
            }
            if ($CIDRAM['DirValue']['type'] === 'timezone') {
                $CIDRAM['DirValue']['choices'] = ['SYSTEM' => $CIDRAM['lang']['field_system_timezone']];
                foreach (array_unique(DateTimeZone::listIdentifiers()) as $CIDRAM['DirValue']['ChoiceValue']) {
                    $CIDRAM['DirValue']['choices'][$CIDRAM['DirValue']['ChoiceValue']] = $CIDRAM['DirValue']['ChoiceValue'];
                }
            }
            if (isset($CIDRAM['DirValue']['choices'])) {
                $CIDRAM['ThisDir']['FieldOut'] = '<select class="auto" name="' . $CIDRAM['ThisDir']['DirLangKey'] . '" id="' . $CIDRAM['ThisDir']['DirLangKey'] . '_field"' . $CIDRAM['ThisDir']['Trigger'] . '>';
                foreach ($CIDRAM['DirValue']['choices'] as $CIDRAM['ChoiceKey'] => $CIDRAM['ChoiceValue']) {
                    if (isset($CIDRAM['DirValue']['choice_filter'], $CIDRAM[$CIDRAM['DirValue']['choice_filter']])) {
                        if (!$CIDRAM[$CIDRAM['DirValue']['choice_filter']]($CIDRAM['ChoiceKey'], $CIDRAM['ChoiceValue'])) {
                            continue;
                        }
                    }
                    if (strpos($CIDRAM['ChoiceValue'], '{') !== false) {
                        $CIDRAM['ChoiceValue'] = $CIDRAM['TimeFormat']($CIDRAM['Now'], $CIDRAM['ChoiceValue']);
                        if (strpos($CIDRAM['ChoiceValue'], '{') !== false) {
                            $CIDRAM['ChoiceValue'] = $CIDRAM['ParseVars']($CIDRAM['lang'], $CIDRAM['ChoiceValue']);
                        }
                    }
                    $CIDRAM['ThisDir']['FieldOut'] .= '<option value="' . $CIDRAM['ChoiceKey'] . '"' . ((
                        $CIDRAM['ChoiceKey'] === $CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']]
                    ) ? ' selected' : '') . '>' . $CIDRAM['ChoiceValue'] . '</option>';
                }
                $CIDRAM['ThisDir']['FieldOut'] .= '</select>';
            } elseif ($CIDRAM['DirValue']['type'] === 'bool') {
                $CIDRAM['ThisDir']['FieldOut'] = sprintf(
                        '<select class="auto" name="%1$s" id="%1$s_field"%2$s>' .
                        '<option value="true"%5$s>%3$s</option><option value="false"%6$s>%4$s</option>' .
                        '</select>',
                    $CIDRAM['ThisDir']['DirLangKey'],
                    $CIDRAM['ThisDir']['Trigger'],
                    $CIDRAM['lang']['field_true'],
                    $CIDRAM['lang']['field_false'],
                    ($CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] ? ' selected' : ''),
                    ($CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] ? '' : ' selected')
                );
            } elseif ($CIDRAM['DirValue']['type'] === 'int' || $CIDRAM['DirValue']['type'] === 'real') {
                $CIDRAM['ThisDir']['FieldOut'] = sprintf(
                    '<input type="number" name="%1$s" id="%1$s_field" value="%2$s"%3$s%4$s />',
                    $CIDRAM['ThisDir']['DirLangKey'],
                    $CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']],
                    (isset($CIDRAM['DirValue']['step']) ? ' step="' . $CIDRAM['DirValue']['step'] . '"' : ''),
                    $CIDRAM['ThisDir']['Trigger']
                );
            } elseif ($CIDRAM['DirValue']['type'] === 'string') {
                $CIDRAM['ThisDir']['FieldOut'] = '<textarea name="' . $CIDRAM['ThisDir']['DirLangKey'] . '" id="' . $CIDRAM['ThisDir']['DirLangKey'] . '_field" class="half"' . $CIDRAM['ThisDir']['Trigger'] . '>' . $CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] . '</textarea>';
            } else {
                $CIDRAM['ThisDir']['FieldOut'] = '<input type="text" name="' . $CIDRAM['ThisDir']['DirLangKey'] . '" id="' . $CIDRAM['ThisDir']['DirLangKey'] . '_field" value="' . $CIDRAM['Config'][$CIDRAM['CatKey']][$CIDRAM['DirKey']] . '"' . $CIDRAM['ThisDir']['Trigger'] . ' />';
            }
            $CIDRAM['ThisDir']['FieldOut'] .= $CIDRAM['ThisDir']['Preview'];
            $CIDRAM['FE']['ConfigFields'] .= $CIDRAM['ParseVars'](
                $CIDRAM['lang'] + $CIDRAM['ThisDir'], $CIDRAM['FE']['ConfigRow']
            );
        }
        $CIDRAM['FE']['ConfigFields'] .= "</table></span>\n";
        $CIDRAM['RegenerateConfig'] .= "\r\n";
    }

    /** Update the currently active configuration file if any changes were made. */
    if ($CIDRAM['ConfigModified']) {
        $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_configuration_updated'];
        $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . $CIDRAM['FE']['ActiveConfigFile'], 'w');
        fwrite($CIDRAM['Handle'], $CIDRAM['RegenerateConfig']);
        fclose($CIDRAM['Handle']);
        if (empty($CIDRAM['QueryVars']['updated'])) {
            header('Location: ?cidram-page=config&updated=true');
            die;
        }
    }

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_config.html'))
    );

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** Cache data. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'cache-data' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_cache_data'], $CIDRAM['lang']['tip_cache_data']);

    /** Initialise cache. */
    $CIDRAM['InitialiseCache']();

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    if ($CIDRAM['FE']['ASYNC']) {

        /** Perform some function on a cache entry. */
        if (!empty($_POST['cdi']) && !empty($_POST['do']) && isset($CIDRAM['Cache'][$_POST['cdi']])) {
            if ($_POST['do'] === 'delete') {
                unset($CIDRAM['Cache'][$_POST['cdi']]);
                $CIDRAM['CacheModified'] = true;
            } elseif ($_POST['do'] === 'show') {
                $CIDRAM['Output'] = is_array($CIDRAM['Cache'][$_POST['cdi']]) ? serialize($CIDRAM['Cache'][$_POST['cdi']]) : $CIDRAM['Cache'][$_POST['cdi']];
                echo '<textarea readonly>' . str_replace(['<', '>'], ['&lt;', '&gt;'], $CIDRAM['Output']) . '</textarea>';
                if (is_array($CIDRAM['Cache'][$_POST['cdi']])) {
                    foreach ($CIDRAM['Cache'][$_POST['cdi']] as $CIDRAM['ThisItemName'] => $CIDRAM['ThisItem']) {
                        if (!is_array($CIDRAM['ThisItem'])) {
                            $CIDRAM['ThisItem'] = ['Data' => $CIDRAM['ThisItem'], 'Len' => strlen($CIDRAM['ThisItem'])];
                        } else {
                            $CIDRAM['ThisItem']['Data'] = serialize($CIDRAM['ThisItem']);
                            $CIDRAM['ThisItem']['Len'] = strlen(serialize($CIDRAM['ThisItem'])) ?: 0;
                        }
                        $CIDRAM['FormatFilesize']($CIDRAM['ThisItem']['Len']);
                        $CIDRAM['ThisItem']['Time'] = isset($CIDRAM['ThisItem']['Time']) ? $CIDRAM['TimeFormat'](
                            $CIDRAM['ThisItem']['Time'],
                            $CIDRAM['Config']['general']['timeFormat']
                        ) : $CIDRAM['lang']['label_never'];
                        echo '<small>' . sprintf(
                            '"cache.dat" -&gt; "%1$s" -&gt; "%2$s"<br />%3$s%4$s<br />%5$s',
                            $_POST['cdi'],
                            $CIDRAM['ThisItemName'],
                            $CIDRAM['lang']['label_expires'],
                            $CIDRAM['ThisItem']['Time'],
                            '<code>' . str_replace(['<', '>'], ['&lt;', '&gt;'], $CIDRAM['ThisItem']['Data']) . '</code>'
                        ) . '</small><hr />';
                    }
                    unset($CIDRAM['ThisItemName'], $CIDRAM['ThisItem']);
                }
            }
        }

        /** Perform some function on a cache entry (the front-end cache). */
        elseif (!empty($_POST['fecdi']) && !empty($_POST['do'])) {
            if ($_POST['do'] === 'delete') {
                $CIDRAM['FECacheRemove']($CIDRAM['FE']['Cache'], $CIDRAM['FE']['Rebuild'], $_POST['fecdi']);
            } elseif ($_POST['do'] === 'show') {
                if ($CIDRAM['Output'] = $CIDRAM['FECacheGet']($CIDRAM['FE']['Cache'], $_POST['fecdi'])) {
                    echo '<textarea readonly>' . str_replace(['<', '>'], ['&lt;', '&gt;'], $CIDRAM['Output']) . '</textarea>';
                }
            }
        }

    } else {

        /** Append async globals. */
        $CIDRAM['FE']['JS'] .=
            "function cdd(d,n){window.cdi=d,window.do=null==n?'delete':'show',$('POST',''" .
            ",['cidram-form-target','cdi','do'],null,function(o){null==n?hideid(d+'Contai" .
            "ner'):(w(d+'ID',r(d+'ID')+o),hideid(d+'SB'))})}window['cidram-form-target']=" .
            "'cache-data';function fecdd(d,n){window.fecdi=d,window.do=null==n?'delete':'" .
            "show',$('POST','',['cidram-form-target','fecdi','do'],null,function(o){null=" .
            "=n?hideid(d+'FEContainer'):(w(d+'FEID',r(d+'FEID')+o),hideid(d+'FESB'))})}wi" .
            "ndow['cidram-form-target']='cache-data';";

        /** To be populated by the cache data. */
        $CIDRAM['FE']['CacheData'] = '';

        /** Get cache index data. */
        foreach ($CIDRAM['Cache'] as $CIDRAM['ThisCacheName'] => $CIDRAM['ThisCacheItem']) {
            if (isset($CIDRAM['ThisCacheItem']['Time']) && $CIDRAM['ThisCacheItem']['Time'] > 0 && $CIDRAM['Now'] >= $CIDRAM['ThisCacheItem']['Time']) {
                continue;
            }
            if (!is_array($CIDRAM['ThisCacheItem'])) {
                $CIDRAM['ThisCacheItem'] = ['Data' => $CIDRAM['ThisCacheItem'], 'Len' => strlen($CIDRAM['ThisCacheItem'])];
            } else {
                $CIDRAM['ThisCacheItem']['Len'] = strlen(serialize($CIDRAM['ThisCacheItem'])) ?: 0;
            }
            $CIDRAM['FormatFilesize']($CIDRAM['ThisCacheItem']['Len']);
            $CIDRAM['ThisCacheItem']['Time'] = isset($CIDRAM['ThisCacheItem']['Time']) ? $CIDRAM['TimeFormat'](
                $CIDRAM['ThisCacheItem']['Time'],
                $CIDRAM['Config']['general']['timeFormat']
            ) : $CIDRAM['lang']['label_never'];
            $CIDRAM['FE']['CacheData'] .= sprintf(
                "\n        " .
                '<div class="ng1" id="%1$sContainer"><span class="s">"cache.dat" -&gt; "%1$s"<br /><small>%2$s%3$s<br />%4$s%5$s</small><div id="%1$sID">' .
                '<input onclick="javascript:cdd(\'%1$s\')" type="button" value="%6$s" class="auto" /> ' .
                '<input onclick="javascript:cdd(\'%1$s\',1)" id="%1$sSB" type="button" value="%7$s" class="auto" />' .
                '</div></span></div>',
                $CIDRAM['ThisCacheName'],
                $CIDRAM['lang']['field_size'],
                $CIDRAM['ThisCacheItem']['Len'],
                $CIDRAM['lang']['label_expires'],
                $CIDRAM['ThisCacheItem']['Time'],
                $CIDRAM['lang']['field_delete_file'],
                $CIDRAM['lang']['label_show']
            ) . "\n";
        }
        unset($CIDRAM['ThisCacheName'], $CIDRAM['ThisCacheItem']);

        /** Get front-end cache data. */
        if ($CIDRAM['CacheIndexData'] = $CIDRAM['FE']['Cache']) {
            foreach (explode("\n", $CIDRAM['CacheIndexData']) as $CIDRAM['CacheIndexData']) {
                if (!$CIDRAM['CacheIndexData']) {
                    continue;
                }
                $CIDRAM['CacheIndexData'] = explode(',', $CIDRAM['CacheIndexData']);
                $CIDRAM['CacheIndexData'][0] = base64_decode($CIDRAM['CacheIndexData'][0]);
                $CIDRAM['CacheIndexData'][3] = strlen(base64_decode($CIDRAM['CacheIndexData'][1]));
                $CIDRAM['FormatFilesize']($CIDRAM['CacheIndexData'][3]);
                $CIDRAM['FE']['CacheData'] .= sprintf(
                    "\n        " .
                    '<div class="ng1" id="%1$sFEContainer"><span class="s">"fe_assets/frontend.dat" -&gt; "%1$s"<br /><small>%2$s%3$s<br />%4$s%5$s</small><div id="%1$sFEID">' .
                    '<input onclick="javascript:fecdd(\'%1$s\')" type="button" value="%7$s" class="auto" /> ' .
                    '<input onclick="javascript:fecdd(\'%1$s\',1)" id="%1$sFESB" type="button" value="%6$s" class="auto" />' .
                    '</div></span></div>',
                    $CIDRAM['CacheIndexData'][0],
                    $CIDRAM['lang']['field_size'],
                    $CIDRAM['CacheIndexData'][3],
                    $CIDRAM['lang']['label_expires'],
                    ($CIDRAM['CacheIndexData'][2] >= 0 ? $CIDRAM['TimeFormat'](
                        $CIDRAM['CacheIndexData'][2],
                        $CIDRAM['Config']['general']['timeFormat']
                    ) : $CIDRAM['lang']['label_never']),
                    $CIDRAM['lang']['label_show'],
                    $CIDRAM['lang']['field_delete_file']
                ) . "\n";
            }
        }

        /** Cache is empty. */
        if (!$CIDRAM['FE']['CacheData']) {
            $CIDRAM['FE']['CacheData'] = '<div class="ng1"><span class="s">' . $CIDRAM['lang']['state_cache_is_empty'] . '</span></div>';
        }

        /** Cleanup. */
        unset($CIDRAM['ThisCacheData'], $CIDRAM['CacheIndexData']);

        /** Parse output. */
        $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_cache.html'))
        );

        /** Send output. */
        echo $CIDRAM['SendOutput']();

    }

    /** Update the cache. */
    if ($CIDRAM['CacheModified']) {
        $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . 'cache.dat', 'w');
        fwrite($CIDRAM['Handle'], serialize($CIDRAM['Cache']));
        fclose($CIDRAM['Handle']);
    }

    /** Cleanup. */
    unset($CIDRAM['CacheModified'], $CIDRAM['Cache']);

}

/** Updates. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'updates' && ($CIDRAM['FE']['Permissions'] === 1 || ($CIDRAM['FE']['Permissions'] === 3 && $CIDRAM['FE']['CronMode']))) {

    $CIDRAM['FE']['UpdatesFormTarget'] = 'cidram-page=updates';
    $CIDRAM['FE']['UpdatesFormTargetControls'] = '';
    $CIDRAM['StateModified'] = false;
    $CIDRAM['FilterSwitch'](
        ['hide-non-outdated', 'hide-unused'],
        isset($_POST['FilterSelector']) ? $_POST['FilterSelector'] : '',
        $CIDRAM['StateModified'],
        $CIDRAM['FE']['UpdatesFormTarget'],
        $CIDRAM['FE']['UpdatesFormTargetControls']
    );
    if ($CIDRAM['StateModified']) {
        header('Location: ?' . $CIDRAM['FE']['UpdatesFormTarget']);
        die;
    }
    unset($CIDRAM['StateModified']);

    /** Prepare components metadata working array. */
    $CIDRAM['Components'] = ['Meta' => [], 'RemoteMeta' => []];

    /** Fetch components lists. */
    $CIDRAM['FetchComponentsLists']($CIDRAM['Vault'], $CIDRAM['Components']['Meta']);

    /** Cleanup. */
    unset($CIDRAM['Components']['Files']);

    /** Indexes. */
    $CIDRAM['FE']['Indexes'] = [];

    /** A form has been submitted. */
    if (empty($CIDRAM['Alternate']) && $CIDRAM['FE']['FormTarget'] === 'updates' && !empty($_POST['do']) && !empty($_POST['ID'])) {

        /** Trigger updates handler. */
        $CIDRAM['UpdatesHandler']($_POST['do'], $_POST['ID']);

    }

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_updates'], $CIDRAM['lang']['tip_updates']);

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    $CIDRAM['FE']['UpdatesRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_updates_row.html'));

    $CIDRAM['Components'] = [
        'Meta' => $CIDRAM['Components']['Meta'],
        'RemoteMeta' => $CIDRAM['Components']['RemoteMeta'],
        'Remotes' => [],
        'Dependencies' => [],
        'Outdated' => [],
        'Verify' => [],
        'Out' => []
    ];

    /** Prepare installed component metadata and options for display. */
    foreach ($CIDRAM['Components']['Meta'] as $CIDRAM['Components']['Key'] => &$CIDRAM['Components']['ThisComponent']) {

        /** Skip if component is malformed. */
        if (empty($CIDRAM['Components']['ThisComponent']['Name']) && empty($CIDRAM['lang']['Name: ' . $CIDRAM['Components']['Key']])) {
            $CIDRAM['Components']['ThisComponent'] = '';
            continue;
        }

        /** Execute any necessary preload instructions. */
        if (!empty($CIDRAM['Components']['ThisComponent']['When Checking'])) {
            $CIDRAM['FE_Executor']($CIDRAM['Components']['ThisComponent']['When Checking']);
        }

        $CIDRAM['PrepareName']($CIDRAM['Components']['ThisComponent'], $CIDRAM['Components']['Key']);
        $CIDRAM['PrepareExtendedDescription']($CIDRAM['Components']['ThisComponent'], $CIDRAM['Components']['Key']);
        $CIDRAM['Components']['ThisComponent']['ID'] = $CIDRAM['Components']['Key'];
        $CIDRAM['Components']['ThisComponent']['Options'] = '';
        $CIDRAM['Components']['ThisComponent']['StatusOptions'] = '';
        $CIDRAM['Components']['ThisComponent']['StatClass'] = '';
        if (empty($CIDRAM['Components']['ThisComponent']['Version'])) {
            if (empty($CIDRAM['Components']['ThisComponent']['Files']['To'])) {
                $CIDRAM['Components']['ThisComponent']['RowClass'] = 'h2';
                $CIDRAM['Components']['ThisComponent']['Version'] = $CIDRAM['lang']['response_updates_not_installed'];
                $CIDRAM['Components']['ThisComponent']['StatClass'] = 'txtRd';
                $CIDRAM['Components']['ThisComponent']['StatusOptions'] = $CIDRAM['lang']['response_updates_not_installed'];
            } else {
                $CIDRAM['Components']['ThisComponent']['Version'] = $CIDRAM['lang']['response_updates_unable_to_determine'];
                $CIDRAM['Components']['ThisComponent']['StatClass'] = 's';
            }
        }
        if (!empty($CIDRAM['Components']['ThisComponent']['Files'])) {
            $CIDRAM['Arrayify']($CIDRAM['Components']['ThisComponent']['Files']);
            $CIDRAM['Arrayify']($CIDRAM['Components']['ThisComponent']['Files']['To']);
            $CIDRAM['Arrayify']($CIDRAM['Components']['ThisComponent']['Files']['From']);
            if (isset($CIDRAM['Components']['ThisComponent']['Files']['Checksum'])) {
                $CIDRAM['Arrayify']($CIDRAM['Components']['ThisComponent']['Files']['Checksum']);
            }
        }
        if (empty($CIDRAM['Components']['ThisComponent']['Remote'])) {
            $CIDRAM['Components']['ThisComponent']['RemoteData'] = $CIDRAM['lang']['response_updates_unable_to_determine'];
            if (!$CIDRAM['Components']['ThisComponent']['StatClass']) {
                $CIDRAM['Components']['ThisComponent']['StatClass'] = 's';
            }
        } else {
            $CIDRAM['FetchRemote']();
            if (
                substr($CIDRAM['Components']['ThisComponent']['RemoteData'], 0, 4) === "---\n" &&
                ($CIDRAM['Components']['EoYAML'] = strpos(
                    $CIDRAM['Components']['ThisComponent']['RemoteData'], "\n\n"
                )) !== false
            ) {

                /** Process remote components metadata. */
                if (!isset($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']])) {
                    $CIDRAM['YAML'](
                        substr($CIDRAM['Components']['ThisComponent']['RemoteData'], 4, $CIDRAM['Components']['EoYAML'] - 4),
                        $CIDRAM['Components']['RemoteMeta']
                    );
                }

                if (isset($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Version'])) {
                    $CIDRAM['Components']['ThisComponent']['Latest'] =
                        $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Version'];
                } else {
                    if (!$CIDRAM['Components']['ThisComponent']['StatClass']) {
                        $CIDRAM['Components']['ThisComponent']['StatClass'] = 's';
                    }
                }
            } elseif (!$CIDRAM['Components']['ThisComponent']['StatClass']) {
                $CIDRAM['Components']['ThisComponent']['StatClass'] = 's';
            }
            if (!empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Name'])) {
                $CIDRAM['Components']['ThisComponent']['Name'] =
                    $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Name'];
                $CIDRAM['PrepareName']($CIDRAM['Components']['ThisComponent'], $CIDRAM['Components']['Key']);
            }
            if (
                empty($CIDRAM['Components']['ThisComponent']['False Positive Risk']) &&
                !empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['False Positive Risk'])
            ) {
                $CIDRAM['Components']['ThisComponent']['False Positive Risk'] =
                    $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['False Positive Risk'];
            }
            if (
                empty($CIDRAM['Components']['ThisComponent']['Used with']) &&
                !empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Used with'])
            ) {
                $CIDRAM['Components']['ThisComponent']['Used with'] = $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Used with'];
            }
            if (!empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Extended Description'])) {
                $CIDRAM['Components']['ThisComponent']['Extended Description'] =
                    $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Extended Description'];
                $CIDRAM['PrepareExtendedDescription']($CIDRAM['Components']['ThisComponent'], $CIDRAM['Components']['Key']);
            }
            if (!$CIDRAM['Components']['ThisComponent']['StatClass']) {
                if (
                    !empty($CIDRAM['Components']['ThisComponent']['Latest']) &&
                    $CIDRAM['VersionCompare'](
                        $CIDRAM['Components']['ThisComponent']['Version'],
                        $CIDRAM['Components']['ThisComponent']['Latest']
                    )
                ) {
                    $CIDRAM['Components']['ThisComponent']['Outdated'] = true;
                    if (
                        $CIDRAM['Components']['Key'] === 'l10n/' . $CIDRAM['Config']['general']['lang'] ||
                        $CIDRAM['Components']['Key'] === 'theme/' . $CIDRAM['Config']['template_data']['theme']
                    ) {
                        $CIDRAM['Components']['Dependencies'][] = $CIDRAM['Components']['Key'];
                    }
                    $CIDRAM['Components']['Outdated'][] = $CIDRAM['Components']['Key'];
                    $CIDRAM['Components']['ThisComponent']['RowClass'] = 'r';
                    $CIDRAM['Components']['ThisComponent']['StatClass'] = 'txtRd';
                    if (
                        empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required']) ||
                        $CIDRAM['VersionCompare'](
                            $CIDRAM['ScriptVersion'],
                            $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required']
                        )
                    ) {
                        $CIDRAM['Components']['ThisComponent']['StatusOptions'] =
                            $CIDRAM['lang']['response_updates_outdated_manually'];
                    } elseif (
                        !empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required PHP']) &&
                        $CIDRAM['VersionCompare'](PHP_VERSION, $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required PHP'])
                    ) {
                        $CIDRAM['Components']['ThisComponent']['StatusOptions'] = $CIDRAM['ParseVars'](
                            ['V' => $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required PHP']],
                            $CIDRAM['lang']['response_updates_outdated_php_version']
                        );
                    } else {
                        $CIDRAM['Components']['ThisComponent']['StatusOptions'] =
                            $CIDRAM['lang']['response_updates_outdated'];
                        $CIDRAM['Components']['ThisComponent']['Options'] .=
                            '<option value="update-component">' . $CIDRAM['lang']['field_update'] . '</option>';
                    }
                } else {
                    $CIDRAM['Components']['ThisComponent']['StatClass'] = 'txtGn';
                    $CIDRAM['Components']['ThisComponent']['StatusOptions'] =
                        $CIDRAM['lang']['response_updates_already_up_to_date'];
                }
            }
            if (!empty($CIDRAM['Components']['ThisComponent']['Files']['To'])) {
                $CIDRAM['Activable'] = $CIDRAM['IsActivable']($CIDRAM['Components']['ThisComponent']);
                if (
                    ($CIDRAM['Components']['Key'] === 'l10n/' . $CIDRAM['Config']['general']['lang']) ||
                    ($CIDRAM['Components']['Key'] === 'theme/' . $CIDRAM['Config']['template_data']['theme']) ||
                    ($CIDRAM['Components']['Key'] === 'CIDRAM') ||
                    $CIDRAM['IsInUse']($CIDRAM['Components']['ThisComponent'])
                ) {
                    $CIDRAM['AppendToString']($CIDRAM['Components']['ThisComponent']['StatusOptions'], '<hr />',
                        '<div class="txtGn">' . $CIDRAM['lang']['state_component_is_active'] . '</div>'
                    );
                    if ($CIDRAM['Activable']) {
                        $CIDRAM['Components']['ThisComponent']['Options'] .=
                            '<option value="deactivate-component">' . $CIDRAM['lang']['field_deactivate'] . '</option>';
                    }
                } else {
                    if ($CIDRAM['Activable']) {
                        $CIDRAM['Components']['ThisComponent']['Options'] .=
                            '<option value="activate-component">' . $CIDRAM['lang']['field_activate'] . '</option>';
                    }
                    if (!empty($CIDRAM['Components']['ThisComponent']['Uninstallable'])) {
                        $CIDRAM['Components']['ThisComponent']['Options'] .=
                            '<option value="uninstall-component">' . $CIDRAM['lang']['field_uninstall'] . '</option>';
                    }
                    if (!empty($CIDRAM['Components']['ThisComponent']['Provisional'])) {
                        $CIDRAM['AppendToString']($CIDRAM['Components']['ThisComponent']['StatusOptions'], '<hr />',
                            '<div class="txtOe">' . $CIDRAM['lang']['state_component_is_provisional'] . '</div>'
                        );
                    } else {
                        $CIDRAM['AppendToString']($CIDRAM['Components']['ThisComponent']['StatusOptions'], '<hr />',
                            '<div class="txtRd">' . $CIDRAM['lang']['state_component_is_inactive'] . '</div>'
                        );
                    }
                }
            }
        }
        if (empty($CIDRAM['Components']['ThisComponent']['Latest'])) {
            $CIDRAM['Components']['ThisComponent']['Latest'] = $CIDRAM['lang']['response_updates_unable_to_determine'];
        } elseif (
            empty($CIDRAM['Components']['ThisComponent']['Files']['To']) &&
            !empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Files']['To'])
        ) {
            if (
                empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required PHP']) ||
                !$CIDRAM['VersionCompare'](PHP_VERSION, $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required PHP'])
            ) {
                $CIDRAM['Components']['ThisComponent']['Options'] .=
                    '<option value="update-component">' . $CIDRAM['lang']['field_install'] . '</option>';
            } elseif ($CIDRAM['Components']['ThisComponent']['StatusOptions'] === $CIDRAM['lang']['response_updates_not_installed']) {
                $CIDRAM['Components']['ThisComponent']['StatusOptions'] = $CIDRAM['ParseVars'](
                    ['V' => $CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Minimum Required PHP']],
                    $CIDRAM['lang']['response_updates_not_installed_php']
                );
            }
        }
        $CIDRAM['Components']['ThisComponent']['VersionSize'] = 0;
        if (
            !empty($CIDRAM['Components']['ThisComponent']['Files']['Checksum']) &&
            is_array($CIDRAM['Components']['ThisComponent']['Files']['Checksum'])
        ) {
            $CIDRAM['Components']['ThisComponent']['Options'] .=
                '<option value="verify-component">' . $CIDRAM['lang']['field_verify'] . '</option>';
            $CIDRAM['Components']['Verify'][] = $CIDRAM['Components']['Key'];
            array_walk($CIDRAM['Components']['ThisComponent']['Files']['Checksum'], function ($Checksum) use (&$CIDRAM) {
                if (!empty($Checksum) && ($Delimiter = strpos($Checksum, ':')) !== false) {
                    $CIDRAM['Components']['ThisComponent']['VersionSize'] += (int)substr($Checksum, $Delimiter + 1);
                }
            });
        }
        if ($CIDRAM['Components']['ThisComponent']['VersionSize'] > 0) {
            $CIDRAM['FormatFilesize']($CIDRAM['Components']['ThisComponent']['VersionSize']);
            $CIDRAM['Components']['ThisComponent']['VersionSize'] =
                '<br />' . $CIDRAM['lang']['field_size'] .
                $CIDRAM['Components']['ThisComponent']['VersionSize'];
        } else {
            $CIDRAM['Components']['ThisComponent']['VersionSize'] = '';
        }
        $CIDRAM['Components']['ThisComponent']['LatestSize'] = 0;
        if (
            !empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Files']['Checksum']) &&
            is_array($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Files']['Checksum'])
        ) {
            array_walk($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['Key']]['Files']['Checksum'], function ($Checksum) use (&$CIDRAM) {
                if (!empty($Checksum) && ($Delimiter = strpos($Checksum, ':')) !== false) {
                    $CIDRAM['Components']['ThisComponent']['LatestSize'] += (int)substr($Checksum, $Delimiter + 1);
                }
            });
        }
        if ($CIDRAM['Components']['ThisComponent']['LatestSize'] > 0) {
            $CIDRAM['FormatFilesize']($CIDRAM['Components']['ThisComponent']['LatestSize']);
            $CIDRAM['Components']['ThisComponent']['LatestSize'] =
                '<br />' . $CIDRAM['lang']['field_size'] .
                $CIDRAM['Components']['ThisComponent']['LatestSize'];
        } else {
            $CIDRAM['Components']['ThisComponent']['LatestSize'] = '';
        }
        if (!empty($CIDRAM['Components']['ThisComponent']['Options'])) {
            $CIDRAM['AppendToString']($CIDRAM['Components']['ThisComponent']['StatusOptions'], '<hr />',
                '<select name="do" class="auto">' . $CIDRAM['Components']['ThisComponent']['Options'] .
                '</select><input type="submit" value="' . $CIDRAM['lang']['field_ok'] . '" class="auto" />'
            );
            $CIDRAM['Components']['ThisComponent']['Options'] = '';
        }
        /** Append changelog. */
        $CIDRAM['Components']['ThisComponent']['Changelog'] = empty(
            $CIDRAM['Components']['ThisComponent']['Changelog']
        ) ? '' : '<br /><a href="' . $CIDRAM['Components']['ThisComponent']['Changelog'] . '">Changelog</a>';
        /** Append tests. */
        if (!empty($CIDRAM['Components']['RemoteMeta'][$CIDRAM['Components']['ThisComponent']['ID']]['Tests'])) {
            $CIDRAM['AppendTests']($CIDRAM['Components']['ThisComponent']);
        }
        /** Append filename. */
        $CIDRAM['Components']['ThisComponent']['Filename'] = (
            empty($CIDRAM['Components']['ThisComponent']['Files']['To']) ||
            count($CIDRAM['Components']['ThisComponent']['Files']['To']) !== 1
        ) ? '' : '<br />' . $CIDRAM['lang']['field_filename'] . $CIDRAM['Components']['ThisComponent']['Files']['To'][0];
        /** Finalise entry. */
        if (
            !($CIDRAM['FE']['hide-non-outdated'] && empty($CIDRAM['Components']['ThisComponent']['Outdated'])) &&
            !($CIDRAM['FE']['hide-unused'] && empty($CIDRAM['Components']['ThisComponent']['Files']['To']))
        ) {
            if (empty($CIDRAM['Components']['ThisComponent']['RowClass'])) {
                $CIDRAM['Components']['ThisComponent']['RowClass'] = 'h1';
            }
            $CIDRAM['FE']['Indexes'][$CIDRAM['Components']['ThisComponent']['ID']] =
                '<a href="#' . $CIDRAM['Components']['ThisComponent']['ID'] . '">' . $CIDRAM['Components']['ThisComponent']['Name'] . "</a><br /><br />\n            ";
            $CIDRAM['Components']['Out'][$CIDRAM['Components']['Key']] = $CIDRAM['ParseVars'](
                $CIDRAM['lang'] + $CIDRAM['ArrayFlatten']($CIDRAM['Components']['ThisComponent']) + $CIDRAM['ArrayFlatten']($CIDRAM['FE']),
                $CIDRAM['FE']['UpdatesRow']
            );
        }
    }

    /** Update request via Cronable. */
    if (!empty($CIDRAM['Alternate']) && !empty($UpdateAll) && !empty($CIDRAM['Components']['Outdated'])) {

        /** Trigger updates handler. */
        $CIDRAM['UpdatesHandler']('update-component', $CIDRAM['Components']['Outdated']);

    }

    /** Prepare newly found component metadata and options for display. */
    foreach ($CIDRAM['Components']['RemoteMeta'] as $CIDRAM['Components']['Key'] => &$CIDRAM['Components']['ThisComponent']) {
        if (
            isset($CIDRAM['Components']['Meta'][$CIDRAM['Components']['Key']]) ||
            empty($CIDRAM['Components']['ThisComponent']['Remote']) ||
            empty($CIDRAM['Components']['ThisComponent']['Version']) ||
            empty($CIDRAM['Components']['ThisComponent']['Files']['From']) ||
            empty($CIDRAM['Components']['ThisComponent']['Files']['To']) ||
            empty($CIDRAM['Components']['ThisComponent']['Reannotate']) ||
            !$CIDRAM['Traverse']($CIDRAM['Components']['ThisComponent']['Reannotate']) ||
            !file_exists($CIDRAM['Vault'] . $CIDRAM['Components']['ThisComponent']['Reannotate'])
        ) {
            continue;
        }
        $CIDRAM['Components']['ReannotateThis'] = $CIDRAM['Components']['ThisComponent']['Reannotate'];
        $CIDRAM['FetchRemote']();
        if (!preg_match(
            "\x01(\n" . preg_quote($CIDRAM['Components']['Key']) . ":?)(\n [^\n]*)*\n\x01i",
            $CIDRAM['Components']['ThisComponent']['RemoteData'],
            $CIDRAM['Components']['RemoteDataThis']
        )) {
            continue;
        }
        $CIDRAM['Components']['RemoteDataThis'] = preg_replace(
            ["/\n Files:(\n  [^\n]*)*\n/i", "/\n Version: [^\n]*\n/i"],
            "\n",
            $CIDRAM['Components']['RemoteDataThis'][0]
        );
        if (empty($CIDRAM['Components']['Remotes'][$CIDRAM['Components']['ReannotateThis']])) {
            $CIDRAM['Components']['Remotes'][$CIDRAM['Components']['ReannotateThis']] =
                $CIDRAM['ReadFile']($CIDRAM['Vault'] . $CIDRAM['Components']['ReannotateThis']);
        }
        if (substr(
            $CIDRAM['Components']['Remotes'][$CIDRAM['Components']['ReannotateThis']], -2
        ) !== "\n\n" || substr(
            $CIDRAM['Components']['Remotes'][$CIDRAM['Components']['ReannotateThis']], 0, 4
        ) !== "---\n") {
            continue;
        }
        $CIDRAM['ThisOffset'] = [0 => []];
        $CIDRAM['ThisOffset'][1] = preg_match(
            '/(\n+)$/',
            $CIDRAM['Components']['Remotes'][$CIDRAM['Components']['ReannotateThis']],
            $CIDRAM['ThisOffset'][0]
        );
        $CIDRAM['ThisOffset'] = strlen($CIDRAM['ThisOffset'][0][0]) * -1;
        $CIDRAM['Components']['Remotes'][$CIDRAM['Components']['ReannotateThis']] = substr(
            $CIDRAM['Components']['Remotes'][$CIDRAM['Components']['ReannotateThis']], 0, $CIDRAM['ThisOffset']
        ) . $CIDRAM['Components']['RemoteDataThis'] . "\n";
        $CIDRAM['PrepareName']($CIDRAM['Components']['ThisComponent'], $CIDRAM['Components']['Key']);
        $CIDRAM['PrepareExtendedDescription']($CIDRAM['Components']['ThisComponent'], $CIDRAM['Components']['Key']);
        $CIDRAM['Components']['ThisComponent']['ID'] = $CIDRAM['Components']['Key'];
        $CIDRAM['Components']['ThisComponent']['Latest'] = $CIDRAM['Components']['ThisComponent']['Version'];
        $CIDRAM['Components']['ThisComponent']['Version'] = $CIDRAM['lang']['response_updates_not_installed'];
        $CIDRAM['Components']['ThisComponent']['StatClass'] = 'txtRd';
        $CIDRAM['Components']['ThisComponent']['RowClass'] = 'h2';
        $CIDRAM['Components']['ThisComponent']['VersionSize'] = '';
        $CIDRAM['Components']['ThisComponent']['LatestSize'] = 0;
        if (
            !empty($CIDRAM['Components']['ThisComponent']['Files']['Checksum']) &&
            is_array($CIDRAM['Components']['ThisComponent']['Files']['Checksum'])
        ) {
            foreach ($CIDRAM['Components']['ThisComponent']['Files']['Checksum'] as $CIDRAM['Components']['ThisChecksum']) {
                if (empty($CIDRAM['Components']['ThisChecksum'])) {
                    continue;
                }
                if (($CIDRAM['FilesDelimit'] = strpos($CIDRAM['Components']['ThisChecksum'], ':')) !== false) {
                    $CIDRAM['Components']['ThisComponent']['LatestSize'] +=
                        (int)substr($CIDRAM['Components']['ThisChecksum'], $CIDRAM['FilesDelimit'] + 1);
                }
            }
        }
        if ($CIDRAM['Components']['ThisComponent']['LatestSize'] > 0) {
            $CIDRAM['FormatFilesize']($CIDRAM['Components']['ThisComponent']['LatestSize']);
            $CIDRAM['Components']['ThisComponent']['LatestSize'] =
                '<br />' . $CIDRAM['lang']['field_size'] .
                $CIDRAM['Components']['ThisComponent']['LatestSize'];
        } else {
            $CIDRAM['Components']['ThisComponent']['LatestSize'] = '';
        }
        $CIDRAM['Components']['ThisComponent']['StatusOptions'] = (
            !empty($CIDRAM['Components']['ThisComponent']['Minimum Required PHP']) &&
            $CIDRAM['VersionCompare'](PHP_VERSION, $CIDRAM['Components']['ThisComponent']['Minimum Required PHP'])
        ) ? $CIDRAM['ParseVars'](
            ['V' => $CIDRAM['Components']['ThisComponent']['Minimum Required PHP']],
            $CIDRAM['lang']['response_updates_not_installed_php']
        ) :
            $CIDRAM['lang']['response_updates_not_installed'] .
            '<br /><select name="do" class="auto"><option value="update-component">' .
            $CIDRAM['lang']['field_install'] . '</option></select><input type="submit" value="' .
            $CIDRAM['lang']['field_ok'] . '" class="auto" />';
        /** Append changelog. */
        $CIDRAM['Components']['ThisComponent']['Changelog'] = empty(
            $CIDRAM['Components']['ThisComponent']['Changelog']
        ) ? '' : '<br /><a href="' . $CIDRAM['Components']['ThisComponent']['Changelog'] . '">Changelog</a>';
        /** Append tests. */
        if (!empty($CIDRAM['Components']['ThisComponent']['Tests'])) {
            $CIDRAM['AppendTests']($CIDRAM['Components']['ThisComponent']);
        }
        /** Append filename (empty). */
        $CIDRAM['Components']['ThisComponent']['Filename'] = '';
        /** Finalise entry. */
        if (!$CIDRAM['FE']['hide-unused']) {
            $CIDRAM['FE']['Indexes'][$CIDRAM['Components']['ThisComponent']['ID']] =
                '<a href="#' . $CIDRAM['Components']['ThisComponent']['ID'] . '">' . $CIDRAM['Components']['ThisComponent']['Name'] . "</a><br /><br />\n            ";
            $CIDRAM['Components']['Out'][$CIDRAM['Components']['Key']] = $CIDRAM['ParseVars'](
                $CIDRAM['lang'] + $CIDRAM['ArrayFlatten']($CIDRAM['Components']['ThisComponent']) + $CIDRAM['ArrayFlatten']($CIDRAM['FE']),
                $CIDRAM['FE']['UpdatesRow']
            );
        }
    }
    /** Cleanup. */
    unset($CIDRAM['Components']['ThisComponent']);

    /** Write annotations for newly found component metadata. */
    array_walk($CIDRAM['Components']['Remotes'], function ($Remote, $Key) use (&$CIDRAM) {
        if (substr($Remote, -2) !== "\n\n" || substr($Remote, 0, 4) !== "---\n") {
            return;
        }
        $Handle = fopen($CIDRAM['Vault'] . $Key, 'w');
        fwrite($Handle, $Remote);
        fclose($Handle);
    });

    /** Finalise output and unset working data. */
    uksort($CIDRAM['FE']['Indexes'], $CIDRAM['UpdatesSortFunc']);
    $CIDRAM['FE']['Indexes'] = implode('', $CIDRAM['FE']['Indexes']);
    uksort($CIDRAM['Components']['Out'], $CIDRAM['UpdatesSortFunc']);
    $CIDRAM['FE']['Components'] = implode('', $CIDRAM['Components']['Out']);

    $CIDRAM['Components']['CountOutdated'] = count($CIDRAM['Components']['Outdated']);
    $CIDRAM['Components']['CountVerify'] = count($CIDRAM['Components']['Verify']);

    /** Preparing for update all and verify all buttons. */
    $CIDRAM['FE']['UpdateAll'] = ($CIDRAM['Components']['CountOutdated'] || $CIDRAM['Components']['CountVerify']) ? '<hr />' : '';

    /** Instructions to update everything at once. */
    if ($CIDRAM['Components']['CountOutdated']) {
        $CIDRAM['FE']['UpdateAll'] .=
            '<form action="?' . $CIDRAM['FE']['UpdatesFormTarget'] .
            '" method="POST" style="display:inline"><input name="cidram-form-target" type="hidden" value="updates" />' .
            '<input name="do" type="hidden" value="update-component" />';
        foreach ($CIDRAM['Components']['Outdated'] as $CIDRAM['Components']['ThisOutdated']) {
            $CIDRAM['FE']['UpdateAll'] .= '<input name="ID[]" type="hidden" value="' . $CIDRAM['Components']['ThisOutdated'] . '" />';
        }
        $CIDRAM['FE']['UpdateAll'] .= '<input type="submit" value="' . $CIDRAM['lang']['field_update_all'] . '" class="auto" /></form>';
    }

    /** Instructions to verify everything at once. */
    if ($CIDRAM['Components']['CountVerify']) {
        $CIDRAM['FE']['UpdateAll'] .=
            '<form action="?' . $CIDRAM['FE']['UpdatesFormTarget'] .
            '" method="POST" style="display:inline"><input name="cidram-form-target" type="hidden" value="updates" />' .
            '<input name="do" type="hidden" value="verify-component" />';
        foreach ($CIDRAM['Components']['Verify'] as $CIDRAM['Components']['ThisVerify']) {
            $CIDRAM['FE']['UpdateAll'] .= '<input name="ID[]" type="hidden" value="' . $CIDRAM['Components']['ThisVerify'] . '" />';
        }
        $CIDRAM['FE']['UpdateAll'] .= '<input type="submit" value="' . $CIDRAM['lang']['field_verify_all'] . '" class="auto" /></form>';
    }

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_updates.html'))
    );

    /** Inject dependencies into update instructions for core package component. */
    if (count($CIDRAM['Components']['Dependencies'])) {
        $CIDRAM['FE']['FE_Content'] = str_replace('<input name="ID" type="hidden" value="CIDRAM" />',
            '<input name="ID[]" type="hidden" value="' .
            implode('" /><input name="ID[]" type="hidden" value="', $CIDRAM['Components']['Dependencies']) .
            '" /><input name="ID[]" type="hidden" value="CIDRAM" />',
        $CIDRAM['FE']['FE_Content']);
    }

    /** Send output. */
    if (!$CIDRAM['FE']['CronMode']) {
        /** Normal page output. */
        echo $CIDRAM['SendOutput']();
    } elseif (!empty($UpdateAll)) {
        /** Returned state message for cronable (locally updating). */
        $Results = ['state_msg' => str_ireplace(['<code>', '</code>', '<br />'], ['[', ']', "\n"], $CIDRAM['FE']['state_msg'])];
    } elseif (!empty($CIDRAM['FE']['state_msg'])) {
        /** Returned state message for cronable. */
        echo json_encode([
            'state_msg' => str_ireplace(['<code>', '</code>', '<br />'], ['[', ']', "\n"], $CIDRAM['FE']['state_msg'])
        ]);
    } elseif (!empty($_POST['do']) && $_POST['do'] === 'get-list' && count($CIDRAM['Components']['Outdated'])) {
        /** Returned list of outdated components for cronable. */
        echo json_encode([
            'state_msg' => str_ireplace(['<code>', '</code>', '<br />'], ['[', ']', "\n"], $CIDRAM['FE']['state_msg']),
            'outdated' => $CIDRAM['Components']['Outdated']
        ]);
    }

    /** Cleanup. */
    unset($CIDRAM['Components']);

}

/** File Manager. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'file-manager' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_file_manager'], $CIDRAM['lang']['tip_file_manager'], false);

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Load pie chart template file upon request. */
    if (empty($CIDRAM['QueryVars']['show'])) {
        $CIDRAM['FE']['ChartJSPath'] = $CIDRAM['PieFile'] = $CIDRAM['PiePath'] = '';
    } else {
        if ($CIDRAM['PiePath'] = $CIDRAM['GetAssetPath']('_chartjs.html', true)) {
            $CIDRAM['PieFile'] = $CIDRAM['ReadFile']($CIDRAM['PiePath']);
        } else {
            $CIDRAM['PieFile'] = '<tr><td class="h4f" colspan="2"><div class="s">{PieChartHTML}</div></td></tr>';
        }
        $CIDRAM['FE']['ChartJSPath'] = $CIDRAM['GetAssetPath']('Chart.min.js', true) ? '?cidram-asset=Chart.min.js&theme=default' : '';
    }

    /** Set vault path for pie chart display. */
    $CIDRAM['FE']['VaultPath'] = str_replace("\\", '/', $CIDRAM['Vault']) . '*';

    /** Prepare components metadata working array. */
    $CIDRAM['Components'] = ['Files', 'Components', 'Names'];

    /** Show/hide pie charts link and etc. */
    if (!$CIDRAM['PieFile']) {

        $CIDRAM['FE']['FMgrFormTarget'] = 'cidram-page=file-manager';
        $CIDRAM['FE']['ShowHideLink'] = '<a href="?cidram-page=file-manager&show=true">' . $CIDRAM['lang']['label_show'] . '</a>';

    } else {

        $CIDRAM['FE']['FMgrFormTarget'] = 'cidram-page=file-manager&show=true';
        $CIDRAM['FE']['ShowHideLink'] = '<a href="?cidram-page=file-manager">' . $CIDRAM['lang']['label_hide'] . '</a>';

        /** Fetch components lists. */
        $CIDRAM['FetchComponentsLists']($CIDRAM['Vault'], $CIDRAM['Components']['Components']);

        /** Identifying file component correlations. */
        foreach ($CIDRAM['Components']['Components'] as $CIDRAM['Components']['ThisName'] => &$CIDRAM['Components']['ThisData']) {
            if (!empty($CIDRAM['Components']['ThisData']['Files']['To'])) {
                $CIDRAM['Arrayify']($CIDRAM['Components']['ThisData']['Files']['To']);
                foreach ($CIDRAM['Components']['ThisData']['Files']['To'] as $CIDRAM['Components']['ThisFile']) {
                    $CIDRAM['Components']['ThisFile'] = str_replace("\\", '/', $CIDRAM['Components']['ThisFile']);
                    $CIDRAM['Components']['Files'][$CIDRAM['Components']['ThisFile']] = $CIDRAM['Components']['ThisName'];
                }
            }
            $CIDRAM['PrepareName']($CIDRAM['Components']['ThisData'], $CIDRAM['Components']['ThisName']);
            if (!empty($CIDRAM['Components']['ThisData']['Name'])) {
                $CIDRAM['Components']['Names'][$CIDRAM['Components']['ThisName']] = $CIDRAM['Components']['ThisData']['Name'];
            }
            $CIDRAM['Components']['ThisData'] = 0;
        }

    }

    /** Upload a new file. */
    if (isset($_POST['do']) && $_POST['do'] === 'upload-file' && isset($_FILES['upload-file']['name'])) {

        /** Check whether safe. */
        $CIDRAM['SafeToContinue'] = (
            basename($_FILES['upload-file']['name']) === $_FILES['upload-file']['name'] &&
            $CIDRAM['FileManager-PathSecurityCheck']($_FILES['upload-file']['name']) &&
            isset($_FILES['upload-file']['tmp_name'], $_FILES['upload-file']['error']) &&
            $_FILES['upload-file']['error'] === UPLOAD_ERR_OK &&
            is_uploaded_file($_FILES['upload-file']['tmp_name']) &&
            !is_link($CIDRAM['Vault'] . $_FILES['upload-file']['name'])
        );

        /** If the filename already exists, delete the old file before moving the new file. */
        if ($CIDRAM['SafeToContinue'] && is_readable($CIDRAM['Vault'] . $_FILES['upload-file']['name'])) {
            if (is_dir($CIDRAM['Vault'] . $_FILES['upload-file']['name'])) {
                if ($CIDRAM['IsDirEmpty']($CIDRAM['Vault'] . $_FILES['upload-file']['name'])) {
                    rmdir($CIDRAM['Vault'] . $_FILES['upload-file']['name']);
                } else {
                    $CIDRAM['SafeToContinue'] = false;
                }
            } else {
                unlink($CIDRAM['Vault'] . $_FILES['upload-file']['name']);
            }
        }

        /** Move the newly uploaded file to the designated location. */
        if ($CIDRAM['SafeToContinue']) {
            rename($_FILES['upload-file']['tmp_name'], $CIDRAM['Vault'] . $_FILES['upload-file']['name']);
            $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_file_uploaded'];
        } else {
            $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_upload_error'];
        }

    }

    /** A form was submitted. */
    elseif (
        isset($_POST['filename'], $_POST['do']) &&
        is_readable($CIDRAM['Vault'] . $_POST['filename']) &&
        $CIDRAM['FileManager-PathSecurityCheck']($_POST['filename'])
    ) {

        /** Delete a file. */
        if ($_POST['do'] === 'delete-file') {

            if (is_dir($CIDRAM['Vault'] . $_POST['filename'])) {
                if ($CIDRAM['IsDirEmpty']($CIDRAM['Vault'] . $_POST['filename'])) {
                    rmdir($CIDRAM['Vault'] . $_POST['filename']);
                    $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_directory_deleted'];
                } else {
                    $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_delete_error'];
                }
            } else {
                unlink($CIDRAM['Vault'] . $_POST['filename']);

                /** Remove empty directories. */
                $CIDRAM['DeleteDirectory']($_POST['filename']);

                $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_file_deleted'];
            }

        /** Rename a file. */
        } elseif ($_POST['do'] === 'rename-file' && isset($_POST['filename'])) {

            if (isset($_POST['filename_new'])) {

                /** Check whether safe. */
                $CIDRAM['SafeToContinue'] = (
                    $CIDRAM['FileManager-PathSecurityCheck']($_POST['filename']) &&
                    $CIDRAM['FileManager-PathSecurityCheck']($_POST['filename_new']) &&
                    $_POST['filename'] !== $_POST['filename_new']
                );

                /** If the destination already exists, delete it before renaming the new file. */
                if (
                    $CIDRAM['SafeToContinue'] &&
                    file_exists($CIDRAM['Vault'] . $_POST['filename_new']) &&
                    is_readable($CIDRAM['Vault'] . $_POST['filename_new'])
                ) {
                    if (is_dir($CIDRAM['Vault'] . $_POST['filename_new'])) {
                        if ($CIDRAM['IsDirEmpty']($CIDRAM['Vault'] . $_POST['filename_new'])) {
                            rmdir($CIDRAM['Vault'] . $_POST['filename_new']);
                        } else {
                            $CIDRAM['SafeToContinue'] = false;
                        }
                    } else {
                        unlink($CIDRAM['Vault'] . $_POST['filename_new']);
                    }
                }

                /** Rename the file. */
                if ($CIDRAM['SafeToContinue']) {

                    $CIDRAM['ThisName'] = $_POST['filename_new'];
                    $CIDRAM['ThisPath'] = $CIDRAM['Vault'];

                    /** Add parent directories. */
                    while (strpos($CIDRAM['ThisName'], '/') !== false || strpos($CIDRAM['ThisName'], "\\") !== false) {
                        $CIDRAM['Separator'] = (strpos($CIDRAM['ThisName'], '/') !== false) ? '/' : "\\";
                        $CIDRAM['ThisDir'] = substr($CIDRAM['ThisName'], 0, strpos($CIDRAM['ThisName'], $CIDRAM['Separator']));
                        $CIDRAM['ThisPath'] .= $CIDRAM['ThisDir'] . '/';
                        $CIDRAM['ThisName'] = substr($CIDRAM['ThisName'], strlen($CIDRAM['ThisDir']) + 1);
                        if (!file_exists($CIDRAM['ThisPath']) || !is_dir($CIDRAM['ThisPath'])) {
                            mkdir($CIDRAM['ThisPath']);
                        }
                    }

                    if (rename($CIDRAM['Vault'] . $_POST['filename'], $CIDRAM['Vault'] . $_POST['filename_new'])) {

                        /** Remove empty directories. */
                        $CIDRAM['DeleteDirectory']($_POST['filename']);

                        $CIDRAM['FE']['state_msg'] = (is_dir($CIDRAM['Vault'] . $_POST['filename_new'])) ?
                            $CIDRAM['lang']['response_directory_renamed'] : $CIDRAM['lang']['response_file_renamed'];

                    }

                } elseif (!$CIDRAM['FE']['state_msg']) {
                    $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_rename_error'];
                }

            } else {

                $CIDRAM['FE']['FE_Title'] .= ' – ' . $CIDRAM['lang']['field_rename_file'] . ' – ' . $_POST['filename'];
                $CIDRAM['FE']['filename'] = $_POST['filename'];

                /** Parse output. */
                $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
                    $CIDRAM['lang'] + $CIDRAM['FE'],
                    $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_files_rename.html'))
                );

                /** Send output. */
                echo $CIDRAM['SendOutput']();
                die;

            }

        /** Edit a file. */
        } elseif ($_POST['do'] === 'edit-file') {

            if (isset($_POST['content'])) {

                $_POST['content'] = str_replace("\r", '', $_POST['content']);
                $CIDRAM['OldData'] = $CIDRAM['ReadFile']($CIDRAM['Vault'] . $_POST['filename']);
                if (strpos($CIDRAM['OldData'], "\r\n") !== false && strpos($CIDRAM['OldData'], "\n\n") === false) {
                    $_POST['content'] = str_replace("\n", "\r\n", $_POST['content']);
                }

                $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . $_POST['filename'], 'w');
                fwrite($CIDRAM['Handle'], $_POST['content']);
                fclose($CIDRAM['Handle']);

                $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_file_edited'];

            } else {

                $CIDRAM['FE']['FE_Title'] .= ' – ' . $_POST['filename'];
                $CIDRAM['FE']['filename'] = $_POST['filename'];
                $CIDRAM['FE']['content'] = htmlentities($CIDRAM['ReadFile']($CIDRAM['Vault'] . $_POST['filename']));

                /** Parse output. */
                $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
                    $CIDRAM['lang'] + $CIDRAM['FE'],
                    $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_files_edit.html'))
                );

                /** Send output. */
                echo $CIDRAM['SendOutput']();
                die;

            }

        /** Download a file. */
        } elseif ($_POST['do'] === 'download-file') {

            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary');
            header('Content-disposition: attachment; filename="' . basename($_POST['filename']) . '"');
            echo $CIDRAM['ReadFile']($CIDRAM['Vault'] . $_POST['filename']);
            die;

        }

    }

    /** Template for file rows. */
    $CIDRAM['FE']['FilesRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_files_row.html'));

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_files.html'))
    );

    /** Initialise files data variable. */
    $CIDRAM['FE']['FilesData'] = '';

    /** Total size. */
    $CIDRAM['FE']['TotalSize'] = 0;

    /** Fetch files data. */
    $CIDRAM['FilesArray'] = $CIDRAM['FileManager-RecursiveList']($CIDRAM['Vault']);

    if (!$CIDRAM['PieFile']) {
        $CIDRAM['FE']['PieChart'] = '';
    } else {

        /** Sort pie chart values. */
        arsort($CIDRAM['Components']['Components']);

        /** Initialise pie chart values. */
        $CIDRAM['FE']['PieChartValues'] = [];

        /** Initialise pie chart labels. */
        $CIDRAM['FE']['PieChartLabels'] = [];

        /** Initialise pie chart colours. */
        $CIDRAM['FE']['PieChartColours'] = [];

        /** Initialise pie chart legend. */
        $CIDRAM['FE']['PieChartHTML'] = '';

        /** Building pie chart values. */
        foreach ($CIDRAM['Components']['Components'] as $CIDRAM['Components']['ThisName'] => $CIDRAM['Components']['ThisData']) {
            if (empty($CIDRAM['Components']['ThisData'])) {
                continue;
            }
            $CIDRAM['Components']['ThisSize'] = $CIDRAM['Components']['ThisData'];
            $CIDRAM['FormatFilesize']($CIDRAM['Components']['ThisSize']);
            $CIDRAM['Components']['ThisName'] .= ' – ' . $CIDRAM['Components']['ThisSize'];
            $CIDRAM['FE']['PieChartValues'][] = $CIDRAM['Components']['ThisData'];
            $CIDRAM['FE']['PieChartLabels'][] = $CIDRAM['Components']['ThisName'];
            if ($CIDRAM['PiePath']) {
                $CIDRAM['Components']['ThisColour'] = substr(md5($CIDRAM['Components']['ThisName']), 0, 6);
                $CIDRAM['Components']['RGB'] =
                    hexdec(substr($CIDRAM['Components']['ThisColour'], 0, 2)) . ',' .
                    hexdec(substr($CIDRAM['Components']['ThisColour'], 2, 2)) . ',' .
                    hexdec(substr($CIDRAM['Components']['ThisColour'], 4, 2));
                $CIDRAM['FE']['PieChartColours'][] = '#' . $CIDRAM['Components']['ThisColour'];
                $CIDRAM['FE']['PieChartHTML'] .=
                    '<span style="background:linear-gradient(90deg,rgba(' .
                    $CIDRAM['Components']['RGB'] . ',0.3),rgba(' .
                    $CIDRAM['Components']['RGB'] . ',0))"><span style="color:#' .
                    $CIDRAM['Components']['ThisColour'] . '">➖</span> ' .
                    $CIDRAM['Components']['ThisName'] . "</span><br />\n";
            } else {
                $CIDRAM['FE']['PieChartHTML'] .= '➖ ' . $CIDRAM['Components']['ThisName'] . "<br />\n";
            }
        }

        /** Finalise pie chart values. */
        $CIDRAM['FE']['PieChartValues'] = '[' . implode(', ', $CIDRAM['FE']['PieChartValues']) . ']';

        /** Finalise pie chart labels. */
        $CIDRAM['FE']['PieChartLabels'] = '["' . implode('", "', $CIDRAM['FE']['PieChartLabels']) . '"]';

        /** Finalise pie chart colours. */
        $CIDRAM['FE']['PieChartColours'] = '["' . implode('", "', $CIDRAM['FE']['PieChartColours']) . '"]';

        /** Finalise pie chart. */
        $CIDRAM['FE']['PieChart'] = $CIDRAM['ParseVars']($CIDRAM['lang'] + $CIDRAM['FE'], $CIDRAM['PieFile']);

    }

    /** Cleanup. */
    unset($CIDRAM['PieFile'], $CIDRAM['PiePath'], $CIDRAM['Components']);

    /** Process files data. */
    array_walk($CIDRAM['FilesArray'], function ($ThisFile) use (&$CIDRAM) {
        $ThisFile['ThisOptions'] = '';
        if (!$ThisFile['Directory'] || $CIDRAM['IsDirEmpty']($CIDRAM['Vault'] . $ThisFile['Filename'])) {
            $ThisFile['ThisOptions'] .= '<option value="delete-file">' . $CIDRAM['lang']['field_delete_file'] . '</option>';
            $ThisFile['ThisOptions'] .= '<option value="rename-file">' . $CIDRAM['lang']['field_rename_file'] . '</option>';
        }
        if ($ThisFile['CanEdit']) {
            $ThisFile['ThisOptions'] .= '<option value="edit-file">' . $CIDRAM['lang']['field_edit_file'] . '</option>';
        }
        if (!$ThisFile['Directory']) {
            $ThisFile['ThisOptions'] .= '<option value="download-file">' . $CIDRAM['lang']['field_download_file'] . '</option>';
        }
        if ($ThisFile['ThisOptions']) {
            $ThisFile['ThisOptions'] =
                '<select name="do">' . $ThisFile['ThisOptions'] . '</select>' .
                '<input type="submit" value="' . $CIDRAM['lang']['field_ok'] . '" class="auto" />';
        }
        $CIDRAM['FE']['FilesData'] .= $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'] + $ThisFile, $CIDRAM['FE']['FilesRow']
        );
    });

    /** Total size. */
    $CIDRAM['FormatFilesize']($CIDRAM['FE']['TotalSize']);

    /** Disk free space. */
    $CIDRAM['FE']['FreeSpace'] = disk_free_space(__DIR__);

    /** Disk total space. */
    $CIDRAM['FE']['TotalSpace'] = disk_total_space(__DIR__);

    /** Disk total usage. */
    $CIDRAM['FE']['TotalUsage'] = $CIDRAM['FE']['TotalSpace'] - $CIDRAM['FE']['FreeSpace'];

    $CIDRAM['FormatFilesize']($CIDRAM['FE']['FreeSpace']);
    $CIDRAM['FormatFilesize']($CIDRAM['FE']['TotalSpace']);
    $CIDRAM['FormatFilesize']($CIDRAM['FE']['TotalUsage']);

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** Sections List. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'sections' && $CIDRAM['FE']['Permissions'] === 1) {

    if (!$CIDRAM['FE']['ASYNC']) {

        /** Page initial prepwork. */
        $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_sections_list'], $CIDRAM['lang']['tip_sections_list']);

        /** Append async globals. */
        $CIDRAM['FE']['JS'] .=
            "function slx(a,b,c,d){window['SectionName']=a,window['Action']=b,$('POST','',['SectionName','Action'],null," .
            "function(e){hide(c),show(d,'block')},null)}";

        $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

        /** Add flags CSS. */
        if ($CIDRAM['FE']['Flags'] = file_exists($CIDRAM['Vault'] . 'fe_assets/flags.css')) {
            $CIDRAM['FE']['OtherHead'] .= "\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"?cidram-page=flags\" />";
        }

        /** Process signature files. */
        $CIDRAM['FE']['Data'] = (
            (empty($CIDRAM['Config']['signatures']['ipv4']) && empty($CIDRAM['Config']['signatures']['ipv6']))
        ) ? '        <div class="txtRd">' . $CIDRAM['lang']['warning_signatures_1'] . "</div>\n" : $CIDRAM['SectionsHandler'](
            array_unique(explode(',', $CIDRAM['Config']['signatures']['ipv4'] . ',' . $CIDRAM['Config']['signatures']['ipv6']))
        );

        /** Calculate and append page load time, and append totals. */
        $CIDRAM['FE']['Data'] = '<div class="s">' . sprintf(
            $CIDRAM['lang']['state_loadtime'],
            $CIDRAM['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3)
        ) . '<br />' . sprintf(
            $CIDRAM['lang']['state_sl_totals'],
            $CIDRAM['Number_L10N'](isset($CIDRAM['FE']['SL_Signatures']) ? $CIDRAM['FE']['SL_Signatures'] : 0),
            $CIDRAM['Number_L10N'](isset($CIDRAM['FE']['SL_Sections']) ? $CIDRAM['FE']['SL_Sections'] : 0),
            $CIDRAM['Number_L10N'](isset($CIDRAM['FE']['SL_Files']) ? $CIDRAM['FE']['SL_Files'] : 0),
            $CIDRAM['Number_L10N'](isset($CIDRAM['FE']['SL_Unique']) ? $CIDRAM['FE']['SL_Unique'] : 0)
        ) . '</div><hr />' . $CIDRAM['FE']['Data'];

        /** Parse output. */
        $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_sections.html'))
        );

        /** Send output. */
        echo $CIDRAM['SendOutput']();

    } elseif (isset($_POST['SectionName'], $_POST['Action'])) {

        /** Fetch current ignores data. */
        $CIDRAM['IgnoreData'] = $CIDRAM['ReadFile']($CIDRAM['Vault'] . 'ignore.dat') ?: '';

        if ($_POST['Action'] === 'unignore' && preg_match("~\nIgnore " . $_POST['SectionName'] . "\n~", $CIDRAM['IgnoreData'])) {
            $CIDRAM['IgnoreData'] = preg_replace("~\nIgnore " . $_POST['SectionName'] . "\n~", "\n", $CIDRAM['IgnoreData']);
            $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . 'ignore.dat', 'w');
            fwrite($CIDRAM['Handle'], $CIDRAM['IgnoreData']);
            fclose($CIDRAM['Handle']);
        } elseif ($_POST['Action'] === 'ignore' && !preg_match("~\nIgnore " . $_POST['SectionName'] . "\n~", $CIDRAM['IgnoreData'])) {
            if (strpos($CIDRAM['IgnoreData'], "\n# End front-end generated ignore rules.") === false) {
                $CIDRAM['IgnoreData'] .= "\n# Begin front-end generated ignore rules.\n# End front-end generated ignore rules.\n";
            }
            $CIDRAM['IgnoreData'] = substr($CIDRAM['IgnoreData'], 0, strrpos(
                $CIDRAM['IgnoreData'],
                "# End front-end generated ignore rules.\n"
            )) . "Ignore " . $_POST['SectionName'] . "\n" . substr($CIDRAM['IgnoreData'], strrpos(
                $CIDRAM['IgnoreData'],
                "# End front-end generated ignore rules.\n"
            ));
            $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . 'ignore.dat', 'w');
            fwrite($CIDRAM['Handle'], $CIDRAM['IgnoreData']);
            fclose($CIDRAM['Handle']);
        }

        /** Cleanup. */
        unset($CIDRAM['Handle'], $CIDRAM['IgnoreData']);

    }

}

/** Range Tables. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'range' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_range'], $CIDRAM['lang']['tip_range']);

    /** Append number localisation JS. */
    $CIDRAM['FE']['JS'] .= $CIDRAM['Number_L10N_JS']() . "\n";

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Add flags CSS. */
    if ($CIDRAM['FE']['Flags'] = file_exists($CIDRAM['Vault'] . 'fe_assets/flags.css')) {
        $CIDRAM['FE']['OtherHead'] .= "\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"?cidram-page=flags\" />";
    }

    /** Template for range rows. */
    $CIDRAM['FE']['RangeRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_range_row.html'));

    /** Process signature files and fetch returned JavaScript stuff. */
    $CIDRAM['FE']['JSFOOT'] = $CIDRAM['RangeTablesHandler'](
        array_unique(explode(',', $CIDRAM['Config']['signatures']['ipv4'])),
        array_unique(explode(',', $CIDRAM['Config']['signatures']['ipv6']))
    );

    /** Calculate and append page load time, and append totals. */
    $CIDRAM['FE']['ProcTime'] = '<div class="s">' . sprintf(
        $CIDRAM['lang']['state_loadtime'],
        $CIDRAM['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3)
    ) . '</div>';

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_range.html'))
    );

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** IP Aggregator. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'ip-aggregator' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_ip_aggregator'], $CIDRAM['lang']['tip_ip_aggregator'], false);

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Results counts. */
    $CIDRAM['Results'] = ['In' => 0, 'Rejected' => 0, 'Accepted' => 0, 'Merged' => 0, 'Out' => 0];

    /** Data was submitted for aggregation. */
    if (isset($_POST['input'])) {
        $CIDRAM['FE']['input'] = $_POST['input'];
        require $CIDRAM['Vault'] . 'aggregator.php';
        $CIDRAM['Aggregator'] = new Aggregator($CIDRAM);
        $CIDRAM['FE']['output'] = $CIDRAM['Aggregator']->aggregate($_POST['input']);
        unset($CIDRAM['Aggregator']);
        $CIDRAM['FE']['ResultLine'] = sprintf(
            $CIDRAM['lang']['label_results'],
            '<span class="txtRd">' . $CIDRAM['Number_L10N']($CIDRAM['Results']['In']) . '</span>',
            '<span class="txtRd">' . $CIDRAM['Number_L10N']($CIDRAM['Results']['Rejected']) . '</span>',
            '<span class="txtRd">' . $CIDRAM['Number_L10N']($CIDRAM['Results']['Accepted']) . '</span>',
            '<span class="txtRd">' . $CIDRAM['Number_L10N']($CIDRAM['Results']['Merged']) . '</span>',
            '<span class="txtRd">' . $CIDRAM['Number_L10N']($CIDRAM['Results']['Out']) . '</span>'
        );
    } else {
        $CIDRAM['FE']['output'] = $CIDRAM['FE']['input'] = '';
    }

    /** Calculate page load time (useful for debugging). */
    $CIDRAM['FE']['state_msg'] .= sprintf($CIDRAM['lang']['state_loadtime'], $CIDRAM['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3));

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_ip_aggregator.html'))
    );

    /** Strip output row if input doesn't exist. */
    if (isset($_POST['input'])) {
        $CIDRAM['FE']['FE_Content'] = str_replace(['<!-- Output Begin -->', '<!-- Output End -->'], '', $CIDRAM['FE']['FE_Content']);
    } else {
        $CIDRAM['Markers'] = [
            'Begin' => strpos($CIDRAM['FE']['FE_Content'], '<!-- Output Begin -->'),
            'End' => strpos($CIDRAM['FE']['FE_Content'], '<!-- Output End -->')
        ];
        $CIDRAM['FE']['FE_Content'] =
            substr($CIDRAM['FE']['FE_Content'], 0, $CIDRAM['Markers']['Begin']) .
            substr($CIDRAM['FE']['FE_Content'], $CIDRAM['Markers']['End'] + 19);
        unset($CIDRAM['Markers']);
    }

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** IP Test. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'ip-test' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_ip_test'], $CIDRAM['lang']['tip_ip_test'], false);

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Add flags CSS. */
    if ($CIDRAM['FE']['Flags'] = file_exists($CIDRAM['Vault'] . 'fe_assets/flags.css')) {
        $CIDRAM['FE']['OtherHead'] .= "\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"?cidram-page=flags\" />";
    }

    /** Template for result rows. */
    $CIDRAM['FE']['IPTestRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_ip_test_row.html'));

    /** Initialise results data. */
    $CIDRAM['FE']['IPTestResults'] = '';

    /** Module switch for SimulateBlockEvent closure. */
    $CIDRAM['ModuleSwitch'] = !empty($_POST['ModuleSwitch']);

    /** Module switch for HTML. */
    $CIDRAM['FE']['ModuleSwitch'] = $CIDRAM['ModuleSwitch'] ? ' checked' : '';

    /** Fetch custom user agent if specified. */
    $CIDRAM['FE']['custom-ua'] = !empty($_POST['custom-ua']) ? $_POST['custom-ua'] : '';

    /** IPs were submitted for testing. */
    if (isset($_POST['ip-addr'])) {
        $CIDRAM['FE']['ip-addr'] = $_POST['ip-addr'];
        $_POST['ip-addr'] = array_unique(array_map(function ($IP) {
            return preg_replace('~[^\da-f:./]~i', '', $IP);
        }, explode("\n", $_POST['ip-addr'])));
        natsort($_POST['ip-addr']);
        $CIDRAM['ThisIP'] = [];
        foreach ($_POST['ip-addr'] as $CIDRAM['ThisIP']['IPAddress']) {
            if (!$CIDRAM['ThisIP']['IPAddress']) {
                continue;
            }
            $CIDRAM['SimulateBlockEvent']($CIDRAM['ThisIP']['IPAddress'], $CIDRAM['ModuleSwitch']);
            if ($CIDRAM['Caught'] || empty($CIDRAM['LastTestIP']) || empty($CIDRAM['TestResults'])) {
                $CIDRAM['ThisIP']['YesNo'] = $CIDRAM['lang']['response_error'];
                $CIDRAM['ThisIP']['StatClass'] = 'txtOe';
            } elseif ($CIDRAM['BlockInfo']['SignatureCount']) {
                $CIDRAM['ThisIP']['YesNo'] = $CIDRAM['lang']['response_yes'] . ' – ' . $CIDRAM['BlockInfo']['WhyReason'];
                $CIDRAM['ThisIP']['StatClass'] = 'txtRd';
                if (
                    $CIDRAM['FE']['Flags'] &&
                    preg_match_all('~\[([A-Z]{2})\]~', $CIDRAM['ThisIP']['YesNo'], $CIDRAM['ThisIP']['Matches']) &&
                    !empty($CIDRAM['ThisIP']['Matches'][1])
                ) {
                    foreach ($CIDRAM['ThisIP']['Matches'][1] as $CIDRAM['ThisIP']['ThisMatch']) {
                        $CIDRAM['ThisIP']['YesNo'] = str_replace(
                            '[' . $CIDRAM['ThisIP']['ThisMatch'] . ']',
                            '<span class="flag ' . $CIDRAM['ThisIP']['ThisMatch'] . '"><span></span></span>',
                            $CIDRAM['ThisIP']['YesNo']
                        );
                    }
                }
            } else {
                $CIDRAM['ThisIP']['YesNo'] = $CIDRAM['lang']['response_no'];
                $CIDRAM['ThisIP']['StatClass'] = 'txtGn';
            }
            $CIDRAM['FE']['IPTestResults'] .= $CIDRAM['ParseVars'](
                $CIDRAM['lang'] + $CIDRAM['ThisIP'],
                $CIDRAM['FE']['IPTestRow']
            );
        }
    } else {
        $CIDRAM['FE']['ip-addr'] = '';
    }

    /** Calculate page load time (useful for debugging). */
    $CIDRAM['FE']['state_msg'] .= sprintf($CIDRAM['lang']['state_loadtime'], $CIDRAM['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3));

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_ip_test.html'))
    );

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** IP Tracking. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'ip-tracking' && $CIDRAM['FE']['Permissions'] === 1) {

    $CIDRAM['FE']['TrackingFilter'] = 'cidram-page=ip-tracking';
    $CIDRAM['FE']['TrackingFilterControls'] = '';
    $CIDRAM['StateModified'] = false;
    $CIDRAM['FilterSwitch'](
        ['tracking-blocked-already', 'tracking-hide-banned-blocked'],
        isset($_POST['FilterSelector']) ? $_POST['FilterSelector'] : '',
        $CIDRAM['StateModified'],
        $CIDRAM['FE']['TrackingFilter'],
        $CIDRAM['FE']['TrackingFilterControls']
    );
    if ($CIDRAM['StateModified']) {
        header('Location: ?' . $CIDRAM['FE']['TrackingFilter']);
        die;
    }
    unset($CIDRAM['StateModified']);

    if (!$CIDRAM['FE']['ASYNC']) {

        /** Page initial prepwork. */
        $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_ip_tracking'], $CIDRAM['lang']['tip_ip_tracking']);

        $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

        /** Template for result rows. */
        $CIDRAM['FE']['TrackingRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_ip_tracking_row.html'));

    }

    /** Initialise variables. */
    $CIDRAM['FE']['TrackingData'] = '';
    $CIDRAM['FE']['TrackingCount'] = '';
    $CIDRAM['ThisTracking'] = [];

    /** Generate confirm button. */
    $CIDRAM['FE']['Confirm-ClearAll'] = $CIDRAM['GenerateConfirm']($CIDRAM['lang']['field_clear_all'], 'trackForm');

    /** Fetch cache.dat data. */
    $CIDRAM['Cache'] = file_exists($CIDRAM['Vault'] . 'cache.dat') ? unserialize($CIDRAM['ReadFile']($CIDRAM['Vault'] . 'cache.dat')) : [];

    /** Clear/revoke IP tracking for an IP address. */
    if (isset($_POST['IPAddr'])) {
        if ($_POST['IPAddr'] === '*') {
            unset($CIDRAM['Cache']['Tracking']);
            $CIDRAM['Cleared'] = true;
        } elseif (isset($CIDRAM['Cache']['Tracking'][$_POST['IPAddr']])) {
            unset($CIDRAM['Cache']['Tracking'][$_POST['IPAddr']]);
            $CIDRAM['Cleared'] = true;
        }
        if (!empty($CIDRAM['Cleared'])) {
            $CIDRAM['FE']['state_msg'] = $CIDRAM['lang']['response_tracking_cleared'];
            $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . 'cache.dat', 'w');
            fwrite($CIDRAM['Handle'], serialize($CIDRAM['Cache']));
            fclose($CIDRAM['Handle']);
            unset($CIDRAM['Cleared']);
        }
    }

    /** Process IP tracking data. */
    if (!empty($CIDRAM['Cache']['Tracking']) && is_array($CIDRAM['Cache']['Tracking'])) {

        /** Count currently tracked IPs. */
        $CIDRAM['FE']['TrackingCount'] = count($CIDRAM['Cache']['Tracking']);
        $CIDRAM['FE']['TrackingCount'] = sprintf(
            $CIDRAM['Plural']($CIDRAM['FE']['TrackingCount'], $CIDRAM['lang']['state_tracking']),
            '<span class="txtRd">' . $CIDRAM['Number_L10N']($CIDRAM['FE']['TrackingCount']) . '</span>'
        );

        if (!$CIDRAM['FE']['ASYNC']) {

            uasort($CIDRAM['Cache']['Tracking'], function ($A, $B) {
                if (empty($A['Time']) || empty($B['Time']) || $A['Time'] === $B['Time']) {
                    return 0;
                }
                return ($A['Time'] < $B['Time']) ? -1 : 1;
            });
            foreach ($CIDRAM['Cache']['Tracking'] as $CIDRAM['ThisTracking']['IPAddr'] => $CIDRAM['ThisTrackingArr']) {
                if (!isset($CIDRAM['ThisTrackingArr']['Time'], $CIDRAM['ThisTrackingArr']['Count'])) {
                    continue;
                }

                /** Check whether normally blocked by signature files. */
                if ($CIDRAM['FE']['tracking-blocked-already']) {
                    $CIDRAM['SimulateBlockEvent']($CIDRAM['ThisTracking']['IPAddr']);
                    $CIDRAM['ThisTracking']['Blocked'] = ($CIDRAM['Caught'] || $CIDRAM['BlockInfo']['SignatureCount']);
                } else {
                    $CIDRAM['ThisTracking']['Blocked'] = false;
                }

                /** Hide banned/blocked IPs. */
                if ($CIDRAM['FE']['tracking-hide-banned-blocked'] && (
                    $CIDRAM['ThisTracking']['Blocked'] || $CIDRAM['ThisTrackingArr']['Count'] >= $CIDRAM['Config']['signatures']['infraction_limit']
                )) {
                    continue;
                }
                $CIDRAM['ThisTracking']['IPID'] = bin2hex($CIDRAM['ThisTracking']['IPAddr']);

                /** Set clearing option. */
                $CIDRAM['ThisTracking']['Options'] = (
                    $CIDRAM['ThisTrackingArr']['Count'] > 0
                ) ?
                    '<input type="button" class="auto" onclick="javascript:{window[\'IPAddr\']=\'' .
                    $CIDRAM['ThisTracking']['IPAddr'] .
                    '\';$(\'POST\',\'\',[\'IPAddr\'],function(){w(\'stateMsg\',\'' .
                    $CIDRAM['lang']['state_loading'] . '\')},function(e){w(\'stateMsg\',e);hideid(\'' .
                    $CIDRAM['ThisTracking']['IPID'] . '\')},function(e){w(\'stateMsg\',e)})}" value="' .
                    $CIDRAM['lang']['field_clear'] . '" />'
                : '';
                $CIDRAM['ThisTracking']['Expiry'] = $CIDRAM['TimeFormat'](
                    $CIDRAM['ThisTrackingArr']['Time'],
                    $CIDRAM['Config']['general']['timeFormat']
                );

                if ($CIDRAM['ThisTrackingArr']['Count'] >= $CIDRAM['Config']['signatures']['infraction_limit']) {
                    $CIDRAM['ThisTracking']['StatClass'] = 'txtRd';
                    $CIDRAM['ThisTracking']['Status'] = $CIDRAM['lang']['field_banned'];
                } elseif ($CIDRAM['ThisTrackingArr']['Count'] >= ($CIDRAM['Config']['signatures']['infraction_limit'] / 2)) {
                    $CIDRAM['ThisTracking']['StatClass'] = 'txtOe';
                    $CIDRAM['ThisTracking']['Status'] = $CIDRAM['lang']['field_tracking'];
                } else {
                    $CIDRAM['ThisTracking']['StatClass'] = 's';
                    $CIDRAM['ThisTracking']['Status'] = $CIDRAM['lang']['field_tracking'];
                }
                if ($CIDRAM['ThisTracking']['Blocked']) {
                    $CIDRAM['ThisTracking']['StatClass'] = 'txtRd';
                    $CIDRAM['ThisTracking']['Status'] .= '/' . $CIDRAM['lang']['field_blocked'];
                }
                $CIDRAM['ThisTracking']['Status'] .= ' – ' . $CIDRAM['Number_L10N']($CIDRAM['ThisTrackingArr']['Count'], 0);
                $CIDRAM['ThisTracking']['TrackingFilter'] = $CIDRAM['FE']['TrackingFilter'];
                $CIDRAM['FE']['TrackingData'] .= $CIDRAM['ParseVars'](
                    $CIDRAM['lang'] + $CIDRAM['ThisTracking'],
                    $CIDRAM['FE']['TrackingRow']
                );
            }

        }
    }

    /** Cleanup. */
    unset($CIDRAM['Cache'], $CIDRAM['ThisTracking']);

    /** Fix status display. */
    if ($CIDRAM['FE']['state_msg']) {
        $CIDRAM['FE']['state_msg'] .= '<br />';
    }

    if ($CIDRAM['FE']['TrackingCount']) {
        $CIDRAM['FE']['TrackingCount'] .= ' ';
    }

    /** Calculate page load time (useful for debugging). */
    $CIDRAM['FE']['TrackingCount'] .= sprintf($CIDRAM['lang']['state_loadtime'], $CIDRAM['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3));

    if ($CIDRAM['FE']['ASYNC']) {
        /** Send output (async). */
        echo $CIDRAM['FE']['state_msg'] . $CIDRAM['FE']['TrackingCount'];
    } else {

        /** Parse output. */
        $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
            $CIDRAM['lang'] + $CIDRAM['FE'],
            $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_ip_tracking.html'))
        );

        /** Send output. */
        echo $CIDRAM['SendOutput']();

    }

}

/** CIDR Calculator. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'cidr-calc' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_cidr_calc'], $CIDRAM['lang']['tip_cidr_calc'], false);

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Template for result rows. */
    $CIDRAM['FE']['CalcRow'] = $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_cidr_calc_row.html'));

    /** Initialise results data. */
    $CIDRAM['FE']['Ranges'] = '';

    /** IPs were submitted for testing. */
    if (isset($_POST['cidr'])) {
        $CIDRAM['FE']['cidr'] = $_POST['cidr'];
        if ($_POST['cidr'] = preg_replace('~[^\da-f:./]~i', '', $_POST['cidr'])) {
            if (!$CIDRAM['CIDRs'] = $CIDRAM['ExpandIPv4']($_POST['cidr'])) {
                $CIDRAM['CIDRs'] = $CIDRAM['ExpandIPv6']($_POST['cidr']);
            }
        }
    } else {
        $CIDRAM['FE']['cidr'] = '';
    }

    /** Process CIDRs. */
    if (!empty($CIDRAM['CIDRs'])) {
        $CIDRAM['Factors'] = count($CIDRAM['CIDRs']);
        array_walk($CIDRAM['CIDRs'], function ($CIDR, $Key) use (&$CIDRAM) {
            $First = substr($CIDR, 0, strlen($CIDR) - strlen($Key + 1) - 1);
            if ($CIDRAM['Factors'] === 32) {
                $Last = $CIDRAM['IPv4GetLast']($First, $Key + 1);
            } elseif ($CIDRAM['Factors'] === 128) {
                $Last = $CIDRAM['IPv6GetLast']($First, $Key + 1);
            } else {
                $Last = $CIDRAM['lang']['response_error'];
            }
            $Arr = ['CIDR' => $CIDR, 'Range' => $First . ' – ' . $Last];
            $CIDRAM['FE']['Ranges'] .= $CIDRAM['ParseVars']($Arr, $CIDRAM['FE']['CalcRow']);
        });
    }

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_cidr_calc.html'))
    );

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** Statistics. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'statistics' && $CIDRAM['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_statistics'], $CIDRAM['lang']['tip_statistics'], false);

    /** Display how to enable statistics if currently disabled. */
    if (!$CIDRAM['Config']['general']['statistics']) {
        $CIDRAM['FE']['state_msg'] .= '<span class="txtRd">' . $CIDRAM['lang']['tip_statistics_disabled'] . '</span><br />';
    }

    /** Generate confirm button. */
    $CIDRAM['FE']['Confirm-ClearAll'] = $CIDRAM['GenerateConfirm']($CIDRAM['lang']['field_clear_all'], 'statForm');

    /** Fetch cache.dat data. */
    $CIDRAM['Cache'] = file_exists($CIDRAM['Vault'] . 'cache.dat') ? unserialize($CIDRAM['ReadFile']($CIDRAM['Vault'] . 'cache.dat')) : [];

    /** Clear statistics. */
    if (!empty($_POST['ClearStats'])) {
        if (isset($CIDRAM['Cache']['Statistics'])) {
            unset($CIDRAM['Cache']['Statistics']);
            $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . 'cache.dat', 'w');
            fwrite($CIDRAM['Handle'], serialize($CIDRAM['Cache']));
            fclose($CIDRAM['Handle']);
            unset($CIDRAM['Handle']);
        }
        $CIDRAM['FE']['state_msg'] .= $CIDRAM['lang']['response_statistics_cleared'] . '<br />';
    }

    /** Statistics have been counted since... */
    if (empty($CIDRAM['Cache']['Statistics']['Other-Since'])) {
        $CIDRAM['FE']['Other-Since'] = '<span class="s">-</span>';
    } else {
        $CIDRAM['FE']['Other-Since'] = '<span class="s">' . $CIDRAM['TimeFormat'](
            $CIDRAM['Cache']['Statistics']['Other-Since'],
            $CIDRAM['Config']['general']['timeFormat']
        ) . '</span>';
    }

    /** Fetch and process various statistics. */
    foreach ([
        ['Blocked-IPv4', 'Blocked-Total'],
        ['Blocked-IPv6', 'Blocked-Total'],
        ['Blocked-Other', 'Blocked-Total'],
        ['Banned-IPv4', 'Banned-Total'],
        ['Banned-IPv6', 'Banned-Total'],
        ['reCAPTCHA-Failed', 'reCAPTCHA-Total'],
        ['reCAPTCHA-Passed', 'reCAPTCHA-Total']
    ] as $CIDRAM['TheseStats']) {
        $CIDRAM['FE'][$CIDRAM['TheseStats'][0]] = '<span class="s">' . $CIDRAM['Number_L10N'](
            empty($CIDRAM['Cache']['Statistics'][$CIDRAM['TheseStats'][0]]) ? 0 : $CIDRAM['Cache']['Statistics'][$CIDRAM['TheseStats'][0]]
        ) . '</span>';
        if (!isset($CIDRAM['FE'][$CIDRAM['TheseStats'][1]])) {
            $CIDRAM['FE'][$CIDRAM['TheseStats'][1]] = 0;
        }
        $CIDRAM['FE'][$CIDRAM['TheseStats'][1]] += empty(
            $CIDRAM['Cache']['Statistics'][$CIDRAM['TheseStats'][0]]
        ) ? 0 : $CIDRAM['Cache']['Statistics'][$CIDRAM['TheseStats'][0]];
    }

    /** Fetch and process totals. */
    foreach (['Blocked-Total', 'Banned-Total', 'reCAPTCHA-Total'] as $CIDRAM['TheseStats']) {
        $CIDRAM['FE'][$CIDRAM['TheseStats']] = '<span class="s">' . $CIDRAM['Number_L10N'](
            $CIDRAM['FE'][$CIDRAM['TheseStats']]
        ) . '</span>';
    }

    /** Active signature files. */
    foreach ([
        ['ipv4', 'Other-ActiveIPv4'],
        ['ipv6', 'Other-ActiveIPv6'],
        ['modules', 'Other-ActiveModules']
    ] as $CIDRAM['TheseStats']) {
        if (empty($CIDRAM['Config']['signatures'][$CIDRAM['TheseStats'][0]])) {
            $CIDRAM['FE'][$CIDRAM['TheseStats'][1]] = '<span class="txtRd">' . $CIDRAM['Number_L10N'](0) . '</span>';
        } else {
            $CIDRAM['FE'][$CIDRAM['TheseStats'][1]] = 0;
            $CIDRAM['StatWorking'] = explode(',', $CIDRAM['Config']['signatures'][$CIDRAM['TheseStats'][0]]);
            array_walk($CIDRAM['StatWorking'], function ($SigFile) use (&$CIDRAM) {
                if (!empty($SigFile) && is_readable($CIDRAM['Vault'] . $SigFile)) {
                    $CIDRAM['FE'][$CIDRAM['TheseStats'][1]]++;
                }
            });
            $CIDRAM['StatColour'] = $CIDRAM['FE'][$CIDRAM['TheseStats'][1]] ? 'txtGn' : 'txtRd';
            $CIDRAM['FE'][$CIDRAM['TheseStats'][1]] = '<span class="' . $CIDRAM['StatColour'] . '">' . $CIDRAM['Number_L10N'](
                $CIDRAM['FE'][$CIDRAM['TheseStats'][1]]
            ) . '</span>';
        }
    }

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_statistics.html'))
    );

    /** Send output. */
    echo $CIDRAM['SendOutput']();

    /** Cleanup. */
    unset($CIDRAM['StatColour'], $CIDRAM['StatWorking'], $CIDRAM['TheseStats'], $CIDRAM['Cache']);

}

/** Logs. */
elseif ($CIDRAM['QueryVars']['cidram-page'] === 'logs' && $CIDRAM['FE']['Permissions'] > 0) {

    /** Page initial prepwork. */
    $CIDRAM['InitialPrepwork']($CIDRAM['lang']['title_logs'], $CIDRAM['lang']['tip_logs'], false);

    $CIDRAM['FE']['bNav'] = $CIDRAM['lang']['bNav_home_logout'];

    /** Parse output. */
    $CIDRAM['FE']['FE_Content'] = $CIDRAM['ParseVars'](
        $CIDRAM['lang'] + $CIDRAM['FE'],
        $CIDRAM['ReadFile']($CIDRAM['GetAssetPath']('_logs.html'))
    );

    /** Initialise array for fetching logs data. */
    $CIDRAM['FE']['LogFiles'] = [
        'Files' => $CIDRAM['Logs-RecursiveList']($CIDRAM['Vault']),
        'Out' => ''
    ];

    /** Text mode switch link base. */
    $CIDRAM['FE']['TextModeSwitchLink'] = '';

    /** Default field separator. */
    $CIDRAM['FE']['FieldSeparator'] = ': ';

    /** Link to search for related blocks and search information readout. */
    $CIDRAM['FE']['SearchInfo'] = $CIDRAM['FE']['SearchQuery'] = $CIDRAM['FE']['BlockLink'] = '';

    /** Add flags CSS. */
    if ($CIDRAM['FE']['Flags'] = file_exists($CIDRAM['Vault'] . 'fe_assets/flags.css')) {
        $CIDRAM['FE']['OtherHead'] .= "\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"?cidram-page=flags\" />";
    }

    /** How to display the log data? */
    $CIDRAM['FE']['TextMode'] = false;
    if (empty($CIDRAM['QueryVars']['text-mode']) || $CIDRAM['QueryVars']['text-mode'] === 'false') {
        $CIDRAM['FE']['TextModeLinks'] = 'false';
    } elseif ($CIDRAM['QueryVars']['text-mode'] === 'tally') {
        $CIDRAM['FE']['TextModeLinks'] = 'tally';
    } else {
        $CIDRAM['FE']['TextModeLinks'] = 'true';
        $CIDRAM['FE']['TextMode'] = true;
    }

    /** Define log data. */
    if (empty($CIDRAM['QueryVars']['logfile'])) {
        $CIDRAM['FE']['logfileData'] = $CIDRAM['lang']['logs_no_logfile_selected'];
    } elseif (empty($CIDRAM['FE']['LogFiles']['Files'][$CIDRAM['QueryVars']['logfile']])) {
        $CIDRAM['FE']['logfileData'] = $CIDRAM['lang']['logs_logfile_doesnt_exist'];
    } else {
        $CIDRAM['FE']['TextModeSwitchLink'] .= '?cidram-page=logs&logfile=' . $CIDRAM['QueryVars']['logfile'];
        if (strtolower(substr($CIDRAM['QueryVars']['logfile'], -3)) === '.gz') {
            $CIDRAM['GZLogHandler'] = gzopen($CIDRAM['Vault'] . $CIDRAM['QueryVars']['logfile'], 'rb');
            $CIDRAM['FE']['logfileData'] = '';
            if (is_resource($CIDRAM['GZLogHandler'])) {
                while (!gzeof($CIDRAM['GZLogHandler'])) {
                    $CIDRAM['FE']['logfileData'] .= gzread($CIDRAM['GZLogHandler'], 131072);
                }
                gzclose($CIDRAM['GZLogHandler']);
            }
            unset($CIDRAM['GZLogHandler']);
        } else {
            $CIDRAM['FE']['logfileData'] = $CIDRAM['ReadFile']($CIDRAM['Vault'] . $CIDRAM['QueryVars']['logfile']);
        }
        if (strpos($CIDRAM['FE']['logfileData'], '：') !== false) {
            $CIDRAM['FE']['FieldSeparator'] = '：';
        }

        /** Handle block filtering. */
        if (!empty($CIDRAM['FE']['logfileData']) && !empty($CIDRAM['QueryVars']['search'])) {
            $CIDRAM['FE']['NewLogFileData'] = '';
            $CIDRAM['FE']['SearchQuery'] = base64_decode(str_replace('_', '=', $CIDRAM['QueryVars']['search']));
            $CIDRAM['FE']['BlockStart'] = 0;
            $CIDRAM['FE']['BlockEnd'] = 0;
            $CIDRAM['FE']['BlockSeparator'] = (
                strpos($CIDRAM['FE']['logfileData'], "\n\n") !== false
            ) ? "\n\n" : "\n";
            while (($CIDRAM['FE']['Needle'] = strpos(
                $CIDRAM['FE']['logfileData'],
                ($CIDRAM['FE']['BlockSeparator'] === "\n\n" ? $CIDRAM['FE']['FieldSeparator'] . $CIDRAM['FE']['SearchQuery'] . "\n" : $CIDRAM['FE']['SearchQuery']),
                $CIDRAM['FE']['BlockEnd']
            )) !== false || ($CIDRAM['FE']['Needle'] = strpos(
                $CIDRAM['FE']['logfileData'],
                '("' . $CIDRAM['FE']['SearchQuery'] . '", L',
                $CIDRAM['FE']['BlockEnd']
            )) !== false || (strlen($CIDRAM['FE']['SearchQuery']) === 2 && ($CIDRAM['FE']['Needle'] = strpos(
                $CIDRAM['FE']['logfileData'],
                '[' . $CIDRAM['FE']['SearchQuery'] . ']',
                $CIDRAM['FE']['BlockEnd']
            )) !== false)) {
                $CIDRAM['FE']['BlockStart'] = strrpos(substr($CIDRAM['FE']['logfileData'], 0, $CIDRAM['FE']['Needle']), $CIDRAM['FE']['BlockSeparator'], $CIDRAM['FE']['BlockEnd']);
                $CIDRAM['FE']['BlockEnd'] = strpos($CIDRAM['FE']['logfileData'], $CIDRAM['FE']['BlockSeparator'], $CIDRAM['FE']['Needle']);
                $CIDRAM['FE']['NewLogFileData'] .= substr($CIDRAM['FE']['logfileData'], $CIDRAM['FE']['BlockStart'], $CIDRAM['FE']['BlockEnd'] - $CIDRAM['FE']['BlockStart']);
            }
            if ($CIDRAM['FE']['BlockSeparator'] === "\n\n") {
                $CIDRAM['FE']['logfileData'] = substr($CIDRAM['FE']['NewLogFileData'], strlen($CIDRAM['FE']['BlockSeparator'])) . $CIDRAM['FE']['BlockSeparator'];
            }
            $CIDRAM['FE']['EntryCount'] = !str_replace("\n", '', $CIDRAM['FE']['logfileData']) ? 0 : (
                substr_count($CIDRAM['FE']['logfileData'], $CIDRAM['FE']['BlockSeparator'])
            );
            unset($CIDRAM['FE']['Needle'], $CIDRAM['FE']['BlockSeparator'], $CIDRAM['FE']['BlockEnd'], $CIDRAM['FE']['BlockStart'], $CIDRAM['FE']['NewLogFileData']);
            $CIDRAM['FE']['SearchInfoRender'] = (
                $CIDRAM['FE']['Flags'] && preg_match('~^[A-Z]{2}$~', $CIDRAM['FE']['SearchQuery'])
            ) ? '<span class="flag ' . $CIDRAM['FE']['SearchQuery'] . '"><span></span></span>' : '<code>' . $CIDRAM['FE']['SearchQuery'] . '</code>';
            $CIDRAM['FE']['SearchInfo'] = '<br />' . sprintf(
                $CIDRAM['Plural']($CIDRAM['FE']['EntryCount'], $CIDRAM['lang']['label_displaying_that_cite']),
                $CIDRAM['Number_L10N']($CIDRAM['FE']['EntryCount']),
                $CIDRAM['FE']['SearchInfoRender']
            );
        } else {
            $CIDRAM['FE']['EntryCount'] = !str_replace("\n", '', $CIDRAM['FE']['logfileData']) ? 0 : (
                substr_count($CIDRAM['FE']['logfileData'], "\n\n") ?: substr_count($CIDRAM['FE']['logfileData'], "\n")
            );
            if (substr($CIDRAM['FE']['logfileData'], 0, 2) === '<?') {
                $CIDRAM['FE']['EntryCount']--;
            }
            $CIDRAM['FE']['SearchInfo'] = '<br />' . sprintf(
                $CIDRAM['Plural']($CIDRAM['FE']['EntryCount'], $CIDRAM['lang']['label_displaying']),
                $CIDRAM['Number_L10N']($CIDRAM['FE']['EntryCount'])
            );
        }

        $CIDRAM['FE']['TextModeSwitchLink'] .= '&text-mode=';
        $CIDRAM['FE']['BlockLink'] .= $CIDRAM['FE']['TextModeSwitchLink'] . $CIDRAM['FE']['TextModeLinks'];
        $CIDRAM['FE']['logfileData'] = $CIDRAM['FE']['TextMode'] ? str_replace(
            ['<', '>', "\r", "\n"], ['&lt;', '&gt;', '', "<br />\n"], $CIDRAM['FE']['logfileData']
        ) : str_replace(
            ['<', '>', "\r"], ['&lt;', '&gt;', ''], $CIDRAM['FE']['logfileData']
        );
        $CIDRAM['FE']['mod_class_nav'] = ' big';
        $CIDRAM['FE']['mod_class_right'] = ' extend';
    }
    if (empty($CIDRAM['FE']['mod_class_nav'])) {
        $CIDRAM['FE']['mod_class_nav'] = ' extend';
        $CIDRAM['FE']['mod_class_right'] = ' big';
    }
    if (empty($CIDRAM['FE']['TextModeSwitchLink'])) {
        $CIDRAM['FE']['TextModeSwitchLink'] .= '?cidram-page=logs&text-mode=';
    }
    $CIDRAM['FE']['SearchPart'] = empty($CIDRAM['QueryVars']['search']) ? '' : '&search=' . $CIDRAM['QueryVars']['search'];

    /** Text mode switch link formatted. */
    $CIDRAM['FE']['TextModeSwitchLink'] = sprintf(
        $CIDRAM['lang']['link_textmode'],
        $CIDRAM['FE']['TextModeSwitchLink'],
        $CIDRAM['FE']['SearchPart']
    );

    /** Prepare log data formatting. */
    if ($CIDRAM['FE']['TextMode']) {
        $CIDRAM['Formatter']($CIDRAM['FE']['logfileData'], $CIDRAM['FE']['BlockLink'], $CIDRAM['FE']['SearchQuery'], $CIDRAM['FE']['FieldSeparator'], $CIDRAM['FE']['Flags']);
    } elseif ($CIDRAM['FE']['TextModeLinks'] === 'tally') {
        $CIDRAM['FE']['logfileData'] = $CIDRAM['Tally']($CIDRAM['FE']['logfileData'], $CIDRAM['FE']['BlockLink'], [$CIDRAM['lang']['field_id'], $CIDRAM['lang']['field_datetime']]);
    } else {
        $CIDRAM['FE']['logfileData'] = '<textarea readonly>' . $CIDRAM['FE']['logfileData'] . '</textarea>';
    }

    /** Define logfile list. */
    array_walk($CIDRAM['FE']['LogFiles']['Files'], function ($Arr) use (&$CIDRAM) {
        $CIDRAM['FE']['LogFiles']['Out'] .= sprintf(
            '            <a href="?cidram-page=logs&logfile=%1$s&text-mode=%3$s">%1$s</a> – %2$s<br />',
            $Arr['Filename'],
            $Arr['Filesize'],
            $CIDRAM['FE']['TextModeLinks']
        ) . "\n";
    });

    /** Calculate page load time (useful for debugging). */
    $CIDRAM['FE']['SearchInfo'] .= '<br />' . sprintf($CIDRAM['lang']['state_loadtime'], $CIDRAM['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3));

    /** Set logfile list or no logfiles available message. */
    $CIDRAM['FE']['LogFiles'] = $CIDRAM['FE']['LogFiles']['Out'] ?: $CIDRAM['lang']['logs_no_logfiles_available'];

    /** Send output. */
    echo $CIDRAM['SendOutput']();

}

/** Rebuild cache. */
if ($CIDRAM['FE']['Rebuild']) {
    $CIDRAM['FE']['FrontEndData'] =
        "USERS\n-----" . $CIDRAM['FE']['UserList'] .
        "\nSESSIONS\n--------" . $CIDRAM['FE']['SessionList'] .
        "\nCACHE\n-----" . $CIDRAM['FE']['Cache'];
    $CIDRAM['Handle'] = fopen($CIDRAM['Vault'] . 'fe_assets/frontend.dat', 'w');
    fwrite($CIDRAM['Handle'], $CIDRAM['FE']['FrontEndData']);
    fclose($CIDRAM['Handle']);
}

/** Print Cronable failure state messages here. */
if ($CIDRAM['FE']['CronMode'] && $CIDRAM['FE']['state_msg'] && $CIDRAM['FE']['UserState'] !== 1) {
    if (empty($UpdateAll)) {
        echo json_encode(['state_msg' => $CIDRAM['FE']['state_msg']]);
    } else {
        $Results = ['state_msg' => $CIDRAM['FE']['state_msg']];
    }
}

/** Exit front-end. */
if (empty($CIDRAM['Alternate']) && empty($UpdateAll)) {
    die;
}
