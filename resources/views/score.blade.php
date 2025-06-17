<?php
    $i=1;
?>
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
    @php
         $options_explanation=[];
         $j=0;
    @endphp
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
                    //save answer and axplanation
                    $options_explanation[$j]=["option"=>$option['libele'], "explain"=>$option['explanation']];
                    $j++;
                } elseif (!$isSelected && $isCorrect) {
                    $classes = 'missed-correct';
                    $options_explanation[$j]=["option"=>$option['libele'], "explain"=>$option['explanation']];
                    $j++;
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
        <h2>EXPLICATION GENERALES</h2>
       @foreach ($options_explanation as $key =>$value )
            <h2>{{ $value['option'] }}</h2>
            <p style="font-weight: normal; font-size: 16px; line-height: 1.5; text-align: justify;">
                {{ $value['explain'] }}
            </p>
       @endforeach
    </div>
    <?php $i++;?>
@endforeach

<a href="{{ route('index') }}" id="submitBtn">Retry</a>
</body>
</html>
