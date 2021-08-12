<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Potong;
use App\Jahit;
use App\Cuci;

class DailyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status';

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

        $proses = Potong::whereDate('tanggal_cutting', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'proses potong']);
        $selesai = Potong::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'selesai']);
        $proses = Jahit::whereDate('tanggal_jahit', date('Y-m-d'))->where('status', 'jahitan masuk')->update(['status_jahit' => 'proses jahit']);
        $selesai = Jahit::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'jahitan masuk')->update(['status_jahit' => 'selesai']);
        $proses = Cuci::whereDate('tanggal_cuci', date('Y-m-d'))->where('status', 'cucian masuk')->update(['status_cuci' => 'proses cuci']);
        $selesai = Cuci::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'cucian masuk')->update(['status_cuci' => 'selesai']);

        echo "success";
    }
}
