<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kubernetes Quiz</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
        <div id="quiz-container">
        <h1>Kubernetes Quiz</h1>
        <div id="question">

            <div style="width:100%;text-align:right;font-size:0.95em;color:#666;margin-bottom:8px;">
                Question {{ $question->id }}/ {{ session('nbre_question') }}
            </div>
            <h2>{{ $question->libele }}</h2>
            @if( !$question->reponse_unique)<div style="color:#888;font-size:0.95em;margin-bottom:8px;">(Select all that apply)</div>@endif
        <div id="answers">
            <form id="answers-form" method="POST" action="{{ route('soumission') }}">
                @csrf
                <ul class="answers">
                    @foreach($options as $key => $option)
                        <li>
                            <label>
                                <input
                                type="{{ $question->reponse_unique ? 'radio' : 'checkbox' }}"
                                name="answer{{ $question->reponse_unique ? '' : '[]' }}"
                                value="{{ $option->id }}"
                                {{ in_array($option->id, session('last_user_answers', [])) ? 'checked' : '' }}>
                                {{ $option->libele }}
                            </label>
                        </li>
                        @endforeach
                                    </ul>
                <button type="submit" id="submit-answer">Submit</button>
            </form>
  <div id="feedback" class="feedback"></div>

    @if(session('feedback'))
    <div class="feedback" style="color:{{ session('is_correct') ? 'green' : 'red' }}">
        {{ session('feedback') }}

        @if(!session('is_correct'))
            <p>Correct answer(s):</p>
            <ul>
                @foreach($options as $option)
                    @if(in_array($option->id, session('correct_answers', [])))
                        <li><strong>{{ $option->libele }}</strong></li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
    <button id="next-question" style="margin-top:10px;" onclick="location.href='{{ route('next-quiz') }}'">Next Question</button>
@endif

        </div>
    </div>

    <script>
        document.getElementById('answers-form').addEventListener('submit', function (e) {
            const inputs = document.querySelectorAll('input[name="answer"]:checked');
            if (inputs.length === 0) {
                alert('Please select at least one option.');
                e.preventDefault();
            }
        });
        </script>
 </body>
</html>
