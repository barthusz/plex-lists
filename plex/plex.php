<?php

class Plex {

    public string $ipaddress;
    public int $catid;
    public string $token;

    public string $plexurl;

    public string $genre;

    public function __construct($ipaddress,$token,$catid) {
        $this->ipaddress = $ipaddress;
        $this->token = $token;
        $this->catid = $catid;
        $this->setplexurl();
    }

    public function setplexurl() {
        $this->plexurl = "http://".$this->ipaddress.":32400/library/sections/".$this->catid."/all?X-Plex-Token=".$this->token;
    }

    public function getlist($genre = null) {
        $xml = simplexml_load_file($this->plexurl);
        $arr = (array)$xml;
        
        echo "<table>";

        foreach($arr['Directory'] as $movie) {

            if(isset($genre)) {
                $this->genre = $genre;
                if($this->genre == $movie->Genre['tag']) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<img src='http://".$this->ipaddress.":32400".$movie['thumb']."?X-Plex-Token=".$this->token."' height='150' />";
                    echo "</td>";
                    echo "<td>";
                    echo "<h3>".$movie['title']."</h3>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<pre>";
                print_r($movie);
                echo "</pre>";
            }
            
        }

        echo "</table>";
    }
}