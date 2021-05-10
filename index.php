<?php
require __DIR__.'/vendor/autoload.php';
use VietThuongCrawler\ProductCrawler;
$crawler = new ProductCrawler();
$routers = [
    "https://vietthuong.vn/dan-piano-grand.html",
    "https://vietthuong.vn/dan-piano-grand.html/9",
    "https://vietthuong.vn/digital-piano.html",
    "https://vietthuong.vn/digital-piano.html/9",
    "https://vietthuong.vn/dan-guitar-acoustic.html",
    "https://vietthuong.vn/dan-guitar-acoustic.html/9",
    "https://vietthuong.vn/dan-guitar-classic.html",
    "https://vietthuong.vn/dan-guitar-classic.html/9",
    "https://vietthuong.vn/am-thanh-di-dong",
    "https://vietthuong.vn/phu-kien-loa"

];
$routers = ["https://vietthuong.vn/dan-piano-grand.html"];
foreach ($routers as $key => $value) {
    $products = $crawler->getProducts($value,true);
}