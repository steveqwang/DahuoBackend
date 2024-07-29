<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\ActivitySign;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class OrderCancel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cancel';

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
        Log::info('定时任务:取消报名');
        $list = ActivitySign::where('status', 1)->where('created_at', '<', date('Y-m-d H:i:s',time()-1800))->get();
        foreach ($list as $item){
            $item->status = 5;
            $item->save();
            $user = User::find($item->user_id);
            if ($item->sex == 1){
                Activity::where('id', $item->activity_id)->decrement('nan_num');
            }elseif($item->sex==2){
                Activity::where('id', $item->activity_id)->decrement('nv_num');
            }
            Activity::where('id', $item->activity_id)->decrement('sign_up_number');
        }
    }
}
