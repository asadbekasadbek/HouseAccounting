@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<div class="title h1"><h1>Дом Бухгатерия</h1></div>
<form action="{{route('home.update',Auth::user()->id)}}" method="POST">

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
        <input type="datetime-local" name="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

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
          </select>
      </div>
      <div class="mb-3 ">
        <label for="exampleInputPassword1"  class="form-label">Сумма</label>
        <input type="number" name="sum" step="0.1"  min="0" class="form-control" id="r5" onchange="www()">
      </div>
      <div class="mb-3 ">
        <label for="floatingTextarea">Комментарий</label>
        <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
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
