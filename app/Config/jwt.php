<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class JWT extends BaseConfig
{
    public string $key = 'AXEXan9PqhylhNJBfpbErCEGkrxbFXAdzOBvYqfKizgRZxq88EwMKlloC1Frfebx';
    public string $alg = 'HS256';
    public int $ttl = 43200; // durasi (detik)
}
