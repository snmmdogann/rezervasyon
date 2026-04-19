<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Cikis extends Controller
{
    public function index()
    {
        // Oturumu sonlandır
        session()->destroy();

        // Giriş sayfasına yönlendir
        return redirect()->to(base_url('/'));
    }
}      
