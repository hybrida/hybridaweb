<?php

class YiiForumModule extends CWebModule
{
    public $defaultController = 'forum';

    public $userUrl;

    /**
     * These classes can overrride the htmlOptions->class parameters passed when
     * rendering the table and listview. When not set, a css file will be loaded
     * that makes the listview look like a gridview
     */
    public $forumTableClass;
    public $forumListviewClass;
    public $forumDetailClass;

    /*
     * Date and time formats, and the oprtion to replace the date with either
     * "Today" or "Yesterday" if appropriate.
     */
    public $dateFormatShort = 'M j, Y';
    public $dateFormatLong = 'M j, Y';
    public $dateReplaceWords = true;
    public $timeFormatShort = 'h:i A';
    public $timeFormatLong = 'h:i:s A';

    /**
     * The number of threads/posts to display per page
     */
    public $threadsPerPage = 20;
    public $postsPerPage = 20;

    private $_assetsUrl;

    public function init()
    {
        $this->registerAssets();

        $this->setImport(array(
            'forum.components.*',
            'forum.models.*',
        ));
    }

    /**
     * @return string the base URL that contains all published asset files of this module.
     */
    public function getAssetsUrl()
    {
        if(null == $this->_assetsUrl)
            $this->_assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('forum.assets')
                // Comment this out for production. With this in place, module assets will be published
                // and copied over at every request, instaed of only once
                ,false,-1,true
            );
        return $this->_assetsUrl;
    }

    public function registerAssets()
    {
        $knownClasses = array('MyBB');

        //the css to use
        if(null == $this->forumListviewClass)
        {
            Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/default.css');

        }
        elseif(in_array($this->forumListviewClass, $knownClasses)) {
            $this->forumListviewClass .= '-lv';
            Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/'. $this->forumListviewClass .'.css');
        }

        if(in_array($this->forumTableClass, $knownClasses))
        {
            $this->forumTableClass .= '-tb';
            Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/'. $this->forumTableClass .'.css');
        }

        if(in_array($this->forumDetailClass, $knownClasses))
        {
            $this->forumDetailClass .= '-dt';
            Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/'. $this->forumDetailClass .'.css');
        }

        // the js to use
        /*
        Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerScriptFile($baseUrl . "/js/extrastuff.js", CClientScript::POS_BEGIN);
        */
    }

    public function registerImage($filename)
    {
        return $this->getAssetsUrl() .'/'. $filename;
    }

    /**
     * This doesn't belong here at all, but it's globally accessible...
     */
    public function format_date($timestamp, $format='long')
    {
        if('long' == $format)
        {
            $dateFormat = $this->dateFormatLong;
            $timeFormat = $this->timeFormatLong;
        } else {
            $dateFormat = $this->dateFormatShort;
            $timeFormat = $this->timeFormatShort;
        }

        $date = date($dateFormat, $timestamp);
        $time = date($timeFormat, $timestamp);

        if($this->dateReplaceWords)
        {
            if($date == date($dateFormat)) $date = 'Today';
            elseif($date == date($dateFormat, time()-86400)) $date = 'Yesterday';
        }

        return $date .' '. $time;
    }

}