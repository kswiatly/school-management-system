@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Averages</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Teacher</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Average</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $studentID = DB::table('students')->where('user_id', '=', Auth::user()->id)->value('id');
                            $marks = DB::table('marks')->where('student_id', '=', $studentID)->orderBy('subject_id', 'asc')->get();
                        @endphp
                        @foreach($marks->unique('subject_id') as $mark)
                            <tr>
                            @php
                                $teacherUserID = DB::table('teachers')->where('id', '=', $mark->teacher_id)->value('user_id');
                                $subjectMarkCount = DB::table('marks')->select(DB::raw('COUNT(*) as count'))->whereRaw('subject_id ='.$mark->subject_id.' AND student_id='.$studentID)->value('count');
                                $subjectMarkSum = DB::table('marks')->select(DB::raw('SUM(mark) as sum'))->whereRaw('subject_id ='.$mark->subject_id.' AND student_id='.$studentID)->value('count');
                                $average = $subjectMarkSum/$subjectMarkCount;
                            @endphp
                                <td scope="col">{{DB::table('users')->where('id', '=', $teacherUserID)->value('name')}}</td>
                                <td scope="col">{{DB::table('subjects')->where('id', '=', $mark->subject_id)->value('name')}}</td>
                                <td scope="col">{{ round($average, 2) }}</td>
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
