<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Property;

class Slugify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:slugify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query = Property::query()->get();
        foreach($query as $list) {
           	$id = $list->id;
            $name = $list->name;
           	$slug = Str::slug($name);

           	$updateQuery = Property::where('id', $list->id)->first();


           

          	$updateQuery->slug = $slug;
           	$updateQuery->save();
	


            echo " 💾 Saving new slug: ".$slug."\n";
        }
    }
}
