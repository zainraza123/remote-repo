<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class
 *
 * @author hockenburj1
 */
class Timer {
    private $start_time;
    private $end_time;
    
    function timer() {}
    
    function start() {
        $time = microtime();
        $times = split(' ', $time);
        $this->start_time = $times[0];
        
    }
    
    function stop() {
        $time = microtime();
        $times = split(' ', $time);
        $this->end_time = $times[0];
        return $this->end_time - $this->start_time;
    }
}
