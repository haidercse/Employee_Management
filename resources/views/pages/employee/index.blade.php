@extends('layouts.backend')

@section('title')
   Employee List
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                   @include('layouts.partials.message')
                    <div class="card-header">
                        <h3>Employee List</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                      <a href="{{ route('employee.create') }}" class="float-right btn btn-info mr-2"><i class="fas fa-plus-circle"> Add Employee</i></a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Employee Email</th>
                                    <th scope="col">Employee Phone</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Employee Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        @if ($employee->status == 1)
                                          <td>
                                            <span class="badge badge-success">Active</span>
                                          </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger">InActive</span>
                                            </td>
                                        @endif

                                        <td>
                                            <img src="{{ asset('images/employee/'.$employee->image) }}" alt="{{ $employee->name }}" width="82">
                                        </td>
                                        <td>
                                            <a href="{{ route('employee.edit',$employee->id) }}"
                                                class="btn btn-success btn-sm"><i class="far fa-edit"> Edit</i></a>

                                            <a href="#delteModal{{ $employee->id }}" data-toggle="modal"
                                                class="btn btn-danger btn-sm"><i class="far fa-trash-alt"> Delete</i></a>


                                            <!--Delete  Modal -->
                                            <div class="modal fade" id="delteModal{{ $employee->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure
                                                                to delete this?</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('employee.destroy', $employee->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Permanent
                                                                    Delete</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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
