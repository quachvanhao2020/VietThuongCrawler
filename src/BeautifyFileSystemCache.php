<?php
namespace VietThuongCrawler;

use Laminas\Cache\Storage\Adapter\Filesystem;
use YPHP\Entity;
use YPHP\StorageInterface;

class BeautifyFileSystemCache extends Filesystem implements StorageInterface{
    protected $keys = [];
    /**
     * Constructor
     *
     * @param  null|array|Traversable|AdapterOptions $options
     * @throws Exception\ExceptionInterface
     */
    public function __construct($cacheDir = __DIR__)
    {
        if (!is_dir($cacheDir)) mkdir($cacheDir,0777,true);
        $keys = [];
        $files = scandir($cacheDir);
        foreach ($files as $key => $value) {
            if(!is_file($cacheDir."/".$value)) continue;
            $path = pathinfo($value);
            $name = $path["filename"];
            if($name && $name != "."){
                $keys[$name] = true;
            }
        }
        $this->keys = $keys;
        return parent::__construct([
            "key_pattern" => "",
            "cache_dir" => $cacheDir,
            "dir_level"=>0,
            "suffix"=>"json",
            "namespace_separator"=>"",
            "tag_suffix"=>"",
            "namespace"=>"",
            "ttl"=>0,
        ]);
    }

        /**
     * Write content to a file
     *
     * @param  string  $file        File complete path
     * @param  string  $data        Data to write
     * @param  bool $nonBlocking Don't block script if file is locked
     * @param  bool $wouldblock  The optional argument is set to TRUE if the lock would block
     * @return void
     * @throws Exception\RuntimeException
     */
    protected function putFileContent($file, $data, $nonBlocking = false, & $wouldblock = null)
    {
        $dirname = \dirname($file);
        if (!is_dir($dirname)) mkdir($dirname,0777,true);
        if($data instanceof Entity){
            $data = \json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
        parent::putFileContent($file, $data, $nonBlocking,$wouldblock);
    }

    /**
     * Get the value of keys
     */ 
    public function getKeys()
    {
        return $this->keys;
    }
}