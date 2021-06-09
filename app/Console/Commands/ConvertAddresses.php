<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;

class ConvertAddresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'address:convert';

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
        $query = Company::query()->get();
        foreach($query as $list) {
            $id = $list->id;
            $city = $list->city;
            $street = $list->street;
            $postal = $list->postal;

            $updateQuery = Company::where('id', $list->id)->first();

            $newaddress = $street;
            if($street) { $newaddress .= ", "; }
            $newaddress .= $city;
            if($city) { $newaddress .= ", "; }
            $newaddress .= $postal;

            $newaddress = rtrim($newaddress, ", ");

            $updateQuery->city = $newaddress;
            $updateQuery->street = "";
            $updateQuery->postal = "";
            $updateQuery->save();


            echo " 💾 Saving new address: ".$newaddress."\n";
        }
    }
}
