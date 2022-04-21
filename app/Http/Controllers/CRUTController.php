<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HouseBukhgateria;

use App\Models\User;
use PDO;

class CRUTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $auth= auth()->user()->id;
        $user=User::all()->find($auth);
        $lists= $user->Hous->sortBy('date');
        $lists1= $user->Hous->sortBy('date')->first();
        $li='';
        foreach ($lists as  $value)
        {
          if($lists1->id==$value->id)
          {
            $seve =HouseBukhgateria::find($value->id);
            $seve->user_id=auth()->id();
            $seve->type=$value->type;
            $seve->category=$value->category;
            $seve->sum=$value->sum;
            $seve->date=$value->date;
            $seve->total=$value->sum;
            $seve->comment=$value->comment;
            $seve->save();
            $li=$value;
          }
          elseif($lists1->id!=$value->id)
          {
            $seve =HouseBukhgateria::find($value->id);
            $seve->user_id=auth()->id();
            $seve->type=$value->type;
            $seve->category=$value->category;
            $seve->sum=$value->sum;
            $seve->total=$li->total+$value->sum;
            $seve->date=$value->date;
            $seve->comment=$value->comment;
            $li=$value;
            $seve->save();
          }
        }

        $lists= $user->Hous->sortBy('date');
         return view('home',compact(['lists']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $auth= auth()->user()->id;
      $user=User::all()->find($auth);
      $lists= $user->Category;
       return view('create',compact(['lists']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $s= HouseBukhgateria::find($id);

          if($s!=null)
          {
            $s=$s->user_id;
            $s1=auth()->id();
            if($s==$s1)
            {
                $auth= auth()->user()->id;
                $user=User::all()->find($auth);
                $lists= $user->Category;
              $s2= HouseBukhgateria::find($id);
              return view('edit',compact(['s2']),compact(['lists']));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedDate =$request->validate([
            'date'=>'required|date',
            'type'=>'required',
            'category'=>'required',
            'sum'=>'required',
        ]);

        $s5= HouseBukhgateria::find($id);

        if($s5!=null)
        {
          $s5=$s5->user_id;
          $s6=auth()->id();
          $s=0;
          if($s5==$s6)
          {
            $seve =HouseBukhgateria::find($id);
            $seve->user_id=auth()->id();
            $seve->type=request('type');
            if(request('type')=="Приход")
            {
                $s=request('sum');
            }
            else if(request('type')=="Расход")
            {
                $s-=request('sum');
            }
            $seve->category=request('category');
            $seve->sum=$s;
            $seve->date=request('date');
            $seve->comment=request('comment');
            $seve->save();
            return  redirect('/home');
          }
          else{
              abort(404);
          }
        }
        else
        {
         $auth=auth()->id();
         if($id==$auth){
           $list=new HouseBukhgateria();
           $auth= auth()->user()->id;
           $user=User::all()->find($auth);
           $lists= $user->Hous->sortByDesc('date')->where('date', '<=', $request->date)->first();
        if($list->type=request('type')==="Приход")
        {
            $list->sum=request('sum');
        }
        else if($list->type=request('type')=="Расход")
        {
            $list->sum=request('sum')*(-1);
        }

        $s=0;
        if( $lists!=null){
        $s= $lists->total;
        }
        $s1=$list->total=request('sum');


        if($list->type=request('type')==="Приход")
        {   if($s!=null){
             $s4=$s;
             $list->total=$s4+$s1;
            }
            else{
                $s4=0;
                $list->total=$s4+$s1;
            }
        }
        else if($list->type=request('type')=="Расход")
        {   if($s!=null){
            $s4=$s;
            $list->total=(-$s1)+$s4;
           }
           else{
               $s4=0;
                $list->total=$s4-$s1;
           }
        }
        $list->user_id=auth()->id();
        $list->type=request('type');
        $list->category=request('category');
        $list->date=request('date');
        $list->comment=request('comment');
        $list->save();
        return  redirect('/home');
         }else{
             abort(404);
         }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $s= HouseBukhgateria::find($id);

        if($s!=null)
        {
          $s=$s->user_id;
          $s1=auth()->id();
          if($s==$s1)
          {
            $s1=HouseBukhgateria::find($id)->delete();
           return redirect()->route('home.index');
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
}
