<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('products')
            ->select(
                DB::raw('category_id as category_id'),
                DB::raw('count(*) as number')
            )
            ->groupBy('category_id')
            ->get();
        $array[] = ['category_id', 'number'];
        // dd($data);
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->category_id, $value->number];
        }


        //grafik item
        $data1 = DB::table('orders')
            ->select(
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year"),
                DB::raw('(sum(total_item)) as total_item')
            )
            ->groupBy('month_year')
            ->get();

        $array1[] = ['month_year', 'total_item'];

        foreach ($data1 as $key => $value) {
            $array1[++$key] = [$value->month_year, $value->total_item];
        }
        // 
        //grafik jual
        $data2 = DB::table('orders')
            ->select(
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year"),
                DB::raw('(sum(total)) as total')
            )
            ->groupBy('month_year')
            ->get();

        $array2[] = ['month_year', 'total'];

        foreach ($data2 as $key => $value) {
            $array2[++$key] = [$value->month_year, $value->total];
        }
        // 
        $jml_product = product::count();
        $jml_tshirt = product::where('category_id', '1')->count();
        $jml_crwnk = product::where('category_id', '2')->count();
        // dd($crewneck);
        return view('admin.index', [
            'jml' => $jml_product, 'tshirt' => $jml_tshirt,
            'crwnk' => $jml_crwnk
        ])->with('category_id', json_encode($array))
            ->with('data1', json_encode($array1, JSON_NUMERIC_CHECK))
            ->with('data2', json_encode($array2, JSON_NUMERIC_CHECK));
    }
}
