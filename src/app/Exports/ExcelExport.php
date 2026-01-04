<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelExport implements FromView
{
  protected $data;
  protected $headings;

  function __construct($data,$headings) {
    $this->data = $data;
    $this->headings = $headings;
  }

  public function view(): View
  {
    return view('export', [
      'datas' => $this->data,
      'headings' => $this->headings,
    ]);
  }
}