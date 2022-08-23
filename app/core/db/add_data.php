<?php

namespace Core;

use \Database;


/**
 * add data class
 */
class Add_Data extends Database
{
  public function to($table)
  {
    if (method_exists($this, $table)) {
      $query = $this->$table();
      $this->query($query);
    }
  }

  private function test()
  {
    return <<<EOT
    INSERT INTO test (symbol, language) VALUES('af_ZA',"Afrikaans");
    INSERT INTO test (symbol, language) VALUES('sq_AL',"Shqip");
    INSERT INTO test (symbol, language) VALUES('ar_AR',"العربية");
    INSERT INTO test (symbol, language) VALUES('hy_AM',"Հայերեն");
    INSERT INTO test (symbol, language) VALUES('ay_BO',"Aymar aru");
    INSERT INTO test (symbol, language) VALUES('az_AZ',"Azərbaycan dili");
    INSERT INTO test (symbol, language) VALUES('eu_ES',"Euskara");
    INSERT INTO test (symbol, language) VALUES('bn_IN',"Bangla");
    INSERT INTO test (symbol, language) VALUES('bs_BA',"Bosanski");
    INSERT INTO test (symbol, language) VALUES('bg_BG',"Български");
    INSERT INTO test (symbol, language) VALUES('my_MM',"မြန်မာဘာသာ");
    INSERT INTO test (symbol, language) VALUES('ca_ES',"Català");
    INSERT INTO test (symbol, language) VALUES('ck_US',"Cherokee");
    INSERT INTO test (symbol, language) VALUES('hr_HR',"Hrvatski");
    INSERT INTO test (symbol, language) VALUES('cs_CZ',"Čeština");
    INSERT INTO test (symbol, language) VALUES('da_DK',"Dansk");
    EOT;
  }

  private function users()
  {
    return <<<EOT
    INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `date`, `about`, `company`, `job`, `country`, `address`, `phone`, `slug`, `image`, `facebook_link`, `instagram_link`, `twitter_link`, `linkedin_link`) VALUES
    (2, 'Mary', 'Smith', 'dhard@gmail.com', "$2y$10$h4AkOL7q2hVWB88Z15cSLOAATDp8EnMmltD6Z.ADRxeDRToSBl93O", 'user', '2022-08-10', 'About', 'ABC', '', 'America', 'sadsagerge', '', 'david-hard', 'uploads/images/1660644117_TaylorSwift.jpg', 'https://facebook.com', '', 'https://twitter.com', ''),
    (3, 'harry', 'hill', 'hh@gmail.com', '$2y$10$CC8mKIr8ipjNKfadsZXl8uXleGTJnpStEa6VBQEq6p5uYp24HzwJS', 'user', '2022-08-13', '', '', '', '', '', '', NULL, 'uploads/images/1660469785_TaylorSwift.jpg', '', '', '', ''),
    (4, 'sdfdf', 'dfsdf', 'sdfsdfs@dfs.com', '$2y$10$Hh8YkkcVBqyv0/IfgbjqxOzIcoWn5Tvq44YfVHNFEClAgU7r.3MT6', 'user', '2022-08-14  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    EOT;
  }
  private function categories()
  {
    return <<<EOT
    INSERT INTO `categories` (`id`, `category`, `disabled`) VALUES
    (1, 'Development', 0),
    (2, 'Business', 0),
    (3, 'Finance & Accounting', 0),
    (4, 'IT & Software', 0),
    (5, 'Office Productivity', 0),
    (6, 'Personal Development', 0),
    (7, 'Design', 0),
    (8, 'Marketing', 0),
    (9, 'Lifestyle', 0),
    (10, 'Photography & Video', 0),
    (11, 'Health & Fitness', 0),
    (12, 'Music', 0),
    (13, 'Teaching & Academics', 0),
    (14, 'I don\'t know yet', 0);
    EOT;
  }

