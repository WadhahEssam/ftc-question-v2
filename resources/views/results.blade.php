
@if (count($results))

    <h3>عدد المباريات </h3>
    <p>{{count($results)}}</p>

    <table id="results-table">
        {{--todo : i might add a way to increse desplaied info without making it ugly as fuck--}}
        <tr>
            <th>رقم المباراة</th>

            <th>اسم الاول</th>

            <th>نقاط الاول</th>

            <th>اسم الثاني</th>

            <th>نقاط الثاني</th>


            {{--<th>الفائز</th>--}}


        @foreach($results as $result)
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td @if($result->winner == 1) style="color:rgba(61,128,66,0.76)" @else style="color:rgba(255,77,77,0.74)" @endif >{{$result->first_student_name}}<br>{{$result->first_student_id}}</td>
            <td @if($result->winner == 1) style="color:rgba(61,128,66,0.76)" @else style="color:rgba(255,77,77,0.74)" @endif >{{$result->first_student_points}}</td>

            <td  @if($result->winner == 2) style="color:rgba(61,128,66,0.76)" @else style="color:rgba(255,77,77,0.74)" @endif> {{$result->second_student_name}}<br>{{$result->second_student_id}}</td>
            <td  @if($result->winner == 2) style="color:rgba(61,128,66,0.76)" @else style="color:rgba(255,77,77,0.74)" @endif>{{$result->second_student_points}}</td>
        </tr>
        @endforeach


    </table>
@else
    <p>لا توجد نتائج</p>
@endif