<?php
    /**
     *  Sexy little extras!
     *  Add little static global things here! :)
     */
    
    function prettyprint($var, $name = null)
    {
        if (false === empty($name)) $name .= ' ';
        echo '<pre>'.$name.print_r($var,true).'</pre>';
    }
    
    