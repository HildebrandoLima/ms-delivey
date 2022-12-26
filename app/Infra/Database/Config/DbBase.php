<?php

namespace App\Infra\Database\Config;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;

class DbBase
{
    protected ConnectionInterface $db;
    public function __construct()
    {
        $this->db = DB::connection();
    }
}
