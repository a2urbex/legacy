<?php

namespace App\Service;

class DataService {
    public function fetchUrl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);   
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);         
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_NOBODY, false);
        
        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
        } else {
            return curl_exec($ch);
        }
    }

    public function writeJson($file, $data) {
        $string = json_encode($data, JSON_PRETTY_PRINT);
        $this->writeFile($file, $data);
    }

    public function writeFile($file, $data, $append = false) {
        $fp = fopen($file, $append ? 'a' : 'w');
        fwrite($fp, $data);
        fclose($fp);
    }

    public function verifyFolder($folder, $create = false) {
        if(file_exists($folder)) return;
        mkdir($folder, 0777, true);
    }

    public function createFile($file) {
        
    }

    public function initFile($file) {
        file_put_contents($file, '');
    }
}