<?php

  class DLsiteParser{
    /*-----------------------------------------------------*\
    function : CheckRJNum
    parameter: $rjnum(string)
    return   : http status code
    \*-----------------------------------------------------*/
    public function CheckRJNum($rjnum)
    {
      if preg_match("/^RJ/d{6}/im", $rjnum)
      {
        private $url = "https://www.dlsite.com/maniax/work/=/product_id/" . $rjnum . ".html";
        if ($html = @file_get_contents($url))
        {
            $status_code = explode(' ', $http_response_header[0]);
            // HTTP 200
            CheckRJNum = $status_code[1];
            unset($html);
        }else
        {
          if(count($http_response_header) > 0)
          { 
            $status_code = explode(' ', $http_response_header[0]);
            // e.g.) 403, 404 ..
            // https://ja.wikipedia.org/wiki/HTTP%E3%82%B9%E3%83%86%E3%83%BC%E3%82%BF%E3%82%B9%E3%82%B3%E3%83%BC%E3%83%89
            CheckRJNum = $status_code[1];
            unset($html);
          }
        }
      }
    }
    /*-----------------------------------------------------*\
    function : getTitle
    parameter: $rjnum(string)
    return   : empty(string)=error(notfound,badgateway etc)
    \*-----------------------------------------------------*/
    public function getTitle($rjnum){
      private $url = "https://www.dlsite.com/maniax/work/=/product_id/" . $rjnum . ".html";
      if ($html = @file_get_contents($url))
      {
        $status_code = explode(' ', $http_response_header[0]);
        if ($http_response_header[1] == '200')
        {
          getTitle =  str_replace("\n", '', phpQuery::newDocument($html)->find("#work_name")->text());
          unset($html);
        }
        else 
        {
          getTitle = '';
          unset($html);
        }
      } else {
        getTitle = '';
      }
    }
    /*-----------------------------------------------------*\
    function : getCircle
    parameter: $rjnum(string)
    return   : empty(string)=error(notfound,badgateway etc)
    \*-----------------------------------------------------*/
    public function getCircle($rjnum){
      private $url = "https://www.dlsite.com/maniax/work/=/product_id/" . $rjnum . ".html";
      if ($html = @file_get_contents($url))
      {
        $status_code = explode(' ', $http_response_header[0]);
        if ($http_response_header[1] == '200')
        {
          getCircle =  str_replace("\r", '', str_replace("\n", '', phpQuery::newDocument($html)->find("#work_maker")->find(".maker_name")->text()));
          unset($html);
        }
        else 
        {
          getCircle = '';
          unset($html);
        }
      } else {
        getCircle = '';
      }
    }
