<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'bit.rad' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?)h2tGrv-&IcE8H<E7q8BZM0!|Zt@_^qgOY!&@ZkxvDs5e~-jF0Ne(DDPkczE]8n' );
define( 'SECURE_AUTH_KEY',  'O[4g;N}=d$!Ad6)ZN]YV_~s-SVAA)N!WIHmzcH:dVxnA%xUR<Bg)xEkr@m1[%LYB' );
define( 'LOGGED_IN_KEY',    'mcF()YHZF`!I&LuZ$X_K6[t$Wy@vptYlV]]qUI6jDxy9:][^ Wk;1uvIsY2SUJxN' );
define( 'NONCE_KEY',        '/)u@1i0sUm&bR:y7AI+dG]A{S}#wY)%8/F9aJT/P!__tj?(Eo$FExBV4RKYL.OhR' );
define( 'AUTH_SALT',        '6f)Y7_EdU mg8*l F:fiCcdmnD&A)uvhJm2LSNC<G0w-:M@GycfiSBi5yo.3u)t8' );
define( 'SECURE_AUTH_SALT', '`^=pE8E`1|$W5m!ZvFg$R)y2#4?(:<0M#]aRh5e*J3zEeSr6i|O<96$@R~|q=:a+' );
define( 'LOGGED_IN_SALT',   'feC4yI/mSASWH|~wB[%$FW*C=/4Ap-SU Sa T?9|/y1cY>ncUQwGy[(uzKVp{OG5' );
define( 'NONCE_SALT',       '$yG;iU)^fMf[x@ocZwP^5UHxe Q..G@6P~,v--7jK89X4&@Ba [!<]<IxM<H)WoV' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
