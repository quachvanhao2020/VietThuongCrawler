<?php
namespace VietThuongCrawler\Model\Storage;

use Ecomo\Product\Storage\ProductStorage as StorageProductStorage;
use YPHP\ArrayObject;
use VietThuongCrawler\Model\Product;
use VietThuongCrawler\Model\Storage\Iterator\ProductIterator;
use YPHP\Storage\EntityStorage;
use Ecomo\Product\Storage\ProductStorageInterface;

class ProductStorage extends StorageProductStorage implements ProductStorageInterface{

    const ENTITY = Product::class;
    /**
     * Create a new iterator from an ArrayObject instance
     *
     * @return ProductIterator
     */
    public function getIterator()
    {
        return new ProductIterator($this->storage);
    }

    /**
     * Get the value of storage
     *
     * @return  \Ecomo\Product\Product[]
     */ 
    public function getStorage()
    {
        return $this->storage;
    }


    /**
     * Set the value of storage
     *
     * @param  \Ecomo\Product\Product[]  $storage
     *
     * @return  self
     */ 
    public function setStorage($storage = [])
    {
        return parent::setStorage($storage);
    }
}