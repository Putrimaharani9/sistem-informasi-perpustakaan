<?php

namespace App\Console\Commands;

use App\Models\Loan;
use App\Services\ReturnLoanReminderService;
use Illuminate\Console\Command;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;

class ReturnLoanReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send return reminder to members';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $needToReturnLoans = Loan::with('book', 'member', 'member.deviceIds')->needReturn()->get();

        foreach ($needToReturnLoans as $loan) {
            $notification = Notification::create('Pengembalian Buku', 'Halo ' . $loan->member->name . ' jangan lupa besok kembalikan buku ' . $loan->book->title . ' ya!', getSetting('app_icon'));

            $deviceIds = $loan->member->deviceIds->pluck('device_id')->take(5);

            foreach ($deviceIds as $token) {
                $messaging = app('firebase.messaging');
                $message = CloudMessage::new()
                    ->withNotification($notification)
                    ->withWebPushConfig(WebPushConfig::fromArray([
                        'fcm_options' => [
                            'link' => env('APP_URL'),
                        ],
                    ]))
                    ->toToken($token);

                $messaging->send($message);
            }
        }
    }
}
