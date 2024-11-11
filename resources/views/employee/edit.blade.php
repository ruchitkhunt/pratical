<x-layout>
    <x-slot name="content">
        <div class="container">
            <h4 class="text-center">Edit Employee</h4>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Edit Employee</h5>
                                <a href="{{ route('employee.index') }}" class="btn btn-outline-primary">Employee List</a>
                            </div>
                            <form id="employeeForm" action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $employee->first_name) }}">
                                            @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group pt-4">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email', $employee->email) }}">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group pt-4">
                                            <label>Gender</label><br>
                                            <input type="radio" id="male" name="gender" value="male" {{ old('gender', $employee->gender) == 'male' ? 'checked' : '' }}>
                                            <label for="male">Male</label>&nbsp;&nbsp;

                                            <input type="radio" id="female" name="gender" value="female" {{ old('gender', $employee->gender) == 'female' ? 'checked' : '' }}>
                                            <label for="female">Female</label>&nbsp;&nbsp;

                                            <input type="radio" id="other" name="gender" value="other" {{ old('gender', $employee->gender) == 'other' ? 'checked' : '' }}>
                                            <label for="other">Other</label>

                                            @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group pt-4">
                                            <label for="photo">Photo</label>
                                            <input type="file" id="photo" name="photo" class="form-control">
                                            @if($employee->photo)
                                            <div class="mt-2">
                                                <img src="{{ asset('/' . $employee->photo) }}" alt="Employee Photo" width="100">
                                                <br><small>Current Photo</small>
                                            </div>
                                            @endif
                                            @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $employee->last_name) }}">
                                            @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="row pt-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country_code">Country Code</label>
                                                    <select id="country_code" name="country_code" class="form-select">
                                                        <option value="+1" {{ old('country_code', $employee->country_code) == '+1' ? 'selected' : '' }}>+1 (USA)</option>
                                                        <option value="+44" {{ old('country_code', $employee->country_code) == '+44' ? 'selected' : '' }}>+44 (UK)</option>
                                                        <option value="+91" {{ old('country_code', $employee->country_code) == '+91' ? 'selected' : '' }}>+91 (India)</option>
                                                        <option value="+61" {{ old('country_code', $employee->country_code) == '+61' ? 'selected' : '' }}>+61 (Australia)</option>
                                                        <option value="+81" {{ old('country_code', $employee->country_code) == '+81' ? 'selected' : '' }}>+81 (Japan)</option>
                                                    </select>
                                                    @error('country_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="mobile_number">Mobile Number</label>
                                                    <input type="text" id="mobile_number" name="mobile_number" class="form-control" value="{{ old('mobile_number', $employee->mobile_number) }}">
                                                    @error('mobile_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group pt-4">
                                            <label>Hobbies</label><br>
                                            <input type="checkbox" id="hobby_reading" name="hobbies[]" value="Reading" {{ in_array('Reading', old('hobbies', explode(',', $employee->hobbies))) ? 'checked' : '' }}>
                                            <label for="hobby_reading">Reading</label>&nbsp;&nbsp;

                                            <input type="checkbox" id="hobby_traveling" name="hobbies[]" value="Traveling" {{ in_array('Traveling', old('hobbies', explode(',', $employee->hobbies))) ? 'checked' : '' }}>
                                            <label for="hobby_traveling">Traveling</label>&nbsp;&nbsp;

                                            <input type="checkbox" id="hobby_cooking" name="hobbies[]" value="Cooking" {{ in_array('Cooking', old('hobbies', explode(',', $employee->hobbies))) ? 'checked' : '' }}>
                                            <label for="hobby_cooking">Cooking</label>

                                            @error('hobbies')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address Field -->
                                    <div class="col-md-12 pt-4">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea id="address" name="address" class="form-control" rows="4">{{ old('address', $employee->address) }}</textarea>
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-layout>
<script>
    $(document).ready(function() {
        $('#employeeForm').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                gender: {
                    required: true
                },
                mobile_number: {
                    required: true,
                    digits: true,
                    minlength: 10
                },

                hobbies: {
                    required: true,
                    minlength: 1
                },

            },
            messages: {
                first_name: {
                    required: "Please enter the first name",
                    minlength: "First name must be at least 3 characters"
                },
                last_name: {
                    required: "Please enter the last name",
                    minlength: "Last name must be at least 3 characters"
                },
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email address"
                },
                gender: {
                    required: "Please select gender"
                },
                mobile_number: {
                    required: "Please enter a mobile number",
                    digits: "Please enter a valid mobile number",
                    minlength: "Mobile number must be at least 10 digits"
                },

                hobbies: {
                    required: "Please select at least one hobby"
                },

            },
            errorElement: "span",
            errorClass: "text-danger",
            highlight: function(element) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element) {
                $(element).removeClass("is-invalid");
            }
        });
    });
</script>