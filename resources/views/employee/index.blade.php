<x-layout>
    <x-slot name="content">
        <div class="container">
            <div class="text-center">
                <h4>Employee List</h4>
            </div>
            @if (session('success'))
            <div class="alert alert-success" id="alert" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Employee List</h5>
                                <a href="{{ route('employee.create') }}" class="btn btn-outline-primary">Add Employee</a>
                            </div>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Hobby</th>
                                        <th>Photo</th>
                                        <th>Created date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee as $index => $emp) <!-- Note: corrected 'emp' from 'employee' -->
                                    <tr>
                                        <td>{{ $index + 1 }}</td> <!-- Displays the row number -->
                                        <td>{{ $emp->first_name }}</td>
                                        <td>{{ $emp->last_name }}</td>
                                        <td>{{ $emp->email }}</td>
                                        <td>{{ $emp->country_code . $emp->mobile_number }}</td>
                                        <td>{{ $emp->address }}</td>
                                        <td>{{ ucfirst($emp->gender) }}</td> <!-- Capitalize gender -->
                                        <td>
                                            {{ $emp->hobbies }}
                                        </td>
                                        <td>
                                            @if($emp->photo)
                                            <img src="{{ asset('/' . $emp->photo) }}" alt="Employee Photo" width="50">

                                            @else
                                            No Photo
                                            @endif
                                        </td>
                                        <td>{{ $emp->created_at->format('Y-m-d') }}</td> <!-- Format the date -->
                                        <td>
                                            <a href="{{ route('employee.edit', $emp->id) }}" class="edit"><i class="far fa-edit"></i></a> &nbsp; / &nbsp;
                                            <a href="{{ route('employee.delete', $emp->id) }}" style="color:red;" onclick="return confirm('Are You Sure for Delete?')"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($employee->isEmpty())
                                    <tr>
                                        <td colspan="11" class="text-center">No records available.</td>
                                    </tr>
                                    @else
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>