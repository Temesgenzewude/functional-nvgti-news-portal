<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Post;
use App\Models\Video;
use App\Models\Writer;

use App\Models\Advertiser;
use App\Models\Setting;
use Illuminate\Http\Request;


class FrontEndController extends Controller
{
    //



    public function uploadImage($image, $dir)
    {

        
        $image_name=uniqid().'_'.$image
        ->getClientOriginalName();
        $image->move($dir, $image_name);
        return $image_name;


    }

    public function ckUpload(Request $request)
    {

        if ($request->hasFile('upload')) {
           
            $dir="storage/ckUploads/";
            $filename = $this->uploadImage($request->file('upload'), $dir);
        
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/ckUploads/'.$filename);

            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
          
          
        }
        
    }
    public function home()
    {
        $categories=Category::latest()->get();

        $latest_breaking_post=Post::where('is_breaking', 1)->latest()->first();
        $breaking_posts=Post::where('is_breaking', 1)->latest()->get();
        $latest_posts=Post::latest()->take(3)->get();
        $videos=Video::latest()->get();
        $latest_videos=Video::latest()->take(3)->get();
        return view('welcome', compact('categories', 'latest_breaking_post', 'breaking_posts', 'latest_posts', 'videos', "latest_videos"));
    }

    public function clientGetPost($post_id)
    {
        $post=Post::find($post_id);
        $post->increment('views',1);
        return view('client.post-detail', compact('post'));
    }

    public function clientGetPostsByCategory($category_id)
    {
        $category=Category::find($category_id);
        $latest_posts=$category->posts()->latest()->take(3)->get();
        $all_posts=$category->posts()->paginate(5);
        $trending_posts=$category->posts()->orderBy('views', 'desc')->take(5)->get();
        return view('client.category-posts', compact('all_posts', 'latest_posts', 'category', 'trending_posts'));
    }


    public function writeForUsForm()
    {
        
        return view('client.write-for-us');
    }

    public function writeForUs(Request $request)
    {
        $write_request_exists=Writer::where("user_id", auth()->id())->first();
        if($write_request_exists) {
            toastr()->error('Please wait until the request is approved.', 'You have already send writer request!');

            return back();


        }

        Writer::create($request->all());
        toastr()->success('We will call you for more information.', 'Writer Request has been sent successfully!');

        return back();

    }

    public function contactUsForm()
    {
        return view('client.contact-us');
    }

    public function contactUs()
    {

    }


    public function advertiseForm()
    {
        return view('client.advertise');
    }

    public function advertise(Request $request)
    {
        $advert_request_exists=Advertiser::where("user_id", auth()->id())->first();
        if($advert_request_exists) {
            toastr()->error('Please wait until the request is approved.', 'You have already send advertiser request!');

            return back();


        }

        Advertiser::create($request->all());
        toastr()->success('We will call you for more information.', 'Advertiser Request has been sent successfully!');

        return back();

    }

    public function aboutUsForm()
    {
        $about=Setting::latest()->first()->about;
        return view('client.about-us', compact('about'));
    }

    public function clientGetEvents()
    {
        $events=Event::latest()->paginate(10);
        return view('client.events', compact('events'));
    }

    


}
