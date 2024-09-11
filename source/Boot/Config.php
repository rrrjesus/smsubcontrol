<?php

/**
 * DATABASE
 */
 define("CONF_DB_HOST", "10.23.237.201");
 define("CONF_DB_USER", "smsubcoti");
 define("CONF_DB_PASS", ")f9aGXVCh8YqJ8[L");
 define("CONF_DB_NAME", "smsub_test");
 
 /**
  * PROJECT URLs
  */
 define("CONF_URL_BASE", "http://10.23.237.201/smsubcontrol");
 define("CONF_URL_TESTE", "http://127.0.0.1/smsubcontrol");
 define("CONF_URL_ADMIN", "/dashboard");

/**
 * SITE
 */
define("CONF_SITE_NAME", "SMSUB");
define("CONF_SITE_TITLE", "smsub");
define("CONF_SITE_DESC", "smsub SMSUB");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "smsub");
define("CONF_SITE_EMAIL", "cotisuporte@smsub.prefeitura.sp.gov.br");
define("CONF_SITE_ADDR_STREET", "Rua São Bento, 405 / Rua Líbero Badaró");
define("CONF_SITE_ADDR_NUMBER", "504");
define("CONF_SITE_ADDR_COMPLEMENT", "Edifício Martinelli - 23º e 24º andar");
define("CONF_SITE_ADDR_NEIGHBORHOOD", "Centro");
define("CONF_SITE_ADDR_CITY", "São Paulo");
define("CONF_SITE_ADDR_STATE", "São Paulo");
define("CONF_SITE_ADDR_ZIPCODE", "01011-100");

/**
 * COLORS
 */
define("CONF_WEB_COLOR","smsub");
define("CONF_APP_COLOR","success");
define("CONF_ADMIN_COLOR","dark");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "");
define("CONF_SOCIAL_FACEBOOK_APP", "");
define("CONF_SOCIAL_FACEBOOK_PAGE", "secretariamunicipaldassubprefeituras");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "secretariamunicipaldassubprefeituras");
define("CONF_SOCIAL_GOOGLE_PAGE", ""); //107305124528362639842
define("CONF_SOCIAL_GOOGLE_AUTHOR", ""); //103958419096641225872
define("CONF_SOCIAL_INSTAGRAM_PAGE", "smsub_sp/");
define("CONF_SOCIAL_YOUTUBE_PAGE", "channel/UCmim2vKCDYw6aSBF8uRf93g");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "smsubweb");
define("CONF_VIEW_APP", "smsubapp");
define("CONF_VIEW_ADMIN", "smsubadmin");

/**
 * UPLOAD   
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.sendgrid.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "apikey");
define("CONF_MAIL_PASS", "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");
define("CONF_MAIL_SENDER", ["name" => "SMSUB - COTI", "address" => "cidinha.romaioli@gmail.com"]);
define("CONF_MAIL_SUPPORT", "cotisuporte@smsub.prefeitura.sp.gov.br");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");