<?php

namespace App\Exports;

use App\Models\Client;

class ClientsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Client::all();
    }
}
