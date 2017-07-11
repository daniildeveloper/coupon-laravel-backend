<?php

namespace App\Http\Controllers;

use App\Company;
use App\Coupon;
use Illuminate\Support\Facades\DB;
use \Excel;

class AccountingDataController extends Controller
{

    protected $coupons;

    public function __construct()
    {
        $this->middleware("admin");

        // init basic data
        $coupons = Coupon::all();

    }
    /**
     * genereate count in excel about visits
     * @return [type] [description]
     */
    public function couponVisits()
    {
        Excel::create("Отчет по посещениям", function ($data) {
            $data->sheet("Отчет по просмотрам купонов", function ($sheet) {
                $sheet->cell("a1", function ($cell) {
                    $cell->setValue("#");
                });
                $sheet->cell("b1", function ($cell) {
                    $cell->setValue("Просмотры");
                });
                $sheet->cell("c1", function ($cell) {
                    $cell->setValue("Название");
                });
                $sheet->cell("d1", function ($cell) {
                    $cell->setValue("Поставщик");
                });
                foreach (DB::table("coupons")->where("is_show", 1)->get() as $c => $key) {
                    $sheet->cell("a$key", function ($cell) use ($c) {
                        $cell->setValue($c->id);
                    });
                    $sheet->cell("b$key", function ($cell) use ($c) {
                        $cell->setValue($c->views);
                    });
                    $sheet->cell("c$key", function ($cell) use ($c) {
                        $cell->setValue($c->title);
                    });
                    $sheet->cell("d$key", function ($cell) use ($c) {
                        $cell->setValue($c->title);
                    });

                    $data->setCellValue("d$key", Company::find($c->company_id)->name);
                }
            });
            // TODO: beatiful header
        })->export("xls");
        return redirect()->back();
    }

}
