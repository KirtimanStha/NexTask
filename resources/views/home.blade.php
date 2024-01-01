@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" id="userDetails">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.3/axios.min.js" integrity="sha512-JWQFV6OCC2o2x8x46YrEeFEQtzoNV++r9im8O8stv91YwHNykzIS2TbvAlFdeH0GVlpnyd79W0ZGmffcRi++Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        axios.get('/api/v1/profile/{{ auth()->user()->id }}')
            .then(function (response) {
                if (response.data.status == '200') {
                    $html = '<p><b>Name:</b> '+response.data.data.user.name +' </p>';
                    $html += '<p><b>Email:</b> '+response.data.data.user.email +' </p>';

                    $('#userDetails').html($html);
                } else {
                    console.error(response.data.message);
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
    });
</script>
@endsection
