<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h4>Dear Dr. {{ $booking->doctor->full_name }}</h4>
    
    <p>
        You have a new appointment with <b>{{ $booking->patient->full_name }}</b> and is scheduled in {{ $booking->date->toFormattedDateString() }} at {{ date('h:i a', strtotime($booking->start_time)) }}
        <br>
        <br>
        This is <b>{{ $booking->patient->full_name }}’s</b> cell phone number, just in case, <b>{{ $booking->patient->profile->tel }}</b>.
        <br>
        <br>
        Best Regards,
        <br>
        <br>
        Online Appoitment System
    </p>
</body>
</html>