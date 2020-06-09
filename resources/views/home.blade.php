@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                You are logged in!
                @can('is-student')
                <table class="table table-bordered text-center mt-5">
                    <thead class="thead-dark">
                        <tr>
                            <th>Hours</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">8:00-8:45</td>
                            <td class="align-middle">Religion</td>
                            <td class="align-middle">History</td>
                            <td class="align-middle">Computer Science</td>
                            <td class="align-middle">English</td>
                            <td class="align-middle">Computer Science</td>
                        </tr>
                        <tr>
                            <td class="align-middle">8:50-9:35</td>
                            <td class="align-middle">Mathematics</td>
                            <td class="align-middle">Chemistry</td>
                            <td class="align-middle">Educational Hour</td>
                            <td class="align-middle">Mathematic</td>
                            <td class="align-middle">Geography</td>
                        </tr>
                        <tr>
                            <td class="align-middle">9:40-10:25</td>
                            <td class="align-middle">Mathematics</td>
                            <td class="align-middle">Polish</td>
                            <td class="align-middle">Physical Education</td>
                            <td class="align-middle">Polish</td>
                            <td class="align-middle">Mathematics</td>
                        </tr>
                        <tr>
                            <td class="align-middle">10:45-11:30</td>
                            <td class="align-middle">Physics</td>
                            <td class="align-middle">Biology</td>
                            <td class="align-middle">Religion</td>
                            <td class="align-middle">History</td>
                            <td class="align-middle">German</td>
                        </tr>
                        <tr>
                            <td class="align-middle">11:35-12:20</td>
                            <td class="align-middle">German</td>
                            <td class="align-middle">English</td>
                            <td class="align-middle">Polish</td>
                            <td class="align-middle">History</td>
                            <td class="align-middle">Computer Science</td>
                        </tr>
                        <tr>
                            <td class="align-middle">12:25-13:10</td>
                            <td class="align-middle"></td>
                            <td class="align-middle">Biology</td>
                            <td class="align-middle">Physical Education</td>
                            <td class="align-middle">Polish</td>
                            <td class="align-middle">Mathematics</td>
                        </tr>
                        <tr>
                            <td class="align-middle">13:15-14:00</td>
                            <td class="align-middle"></td>
                            <td class="align-middle">Geography</td>
                            <td class="align-middle"></td>
                            <td class="align-middle">English</td>
                            <td class="align-middle">Polish</td>
                        </tr>
                    </tbody>
                </table>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection