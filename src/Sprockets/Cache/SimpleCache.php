<?php

namespace Igorgoroshit\Sprockets\Cache;

use Passet\Contracts\AssetInterface;
use Passet\Contracts\CacheInterface;

class SimpleCache implements CacheInterface
{
    public $data = array();

    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function get($key)
    {
        return $this->data[$key];
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function remove($key)
    {
        unset($this->data[$key]);
    }

}
