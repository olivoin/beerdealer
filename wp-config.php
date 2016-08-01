<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'beer');

/** Имя пользователя MySQL */
define('DB_USER', 'admin');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'ba0de51');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'R:qm#{V-Xuk&BBr$)%3a.Xeg)~z@A-|+z~rdfwS !22K4M`.|/9Xc7Fq]]s$*$J#');
define('SECURE_AUTH_KEY',  'd_N1f9I2<N(mEfG79S$S^ >/Ltr{=~BHMj0FD`>hkT[+$L.~D|#zyF-b!?xw#vJ<');
define('LOGGED_IN_KEY',    'BSoa2qm i8Q?HFOL5o -_a7hh]JCwv@.QY<H&z^>N]PKC3 #AP7&c+:{&WcX!y>*');
define('NONCE_KEY',        'OyeF;!DL&YiLjAws.P%vx%$[U2+Dt*~RmE]j?Sj+Qbq{,~7!%lB/dCuVqw^%DR_l');
define('AUTH_SALT',        'ow&CUbqP6g6:,3hOp-{_>,6<&qh7c$IaWrr=$Uc#1PnF{K~)8ljGPXZSCyHzR^6}');
define('SECURE_AUTH_SALT', 'n~l#BAQ)PB#W9HmK0W-,,CGm!Q/KLlzb%4quoLSxfFt(XYk*&JT7L;!EqZd{NUPC');
define('LOGGED_IN_SALT',   '*k}R.d g4_A/s$(r@>GwTI-B+QyZ#Yy93A{O1X{9bUM#Js}&UN0`Q)Jg%[|oFrJo');
define('NONCE_SALT',       '#OSGAF8zFx5.A}yqL,5`_s6fV%BhTk*qh>GLMtG>iky}=bZ9mMbz3?)?v-98luIe');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
