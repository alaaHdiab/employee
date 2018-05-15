@extends('layouts.app')

@section('content')

<div class="container">
<nav class="navbar navbar-default">
  <div class="container-fluid">
   
    <ul class="nav navbar-nav">
      <li class="active"><a  href="/admin/create">Add Employee</a></li>
      <!-- <li class="active"><a  href="/admin/search/{name}">Search By Name</a></li> -->
      
    </ul>
  </div>
</nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Employee') }}</div>

                <div class="card-body">

                 <form method="get" action="{{ route('search-employee') }}">
  
  
    <label>search by name </label>
    <input type="text" name="searchName">
      <button type="submit" class="btn btn-default">Submit</button>

  </div>
</form> 
                  
               

                  <table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>status</th>
        <th>job</th>
        <th>location</th>
        <th>operations</th>
        
      </tr>
    </thead>
    <tbody>
     @foreach ($emps as $emp )

      <tr>
        <td>{{$emp->first_name}}</td>
        <td>{{$emp->last_name}}</td>
        <td>{{$emp->status}}</td>
         <td>{{$emp->job}}</td>
          <td>{{$emp->location}}</td>
          <td><a class="btn-primary" href="/admin/{{$emp->id}}/edit" style="padding:5px;" >Edit</a><a class="btn-success" style="padding:5px;" href="/admin/{{$emp->id}}/destroy" >Delete</a></td>
        
      </tr>
    @endforeach  
     
    </tbody>
  </table>
                        

                       

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
