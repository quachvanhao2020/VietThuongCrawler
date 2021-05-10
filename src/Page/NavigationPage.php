<?php
namespace VietThuongCrawler\Page;
use Laminas\Navigation\Navigation;

class NavigationPage{

    public static function getDefaultConfig(){
        return require_once "default.php";
    }
    public static function getSiteMapConfig(){
        return require_once "sitemap.php";
    }
    public static function getSpecialConfig(){
        return require_once "special.php";
    }
    public static function getNavigation(){
        return new Navigation(
            self::getDefaultConfig(),
        );
    }

}