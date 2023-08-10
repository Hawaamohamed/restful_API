@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
        <a href="{{ route('user.create') }}" class='btn btn-success pull-right'>Create user</a>
         
        <h1>All users</h1>
        @if($users->count() > 0)
          <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td> 
                    <th>Date</th>
                    <td>Actions</td>
                <tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($users as $user) 
                   
                    <tr><td>{{ $i++ }} </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                           
                           {{-- @if ($user->user_id == Auth::id())  --}}
                            <a href="{{ route('user.destroy', $user->id) }}" class='btn btn-danger'>Delete</a> 
                            {{-- @endif --}}
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
          </table>
        @else
           <div class="alert alert-info">No users Exist Yet</div>
        @endif
   
        
     </div>
    </div>
   </div>
   
   
@endsection