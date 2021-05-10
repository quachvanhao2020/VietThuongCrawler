<?php
namespace VietThuongCrawler\Factory;
use Ecomo\Product\Factory\BaseProductFactory;
use VietThuongCrawler\Model\Storage\ProductStorage;
use VietThuongCrawler\Model\Product;
use Laminas\Hydrator\Strategy\DateTimeArrayFormatterStrategy;
use Laminas\Hydrator\Strategy\EnumStrategy;
use Laminas\Hydrator\Strategy\NewClassStrategy;
use Laminas\Hydrator\Strategy\StorageStrategy;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\StreamStrategy;
use YPHP\Factory\ExcelEntityFactoryTrait;
use YPHP\FilterInputInterface;
use YPHP\SortingInputInterface;

class ExcelProductFactory extends BaseProductFactory{
    const ENTITY = Product::class;
    const STORAGE = ProductStorage::class;

    use ExcelEntityFactoryTrait;

        /**
     * @param int $first
     * @param string $after
     * @param int $last
     * @param string $before
     * @param ProductFilter $filter
     * @param SortingInputInterface $sort
     * @return mixed
     */
    public function list(int $first = 0,string $after = "",int $last = -1,string $before = "",FilterInputInterface $filter = null,SortingInputInterface $sort = null){
        $storage = $this->storage;
        $filter && $filter->filter($storage);
        return $storage;
    }

    /**
     * Get the value of strategys
     *
     * @return  StrategyInterface[]
     */ 
    public static function getStrategys(HydratorInterface $hydrator)
    {
        $minimum_new_class = new NewClassStrategy($hydrator);
        $new_class = new NewClassStrategy($hydrator,false);
        $storage_strategy = new StorageStrategy();
        $streamStrategy = new StreamStrategy();
        $stream_storage_strategy = new StorageStrategy($streamStrategy);
        return [
            Product::STATUS => [
                "strategy" => new EnumStrategy(),
                "recursive" => true,
                "children" => [],
            ],
            Product::ATTRIBUTES => [
                "strategy" => $storage_strategy,
                "recursive" => true,
                "children" => [],
            ],
            Product::VARIANTS => [
                "strategy" => $storage_strategy,
                "recursive" => true,
                "children" => [],
            ],
            Product::DATECREATED => [
                "strategy" => new DateTimeArrayFormatterStrategy(),
                "recursive" => true,
                "children" => [],
            ],
            Product::CATEGORY => [
                "strategy" => $minimum_new_class,
                "recursive" => true,
                "children" => [],
            ],
            Product::LOGO => [
                "strategy" => $new_class,
                "recursive" => true,
                "children" => [],
            ],
            Product::CHILDREN => [
                "strategy" => $storage_strategy,
                "recursive" => true,
                "children" => [],
            ],
            Product::PARENT => [
                "strategy" => $minimum_new_class,
                "recursive" => true,
                "children" => [],
            ],
            Product::descriptionHtml => [
                "strategy" => $streamStrategy,
                "recursive" => true,
                "children" => [],
            ],
            Product::tsktHtml => [
                "strategy" => $streamStrategy,
                "recursive" => true,
                "children" => [],
            ],
            Product::imageGallery => [
                "strategy" => $stream_storage_strategy,
                "recursive" => true,
                "children" => [],
            ],
        ];
    }

    /**
     * Get the value of storage
     *
     * @return  ProductStorage
     */ 
    public function getStorage()
    {
        if(!$this->storage) $this->storage = new ProductStorage();
        return $this->storage;
    }

    public function getClassEntity(){
        return Product::class;
    }

    protected function _convertArraySheet(array &$array){
        return;
    }
}