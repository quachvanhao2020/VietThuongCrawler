<?php
require __DIR__.'/vendor/autoload.php';

use VietThuongCrawler\Model\Storage\ProductStorage;
use VietThuongCrawler\ProductCrawler;
use VietThuongCrawler\Factory\ExcelProductFactory;
use Ecomo\Category\Category;
use YPHP\Model\Stream\Image;
use YPHP\Storage\EntityStorage;
use YPHP\Bundle;

//return trigger_event(DEBUG,null,new Bundle(StaticServer::class,"fsdfds",__FUNCTION__));

$crawler = new ProductCrawler();
$routers = [
    "https://vietthuong.vn/dan-piano-grand.html",
    "https://vietthuong.vn/dan-piano-grand.html/18",
    "https://vietthuong.vn/dan-piano-grand.html/27",
    "https://vietthuong.vn/dan-guitar-classic.html",
    "https://vietthuong.vn/dan-guitar-classic.html/18",
    "https://vietthuong.vn/dan-guitar-acoustic.html",
    "https://vietthuong.vn/dan-guitar-acoustic.html/18",
    "https://vietthuong.vn/dan-guitar-acoustic.html/36",
    "https://vietthuong.vn/amply-tro-khang-cao",
    "https://vietthuong.vn/amply-tro-khang-cao/9",
    "https://vietthuong.vn/am-thanh-di-dong",
    "https://vietthuong.vn/am-thanh-di-dong/18",
];
$routers = ["https://vietthuong.vn/dan-piano-grand.html/40"];
$products = unserialize(file_get_contents("keep"));
if(!$products){
    $products = new ProductStorage();
    foreach ($routers as $key => $value) {
        $_products = $crawler->getProducts($value,true);
        $products->merge($_products);
    }
}
//var_dump($products);
if(!file_exists("keep")){
    file_put_contents("keep",serialize($products));
}
$mexel = [
    'id' => [
        'name' => "Id",
    ],
    'note' => [
        'name' => "Note",
    ],
    'name' => [
        'name' => "Name",
    ],
    'status_value' => [
        'name' => "Status",
    ],
    'category_id' => [
        'name' => "Category",
    ],
    'category_class' => [
        'link' => true,
        'value' => Category::class,
    ],
    'logo_src' => [
        'name' => "Logo",
    ],
    'logo_class' => [
        'link' => true,
        'value' => Image::class,
    ],
    'oldMoney_price' => [
        'name' => "Old Price",
    ],
    'money_price' => [
        'name' => "Price",
    ],
    'description' => [
        'name' => "Description",
    ],
    'khuyenMai_ids' => [
        'name' => "Discount",
    ],
    'khuyenMai_class' => [
        'link' => true,
        'value' => EntityStorage::class,
    ],
    'tsktHtml' => [
        'name' => "Tskt",
    ],
    'descriptionHtml' => [
        'name' => "Description Over",
    ],
    'tableInfo' => [
        'name' => "Table",
    ],
    'youtubeVideo' => [
        'name' => "Video",
    ],
    'imageGallery_ids' => [
        'name' => "Image Gallery",
    ],
    'imageGallery_class' => [
        'link' => true,
        'value' => "YPHP\Model\Stream\Storage\ImageStorage",
    ],
];
//$mexel = [];
$xlsx = new ExcelProductFactory(__DIR__."/product.xlsx",1,$mexel);
$xlsx->setStorage($products);