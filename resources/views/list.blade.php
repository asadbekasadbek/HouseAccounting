@extends('layouts.app')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"  >
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="/css/style.css">
@section('content')
<div class="title h1"><h1>Дом Бухгатерия ({{ Auth::user()->name }} )</h1></div>
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Тип</th>
        <th scope="col">Категория</th>
        <th scope="col">Дата</th>
        <th scope="col">Сумма</th>
       <th scope="col">Итого</th>
       <th scope="col">Комментарий</th>
       <th scope="col">Редактировать</th>
       <th scope="col">Разрушать</th>
      </tr>
    </thead>
    <tbody>
         @foreach ($lists as $list)
         <tr>
            <th scope="row">{{ $list->type }}</th>
             <td>{{ $list->category }}</td>
            <td>{{ $list->date}}</td>
            <td id="s1">{{number_format($list->sum , 2, '.', ' ')}}</td>
            <td id="s1">{{  number_format($list->total , 2, '.', ' ')}}</td>
             <td>{{ $list->comment }}</td>
             <td><a href="{{route('home.edit',$list->id)}}">
                <button type="button" class="btn btn-outline-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                  </svg> редактировать</button></a></td>
             <form  method="post" action="{{route('home.destroy',$list->id)}}">
                @csrf
                @method('DELETE')
                <td><button type="submit" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                  </svg> удалять</button></td>
            </form>
           </tr>
           <tr>
        @endforeach
   </table>
   <div class="title">
    <a href="{{route('home.index')}}"><button type="button" class="btn btn-outline-success">Возвращаться Дом Бухгатерия </button></a>
</div>
@endsection


