@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"  >
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<div class="title h1"><h1>Добавить категорию</h1></div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="/home/category/changes/{{ Auth::user()->id }}" method="POST">
    @csrf
<div class="content">
    <div class="mb-3">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Выберите вид категорию(Приход / Расход)</label>
        <input  type="date"  name="from" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3 ">
        <label for="exampleInputPassword1" class="form-label">Названия категорий</label>
        <input type="date"  class="form-control" name="to" class="form-control" id="exampleInputPassword1">
      </div>
      <button type="submit" class="btn btn-outline-success">Submit</button>
</div>
</form>
@endsection

