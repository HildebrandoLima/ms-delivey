<?php

namespace App\Infra\Database;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;

class DBConnection
{
    protected ConnectionInterface $db;

    public function __construct()
    {
        $this->db = DB::connection();
    }
}
