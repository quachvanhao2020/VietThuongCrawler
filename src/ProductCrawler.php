<?php
namespace VietThuongCrawler;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\HtmlNode;
use YPHP\Model\Stream\Image;
use Laminas\Cache\Storage\StorageInterface;
use Laminas\Hydrator\HydratorInterface;
use YPHP\Hydrator\ClassMethodsHydrator;
use YPHP\Entity;
use VietThuongCrawler\Factory\ExcelProductFactory;
use YPHP\StorageHydratorTrait;
use Ecomo\Category\Category;
use VietThuongCrawler\Model\Product;
use Exchamo\Money;
use VietThuongCrawler\Model\Storage\ProductStorage;

class ProductCrawler{

    use StorageHydratorTrait;

    const HOST = "https://vietthuong.vn/";

    /**
     * @var HttpClientInterface
     */
    protected $client;

    public function __construct(HttpClientInterface $client = null,StorageInterface $cache = null,HydratorInterface $hydrator = null)
    {
        if(!$client) $client = HttpClient::create();
        if(!$cache){
            $cache = new BeautifyFileSystemCache(__DIR__."/../data/viethuong/");
        }
        if(!$hydrator) $hydrator = new ClassMethodsHydrator();
        $this->client = $client;
        $this->cache = $cache;
        $this->hydrator = $hydrator;
    }

    protected function prepareHeaders(){
        $headers = [
            //'Content-Type' => 'text/plain',
            //'Content-Type' => 'application/json',
        ];
        return $headers;
    }


    /**
     * Get the value of strategys
     *
     * @return  StrategyInterface[]
     */ 
    public static function getStrategys(HydratorInterface $hydrator)
    {
        return ExcelProductFactory::getStrategys($hydrator);
    }
    /**
     * @var Product
     */
    public function getProduct(string $id){
        var_dump($id);
        $result = $this->cache->getItem($id);
        $result = json_decode($result,true);
        $product = $this->hydrate($result,new Product());
        return $product;
    }

    /**
     * @var ProductStorage
     */
    public function getProducts(string $router = null,bool $full = false){
        $products = new ProductStorage();
        if(!$router){
            foreach ($this->cache->getKeys() as $key => $value) {
                try {
                    $products->append($this->getProduct($key));
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
            return $products;
        }
        $result = $this->client->request("GET",$router,['headers' => $this->prepareHeaders(),])->getContent(false);
        $dom = new Dom;
        $dom->loadStr($result);
        $products = self::getProductsByDom($dom);
        foreach ($products as $key => $value) {
            if($full){
                $this->getFullProduct(self::HOST.$value->getId(),$value);
            }
            if($value instanceof Entity){
                $this->cache->setItem(seo_friendly_url($value->getId()),\json_encode($this->extract($value),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
            }
        }
    }

    /**
     * @var ProductStorage
     */
    public static function getProductsByDom(Dom $dom){
        $products = new ProductStorage();
        $list_product = $dom->find(".list-product")[0];
        $nodes = $list_product->find(".item");
        foreach ($nodes as $node) {
            $products->append(self::getProductByNode($node));
        }
        return $products; 
    }

    protected static function stringToMoney($string){
        $money = new Money();
        $money->setPrice(intval(str_replace(",","",$string)));
        return $money;
    }   

    /**
     * @var Product
     */
    public static function getProductByNode(HtmlNode $node){
        $product = new Product();
        $h3 = $node->find("h3");
        $price_new = $node->find(".price_new")[0];
        $short_description = $node->find(".short_description")[0];
        $product->setName($h3->innerHtml);
        $price_new = str_replace("Giá: ","",$price_new->innerHtml);
        $product->setMoney(self::stringToMoney($price_new));
        $product->setDescription($short_description->innerHtml);
        $img = $node->find("img")[0];
        $product->setLogo((new Image())->setSrc($img->getAttribute("src")));
        $a = $node->find('a')[0];
        $product->setId(str_replace(self::HOST,"",$a->getAttribute("href")));
        return $product;
    }

        /**
     * @var Product
     */
    public static function getFullProductByNode(HtmlNode $node,Product &$product = null){
        $product = $product ? $product : new Product();
        try {
            $content_box_khuyen_mai = @$node->find(".content_box_khuyen_mai")[0];
            @$product->setKhuyenMaiHtml($content_box_khuyen_mai->innerHtml);
        } catch (\Exception $th) {
            //throw $th;
        }
        try {
            $tab_description = $node->find("#tab-description");
            $product->setDescriptionHtml($tab_description->innerHtml);
            $tab_tskt = $node->find("#tab-tskt");
            $product->setTsktHtml($tab_tskt->innerHtml);
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $tab_video = $node->find("#tab-video");
            $iframe = @$tab_video->find('iframe')[0];
            @$product->setYoutubeVideo($iframe->getAttribute("src"));
        } catch (\Exception $ex) {
            //throw $th;
        }

        try {
            $breadcrumbs = $node->find(".breadcrumbs")[0];
            $lis = $breadcrumbs->find("li");
            $li = $lis[count($lis)-2];
            $a = $li->find("a")[0];
            $href = $a->getAttribute("href");
            $href = str_replace(self::HOST,"",$href);
            $href = str_replace(".html",'',$href);
            $product->setCategory(new Category($href));
        } catch (\Throwable $th) {
            throw $th;
        }
        return $product;
    }

        /**
     * @var ProductStorage
     */
    public function getFullProduct(string $router,Product &$product = null){
        $router = trim($router);
        var_dump($router);
        $product = $product ? $product : new Product();
        $result = $this->client->request("GET",$router,['headers' => $this->prepareHeaders(),])->getContent(false);
        $dom = new Dom;
        $dom->loadStr($result);
        try {
            $container = $dom->find("#main")[0];
            return self::getFullProductByNode($container,$product);
        } catch (\Throwable $th) {
            throw $th;
            var_dump($result);
        }
    }

}

function seo_friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}