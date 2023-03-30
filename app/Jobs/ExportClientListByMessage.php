<?php

namespace App\Jobs;

use App\Exports\ClientsExport;
use App\Mail\ExportClientsMail;
use App\Models\Client;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportClientListByMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $admin;
    public string $format;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin, $format) {
        $this->admin = $admin;
        $this->format = $format;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $filename = "";
        if ($this->format == "csv") {
            $filename = "listeClients.csv";
            Excel::store(new ClientsExport(), $filename, 'public');
        } elseif ($this->format == "xls") {
            $filename = "listeClients.xls";
            Excel::store(new ClientsExport(), $filename, 'public');
        } elseif ($this->format == "pdf") {
            $filename = "listeClients.pdf";
            $pdf = PDF::loadView('clients.liste', ['clients' => Client::all()]);
            $pdf->save($filename, 'public');
        } else {
            Log::warning("format de fichier non pris en charge");
            return;
        }

        Mail::to($this->admin->email)
            ->send(new ExportClientsMail(
                "Liste des clients au format ".$this->format,
                $filename
            ));
    }
}
