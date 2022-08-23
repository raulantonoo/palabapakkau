<?php

// namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', 'Admin\ChartController@index')->name('dashboard');
    Route::get('/user', 'Admin\HomeController@user')->name('user');
    Route::get('/user/delete/{id}', 'Admin\HomeController@delete')->name('delete');

    // kategori
    Route::get('/kategori', 'Admin\CategoryController@index')->name('kategori');
    Route::post('/kategori_store', 'Admin\CategoryController@store');
    Route::get('/kategori_edit/{id}', 'Admin\CategoryController@edit')->name('kategori_edit');
    Route::post('/kategori/update', 'Admin\CategoryController@update');
    Route::delete('/kategori/delete', 'Admin\CategoryController@destroy')->name('kategori_delete');
    // end

    // produk
    Route::get('/produk', 'Admin\ProductController@index')->name('produk');
    Route::post('/store', 'Admin\ProductController@store');
    Route::get('/produk_edit/{id}', 'Admin\ProductController@edit')->name('produk_edit');
    Route::post('/produk/update', 'Admin\ProductController@update');
    Route::get('/produk_promo/{id}', 'Admin\ProductController@promo')->name('produk_promo');
    Route::post('/produk/updatepromo', 'Admin\ProductController@updatepromo');
    Route::delete('/produk/delete', 'Admin\ProductController@destroy')->name('produk_delete');
    // end

    // order
    Route::get('/data_pesanan', 'Admin\OrderController@index')->name('data_pesanan');
    Route::get('/pesanan_edit/{id}', 'Admin\OrderController@edit')->name('pesanan_edit');
    Route::post('/pesanan/update', 'Admin\OrderController@update');
    Route::get('/pesanan/cetak_pdf', 'Admin\OrderController@cetak_pdf');

    Route::get('/pembayaran', 'Admin\OrderController@pembayaran')->name('pembayaran');
    Route::get('/pengemasan', 'Admin\OrderController@pengemasan')->name('pengemasan');
    Route::get('/pengiriman', 'Admin\OrderController@pengiriman')->name('pengiriman');
    Route::get('/selesai', 'Admin\OrderController@selesai')->name('selesai');
    Route::get('/order_detail/{id}',  'Admin\OrderController@detail')->name('order_detail');

    // end

    // stok
    Route::get('/stok_barang', 'Admin\StokController@index')->name('stok_barang');
    Route::get('/edit_stok/{id}', 'Admin\StokController@edit')->name('edit_stok');
    Route::post('/stok/update', 'Admin\StokController@update');
    // end

    //laporan
    Route::get('/laporan_keuangan', 'Admin\LaporanController@index')->name('laporan_keuangan');
    //endlaporan

    Route::get('/pesanan', 'Admin\OrderController@index')->name('pesanan');
});

Route::group(['middleware' => ['role:user']], function () {

    Route::resource('/pengguna', 'User\UserController');
    Route::resource('wishlist', 'User\WishlistController');

    Route::get('/wishlist',  'User\WishlistController@index')->name('wishlist');

    // cart
    Route::resource('cart', 'User\CartController');
    Route::post('/cartstore', 'User\CartController@store')->name('cart.store');
    Route::delete('cart/{id}', 'User\CartController@hapus')->name('cart.hapus');
    // Route::get('checkout', 'User\CartController@checkout')->name('checkout');
    Route::post('/wishstore', 'User\WishlistController@store')->name('wishlist.store');
    Route::post('/transaksistore', 'TransaksiController@store')->name('transaksi.store');
    Route::post('delete-cart-item', 'User\CartController@deletefromcart');



    Route::patch('kosongkan/{id}', 'User\CartController@kosongkan');
    Route::delete('hapus_ongkir/{id}', 'User\CartController@hapus_ongkir')->name('hapus_ongkir');
    // cart detail
    Route::resource('cartdetail', 'User\CartDetailController');

    // Route::delete('hapusalamat/{id}', 'AlamatPengirimanController@destroy')->name('hapusalamat');
    Route::resource('checkout', 'User\CheckoutController');

    // Route::get('pesan/{id}', 'User\CartController@index');
    // Route::post('pesan/{id}', 'User\CartController@pesan');
    // Route::post('checkoutdestroy', 'User\CheckoutController@destroy')->name('checkout.destroy');
    // Route::delete('check-out/{id}', 'User\CartController@delete');

    // Route::get('konfirmasi-check-out', 'PesanController@konfirmasi');

});

