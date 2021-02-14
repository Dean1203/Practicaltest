{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    

                {{-- </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Fonts -->
<link rel="stylesheet"
    href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- Styles -->
<style>
html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Raleway', sans-serif;
    font-weight: 100;
    height: auto;
    margin: 0;
}
.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}
.position-ref {
    position: relative;
}
.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}
.content {
/*  text-align: center; */
}
.title {
    font-size: 84px;
}
.m-b-md {
    margin-bottom: 30px;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-body {
  margin: 20px 0;
}
</style>
</head>
<body>
    
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ 'Testing'}}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    You are logged in! as {{ strtoupper(Auth::user()->type) }}
  
    <div class="flex-center position-ref full-height">
        <div id="vue-wrapper">
            <div class="content">
                <div class="add_content">
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" 
                        required v-model="newItem.name" placeholder=" Enter some name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="password" name="email" 
                        required v-model="newItem.email" placeholder="Enter your Email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" class="form-control" id="password" name="password"
                        required v-model="newItem.password" placeholder=" Enter your password">
                  </div>

                 <button class="btn btn-primary" @click.prevent="createItem()" id="name" name="name">
                    <span class="glyphicon glyphicon-plus"></span>ADD
                 </button>
                </div>
                <p class="text-center alert alert-danger"
                    v-bind:class="{ hidden: hasError }">Please fill all fields!</p>
                <p class="text-center alert alert-success"
                    v-bind:class="{ hidden: hasDeleted }">Deleted Successfully!</p>
                    <br>
                    <span>Search: </span><input id="myInput" type="text">

                <div class="table table-borderless" id="table">
                    <table class="table table-borderless search_table" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tr v-for="item in items">
                            <td>@{{ item.id }}</td>
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.email }}</td>
                            <td id="show-modal" @click="showModal=true; setVal(item.id, item.name)"  class="btn btn-info" ><span
                            class="glyphicon glyphicon-pencil"></span></td>
                            <td @click.prevent="deleteItem(item)" class="btn btn-danger"><span
                                class="glyphicon glyphicon-trash"></span></td>
                        </tr>
                    </table>
                </div>
                <modal v-if="showModal" @close="showModal=false">
                    <h3 slot="header">Edit Item</h3>
                    <div slot="body">
                        
                        <input type="hidden" disabled class="form-control" id="e_id" name="id"
                                required  :value="this.e_id">
                        Name: <input type="text" class="form-control" id="e_name" name="name"
                                required  :value="this.e_name">
                    </div>
                    <div slot="footer">
                        <button class="btn btn-default" @click="showModal = false">
                        Cancel
                      </button>
                      
                      <button class="btn btn-info" @click="editItem()">
                        Update
                      </button>
                    </div>
                </modal>
            </div>
              {{-- <pagination :data="laravelData" v-model="page" @pagination-change-page="getVueItems">
              </pagination> --}}
        </div>
    </div>
    
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/x-template" id="modal-template">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
              <div class="modal-header">
                <slot name="header">
                 
                </slot>
              </div>
              <div class="modal-body">
                <slot name="body">
                </slot>
              </div>
              <div class="modal-footer">
                <slot name="footer">
                </slot>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </script>
    <script type="text/javascript">
      var user = '{{ Auth::user()->type }}';
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".search_table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
        if(user == 'admin') {
            $('.add_content').css('display', 'none');
        }else if (user == 'member'){
            $('.add_content').css('display', 'none');
        }else{
            $('.deleteaction').css('display', 'block');
            $('.add_content').css('display', 'block');
            $('#table').css('display', 'block');
        }
    </script>
</body>
</html>