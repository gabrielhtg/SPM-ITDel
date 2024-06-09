<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Services\AllServices;
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
        // { Menyimpan deskripsi berita }
        $description = $request->description;

        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');

        $listDescImg = [];

        foreach ($images as $key => $img) {
            // dump($img->getAttribute('src'));
            // sleep(10);
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/src/newsimg/" . time() . $key . '.png';
            file_put_contents(public_path() . $image_name, $data);
            $listDescImg[] = $image_name;

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        // dd($listDescImg);

        $description = $dom->saveHTML();

        // { Menyimpan gambar background berita }
        if ($request->hasFile('bgimage')) {
            
            $gambarnews = 'image_' . microtime() . '.png';

            $request->file('bgimage')->move(public_path('src/gambarnews'), $gambarnews);

            $news = News::create([
                'title' => $request->title,
                'description' => $description,
                'bgimage' => $gambarnews,
                'descimg' => implode(';', $listDescImg),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'keterangan_status' => true,
            ]);

            // { Update keterangan_status based on start_date and end_date } 
            $currentDateTime = now();
            if ($request->start_date <= $currentDateTime && (!$request->end_date || $request->end_date >= $currentDateTime)) {
                $news->keterangan_status = true;
            }

            $news->save();

            AllServices::addLog(sprintf("Menambah Berita \"%s\"", implode(' ', array_slice(str_word_count($request->title, 1), 0, 10))));
            return redirect('news')->with('toastData', ['success' => true, 'text' => 'Berhasil Menambahkan Berita']);
        }
    }

    public function updatenews(Request $request)
    {

        // dd($id);

        $news = News::find($request->id);

        if ($request->hasFile('bgimage')) {
            $gambarnews = $request->file('bgimage')->getClientOriginalName();

            $request->file('bgimage')->move(public_path('src/gambarnews'), $gambarnews);

            if ($news->bgimage) {
                $imagePath = public_path('src/gambarnews/' . $news->bgimage);
                if (file_exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $news->bgimage = $gambarnews;
        }

        $oldDescImage = explode(';', $news->descimg);
        $newDescImage = [];

        // Mengambil deskripsi dari request
        $description = $request->description;

        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            try {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/src/newsimg/" . time() . $key . '.png';
                $newDescImage[] = $image_name;

                file_put_contents(public_path() . $image_name, $data);
    
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            } catch (\ErrorException $e) {
                $newDescImage[] = $img->getAttribute('src');
            }
           
        }

        foreach ($oldDescImage as $e) {
            if (!in_array($e, $newDescImage)) {
                $imagePath = public_path($e);
                if (file_exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        $description = $dom->saveHTML();

        $news->title = $request->title;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;
        $news->description = $description;
        $news->descimg = implode(';', $newDescImage);

        $currentDateTime = now();
        if ($request->start_date <= $currentDateTime && (!$request->end_date || $request->end_date >= $currentDateTime)) {
            $news->keterangan_status = true;
        } else {
            $news->keterangan_status = false;
        }

        $news->save();

        AllServices::addLog(sprintf("Menyunting Berita \"%s\" menjadi \"%s\"", implode(' ', array_slice(str_word_count($news->title, 1), 0, 10)), implode(' ', array_slice(str_word_count($request->title, 1), 0, 10))));
        return redirect('news')->with('toastData', ['success' => true, 'text' => 'Berhasil Mengubah Berita']);
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

                // dd($news->description);

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

        AllServices::addLog(sprintf("Menghapus Berita \"%s\"", implode(' ', array_slice(str_word_count($news->title, 1), 0, 10))));
        return redirect('news')->with('toastData', ['success' => true, 'text' => 'Berhasil Menghapus Berita']);
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

        $loggedInUserName = auth()->user()->name;

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('news-detail', [
            'newsDetail' =>  $newsdetail,
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