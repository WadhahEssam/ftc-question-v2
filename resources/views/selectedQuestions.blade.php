
<div id="timer">
    <h1 id="timer-clock" style="padding-bottom:4px">15</h1>
    <h3 id="questions-counter" style="margin-top: -11px;">السؤال 1</h3>
</div>

@foreach($selectedQuestions as $selectedQuestion )

    <div id="question-container-{{$loop->index+1}}" @if($loop->index != 0) style="display:none" @endif>

        <table class="current-question-table" id="question-{{$loop->index+1}}" >
            <tr>
                <td colspan="4" id="question-table-data">
                    <h2 style="padding-bottom:13px">{{$selectedQuestion->question}} </h2>
                    @if($selectedQuestion->imagePath != "" )  <img height="80" id="question-image" src="images\{{$selectedQuestion->imagePath}}" > @endif
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
    </div>

@endforeach


<div id="question-container-21" style="display:none" >
    <br>
    <br>
    <h3>انتهت الاسئلة , شكرا لاشتراكك</h3>
    <h1 id="winner" style="margin-bottom: 20px;">الفائز هو </h1>


    <a href="/goToNewChallenge" style="text-decoration:none"><div id="newChallengeButton"><h2>تحدي جديد</h2></div></a>
</div>