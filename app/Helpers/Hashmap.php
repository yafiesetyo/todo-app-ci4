<?php

namespace App\Helpers;

class HashMap
{
    private $map = [];

    // Deklarasi key dan value
    public function put($key, $val)
    {
        $this->hashmap[$key] = $val;
    }

    // Mendapatkan value berdasarkan key
    public function get($key)
    {
        if (in_array($key, $this->hashmap)) {
            return $this->hashmap[$key];
        }
        return null;
    }

    // Menghapus key & value berdasarkan key
    public function remove($key)
    {
        if (in_array($key, $this->hashmap)) {
            unset($this->hashmap[$key]);
        }
    }

    // Menghapus semua key & value
    public function clear()
    {
        unset($this->hashmap);
    }
}
