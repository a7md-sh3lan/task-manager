@extends('layouts.app')

@section('content')

<script src="{{asset('tasks.js')}}"></script>

<style>
    #list1 .form-control {
        border-color: transparent;
    }
    #list1 .form-control:focus {
        border-color: transparent;
        box-shadow: none;
    }
    #list1 .select-input.form-control[readonly]:not([disabled]) {
        background-color: #fbfbfb;
    }
</style>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
          <div class="card-body py-4 px-4 px-md-5">

            <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
              <i class="fas fa-check-square me-1"></i>
              <u>My Tasks</u>
            </p>

            <div class="pb-2">
              <div class="card">
                <div class="card-body">
                    <form action="/tasks" method="post">
                        @csrf
                        <div class="d-flex flex-row align-items-center">
                            <input name="title" type="text" class="form-control form-control-lg" id="exampleFormControlInput1"
                            placeholder="Add new..." required>
                            
                            <div>
                            <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>

            <hr class="my-4">

            
            @foreach ($tasks as $task)
                <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                <li
                    class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                    <div class="form-check">
                    <input class="form-check-input me-0" type="checkbox" value="{{$task->id}}" onchange='handleChange(this);' id=""
                        aria-label="..." {{ $task->completed ? 'checked' : '' }} />
                    </div>
                </li>
                <li
                    class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                    <p class="lead fw-normal mb-0">{{$task->title}}</p>
                </li>
                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                    <div class="d-flex flex-row justify-content-end mb-1">
                    <a href="#" class="text-info update-btn" data-id="{{$task->id}}" full-text="{{$task->title}}" data-mdb-toggle="tooltip" title="Edit todo"><i
                        class="fas fa-pencil-alt me-3"></i></a>
                    <a href="#" class="text-danger delete-btn" data-id="{{$task->id}}" data-mdb-toggle="tooltip" title="Delete todo"><i
                        class="fas fa-trash-alt"></i></a>
                    </div>
                    
                </li>
                </ul>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection