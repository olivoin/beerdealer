<?php
/*
Plugin Name: WP Translitera
Plugin URI: http://yur4enko.com/category/moi-proekty/wp-translitera
Description: Plug-in for transliteration permanent permalink records , pages, and tag
Version: 160707
Author: Evgen Yurchenko
Text Domain: wp_translitera
Domain Path: /languages/
Author URI: http://yur4enko.com/
*/

/*  Copyright 2015 Evgen Yurchenko  (email: evgen@yur4enko.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc.
*/

class wp_translitera {//wp=>3.0 php=>5.2.4
    
    //Создаем локализации
    protected static function createlocale() {//wp=>3.0 php=>5.2.4
        $loc = get_locale();
        if ($loc == 'ru_RU') {//Русская локализация
            $ret = array(
                'А'=>'A','а'=>'a','Б'=>'B','б'=>'b','В'=>'V','в'=>'v','Г'=>'G',
                'г'=>'g','Д'=>'D','д'=>'d','Е'=>'E','е'=>'e','Ё'=>'Jo','ё'=>'jo',
                'Ж'=>'Zh','ж'=>'zh','З'=>'Z','з'=>'z','И'=>'I','и'=>'i','Й'=>'J',
                'й'=>'j','К'=>'K','к'=>'k','Л'=>'L','л'=>'l','М'=>'M','м'=>'m',
                'Н'=>'N','н'=>'n','О'=>'O','о'=>'o','П'=>'P','п'=>'p','Р'=>'R',
                'р'=>'r','С'=>'S','с'=>'s','Т'=>'T','т'=>'t','У'=>'U','у'=>'u',
                'Ф'=>'F','ф'=>'f','Х'=>'H','х'=>'h','Ц'=>'C','ц'=>'c','Ч'=>'Ch',
                'ч'=>'ch','Ш'=>'Sh','ш'=>'sh','Щ'=>'Shh','щ'=>'shh','Ъ'=>'',
                'ъ'=>'','Ы'=>'Y','ы'=>'y','Ь'=>'','ь'=>'','Э'=>'Je','э'=>'je',
                'Ю'=>'Ju','ю'=>'ju','Я'=>'Ja','я'=>'ja'
            );
        } elseif ($loc == 'uk') {//Украинская локализация
            $ret = array(
                'А'=>'A','а'=>'a','Б'=>'B','б'=>'b','В'=>'V','в'=>'v','Г'=>'H',
                'г'=>'h','Ґ'=>'G','ґ'=>'g','Д'=>'D','д'=>'d','Е'=>'E','е'=>'e',
                'Є'=>'Ie','є'=>'ie','Ж'=>'Zh','ж'=>'zh','З'=>'Z','з'=>'z','И'=>'Y',
                'и'=>'y','І'=>'I','і'=>'i','Ї'=>'I','ї'=>'i','Й'=>'I','й'=>'i',
                'К'=>'K','к'=>'k','Л'=>'L','л'=>'l','М'=>'M','м'=>'m','Н'=>'N',
                'н'=>'n','О'=>'O','о'=>'o','П'=>'P','п'=>'p','Р'=>'R','р'=>'r',
                'С'=>'S','с'=>'s','Т'=>'T','т'=>'t','У'=>'U','у'=>'u','Ф'=>'F',
                'ф'=>'f','Х'=>'Kh','х'=>'kh','Ц'=>'Ts','ц'=>'ts','Ч'=>'Ch','ч'=>'ch',
                'Ш'=>'Sh','ш'=>'sh','Щ'=>'Shch','щ'=>'shch','Ь'=>'','ь'=>'','Ю'=>'Iu',
                'ю'=>'iu','Я'=>'Ia','я'=>'ia',"'"=>''
            );
        } else {//Глобальная локализация
            $ret = array(
                'А'=>'A','а'=>'a','Б'=>'B','б'=>'b','В'=>'V','в'=>'v','Г'=>'G',
                'г'=>'g','Д'=>'D','д'=>'d','Е'=>'E','е'=>'e','Ё'=>'Jo','ё'=>'jo',
                'Ж'=>'Zh','ж'=>'zh','З'=>'Z','з'=>'z','И'=>'I','и'=>'i','Й'=>'J',
                'й'=>'j','К'=>'K','к'=>'k','Л'=>'L','л'=>'l','М'=>'M','м'=>'m',
                'Н'=>'N','н'=>'n','О'=>'O','о'=>'o','П'=>'P','п'=>'p','Р'=>'R',
                'р'=>'r','С'=>'S','с'=>'s','Т'=>'T','т'=>'t','У'=>'U','у'=>'u',
                'Ф'=>'F','ф'=>'f','Х'=>'H','х'=>'h','Ц'=>'C','ц'=>'c','Ч'=>'Ch',
                'ч'=>'ch','Ш'=>'Sh','ш'=>'sh','Щ'=>'Shh','щ'=>'shh','Ъ'=>'',
                'ъ'=>'','Ы'=>'Y','ы'=>'y','Ь'=>'','ь'=>'','Э'=>'Je','э'=>'je',
                'Ю'=>'Ju','ю'=>'ju','Я'=>'Ja','я'=>'ja','Ґ'=>'G','ґ'=>'g','Є'=>'Ie',
                'є'=>'ie','І'=>'I','і'=>'i','Ї'=>'I','ї'=>'i',"'"=>''
            );
        }
        return $ret;
    }

