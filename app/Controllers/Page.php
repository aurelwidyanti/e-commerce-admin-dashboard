<?php

namespace App\Controllers;
use App\Models\ProdukModel;

class Page extends BaseController
{
    public function keranjang()
    {
        return view('pages/keranjang_view');
    }

    public function produk()
    {
        $ProdukModel = new ProdukModel();
        $produk = $ProdukModel->findAll();
        $data['produks'] = $produk; 

        return view('pages/produk_view', $data);
    }
}