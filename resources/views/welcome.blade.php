<?php $i=1;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/questions.css') }}">
    <title>Questions</title>
</head>
<body>
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

        <label>
            <input type="checkbox" id="confirmAnswers" disabled> Je confirme mes réponses
        </label><br><br>

        <button type="submit" id="submitBtn" disabled>Soumettre</button>
    </form>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const questionBlocks = document.querySelectorAll('.question-block');
            const confirmCheckbox = document.getElementById('confirmAnswers');
            const submitButton = document.getElementById('submitBtn');

            const checkAllAnswered = () => {
                return Array.from(questionBlocks).every(block => {
                    const inputs = block.querySelectorAll('.option-input');
                    if (inputs[0].type === 'radio') {
                        return Array.from(inputs).some(input => input.checked);
                    } else {
                        return Array.from(inputs).some(input => input.checked);
                    }
                });
            };

            document.querySelectorAll('.option-input').forEach(input => {
                input.addEventListener('change', () => {
                    if (checkAllAnswered()) {
                        confirmCheckbox.disabled = false;
                    } else {
                        confirmCheckbox.disabled = true;
                        confirmCheckbox.checked = false;
                        submitButton.disabled = true;
                    }
                });
            });

            confirmCheckbox.addEventListener('change', () => {
                submitButton.disabled = !confirmCheckbox.checked;
            });
        });
        </script>

</body>
</html>
