<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->insert('fortress_roles', 'App\Models\FortressRole');
        $this->insert('resource_topics', 'App\Models\ResourceTopic');
        $this->insert('resources', 'App\Models\Resource');
        $this->insert('topics', 'App\Models\Topic');
        $this->insert('users', 'App\Models\User');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }

    /**
     * @param $table
     * @param $model
     * @param $file
     * @param null     $truncate
     */
    protected function insert($table, $model, $file = null, $truncate = true)
    {
        echo "\033[32m Seeding {$model}\033[0m \n";
        $file = $file ?? $table;
        $items = require "exports/{$file}.php";
        $records = array_chunk($items, 700, true);
        if ($truncate == true) {
            DB::table($table)->truncate();
        }

        // Use insert or replace, depending on type
        foreach ($records as $r) {
            $model::insert($r);
        }

        $items = null;
        $records = null;
    }
}
