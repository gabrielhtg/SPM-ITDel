<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LogLaporan;
use App\Models\JenisLaporan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendDailyReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-reminder-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily reminder email to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Lakukan pengiriman email di sini
        $nowDate = Carbon::now();
        $logLaporan = LogLaporan::where('end_date', '<', $nowDate)
            ->whereNull('status')
            ->get();

        $userIds = $logLaporan->pluck('upload_by')->toArray();

        // Ambil semua user yang memiliki id yang sesuai dengan user ids dari log laporan
        $userLaporan = User::whereIn('id', $userIds)->get();
        $emails = $userLaporan->pluck('email')->toArray();

        foreach ($emails as $email) {
            $idJenisLaporan = $logLaporan->pluck('id_jenis_laporan')->unique()->toArray(); // Get unique jenis laporan IDs
            $jenisLaporan = JenisLaporan::whereIn('id', $idJenisLaporan)->get();

            $messageContent = 'Segera kumpulkan: ';
            foreach ($jenisLaporan as $jenis) {
                $messageContent .= $jenis->nama . ', ';
            }
            $messageContent = rtrim($messageContent, ', '); // Remove the last comma and space

            Mail::raw($messageContent, function ($message) use ($email) {
                $message->to($email)
                        ->from('amiadmitdel@gmail.com', 'Admin SPM')
                        ->subject('Daily Reminder');
            });
        }

        $this->info('Daily reminder emails sent successfully!');
    }
}
