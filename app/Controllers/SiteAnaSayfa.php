<?php

namespace App\Controllers;

use App\Models\OtelModel;
use App\Models\RestoranModel;

class SiteAnaSayfa extends BaseController
{
    public function index()
    {
        $otelModel = new OtelModel();
        $restoranModel = new RestoranModel();

        $data = [
            'oteller' => $otelModel->findAll(),
            'restoranlar' => $restoranModel->findAll(),
        ];

        return view('site_anasayfa', $data);
    }
}
