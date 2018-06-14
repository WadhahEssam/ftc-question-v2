


@if( count($questions) )
    <h3>عدد الاسئلة (
        {{count($questions)}}
    ) </h3>
    @foreach ($questions as $question )

        <div class="question-container">
            <table id="questions-table">
                <tr>
                    <td colspan="4" style="padding-bottom:3px" ><h2>السؤال : {{$loop->index + 1}}</h2> </td>
                </tr>
                <tr>
                    <td colspan="4"><h3  style="padding-bottom:10px" >{{$question->question}}</h3> </td>
                </tr>
                @if($question->imagePath != "" )
                    <tr>
                        <td colspan="4"><img style="border-radius:15px;margin-top:10px;" height="100" width="100" src="/images/{{$question->imagePath}}"></td>
                    </tr>
                @endif
                <tr>
                    <td colspan="4"><h5> &nbsp 1 : {{$question->option1}} &nbsp</h5></td>
                </tr>
                <tr>
                    <td colspan="4"><h5> &nbsp 2 : {{$question->option2}} &nbsp</h5></td>
                </tr>
                <tr>
                    <td colspan="4"><h5> &nbsp 3 : {{$question->option3}} &nbsp</h5></td>
                </tr>
                <tr>
                    <td colspan="4"><h5> &nbsp <strong> 4 </strong> : {{$question->option4}} &nbsp</h5></td>
                </tr>

                <tr>
                    <td colspan="2">Answer :<h3> {{$question->answer}}<h4></td>
                    <td colspan="2">Difficulty :<h3> {{$question->dif}}<h4></td>
                </tr>
                <tr>
                    <td colspan="4">

                        {!! Form::open(['method'=>'delete' , 'url'=>'/deleteQuestion' , 'style'=>'margin:10px 0px;']) !!}
                            <input type="hidden" name="id" value="{{$question->id}}" >
                            <input style="background-color:rgba(200,74,58,0.72)" class="delete-button" type="submit" value="حذف" >
                        {!! Form::close() !!}
                    </td>
                </tr>
            </table>
        </div>

    @endforeach
@else

<p>لا توجد اسئلة</p>

@endif