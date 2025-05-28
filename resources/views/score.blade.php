<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Results</title>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/score.css') }}">
</head>
<body>

    <h1>Your Score: {{ $score }}</h1>

    @if($score >= 120)
    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_ydo1amjm.json"
    background="transparent"
    speed="1"
    style="width: 300px; height: 300px;"
    loop
    autoplay></lottie-player>

        <p style="color:green; font-size: 1.5em;">Congratulations! You passed!</p>
    @else
    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_qp1q7mct.json"
    background="transparent"
    speed="1"
    style="width: 300px; height: 300px;"
    autoplay></lottie-player>
        <p style="color:red; font-size: 1.5em;">Oops! Try again next time.</p>
    @endif

</body>
</html>
