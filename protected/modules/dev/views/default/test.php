<?php

$this->widget('application.extensions.nivoslider.ENivoSlider', array(
    'images'=>array( //@array images with images arrays.
        array('src'=>'/images/bak1.png', 'caption'=>'hei'), //only display image.
        array('src'=>'/images/bak2.jpg', 'caption'=>'yey'), //display image and nivo slider caption.
        array('src'=>'/images/bak3.jpg', 'caption'=>'hei'), //display image with link.
       // array('src'=>'/images/bak2.jpg', 'caption'=>'neu'), //display image with nivo slider caption and link reference.
        ),
));