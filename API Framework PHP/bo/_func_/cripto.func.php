<?php

if(true){
    function cripto($value){
        return sha1(md5($value));
    }

    function encrypt($h){ return (base64_encode(base64_encode($h))); }
    function decrypt($h){ return (base64_decode(base64_decode($h)));}


}