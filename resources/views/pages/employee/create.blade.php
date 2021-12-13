@extends('layouts.backend')

@section('title')
   Employee Add
@endsection

@section('content')
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                <div class="card">
                    @include('layouts.partials.message')
                    <div class="card-header">
                        <h3>Add Employee Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('employee.index') }}" class=" btn btn-warning ml-2"><i class="fas fa-long-arrow-alt-right "> Back Employee List</i></a>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                              <div class="col-md-6">
                                <label for="name">Employee Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                              </div>
                              <div class="col-md-6">
                                <label for="name">Employee Email</label>
                                <input type="text" name="email" class="form-control" id="email">
                              </div>
                              <div class="col-md-6">
                                <label for="name">Employee Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone">
                              </div>
                              <div class="col-md-6">
                                <label for="name">Employee Status</label>
                               <select name="status" id="" class="form-control">
                                     <option value="1">Active</option>
                                     <option value="0">InActive</option>
                               </select>
                              </div>
                              <div class="col-md-6">
                                <label for="name">Employee Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                              </div>
                              <br>
                              <div class="col-md-3" style="margin-top: 28px">
                                <button class="btn btn-primary" type="submit">Submit</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
         </div>
     </div>
@endsection
