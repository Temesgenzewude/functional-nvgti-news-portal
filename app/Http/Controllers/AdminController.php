<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use App\Models\Writer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function uploadImage($image, $dir)
    {

        
        $image_name=uniqid().'_'.$image
        ->getClientOriginalName();
        $image->move($dir, $image_name);
        return $image_name;


    }
    //
    public function home()
    {
        $categories=Category::all();
        $posts=Post::all();
        $events=Event::all();
        $videos=Video::all();
        $users=User::all();
        $writer_requests=Writer::all();
        $advert_requests=Advertiser::all();
        $latest_posts=Post::latest()->take(5)->get();
        $latest_users=User::latest()->take(5)->get();
        $writers=User::where('is_writer', 1)->get();
        $admins=User::where('is_admin', 1)->get();


        $advertisers=User::where('is_advertiser', 1)->get();

        if(auth()->check() && auth()->user()->is_writer) {
            $latest_posts=Post::where('user_id', auth()->user()->id)->latest()->take(5)->get();
            $posts=Post::where('user_id', auth()->user()->id)->latest()->get();
            $videos=Video::where('user_id', auth()->user()->id)->latest()->get();

        }


        return view('admin.home', compact('categories', 'posts', 'events', 'videos', 'users', 'writer_requests', 'advert_requests', 'latest_posts', 'latest_users', 'writers', 'admins', 'advertisers'));
    }


    // Admin USERS CRUD
    public function getUsers(Request $request)
    {
        $page='Users';
        

        if($request->ajax()) {
            $data=User::latest()->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btns='<div class="btn-group"> 

                <a href="/admin/users/update/form/'.$data->id.'" class="btn btn-info btn-sm me-1">
                                            <i class="fas fa-edit"> </i> View/Edit
                                        </a>
                                        <a href="/admin/users/delete/'.$data->id.' " class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                </div>';
                return $btns;
            })

            ->rawColumns(['action'])
            ->make(true);
        }


        return view('admin.users', compact('page'));

    }

    public function updateProfilePhoto(Request $request, $user_id)
    {
        if (!$request->hasFile('image')) {
            toastr()->error("Please Select an Image");
            return back();
        }
        $user=User::find($user_id);
        $image=null;
        if($request->image) {
            $dir='storage/profile/';
            $image=$this->uploadImage($request->image, $dir);
        }
        $user->image=$image;
        $user->save();
        toastr()->success("Profile Photo Updated Successfully");
        return back();
    }

   



    public function updateUserForm($user_id)
    {
        $page='Update User';
        $user=User::find($user_id);
        return view('admin.profile', compact('page', 'user'));
    }

    public function updateUser(Request $request, $user_id)
    {
        $user=User::find($user_id);
        $input=$request->except('password');
       
        $user->fill($input)->save();
        if($request->password) {
            $password=Hash::make($request->password);

            $user->password=$password;

            $user->save();
        }
        toastr()->success("User Info Updated Successfully");
        return back();
    }
    public function deleteUser($user_id)
    {
        $user=User::find($user_id);
        $user->delete();
        toastr()->success("User Deleted Successfully");
        return back();
    }
    public function settingsUpdateForm()
    {

        $settings=Setting::latest()->first();
        $page='Update Settings';

        return view('admin.update-settings', compact('settings', 'page'));
    }

    public function settingsUpdate(Request $request)
    {
        $settings= Setting::latest()->first();
        $logo=null;
        if($settings && $settings->site_logo) {
            $logo=$settings->site_logo;
        }
        if($request->site_logo) {
            $dir='storage/settings/logo/';
            $logo=$this->uploadImage($request->site_logo, $dir);
        }
        if($settings  !=null) {
            

            $input=$request->all();
            $settings->fill($input)->save();

            if($logo !=null) {
                $settings->site_logo=$logo;
            } else {
                $settings->site_logo=$logo;
            }

            $settings->save();
            toastr()->success("Settings Updated Successfully");



        } else {
            Setting::create($request->all());
            if($logo !=null) {
                $setting= Setting::latest()->first();

                $setting->site_logo=$logo;
                $setting->save();
            }

            toastr()->success("Settings Created Successfully");

        }
        

        return back();
    }


    public function createCategoryForm()
    {
        $page='Create Category';
        return view('admin.create-category', compact('page'));
    }

    public function createCategory(Request $request)
    {

        $image=null;

        if($request->image) {
            $dir='storage/categories/';
            $image=$this->uploadImage($request->image, $dir);
        }

        $category=new Category;

        $category->title=$request->title;
        $category->image=$image;
        $category->desc=$request->desc;
        $category->user_id=$request->user_id;

        $category->save();
        toastr()->success("Category Created Successfully");


        return back();
    }


    public function getCategories(Request $request)
    {
        $page='Categories';
        $categories=Category::latest()->get();
        return view('admin.get-categories', compact('categories', 'page'));
    }

    public function updateCategoryForm($cat_id)
    {
        $page='Update Category';
        $category=Category::find($cat_id);
        return view('admin.update-category', compact('page', 'category'));
    }

    public function updateCategory(Request $request, $cat_id)
    {
        $category=Category::find($cat_id);
        $image=$category->image;


        $category->fill($request->all());

        if($request->image) {
           
            $dir='storage/categories/';

            $image =$this->uploadImage($request->image, $dir);
        }

        $category->image=$image;
        $category->save();
        toastr()->success("Category Updated Successfully");


        return back();
    }

    public function deleteCategory($cat_id)
    {
        $category=Category::find($cat_id);

        $category->delete();
        toastr()->success("Category Deleted Successfully");


        return back();
    }



    // POST CRUD
    public function createPostForm()
    {
        $page='Create Post';
        $categories=Category::latest()->get();
        return view('admin.create-post', compact('page', 'categories'));
    }
   
    public function createPost(Request $request)
    {
        $post=new Post;
        $post->title=$request->title;
        $post->desc=$request->desc;
        $post->short_desc=$request->short_desc;
        $post->user_id=$request->user_id;
        $post->is_special=$request->is_special;
        $post->is_breaking=$request->is_breaking;
        $post->category_id=$request->category_id;

        if ($request->image) {
            $dir='storage/posts/';
            $image=$this->uploadImage($request->image, $dir);
            $post->image=$image;
        }

        $post->save();
        toastr()->success("Post Created Successfully");

        return back();
    }

    public function getPosts(Request $request)
    {
        $page='Posts';
        $posts=Post::latest()->get();

        if($request->ajax()) {
            $data=Post::latest()->get();
            if(auth()->check() && auth()->user()->is_writer) {
                $data=Post::where('user_id', auth()->user()->id)->latest()->get();
            } elseif(auth()->check() && auth()->user()->is_admin) {
                $data=Post::latest()->get();

            }

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btns='<div class="btn-group"> 

                <a href="/admin/posts/update/'.$data->id.'" class="btn btn-info btn-sm me-1">
                                            <i class="fas fa-edit"> </i> View/Edit
                                        </a>
                                        <a href="/admin/posts/delete/'.$data->id.'" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                </div>';
                return $btns;
            })

            ->rawColumns(['action'])
            ->make(true);
        }


        return view('admin.get-posts', compact('page'));
    }

    public function updatePostForm($post_id)
    {
        $page='Update Post';
        $post=Post::find($post_id);
        $categories=Category::latest()->get();
        return view('admin.update-post', compact('page', 'post', 'categories'));
    }

    public function updatePost(Request $request, $post_id)
    {
        $post=Post::find($post_id);
        $image=$post->image;

        $post->fill($request->all());

        if($request->image) {
            $dir='storage/posts/';
            $image=$this->uploadImage($request->image, $dir);
        }

        $post->image=$image;
        $post->save();
        toastr()->success("Post Updated Successfully");


        return back();
    }

    public function deletePost($post_id)
    {
        $post=Post::find($post_id);

        $post->delete();
        toastr()->success("Post Deleted Successfully");


        return back();
    }





    // EVENT CRUD
    public function createEventForm()
    {
        $page='Create Event';
       
        return view('admin.create-event', compact('page'));
    }
   
    public function createEvent(Request $request)
    {
        $event=new Event;
        $event->title=$request->title;
        $event->desc=$request->desc;
        $event->date=$request->date;
       


        $event->save();
        toastr()->success("Event Created Successfully");
        return back();
    }

    public function getEvents(Request $request)
    {
        $page='Events';
        $events=Event::latest()->get();

        return view('admin.events', compact('page', 'events'));
    }

    public function updateEventForm($event_id)
    {
        $page='Update Event';
        $event=Event::find($event_id);
       
        return view('admin.update-event', compact('page', 'event'));
    }

    public function updateEvent(Request $request, $event_id)
    {
        $event=Event::find($event_id);
      

        $event->fill($request->all());

       
        $event->save();
        toastr()->success("Event Updated Successfully");

        return back();
    }

    public function deleteEvent($event_id)
    {
        $event=Event::find($event_id);

        $event->delete();
        toastr()->success("Event Deleted Successfully");

        return back();
    }


    public function writerRequests()
    {

        $page="Writer Requests";
        $writer_requests=Writer::latest()->get();
        return view('admin.writer-requests', compact('writer_requests', 'page'));

    }
    public function advertRequests()
    {
        $page='Advertiser Requests';
        $advert_requests=Advertiser::latest()->get();

        return view('admin.advert-requests', compact('advert_requests', 'page'));
        
    }

    public function deleteWriterRequest($writer_request_id)
    {
        $writer_request=Writer::find($writer_request_id);
        $user=$writer_request->user;
        $user->is_writer=0;
        $user->is_advertiser=0;
        $user->save();

        $writer_request->delete();
        toastr()->success('Writer request deleted successfully');

        return back();

    }
    public function deleteAdvertRequest($advert_request_id)
    {
        $advert_request=Advertiser::find($advert_request_id);
        $user=$advert_request->user;
        $user->is_writer=0;
        $user->is_advertiser=0;
        $user->save();

        $advert_request->delete();
        toastr()->success('Advertiser request deleted successfully');

        return back();


    }

    public function approveWriterRequest($writer_user_id)
    {
        $user=User::find($writer_user_id);
        $user->is_writer=1;
        $user->save();

        toastr()->success('User role changed to writer successfully');

        return back();

    }

    
    public function approveAdvertRequest($advert_user_id)
    {

        $user=User::find($advert_user_id);
        $user->is_advertiser=1;
        $user->save();

        toastr()->success('User role changed to advertiser successfully');

        return back();

    }
    public function banWriter($writer_user_id)
    {
        $user=User::find($writer_user_id);
        $user->is_writer=0;
        $user->save();

        toastr()->success('User banned from accessing writer admin panel successfully');


        return back();

    }

    
    public function banAdvertiser($advert_user_id)
    {

        $user=User::find($advert_user_id);
        $user->is_advertiser=0;
        $user->save();

        toastr()->success('User banned from accessing advertiser admin panel successfully');

        return back();

    }



    // VIDEO CRUD
    public function createVideoForm()
    {
        $page='Create Video';
        $categories=Category::latest()->get();
       
        return view('admin.create-video', compact('page', 'categories'));
    }
   
    public function createVideo(Request $request)
    {

        $image=null;
       

        if($request->image) {
            $dir='storage/videos/';
            $image=$this->uploadImage($request->image, $dir);
        }

        $video=new Video;
        $video->title=$request->title;
        $video->url=$request->url;
        $video->image=$image;
        $video->user_id=$request->user_id;
        $video->category_id=$request->category_id;

        $video->save();
        toastr()->success("Video Created Successfully");
        return back();
    }

    public function getVideos(Request $request)
    {
        $page='Videos';
        if(auth()->check() && auth()->user()->is_admin) {
            $videos=Video::latest()->get();

        } else if(auth()->check() && auth()->user()->is_writer) {
            $videos=Video::where('user_id', auth()->user()->id)->latest()->get();
        }
        
        return view('admin.videos', compact('page', 'videos'));
    }

    public function updateVideoForm($video_id)
    {
        $categories=Category::latest()->get();

        $page='Update Video';
        $video=Video::find($video_id);
      

       
        return view('admin.update-video', compact('page', 'video', 'categories'));
    }

    public function updateVideo(Request $request, $video_id)
    {
        $video=Video::find($video_id);

        $image=$video->image;
       

        $video->fill($request->all());

        if ($request->image !=null) {
            $dir='storage/videos/';
            $image=$this->uploadImage($request->image, $dir);
        }


        $video->image=$image;
        $video->save();
        toastr()->success("Video Updated Successfully");

        return back();
    }

    public function deleteVideo($video_id)
    {
        $video=Video::find($video_id);

        $video->delete();
        toastr()->success("Video Deleted Successfully");

        return back();
    }

}
