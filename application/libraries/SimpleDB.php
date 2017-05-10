<?php
/**
 * PHP Simple DB
 *
 * A Codeigniter library that does dummy simple PDO.
 *
 * Copyright (C) 2017   Marvin Francois.
 *
 * LICENSE
 *
 * Simple DB is released with dual licensing, using the GPL v3 (license-gpl3.txt) and the MIT license (license-mit.txt).
 * You don't have to do anything special to choose one license or the other and you don't have to notify anyone which license you are using.
 * Please see the corresponding license file for details of these licenses.
 * You are free to use, modify and distribute this software, but all copyright information must remain.
 *
 * @package    	Simple DB * @copyright  	Copyright (c) 2017, Marvin Francois
 * @license    	pending
 * @version    	0.9
 * @author     	Marvin Francois <marvinfrancois@gmail.com>
 */

// ------------------------------------------------------------------------

class SimpleDB{

    public function pretty_print_r($text){
        return "<pre>".print_r($text,true)."</pre>";
    }


}