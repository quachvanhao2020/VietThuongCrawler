<?php
namespace VietThuongCrawler\Model;
use Ecomo\Product\ProductSocietyXX;
use YPHP\Filter\SortFilter;
use YPHP\Filter\AwareKeepInterface;
use Ecomo\Filter\AwarePriceInterface;
use YPHP\Filter\AwareSortFilterInterface;
use YPHP\Model\Stream\Storage\ImageStorage;

class Product extends ProductSocietyXX implements AwareKeepInterface,AwarePriceInterface,AwareSortFilterInterface {

    const khuyenMaiHtml = "khuyenMaiHtml";
    const descriptionHtml = "descriptionHtml";
    const tsktHtml = "tsktHtml";
    const imageGallery = "imageGallery";

    /**
     * @var string
     */
    protected $khuyenMaiHtml;
    /**
     * @var string
     */
    protected $descriptionHtml;

    /**
     * @var string
     */
    protected $tsktHtml;

    /**
     * @var string
     */
    protected $youtubeVideo;

    /**
     * @var string[]
     */
    protected $advantages;

    /**
     * @var string
     */
    protected $tableInfo;

    /**
     * @var ImageStorage
     */
    protected $imageGallery;

    public function getWeight($flag = SortFilter::MOST){
        return parent::getWeight($flag);
    }

    /**
     * Get the value of advantages
     *
     * @return  string[]
     */ 
    public function getAdvantages()
    {
        if(!$this->advantages) $this->advantages = [];
        return $this->advantages;
    }

    /**
     * Set the value of advantages
     *
     * @param  string[]  $advantages
     *
     * @return  self
     */ 
    public function setAdvantages($advantages = null)
    {
        $this->advantages = $advantages;

        return $this;
    }

    /**
     * Get the value of tableInfo
     *
     * @return  string
     */ 
    public function getTableInfo()
    {
        return $this->tableInfo;
    }

    /**
     * Set the value of tableInfo
     *
     * @param  string  $tableInfo
     *
     * @return  self
     */ 
    public function setTableInfo(string $tableInfo = null)
    {
        $this->tableInfo = $tableInfo;

        return $this;
    }

    /**
     * Get the value of descriptionHtml
     *
     * @return  string
     */ 
    public function getDescriptionHtml()
    {
        return $this->descriptionHtml;
    }

    /**
     * Set the value of descriptionHtml
     *
     * @param  string  $descriptionHtml
     *
     * @return  self
     */ 
    public function setDescriptionHtml(string $descriptionHtml = null)
    {
        $this->descriptionHtml = $descriptionHtml;

        return $this;
    }

    /**
     * Get the value of tsktHtml
     *
     * @return  string
     */ 
    public function getTsktHtml()
    {
        return $this->tsktHtml;
    }

    /**
     * Set the value of tsktHtml
     *
     * @param  string  $tsktHtml
     *
     * @return  self
     */ 
    public function setTsktHtml(string $tsktHtml = null)
    {
        $this->tsktHtml = $tsktHtml;

        return $this;
    }

    /**
     * Get the value of youtubeVideo
     *
     * @return  string
     */ 
    public function getYoutubeVideo()
    {
        return $this->youtubeVideo;
    }

    /**
     * Set the value of youtubeVideo
     *
     * @param  string  $youtubeVideo
     *
     * @return  self
     */ 
    public function setYoutubeVideo(string $youtubeVideo = null)
    {
        $this->youtubeVideo = $youtubeVideo;

        return $this;
    }

    /**
     * Get the value of khuyenMaiHtml
     *
     * @return  string
     */ 
    public function getKhuyenMaiHtml()
    {
        return $this->khuyenMaiHtml;
    }

    /**
     * Set the value of khuyenMaiHtml
     *
     * @param  string  $khuyenMaiHtml
     *
     * @return  self
     */ 
    public function setKhuyenMaiHtml(string $khuyenMaiHtml = null)
    {
        $this->khuyenMaiHtml = $khuyenMaiHtml;

        return $this;
    }

    /**
     * Get the value of imageGallery
     *
     * @return  ImageStorage
     */ 
    public function getImageGallery()
    {
        return $this->imageGallery;
    }

    /**
     * Set the value of imageGallery
     *
     * @param  ImageStorage  $imageGallery
     *
     * @return  self
     */ 
    public function setImageGallery(ImageStorage $imageGallery = null)
    {
        $this->imageGallery = $imageGallery;

        return $this;
    }
}