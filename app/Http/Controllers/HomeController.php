<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\HouseBukhgateria;
class HomeController extends Controller
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
       return view('home');
    }
    public function category($id){
        if(auth()->id()==$id)
        {
            $s='';
            $auth= auth()->user()->id;
            $user=User::all()->find($auth);
            $lists= $user->Category;
            return view('category',compact(['lists']) ,compact(['s']));
        }else{
            abort(404);
        }
    }
    public function category_post(Request $request,$id){
        $validatedDate =$request->validate([
            'type'=>'required',
            'category'=>'required',
        ]);
        $s="";
        $auth= auth()->user()->id;
        $user=User::all()->find($auth);
        $lists= $user->Category;
        foreach ($lists as $list)
        {
            if($list->category==request('category'))
            {
                $s= "(уже существует такой категория->".$list->category.")";
                return view('category',compact(['lists']),compact(['s']) );
            }
        }
        if(auth()->id()==$id)
        {
            $seve =new Category;
            $seve->user_id=auth()->id();
            $seve->type=request('type');
            $seve->category=request('category');
            $seve->save();
            return  redirect('/home/create');
        }
        else{
            abort(404);
        }
    }
    public function destroy($id){
        $s=Category::find($id);

        if($s!=null)
        {
          $s=$s->user_id;
          $s1=auth()->id();
          if($s==$s1)
          {
            $s1=Category::find($id)->delete();
           return redirect('/home/category/'.$s);
          }
          else{
              abort(404);
          }
        }
        else
        {
          abort(404);
        }
    }
    public function date($id){
        if(auth()->id()==$id)
        {
        return view('data');
        }
        else{
            abort(404);
        }
    }
    public function changes(Request $request,$id){

        $validatedDate =$request->validate([
            'from'=>'required|date',
            'to'=>'required|date',
        ]);
         $s=request('from');
         $s1=request('to');
        if(auth()->id()==$id)
        {
            $user=User::all()->find($id);
            $lists= $user->Hous->sortBy('date')->where('date', '>=', $s)->where('date', '<=', $s1);
            return view('list',compact(['lists']));

        }
        else{
            abort(404);
        }
    }
}
