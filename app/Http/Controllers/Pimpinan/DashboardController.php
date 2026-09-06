<?php

namespace App\Http\Controllers\Pimpinan;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\TestSession;
use App\Models\Product;
use App\Models\Sample;
use App\Models\User;



class DashboardController extends Controller
{


public function index(Request $request)
{


$user = Auth::user();



/*
|--------------------------------------------------------------------------
| Monitoring Pengujian
|--------------------------------------------------------------------------
*/


$sessions = TestSession::with([

    'sample.product',

    'assessments'

])

->when(request('produk'), function($query){

    $query->whereHas('sample.product', function($q){

        $q->where('id', request('produk'));

    });

})


->when(request('status'), function($query){

    $query->where(
        'status',
        request('status')
    );

})


->when(request('tanggal_mulai'), function($query){

    $query->whereDate(
        'tanggal_pengujian',
        '>=',
        request('tanggal_mulai')
    );

})


->when(request('tanggal_selesai'), function($query){

    $query->whereDate(
        'tanggal_pengujian',
        '<=',
        request('tanggal_selesai')
    );

})


->latest()

->get();


/*
|--------------------------------------------------------------------------
| STATISTIK
|--------------------------------------------------------------------------
*/


$totalUji = TestSession::count();



$ujiAktif = TestSession::where(

'status',

'dibuka'

)->count();




$ujiSelesai = TestSession::where(

'status',

'selesai'

)->count();


$totalProduk = Product::count();


$totalSampel = \App\Models\Sample::count();


$totalPanelis = \App\Models\User::where(
    'role',
    'panelis'
)->count();




$totalNilai = 0;

$totalAssessment = 0;



$sessionsMutu = TestSession::with(
    'assessments'
)->get();



foreach($sessionsMutu as $session)
{


    foreach($session->assessments as $assessment)
    {


        $totalNilai += $assessment->total_nilai;

        $totalAssessment++;


    }


}




if($totalAssessment > 0)
{

    $rataMutu = 
    $totalNilai / ($totalAssessment * 4);
    
}
else
{

    $rataMutu = 0;

}

$nilaiMutu = $rataMutu;


if($rataMutu >= 7)
{

    $kategoriMutu = "Baik";

}
elseif($rataMutu >= 5)
{

    $kategoriMutu = "Cukup";

}
else
{

    $kategoriMutu = "Perlu Perhatian";

}








/*
|--------------------------------------------------------------------------
| RATA-RATA MUTU
|--------------------------------------------------------------------------
*/


$totalNilai = 0;

$totalAssessment = 0;



foreach(TestSession::with('assessments')->get()
as $session)
{


foreach($session->assessments as $assessment)
{


$totalNilai += $assessment->total_nilai;

$totalAssessment++;


}

}



if($totalAssessment > 0)
{

    $rataMutu = 
    $totalNilai / ($totalAssessment * 4);

}
else
{

    $rataMutu = 0;

}


$nilaiMutu = $rataMutu;






/*
|--------------------------------------------------------------------------
| LIST PRODUK
|--------------------------------------------------------------------------
*/


$produkList = Product::orderBy(

'nama_produk'

)->get();








/*
|--------------------------------------------------------------------------
| GRAFIK BULAN
|--------------------------------------------------------------------------
*/


$grafikPengujian = TestSession::selectRaw(

"MONTH(tanggal_pengujian) bulan,
COUNT(*) jumlah"

)

->groupBy('bulan')

->get()

->map(function($item){

return [

'bulan'=>

date('M',
mktime(
0,
0,
0,
$item->bulan,
1
)),

'jumlah'=>

$item->jumlah

];


});









/*
|--------------------------------------------------------------------------
| GRAFIK NILAI MUTU
|--------------------------------------------------------------------------
*/


$grafikMutu=[];



foreach(TestSession::with([
'assessments',
'sample.product'
])->get()

as $session)
{


$total=0;

$count=0;



foreach($session->assessments as $assessment)
{

$total += $assessment->total_nilai;

$count++;

}




if($count>0)
{


$grafikMutu[]=[


'produk'=>

$session
->sample
->product
->nama_produk,


'nilai'=>

round(

$total/

($count*4),

2

)



];


}



}







/*
|--------------------------------------------------------------------------
| GRAFIK STATUS
|--------------------------------------------------------------------------
*/


$grafikStatus=[


'draft'=>

TestSession::where(
'status',
'draft'
)->count(),


'dibuka'=>

TestSession::where(
'status',
'dibuka'
)->count(),


'selesai'=>

TestSession::where(
'status',
'selesai'
)->count()


];









return view(

'pimpinan.dashboard',

compact(

'user',

'sessions',

'totalUji',

'ujiAktif',

'ujiSelesai',

'totalProduk',

'totalSampel',

'totalPanelis',

'nilaiMutu',

'grafikPengujian',

'grafikMutu',

'produkList'

)

);



}



}