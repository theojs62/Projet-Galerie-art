<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", description: "Serveur Api Documentation", title: "Serveur Api Documentation")]
#[OA\Contact(name: "Theo Journee, Sebastien Coze",email: "theo.journee@univ-artois.fr , sebastien.coze@univ-artois.fr")]
#[OA\License(name: "Apache 2.0",url: "http://www.apache.org/licenses/LICENSE-2.0.html")]
#[OA\Server(description:"OpenApi host", url: "/api")]

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
