<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OrderClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:clear ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'order:clear overtime';

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
     * @return mixed
     */
    public function handle()
    {
        while (true){
            $orders=\App\Models\Order::where("status",0)->where('created_at','<',date("Y-m-d H:i:s",(time()-15*60)))->update(['status'=>-1]);
            if ($orders){
                echo date("Y-m-d H:i:s")." clear ok".PHP_EOL;
            }
            sleep(5);
        }
    }
}
