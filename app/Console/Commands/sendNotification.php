<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Niche;
use App\Models\Installment;
use Illuminate\Support\Str;
use App\Mail\SendInstallment;
use App\Models\ResetPassword;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $niches = Installment::whereDate('date', Carbon::today())->get();
        foreach ($niches as $nich) {
            if( $nich->status == false)
                {
                    $niche = Niche::where('receipt_id', $nich->receipt_id)->first();
                    $user = User::where('id',$niche->user_id)->first();
                   if  ($user)
                   {
                    $data = [
                        'name'=> $user->firstname .' '. $user->lastname,
                        'date'=> $nich->date,
                    ];
                    Mail::to($user->email)->send(new SendInstallment($data));
                   }
                }
        }
    }
}
