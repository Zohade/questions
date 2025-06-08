<?php $i=1;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/questions.css') }}">
    <title>Questions</title>
</head>
<body>
    <audio id="alertSound" src="{{ asset('assets/audio/alert.mp3') }}" preload="auto"></audio>
    <div class="card" id="chrono">
        <div id="minutes"></div>
        <div id="secondes"></div>
    </div>
<div class="card"><br><br><br><br><br>
 </div>
     <form id="quizForm" method="POST" action="{{ route('soumission') }}">
        @csrf
        @foreach($questions as $index => $question)
            <div class="question-block" data-question-index="{{ $index }}">
                <p><strong>{{$i.'. '. $question->libele }}</strong></p>

                @foreach($question->options as $option)
                    <label>
                        <input
                            type="{{ $question->reponse_unique ? 'radio' : 'checkbox' }}"
                            name="answers[{{ $question->id }}]{{ $question->reponse_unique ? '':'[]' }}"
                            value="{{ $option->id }}"
                            class="option-input"
                        >
                        {{ $option->libele }}
                    </label><br>
                @endforeach
            </div>
            <hr>
            <?php $i++;?>
        @endforeach
        <button type="submit" id="submitBtn">Soumettre</button>
        </form>
    </div>
</div>
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