// Route::get('/produk', 'User\ProdukController@produk')->name('produk');
// Route::get('/produk_tshirt', 'User\ProdukController@tshirt')->name('produk_tshirt');
// Route::get('/produk_sweater', 'User\ProdukController@sweater')->name('produk_sweater');
Route::get('/produk_search', 'User\ProdukController@search')->name('produk_search');
Route::get('/produk_detail/{id}', 'User\ProdukController@detail')->name('produk_detail');


Route::livewire('/coba', 'coba')->name('coba');
Route::livewire('/', 'house')->name('house');
Route::livewire('/products', 'product-index')->name('products');
Route::livewire('/products/liga/{ligaId}', 'product-liga')->name('products.liga');
Route::livewire('/products/{id}', 'product-detail')->name('products.detail');
Route::livewire('/transaksi/{id}', 'transaksi-detail')->name('transaksi.detail');
Route::livewire('/keranjang', 'keranjang')->name('keranjang');
//Route::livewire('/checkout', 'checkout')->name('checkout');
Route::livewire('/transaksi', 'transaksi')->name('transaksi');
Route::livewire('/pay/{id}', 'pay')->name('pay');
Route::livewire('/ongkir/{id}', 'ongkir')->name('ongkir');
Route::livewire('/product-sweater', 'product-sweater')->name('product-sweater');
Route::livewire('/product-tshirt', 'product-tshirt')->name('product-tshirt');
Route::livewire('/product-all', 'product-all')->name('product-all');

Route::livewire('/wish', 'wish')->name('wish');
Route::livewire('/cucul', 'cucul')->name('cucul');
Route::livewire('/about', 'about')->name('about');
Route::livewire('/review', 'review')->name('review');
Route::post('/add_process', 'User\UserController@add_process');
Route::get('/cities/{province_id}', 'AlamatPengirimanController@getCities');

Route::post('/ongkir_store', 'HomepageController@store')->name('ongkir.store');

Route::get('/data_diri', 'HomepageController@data')->name('data_diri');

// Route::get('getCourse/{id}', function ($id) {
//     $course = AlamatPengiriman::where('category_id', $id)->get();
//     return response()->json($course);
// });

Route::get('/transaksi/edit/{id}', 'TransaksiController@edit')->name('edit');
Route::post('/transaksi/edit_process', 'TransaksiController@edit_process')->name('edit_process');
Route::delete('transaksi/{id}', 'TransaksiController@destroy')->name('transaksi.destroy');

// cobaaa
Route::get('cobaan', 'CobaController@index');
Route::get('changeStatus', 'CobaController@changeStatus');


Route::get('changeStat', 'User\CartController@changeStat');
Route::get('changeStatusKirim', 'TransaksiController@changeStatusKirim');

Route::get('alamatpengiriman/ajax/{id}',  'AlamatPengirimanController@alamatpengirimanAjax')->name('alamatpengiriman.ajax');
Route::resource('alamatpengiriman', 'AlamatPengirimanController');
Route::get('kosongkan/{id}', 'User\CartController@kosongkan');


Route::get('checkout', 'User\CartController@checkout')->name('checkout');


Route::get('karepmu', 'user\CartController@karepmu');
Route::post('updatecart', 'User\CartController@updatecart')->name('updatecart');
Route::post('updatetotal', 'User\CartController@updatetotal')->name('updatetotal');
// Route::post('updatetotal', 'User\CartController@updatetotal')->name('updatetotal');

Route::post('/proses', 'User\UserController@proses')->name('proses');
Route::get('/user_edit/{id}', 'User\UserController@ubah')->name('user_edit');
