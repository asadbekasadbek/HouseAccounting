@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"  >
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<div class="title h1"><h1>Добавить категорию</h1></div>



<form action="/home/category/{{ Auth::user()->id}}" method="POST">

    @csrf
<div class="content">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Выберите вид категорию</th>
            <th scope="col">Названия категорий</th>
            <th scope="col">Разрушать</th>
          </tr>
        </thead>
        <tbody>

                @foreach ($lists as $list)
                <tr>

                <th scope="row">{{ $list->type }}</th>
                <td>{{$list->category}}</td>
                    <td>
                        <a href="/home/category/delete/{{ $list->id }}">
                        <button type="button" class="btn btn-outline-danger">Удалять</button> </a>

               </th>
               <tr>
               @endforeach

        </tbody>
    </table>
    <div class="mb-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Выберите вид категорию(Приход / Расход)</label>
        <select class="form-select" name="type" aria-label="Default select example">
            <option value="Приход">Приход</option>
            <option value="Расход">Расход</option>
          </select>
      </div>
      <div class="mb-3 ">
        <label for="exampleInputPassword1" class="form-label">Названия категорий</label>
        <label for="exampleInputPassword1" style="color: red;" class="form-label">{{$s}}</label>

        <input type="text" name="category" class="form-control" id="exampleInputPassword1">
      </div>
      <button type="submit" class="btn btn-outline-success">Submit</button>
</div>
</form>

@endsection
