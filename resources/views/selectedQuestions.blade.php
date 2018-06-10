
<div id="timer">
    <h1 id="timer-clock" style="padding-bottom:4px">15</h1>
    <h3 style="margin-top: -11px;">السؤال 1</h3>
</div>

@foreach($selectedQuestions as $selectedQuestion )

    <table class="current-question-table" id="question-{{$loop->index+1}}" @if($loop->index != 0) style="display:none" @endif>
        <tr>
            <td colspan="4" id="question-table-data">
                <h2 style="padding-bottom:13px">{{$selectedQuestion->question}} and the answer is {{$selectedQuestion->answer}}</h2>
                @if($selectedQuestion->imagePath != "" )  <img height="80" id="question-image" src="images\questionImageTest.jpg" > @endif
            </td>
        </tr>
        <tr>
            <td colspan="2" id="option-data-table-1" class="option-table-data" data-item-id="answer" data-value-id="{{$selectedQuestion->answer}}"><div onclick="optionPressed( {{$selectedQuestion->id}},1)" class="option" id="option-{{$selectedQuestion->id}}-1"><h3> {{$selectedQuestion->option1}} </h3></div></td>
            <td colspan="2" id="option-data-table-2" class="option-table-data" data-item-id="answer" data-value-id="{{$selectedQuestion->answer}}"><div onclick="optionPressed( {{$selectedQuestion->id}},2)" class="option" id="option-{{$selectedQuestion->id}}-2"><h3> {{$selectedQuestion->option2}} </h3></div></td>
        </tr>
        <tr>
            <td colspan="2" id="option-data-table-3" class="option-table-data" data-item-id="answer" data-value-id="{{$selectedQuestion->answer}}"><div onclick="optionPressed( {{$selectedQuestion->id}},3)" class="option" id="option-{{$selectedQuestion->id}}-3"><h3> {{$selectedQuestion->option3}} </h3></div></td>
            <td colspan="2" id="option-data-table-4" class="option-table-data" data-item-id="answer" data-value-id="{{$selectedQuestion->answer}}"><div onclick="optionPressed( {{$selectedQuestion->id}},4)" class="option" id="option-{{$selectedQuestion->id}}-4"><h3> {{$selectedQuestion->option4}} </h3></div></td>
        </tr>
    </table>

@endforeach