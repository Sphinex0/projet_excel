<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form id="importForm" action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" id="imported_file" name="imported_file">
        <br/>
        <button type="submit" id="submit_button">Import</button>
        <p id="timer">00:00:00</p>
    </form>

    <script>
        let startTime;
        let intervalId;

        document.getElementById("submit_button").addEventListener("click", function() {
            startTime = Date.now();
            intervalId = setInterval(updateTimer, 1000);
        });

        function updateTimer() {
            let elapsedTime = Date.now() - startTime;
            let hours = Math.floor(elapsedTime / (1000 * 60 * 60));
            let minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;
            document.getElementById("timer").innerText = hours + ":" + minutes + ":" + seconds;
        }
    </script>
</body>
</html>
{{-- Cloning laravel project from github
1.Run git clone <my-cool-project>
2.Run composer install
3.Run cp .env.example .env
4.Run php artisan key:generate
5.Run php artisan migrate
6.Run php artisan serve
7.Go to link localhost:8000 --}}