  private function languages()
  {

    return <<<EOT
     INSERT INTO languages (symbol, language) VALUES('af_ZA',"Afrikaans");
     INSERT INTO languages (symbol, language) VALUES('sq_AL',"Shqip");
     INSERT INTO languages (symbol, language) VALUES('ar_AR',"العربية");
     INSERT INTO languages (symbol, language) VALUES('hy_AM',"Հայերեն");
     INSERT INTO languages (symbol, language) VALUES('ay_BO',"Aymar aru");
     INSERT INTO languages (symbol, language) VALUES('az_AZ',"Azərbaycan dili");
     INSERT INTO languages (symbol, language) VALUES('eu_ES',"Euskara");
     INSERT INTO languages (symbol, language) VALUES('bn_IN',"Bangla");
     INSERT INTO languages (symbol, language) VALUES('bs_BA',"Bosanski");
     INSERT INTO languages (symbol, language) VALUES('bg_BG',"Български");
     INSERT INTO languages (symbol, language) VALUES('my_MM',"မြန်မာဘာသာ");
     INSERT INTO languages (symbol, language) VALUES('ca_ES',"Català");
     INSERT INTO languages (symbol, language) VALUES('ck_US',"Cherokee");
     INSERT INTO languages (symbol, language) VALUES('hr_HR',"Hrvatski");
     INSERT INTO languages (symbol, language) VALUES('cs_CZ',"Čeština");
     INSERT INTO languages (symbol, language) VALUES('da_DK',"Dansk");
     INSERT INTO languages (symbol, language) VALUES('nl_NL',"Nederlands");
     INSERT INTO languages (symbol, language) VALUES('nl_BE',"Nederlands (België)");
     INSERT INTO languages (symbol, language) VALUES('en_IN',"English (India)");
     INSERT INTO languages (symbol, language) VALUES('en_GB',"English (UK)");
     INSERT INTO languages (symbol, language) VALUES('en_US',"English (US)");
     INSERT INTO languages (symbol, language) VALUES('et_EE',"Eesti");
     INSERT INTO languages (symbol, language) VALUES('fo_FO',"Føroyskt");
     INSERT INTO languages (symbol, language) VALUES('tl_PH',"Filipino");
     INSERT INTO languages (symbol, language) VALUES('fi_FI',"Suomi");
     INSERT INTO languages (symbol, language) VALUES('fr_CA',"Français (Canada)");
     INSERT INTO languages (symbol, language) VALUES('fr_FR',"Français (France)");
     INSERT INTO languages (symbol, language) VALUES('fy_NL',"Frysk");
     INSERT INTO languages (symbol, language) VALUES('gl_ES',"Galego");
     INSERT INTO languages (symbol, language) VALUES('ka_GE',"ქართული");
     INSERT INTO languages (symbol, language) VALUES('de_DE',"Deutsch");
     INSERT INTO languages (symbol, language) VALUES('el_GR',"Ελληνικά");
     INSERT INTO languages (symbol, language) VALUES('gn_PY',"Avañe'ẽ");
     INSERT INTO languages (symbol, language) VALUES('gu_IN',"ગુજરાતી");
     INSERT INTO languages (symbol, language) VALUES('ht_HT',"Ayisyen");
     INSERT INTO languages (symbol, language) VALUES('he_IL',"‏עברית‏");
     INSERT INTO languages (symbol, language) VALUES('hi_IN',"हिन्दी");
     INSERT INTO languages (symbol, language) VALUES('hu_HU',"Magyar");
     INSERT INTO languages (symbol, language) VALUES('is_IS',"Íslenska");
     INSERT INTO languages (symbol, language) VALUES('id_ID',"Bahasa Indonesia");
     INSERT INTO languages (symbol, language) VALUES('ga_IE',"Gaeilge");
     INSERT INTO languages (symbol, language) VALUES('it_IT',"Italiano");
     INSERT INTO languages (symbol, language) VALUES('ja_JP',"日本語");
     INSERT INTO languages (symbol, language) VALUES('jv_ID',"Basa Jawa");
     INSERT INTO languages (symbol, language) VALUES('kn_IN',"Kannaḍa");
     INSERT INTO languages (symbol, language) VALUES('kk_KZ',"Қазақша");
     INSERT INTO languages (symbol, language) VALUES('km_KH',"Khmer");
     INSERT INTO languages (symbol, language) VALUES('ko_KR',"한국어");
     INSERT INTO languages (symbol, language) VALUES('ku_TR',"Kurdî");
     INSERT INTO languages (symbol, language) VALUES('lv_LV',"Latviešu");
     INSERT INTO languages (symbol, language) VALUES('li_NL',"Lèmbörgs");
     INSERT INTO languages (symbol, language) VALUES('lt_LT',"Lietuvių");
     INSERT INTO languages (symbol, language) VALUES('mk_MK',"Македонски");
     INSERT INTO languages (symbol, language) VALUES('mg_MG',"Malagasy");
     INSERT INTO languages (symbol, language) VALUES('ms_MY',"Bahasa Melayu");
     INSERT INTO languages (symbol, language) VALUES('ml_IN',"Malayāḷam");
     INSERT INTO languages (symbol, language) VALUES('mt_MT',"Malti");
     INSERT INTO languages (symbol, language) VALUES('mr_IN',"मराठी");
     INSERT INTO languages (symbol, language) VALUES('mn_MN',"Монгол");
     INSERT INTO languages (symbol, language) VALUES('ne_NP',"नेपाली");
     INSERT INTO languages (symbol, language) VALUES('se_NO',"Davvisámegiella");
     INSERT INTO languages (symbol, language) VALUES('nb_NO',"Norsk (bokmål)");
     INSERT INTO languages (symbol, language) VALUES('nn_NO',"Norsk (nynorsk)");
     INSERT INTO languages (symbol, language) VALUES('ps_AF',"پښتو");
     INSERT INTO languages (symbol, language) VALUES('fa_IR',"فارسی");
     INSERT INTO languages (symbol, language) VALUES('pl_PL',"Polski");
     INSERT INTO languages (symbol, language) VALUES('pt_BR',"Português (Brasil)");
     INSERT INTO languages (symbol, language) VALUES('pt_PT',"Português (Portugal)");
     INSERT INTO languages (symbol, language) VALUES('pa_IN',"ਪੰਜਾਬੀ");
     INSERT INTO languages (symbol, language) VALUES('qu_PE',"Qhichwa");
     INSERT INTO languages (symbol, language) VALUES('ro_RO',"Română");
     INSERT INTO languages (symbol, language) VALUES('rm_CH',"Rumantsch");
     INSERT INTO languages (symbol, language) VALUES('ru_RU',"Русский");
     INSERT INTO languages (symbol, language) VALUES('sa_IN',"संस्कृतम्");
     INSERT INTO languages (symbol, language) VALUES('sr_RS',"Српски");
     INSERT INTO languages (symbol, language) VALUES('zh_CN',"中文(简体)");
     INSERT INTO languages (symbol, language) VALUES('sk_SK',"Slovenčina");
     INSERT INTO languages (symbol, language) VALUES('sl_SI',"Slovenščina");
     INSERT INTO languages (symbol, language) VALUES('so_SO',"Soomaaliga");
     INSERT INTO languages (symbol, language) VALUES('es_LA',"Español");
     INSERT INTO languages (symbol, language) VALUES('es_CL',"Español (Chile)");
     INSERT INTO languages (symbol, language) VALUES('es_CO',"Español (Colombia)");
     INSERT INTO languages (symbol, language) VALUES('es_MX',"Español (México)");
     INSERT INTO languages (symbol, language) VALUES('es_ES',"Español (España)");
     INSERT INTO languages (symbol, language) VALUES('es_VE',"Español (Venezuela)");
     INSERT INTO languages (symbol, language) VALUES('sw_KE',"Kiswahili");
     INSERT INTO languages (symbol, language) VALUES('sv_SE',"Svenska");
     INSERT INTO languages (symbol, language) VALUES('sy_SY',"Leššānā Suryāyā");
     INSERT INTO languages (symbol, language) VALUES('tg_TJ',"тоҷикӣ, تاجیکی‎, tojikī");
     INSERT INTO languages (symbol, language) VALUES('ta_IN',"தமிழ்");
     INSERT INTO languages (symbol, language) VALUES('tt_RU',"татарча / Tatarça / تاتارچا");
     INSERT INTO languages (symbol, language) VALUES('te_IN',"Telugu");
     INSERT INTO languages (symbol, language) VALUES('th_TH',"ภาษาไทย");
     INSERT INTO languages (symbol, language) VALUES('zh_HK',"中文(香港)");
     INSERT INTO languages (symbol, language) VALUES('zh_TW',"中文 (繁體)");
     INSERT INTO languages (symbol, language) VALUES('tr_TR',"Türkçe");
     INSERT INTO languages (symbol, language) VALUES('uk_UA',"Українська");
     INSERT INTO languages (symbol, language) VALUES('ur_PK',"اردو");
     INSERT INTO languages (symbol, language) VALUES('uz_UZ',"O'zbek");
     INSERT INTO languages (symbol, language) VALUES('vi_VN',"Tiếng Việt");
     INSERT INTO languages (symbol, language) VALUES('cy_GB',"Cymraeg");
     INSERT INTO languages (symbol, language) VALUES('xh_ZA',"isiXhosa");
     INSERT INTO languages (symbol, language) VALUES('yi_DE',"ייִדיש");
     INSERT INTO languages (symbol, language) VALUES('zu_ZA',"isiZulu");
     EOT;
  }


  private function course_levels()
  {
    return  <<<EOT
    INSERT INTO `course_levels` (`id`, `level`, `disabled`) 
    VALUES(1, 'Beginner Level', 0), 
    (2, 'Intermediate Level', 0), 
    (3, 'Expert Level', 0),
    (4, 'All Levels', 0);
    EOT;
  }

  private function currencies()
  {
    return  <<<EOT
    INSERT INTO `currencies` (`id`, `currency`, `symbol`, `disabled`) VALUES
    (1, 'US Dollar', '$', 0);
    EOT;
  }

  private function prices()
  {
    return  <<<EOT
    INSERT INTO `prices` (`id`, `name`, `price`, `disabled`) VALUES
    (1, 'Free', '0', 0);
    EOT;
  }
}