    //Процедура преобразования символов
    public static function transliterate($title) {//wp=>0.0.0 php=>5.2.4
        return strtr($title, wp_translitera::createlocale());
    }
    
    //Добавляем раздел в админку
    public static function add_menu(){//wp=>3.0 php=>5.2.4
        add_options_page('WP Translitera', 'Translitera', 'activate_plugins', __FILE__, array('wp_translitera','main_settings'));
    }
    
    //Проставляем галочки в чебоксах
    public static function getchebox($name){//wp=>0.0.0 php=>5.2.4
        $value = wp_translitera::getset($name);
        return (empty($value))?'':' checked';
    }
    
    //Форма админки
    public static function GetForm() {//wp=>0.0.0 php=>5.2.4
        $ret = '<h2>'.__('Convert existing','wp_translitera').':</h2></br>'
                . '<form method=POST> '
                . '<input type="checkbox" name="r1" value="1">'.__('Pages and posts','wp_translitera').'</br>'
                . '<input type="checkbox" name="r2" value="1">'.__('Headings, tags etc...','wp_translitera').'</br>'
                . '<input type="submit" value="'.__('Transliterate','wp_translitera').'" name="transliterate"></form>'
                . '<p><h2>'.__('Settings','wp_translitera').':</h2></br>'
                . '<form method=POST> '
                . '<input type="checkbox" name="tranliterate_uploads_file" value="1"'.wp_translitera::getchebox("tranliterate_uploads_file").'>'.__('Transliterate names of uploads files','wp_translitera').'</br>'
                . '<input type="checkbox" name="tranliterate_404" value="1"'.wp_translitera::getchebox("tranliterate_404").'>'.__('Transliterate 404 url','wp_translitera').'</br>'
                . '<input type="submit" value="'.__('Apply','wp_translitera').'" name="apply"></form>';
        return $ret;                
    }
    
    //Транслитерация в БД
    public static function do_transliterte($table,$id,$name) {//wp=>3.0 php=>5.2.4
        global $wpdb;
        $rez = $wpdb->get_results("SELECT {$id}, {$name} FROM {$table} WHERE 1",ARRAY_A);
        foreach ($rez as $value) {
            $tmp_name = wp_translitera::transliterate(urldecode($value[$name]));
            if ($tmp_name != $value[$name]) {
                $wpdb->update($table,array($name=>$tmp_name),array($id=>$value[$id]));
            }
        }
    }
    
