<?php

namespace Modules\Core\Services;


class TranslitServices
{
    public $array=[
        //default
        'default'=>[
            "а"=>"a","А"=>"A",
            "б"=>"b","Б"=>"B",
            "в"=>"v","В"=>"V",
            "г"=>"g","Г"=>"G",
            "д"=>"d","Д"=>"D",
            "е"=>"e","Е"=>"E",
            "ё"=>"e","Ё"=>"E",
            "ж"=>"j","Ж"=>"J",
            "з"=>"z","З"=>"Z",
            "и"=>"i","И"=>"I",
            "й"=>"y","Й"=>"Y",
            "к"=>"k","К"=>"K",
            "л"=>"l","Л"=>"L",
            "м"=>"m","М"=>"M",
            "н"=>"n","Н"=>"N",
            "о"=>"o","О"=>"O",
            "п"=>"p","П"=>"P",
            "р"=>"r","Р"=>"R",
            "с"=>"s","С"=>"S",
            "т"=>"t","Т"=>"T",
            "у"=>"u","У"=>"U",
            "ф"=>"f","Ф"=>"F",
            "х"=>"h","Х"=>"H",
            "ц"=>"ts","Ц"=>"Ts",
            "ч"=>"ch","Ч"=>"Ch",
            "ш"=>"sh","Ш"=>"Sh",
            "щ"=>"sch","Щ"=>"Sch",
            "ъ"=>"y","Ъ"=>"",
            "ы"=>"yi","Ы"=>"Yi",
            "ь"=>'',"Ь"=>'',
            "э"=>"e","Э"=>"E",
            "ю"=>"yu","Ю"=>"Yu",
            "я"=>"ya","Я"=>"Ya",
        ],
        //url
        'url'=>[
            " "=>'-',
            ','=>'','.'=>'',
            '`'=>'',"'"=>'',
            '"'=>'','_'=>'',
            '/'=>'','\\'=>'',
            '<'=>'','>'=>'',
            '!'=>'','?'=>'',
            '|'=>'',
            '{'=>'','}'=>'',
            '('=>'',')'=>'',
            '^'=>'','#'=>'',
            '@'=>'','%'=>'',
            '*'=>'','№'=>'',
            '«'=>'','»'=>'',
            ':'=>'',';'=>''
        ]
    ];
    //Преобразование строки в траслит
    public function toString($string){
        return strtr($string,$this->array['default']);
    }
    //Преобразование строки по правилам url
    public function toUrl($string){
        return strtolower(strtr($string,array_merge($this->array['default'],$this->array['url'])));
    }
}