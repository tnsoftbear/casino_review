<?php

declare(strict_types=1);

namespace App\Infra\Db;

use Illuminate\Support\Facades\Schema;

class DbSchemaExplorer
{
    /**
     * Check if table has foreign key on column
     * 
     * Array
     *
     * @param string $table
     * @param string $column
     * @return boolean
     */
    public function hasForeignKey(string $table, string $column): bool
    {
        $foreignKeys = Schema::getForeignKeys($table);
        $arr = array_filter($foreignKeys, function($foreignKey) use ($column) {
            return in_array($column, $foreignKey['columns']);
        });
        return (bool)$arr;
    }
}
