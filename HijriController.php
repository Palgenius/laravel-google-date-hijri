<?php

namespace App\Http\Controllers;


class HijriController extends Controller
{

    //this main function that use it in routes .
    //like Route::get('/hijri/{date}','HijriController@getHijriDate');
    public function getHijriDate( $date ){

        return response()->json($this->hijriDateFromGoogle($date),200);
    }


    function get_string_between($string, $start, $end=null)
    {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return "";
        $ini += strlen($start);
        $len= strlen($string)- $ini;
        if($end) $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

    function  curlGet($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        curl_close ($ch);
        return $response;
    }

    function hijriDateFromGoogle($date){
        //https://www.google.com/search?q=hijri+2019-09-10
        $page = $this->curlGet('https://www.google.com/search?q=hijri+'.$date);
        $data=$this->get_string_between($page,'ires','</div></div></div>');

        //<span class="\&quot;mrH1y\&quot;">١١ محرم ١٤٤١</span>
        $data=$this->get_string_between($data,'<span','</span>');
        $data=html_entity_decode($this->get_string_between($data,'>') );
        $data=explode(" ",$data);


        return ['day'=>$data[0],'month'=>$data[1],'year'=>$data[2]];



    }
}
