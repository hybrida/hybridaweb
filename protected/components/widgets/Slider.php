<?php

class Slider extends CWidget {
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        $this->render('slider');
    }
}