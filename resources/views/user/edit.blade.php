@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <form id="profileForm" class="space-y-4">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" value="{{ $user->email }}" readonly disabled class="form-control">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>

        <button type="button" class="btn btn-primary" onclick="updateProfile()" required>
            Update Profile
        </button>
    </form>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function updateProfile() {
        const form = document.getElementById('profileForm');
        const formData = {};

        form.querySelectorAll('input').forEach(function (input) {
            formData[input.name] = input.value;
        });
        axios.patch('/api/v1/profile/{{ $user->id }}/update', formData)
            .then(function (response) {
                console.log('res', response);
                if (response.data.status == '200') {
                    $('[name="password"]').val('');
                    $('[name="confirm_password"]').val('');
                    toastr.success('Profile updated successfully');
                } else {
                    toastr.error('Update error');
                }
            })
            .catch(function (error) {
                toastr.options.positionClass = 'toast-bottom-right';
                if(error.response.status === 422){
                    const keys = Object.keys(error.response.data.errors);
                    console.log(error.response.data.errors);
                    keys.forEach((key) => {
                        error.response.data.errors[key].forEach((e) => {
                            toastr.error(e);
                        })
                    });
                }
            });
    }
</script>
@endsection