    //Модуль формы админки
    public static function main_settings() {//wp=>3.0 php=>5.2.4
        global $wpdb;
        $act = filter_input(INPUT_POST,'transliterate');
        if (!empty($act)) {
            $r1 = filter_input(INPUT_POST, 'r1');
            $r2 = filter_input(INPUT_POST, 'r2');
            if (!empty($r1)) {
                wp_translitera::do_transliterte($wpdb->posts, 'ID', 'post_name');
            }
            if (!empty($r2)){
                wp_translitera::do_transliterte($wpdb->terms, 'term_id', 'slug');
            }
            
        }
        $setupd = filter_input(INPUT_POST, 'apply');
        if (!empty($setupd)){
            wp_translitera::updset('tranliterate_uploads_file', filter_input(INPUT_POST,'tranliterate_uploads_file'));
            wp_translitera::updset('tranliterate_404', filter_input(INPUT_POST,'tranliterate_404'));
        }
        echo wp_translitera::GetForm();
    }
    
    //Инициализация языка
    public static function initlang() {//wp=>3.0 php=>5.2.4
        load_plugin_textdomain('wp_translitera', false, dirname(plugin_basename(__FILE__)).'/languages');
    }
    
    //Получаем настройки
    public static function getoptions() {//wp=>3.0 php=>5.2.4
        $set = get_option('wp_translitera');
        if (gettype($set) != 'array') {
            $set = array();
        }
        return $set;
    }

    //Получаем значение настройки
    public static function getset($name) {//wp=>0.0.0 php=>5.2.4
        $set = wp_translitera::getoptions();
        return (array_key_exists($name,$set))?$set[$name]:NULL;
    }
    
    //Записываем настройки
    public static function updset($name,$value) {//wp=>3.0 php=>5.2.4
        $set = wp_translitera::getoptions();
        $set[$name] = $value;
        update_option('wp_translitera',$set);
    }
    
    //Чистка при удалении
    static function tr_delete(){//wp=>3.0 php=>5.2.4
        delete_option('wp_translitera');
    }
    
    //Транслитерация имени загружаемого файла
    public static function rename_uploads($value) {//wp=>0.0.0 php=>5.2.4
        if (wp_translitera::getset('tranliterate_uploads_file')){
            $value['name'] = wp_translitera::transliterate($value['name']);
        }
        return $value; 
    }
    
    //Обработка файлов загружаемых из форм
    public static function rename_uploads_additional($value, $filename_raw) {//wp=>0.0.0 php=>5.2.4
        if (wp_translitera::getset('tranliterate_uploads_file')){
            $value = wp_translitera::transliterate($value);
        }
        return $value; 
    }
    
    //Попытка транслитерировать урл
    public static function init404(){//wp=>1.5.1 php=>5.2.4
        if (is_404()){
            if (wp_translitera::getset('tranliterate_404')){
                $thisurl = filter_input(INPUT_SERVER, 'REQUEST_URI');
                $thisurl = urldecode($thisurl); 
                $trurl = wp_translitera::transliterate($thisurl);
                if ($thisurl != $trurl) {
                    wp_redirect($trurl,301);
                }
            }
        }
    }
}

//wp=>3.0 php=>5.2.4
//Преименовывание коротких ссылок
add_action('sanitize_title', array('wp_translitera','transliterate'), 0);
//Добавляем админ меню
add_action('admin_menu', array('wp_translitera', 'add_menu'));
//Загружка языковой поддержки
add_action('init', array('wp_translitera', 'initlang'));
//Редирект 404
add_action('wp',array('wp_translitera','init404'));
//Переименовываение загружаемых файлов
add_filter('sanitize_file_name',array('wp_translitera', 'rename_uploads_additional'),10,2);
//Обработка удаления
register_uninstall_hook(__FILE__,array('wp_translitera','tr_delete'));