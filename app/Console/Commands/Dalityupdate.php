<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class Dalityupdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:daily';

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
        $orders = Order::where('is_clear',0)->get();
        foreach($orders as $order){
            $order->is_clear = 1;
            $order->save();
        }
    }
}
