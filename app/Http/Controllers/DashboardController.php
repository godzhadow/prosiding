<?php

namespace App\Http\Controllers;

use File;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Paper;
use App\Team;
use Spatie\PdfToImage\Pdf;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // echo phpinfo();
        // echo 'PHP version: ' . phpversion();
        // echo "<pre>";
        // print_r(get_loaded_extensions());
        // echo "<pre/>";
        $paper = paper::all();
        return view('dashboard',['paper'=>$paper]);
    }

    public function add_abstract(Request $request)
    {
        if ($request->file('abstract') != null) {
            $this->validate($request, [
                'title' => 'required',
                'authors' => 'required',
                'year' =>'required',
                'country' => 'required',
                'abstract' => 'required|file|mimes:jpeg,png,pdf,jpg|max:10240',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('abstract');

            $file_name = $file->getClientOriginalName();
            $file_name_image = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);


                // isi dengan nama folder tempat kemana file diupload
            $directory = 'uploads/abstract/';
            $directoryImage = 'uploads/abstract/image/';


            $pdf = new Pdf($file);
            $pdf->setOutputFormat('png')
            ->saveImage($directoryImage . '/' . $file_name_image.'.png');
            $file->move($directory,$file_name);




            $year = now()->year;
            if(strpos(Auth::user()->university , 'mahardhika')) {
                $country = 'indonesia';
            }

            $input = $request->all();
            $tags = explode(",", $request->tags);

            $paper = Paper::create([
                    'title'=>strtoupper($request->title),
                    'team'=>$request->authors,
                    'abstract' => $directory.$file_name,
                    'preview' => $directoryImage.$file_name_image.'.png',
                    'year' => $request->year,
                    'country' => $request->country,
                    ]);

                if (!$paper) {
                    Session::flash('message', 'Create abstract Failed!');
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/dashboard');
                }else{
                    Session::flash('message', 'Abstract created succesfully!');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/dashboard');
                }

        }else{
            Session::flash('message', 'no file uploaded!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/dashboard');
        }

    }

    public function update_abstract(Request $request){

        $paper = paper::where('id',$request->id)->first();
        // $paper->title = $request->title;
        // $paper->users_id = $request->id;
        $paper->start_date = $request->datetime;
        $paper->price = $request->price;
        $paper->link = $request->link;

        // if with phooto profile
        if ($request->file('photo_paper') !== null) {

            $this->validate($request, [
                'photo_paper' => 'required|file|mimes:jpeg,png,jpg|max:10240'
            ]);

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('photo_paper');


            // $file_name = $paper->name.'-'.$file->getClientOriginalName();
            // $file_name = '4THASER00'.$paper->paper_attribute.'.'.$file->getClientOriginalExtension();
            $file_name = time()."_".$file->getClientOriginalName();


            // isi dengan nama folder tempat kemana file diupload
            $directory = 'uploads/image_paper/';
            $file->move($directory,$file_name);

            if ($paper->image != null) {
                File::delete($paper->image);
            }

            $image =  $directory.$file_name;
        } else {
            // $image = $paper->image;
            if ($paper->image != null) {
                File::delete($paper->image);
            }
            $image = NULL;
        }
        $paper->image = $image;
        $paper = $paper->save();

        if (!$paper) {
            Session::flash('message', 'Update paper or conference Failed!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/dashboard/paper');
        }else{
            // alihkan halaman ke halaman paper
            Session::flash('message', 'Update paper or conference success!');
            Session::flash('alert-class', 'alert-success');
            return redirect('/admin/dashboard/paper');
        }
    }
    public function delete_abstract($id) {
        // menghapus data paper berdasarkan id yang dipilih
        $paper = paper::where('id',$id)->delete();

        // alihkan halaman ke halaman paper
        if (!$paper) {
            Session::flash('message', 'Delete paper Failed!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/dashboard');
        }else{
            // alihkan halaman ke halaman paper
            Session::flash('message', 'Delete paper success!');
            Session::flash('alert-class', 'alert-success');
            return redirect('/dashboard');
        }
    }

}
