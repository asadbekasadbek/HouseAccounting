@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"  >
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<div class="title h1"><h1>Дом Бухгатерия</h1></div>
<form action="{{route('home.update',$s2->id)}}" method="POST">

    @csrf
<div class="content">
    <div class="mb-3">
        @method('PUT')


        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <label for="exampleInputEmail1" class="form-label">Дата добавления</label>
        <input type="datetime-local" name="date" value="{{ $s2->date }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Приход / Расход</label>
        <select class="form-select" id="s" onchange='findOption(this)' onchange='findOption(this)'  name="type" aria-label="Default select example">
            <option value="Приход">Приход</option>
            <option value="Расход">Расход</option>
          </select>
      </div>
      <div class="mb-3 ">
      <label for="exampleInputPassword1" class="form-label">Категория /Добавить Категория  </label>
        <a href="/home/category/{{ Auth::user()->id}}"><img src="https://img.icons8.com/ios/30/000000/right--v1.png"/> <img src="https://img.icons8.com/color/30/000000/plus--v1.png"/></a>
        <select class="form-select "  onchange="www()" name="category" aria-label="Default select example">
            <optgroup id="f" disabled label="Приход">
                 @foreach ($lists as $list)
                 @if($list->type=='Приход')
                 <option value="{{ $list->category }}">{{$list->category}}</option>
                 @endif
                 @endforeach
              </optgroup>
              <optgroup id="f1" disabled label="Расход">
                @foreach ($lists as $list)
                 @if($list->type=='Расход')
                 <option value="{{ $list->category }}">{{$list->category}}</option>
                 @endif
                 @endforeach
              </optgroup>
          </select></div>
      <div class="mb-3 ">
        <label for="exampleInputPassword1"  class="form-label">Сумма</label>
        <input type="number" name="sum" value="{{ $s2->sum }}" step="0.1" min="0" class="form-control"  onchange="www()">
      </div>

      <div class="mb-3 ">
        <label for="floatingTextarea">Комментарий</label>
        <textarea class="form-control" name="comment" placeholder="Leave a comment here" >{{ $s2->comment }}</textarea>
      </div>
      <button type="submit" class="btn btn-outline-success">Submit</button>
</div>
</form>
<script>
document.getElementById('f').disabled = false;
         document.getElementById('f1').disabled=true;

    function findOption(select) {
        var card = document.getElementById("s").value;
        if(card=='Приход')
        {
         document.getElementById('f').disabled = false;
         document.getElementById('f1').disabled=true;
       }
       else if(card=='Расход')
       {
          document.getElementById('f1').disabled=false;
          document.getElementById('f').disabled = true;
       }

   }

</script>
@endsection
