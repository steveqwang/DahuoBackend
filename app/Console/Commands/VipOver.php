<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class VipOver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vip:over';

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
        User::where('vip_end_time', '<', time())->where(['is_vip'=>1])->update(['is_vip'=>0,'activity_num'=>0,'search_num'=>0]);
    }
}
