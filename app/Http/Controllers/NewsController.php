<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use DOMDocument;

class NewsController extends Controller
{
    public function index(){
            // mengambil data dari table pegawai
        $news = DB::table('news')->paginate(10);

            // mengirim data pegawai ke view index
        // return view('full-page-news',['news' => $news]);
        return view('full-page-news', [
            'news' => $news,
            // 'fileSizeInKB' => $fileSizeInKB,
            // 'fileSizeInMB' => $fileSizeInMB,
            // 'loggedInUserName' => $loggedInUserName,
        ]);
    }

    public function getNews()
    {

        $news = News::all()->sortByDesc('id');

        $data = [
            'news' => $news,
            'active_sidebar' => [2, 0]
        ];

        return view('news', $data);
    }

    public function getnewspage()
    {
        // if ($request->has('search')) {
        //     $guestNews = News::where('judul', 'LIKE', '%' . $request->search . '%')->get();
        // } else {
        //     $guestNews = News::all()->sortByDesc('id');
        // }

        // $data = [
        //     'guestNews' => $guestNews  // Perbaikan nama variabel disini
        // ];
        $news = News::all()->sortByDesc('id');

        $data = [
            'news' => $news
        ];

        // return view('news', $data);

        return view('full-page-news', $data);
    }

    public function carinews(Request $request){
        $carinews = $request->carinews;

        $news =  DB::table('news')
        ->where('judul', 'like', "%" . $carinews . "%")
        ->paginate();

        return view('full-page-news',['news' => $news]);
    }


    public function guestNews()
    {
        $news = News::all()->sortByDesc('id'); // Mengambil semua berita dari model News

        return view('dashboard', compact('news'));
    }

    public function store(Request $request)
    {
        $description = $request->description;

        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/src/newsimg/" . time() . $key . 'png';
            file_put_contents(public_path() . $image_name, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $description = $dom->saveHTML();

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('bgimage')) {
            // Mendapatkan nama file asli
            $gambarnews = $request->file('bgimage')->getClientOriginalName();

            // Pindahkan file gambar ke direktori yang ditentukan
            $request->file('bgimage')->move(public_path('src/gambarnews'), $gambarnews);

            // Simpan data pengumuman ke dalam database
            News::create([
                'title' => $request->title,
                'description' => $request->description,
                'bgimage' => $gambarnews,
            ]);

            return redirect('news')->with('toastData', ['success' => true, 'text' => 'Succesfully to add news']);
        }
    }


    public function getDetail($id)
    {

        $newsdetail = News::find($id);
        // $users = auth()->user()->name;

        // Periksa apakah pengumuman ditemukan
        if (!$newsdetail) {
            // Jika tidak ditemukan, kembalikan respons dengan pesan kesalahan atau redirect ke halaman lain
            return redirect()->route('news')->with('error', 'Pengumuman tidak ditemukan.');
        }

        // Mendapatkan ukuran file
        $filePath = public_path('src/gambarnews') . '/' . $newsdetail->gambar;

        $fileSize = filesize($filePath); // Ukuran file dalam byte
        $fileSizeInKB = $fileSize / 1024; // Konversi ke kilobyte
        $fileSizeInMB = $fileSizeInKB / 1024; // Konversi ke megabyte

        // Membatasi jumlah desimal menjadi 2
        $fileSizeInKB = number_format($fileSizeInKB, 2);
        $fileSizeInMB = number_format($fileSizeInMB, 2);

        $loggedInUserName = auth()->user()->name;

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('news-detail', [
            'newsDetail' =>  $newsdetail,
            'fileSizeInKB' => $fileSizeInKB,
            'fileSizeInMB' => $fileSizeInMB,
            'loggedInUserName' => $loggedInUserName,
        ]);
    }


    public function getDetailnews($id)
    {
        $newsdetail = News::find($id);

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('news-layout-user', [
            'newsdetail' =>  $newsdetail
        ]);
    }

    public function getDetaillayoutuser($id)
    {

        $newsdetail = News::find($id);

        if (!$newsdetail) {
            return redirect()->route('news')->with('error', 'Pengumuman tidak ditemukan.');
        }

        // Mendapatkan ukuran file
        $filePath = public_path('src/gambarnews') . '/' . $newsdetail->gambar;

        $fileSize = filesize($filePath); // Ukuran file dalam byte
        $fileSizeInKB = $fileSize / 1024; // Konversi ke kilobyte
        $fileSizeInMB = $fileSizeInKB / 1024; // Konversi ke megabyte

        // Membatasi jumlah desimal menjadi 2
        $fileSizeInKB = number_format($fileSizeInKB, 2);
        $fileSizeInMB = number_format($fileSizeInMB, 2);

        $loggedInUserName = auth()->user() ? auth()->user()->name : '';


        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('news-layout-user', [
            'newsDetail' =>  $newsdetail,
            'fileSizeInKB' => $fileSizeInKB,
            'fileSizeInMB' => $fileSizeInMB,
            'loggedInUserName' => $loggedInUserName,
        ]);
    }

    public function updatenews(Request $request, $id)
    {
        // Temukan data news berdasarkan ID
        $news = News::find($id);

        // Jika data tidak ditemukan, kembalikan response dengan status 404 (Not Found)
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        // Mengambil deskripsi dari request
        $description = $request->description;

        // Membuat objek DOMDocument untuk memanipulasi HTML
        $dom = new DOMDocument();
        $dom->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Mengambil semua elemen gambar dari deskripsi
        $images = $dom->getElementsByTagName('img');

        // Melakukan iterasi untuk setiap gambar
        foreach ($images as $key => $img) {
            // Check if the image is a new one
            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/src/newsimg/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        // Menyimpan kembali deskripsi yang telah diubah
        $description = $dom->saveHTML();

        // Jika ada file bgimage yang diunggah
        if ($request->hasFile('bgimage')) {
            // Mendapatkan nama file asli
            $gambarnews = $request->file('bgimage')->getClientOriginalName();

            // Pindahkan file bgimage ke direktori yang ditentukan
            $request->file('bgimage')->move(public_path('src/gambarnews'), $gambarnews);

            // Hapus gambar lama jika ada
            if ($news->bgimage) {
                $imagePath = public_path('src/gambarnews/' . $news->bgimage);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Simpan nama file bgimage baru
            $news->bgimage = $gambarnews;
        }

        // Update data news
        $news->title = $request->title;
        $news->description = $description;
        $news->save();

        // Redirect ke halaman news dengan pesan sukses
        return redirect('news')->with('toastData', ['success' => true, 'text' => 'Successfully updated news']);
    }

    public function deletenews($id)
    {
        $news = News::find($id);

        $dom = new DOMDocument();
        $dom->loadHTML($news->description, 9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $path = $img->getAttribute('src');

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $bgimageDel = public_path('src/gambarnews/') . $news->bgimage;

        if (File::exists($bgimageDel)) {
            File::delete($bgimageDel);
        }

        $news->delete();

        return redirect('news')->with('toastData', ['success' => true, 'text' => 'Succesfully to delete news']);
    }
}
