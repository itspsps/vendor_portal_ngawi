<?php

namespace App\Console\Commands;

use App\Models\LogAktivityAp;
use App\Models\LogAktivityLab;
use App\Models\LogAktivityQc;
use App\Models\LogAktivitySecurity;
use App\Models\LogAktivitySourching;
use App\Models\LogAktivitySpvAp;
use App\Models\LogAktivitySpvQc;
use App\Models\LogAktivityTimbangan;
use App\Models\LogAktivityUser;
use App\Models\NotifAp;
use App\Models\NotifBongkar;
use App\Models\NotifLab;
use App\Models\NotifSecurity;
use App\Models\NotifSourching;
use App\Models\NotifSpvap;
use App\Models\NotifSpvqc;
use App\Models\NotifTimbangan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:DeleteNotif';
    protected $description = 'Delete old data from the table.';

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
        // Notif
        NotifAp::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        NotifSpvap::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        NotifSpvqc::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        NotifSourching::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        NotifTimbangan::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        NotifSecurity::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        NotifLab::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        NotifBongkar::where('created_at', '<', Carbon::now()->subDays(7))->delete();

        // LOG
        LogAktivityAp::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivityQc::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivitySpvQc::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivityLab::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivitySpvAp::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivitySecurity::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivitySourching::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivityUser::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        LogAktivityTimbangan::where('created_at', '<', Carbon::now()->subDays(30))->delete();
    }
}
