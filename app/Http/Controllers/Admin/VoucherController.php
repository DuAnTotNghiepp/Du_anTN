<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

class VoucherController extends Controller
{
    public function index()
    {

      return view ('admin.vouchers.index');
    }
}
