<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DOMDocument;

class NewsController extends Controller
{
    public function index()
    {
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

    public function carinews(Request $request)
    {
        $carinews = $request->carinews;

        $news =  DB::table('news')
            ->where('judul', 'like', "%" . $carinews . "%")
            ->paginate();

        return view('full-page-news', ['news' => $news]);
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
            $image_name = "/src/newsimg/" . time() . $key . '.png';
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

            // dd($request->start_date, $request->end_date);

            // Simpan data pengumuman ke dalam database
            $news = News::create([
                'title' => $request->title,
                'description' => $request->description,
                'bgimage' => $gambarnews,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'keterangan_status' => true,
            ]);

            // Update keterangan_status based on start_date and end_date
            $currentDateTime = now();
            if ($request->start_date <= $currentDateTime && (!$request->end_date || $request->end_date >= $currentDateTime)) {
                $news->keterangan_status = true;
            }

            $news->save();

            return redirect('news')->with('toastData', ['success' => true, 'text' => 'Succesfully to add news']);
        }
    }

    public function updatenews(Request $request, $id)
    {
        // Temukan data news berdasarkan ID
        $news = News::find($id);

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
                    File::delete($imagePath);
                }
            }

            // Simpan nama file bgimage baru
            $news->bgimage = $gambarnews;
        }

        // Mengambil deskripsi dari request
        $description = $request->description;

        // Membuat objek DOMDocument untuk memanipulasi HTML
        $dom = new DOMDocument();

        // Periksa jika deskripsi tidak kosong
        if (!empty($description)) {
            $dom->loadHTML($description, 9);

            // Mengambil semua elemen gambar dari deskripsi
            $images = $dom->getElementsByTagName('img');

            // Inisialisasi array untuk menyimpan nama file gambar baru
            $newImageNames = [];

            // Melakukan iterasi untuk setiap gambar
            foreach ($images as $key => $img) {
                // Check if the image is a new one
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/src/newsimg/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);

                    // Menyimpan nama file gambar baru
                    $newImageNames[] = $image_name;

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    // Jika gambar tidak baru, tambahkan nama file gambar ke array
                    $oldImageName = basename($img->getAttribute('src'));
                    $newImageNames[] = "/src/newsimg/" . $oldImageName;
                }
            }

            // Menyimpan kembali deskripsi yang telah diubah
            $description = $dom->saveHTML();

            // Hapus gambar lama yang tidak ada dalam deskripsi yang baru
            $oldImages = glob(public_path('src/newsimg/*'));
            foreach ($oldImages as $oldImage) {
                $oldImageName = basename($oldImage);
                if (!in_array("/src/newsimg/" . $oldImageName, $newImageNames)) {
                    unlink($oldImage);
                }
            }
        }

        // Update data news
        $news->title = $request->title;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;

        // Jika deskripsi tidak kosong, simpan perubahan deskripsi
        if (!empty($description)) {
            $news->description = $description;
        }

        $currentDateTime = now();
        if ($request->start_date <= $currentDateTime && (!$request->end_date || $request->end_date >= $currentDateTime)) {
            $news->keterangan_status = true;
        } else {
            $news->keterangan_status = false;
        }

        $news->save();

        // Redirect ke halaman news dengan pesan sukses
        return redirect('news')->with('toastData', ['success' => true, 'text' => 'Successfully updated news']);
    }

    public function deletenews($id)
    {
        $news = News::find($id);

        // Periksa apakah $news->description tidak kosong
        if (!empty($news->description)) {
            $dom = new DOMDocument();

            // Memeriksa apakah HTML yang dimuat valid atau tidak
            if (@$dom->loadHTML($news->description)) {
                $images = $dom->getElementsByTagName('img');

                foreach ($images as $key => $img) {

                    $src = $img->getAttribute('src');
                    $path = Str::of($src)->after('/');

                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }
        }

        $bgimagePath = public_path('src/gambarnews/') . $news->bgimage;

        if (File::exists($bgimagePath)) {
            File::delete($bgimagePath);
        }

        $news->delete();

        return redirect('news')->with('toastData', ['success' => true, 'text' => 'Succesfully to delete news']);
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
            'active_sidebar' => [2, 0]
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
}
