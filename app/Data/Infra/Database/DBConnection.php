<?php

namespace App\Data\Infra\Database;

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
