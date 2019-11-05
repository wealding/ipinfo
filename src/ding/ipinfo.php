<?php

namespace ding;

class ipinfo {

    public $reader = NULL;
    public $ipip_reader = NULL;
    public $qqwry_reader = NULL;

    public function __construct($whichdb = NULL)
    {
        if(!empty($whichdb) && in_array($whichdb,['ipip','qqwry'])){
            $this->reader = new \ipip\db\Reader(dirname(__FILE__).'/db/'.$whichdb.'.ipdb');
        }else{
            $this->ipip_reader = new \ipip\db\Reader(dirname(__FILE__).'/db/ipip.ipdb');
            $this->qqwry_reader = new \ipip\db\Reader(dirname(__FILE__).'/db/qqwry.ipdb');
        }
    }

    public function find($ip, $language)
    {
        if(!empty($this->reader)){
            return $this->reader->find($ip, $language);
        }else{
            $ret['ipip'] = $this->ipip_reader->find($ip, $language);
            $ret['qqwry'] = $this->qqwry_reader->find($ip, $language);
            return $ret;
        }
    }


    public function findMap($ip, $language)
    {
        if(!empty($this->reader)){
            return $this->reader->findMap($ip, $language);
        }else{
            $ret['ipip'] = $this->ipip_reader->findMap($ip, $language);
            $ret['qqwry'] = $this->qqwry_reader->findMap($ip, $language);
            return $ret;
        }
    }


    public function findInfo($ip, $language)
    {
        $map = $this->findMap($ip, $language);
        if (NULL == $map)
        {
            return NULL;
        }
        if(isset($map['ipip'])){
            $ret['ipip'] = new \ipip\db\CityInfo($map['ipip']);
            $ret['qqwry'] = new \ipip\db\CityInfo($map['qqwry']);
            return $ret;
        }
        return new \ipip\db\CityInfo($map);
    }

}