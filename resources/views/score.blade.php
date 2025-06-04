<?php $i=1;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/questions.css') }}">
    <title>Result</title>
</head>
<body>
    <h2>Votre score est de {{ $score }}%</h2>
    @foreach($questions as $question)
    <div class="question-block">
        <p>  {{ $i.' '. $question['libele'] }}</p>

        @foreach($question['options'] as $option)
            @php
                $isSelected = $option['is_user_selected'];
                $isCorrect = $option['is_true'];

                $classes = '';
                $symbol = '';

                if ($isSelected && !$isCorrect) {
                    // sélection incorrecte
                    $classes = 'wrong';
                    $symbol = '❌';
                } elseif ($isSelected && $isCorrect) {
                    $classes = 'correct';
                    $symbol = '✅';
                } elseif (!$isSelected && $isCorrect) {
                    $classes = 'missed-correct';
                } else {
                    $classes = 'neutral';
                }
            @endphp

            <label class="{{ $classes }}">
                {!! $symbol !!}
                <input type="{{ $question['reponse_unique'] ?'radio': 'checkbox' }}"
                       disabled
                       {{ $isSelected ? 'checked' : '' }}>
                {{ $option['libele']}}
            </label>
        @endforeach
    </div>
    <?php $i++;?>
@endforeach

<a href="{{ route('index') }}">Retry</a>
</body>
</html>
