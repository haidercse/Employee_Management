@extends('layouts.backend')

@section('title')
   Employee Update
@endsection

@section('content')
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                <div class="card">
                    @include('layouts.partials.message')
                    <div class="card-header">
                        <h3>Update Employee Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('employee.index') }}" class=" btn btn-warning"><i class="fas fa-long-arrow-alt-right"> Back Employee List</i></a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employee.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                              <div class="col-md-6">
                                <label for="name">Employee Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $employee->name }}">
                              </div>
                              <div class="col-md-6">
                                <label for="email">Employee Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="{{ $employee->email }}">
                              </div>
                              <div class="col-md-6">
                                <label for="phone">Employee Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ $employee->phone }}">
                              </div>
                              <div class="col-md-6">
                                <label for="name">Employee Status</label>
                               <select name="status" id="" class="form-control">
                                     <option value="1" {{ $employee->status == 1 ? 'selected': '' }}>Active</option>
                                     <option value="0" {{ $employee->status == 0 ? 'selected' : '' }}>InActive</option>
                               </select>
                              </div>
                              <div class="col-md-6">
                                <label for="">Old Image</label>
                                <br/>
                                <img src="{{ asset('images/employee/'.$employee->image) }}" alt="{{ $employee->name }}" width="82">
                                <br/>
                                <label for="image">Employee Image</label>
                                <input type="file" name="image" class="form-control" id="image" value="{{ $employee->image }}">
                              </div>
                              <br>

                            </div>
                            <div class="" style="margin-top: 28px">
                                <button class="btn btn-success" type="submit">Update!</button>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
         </div>
     </div>
@endsection
