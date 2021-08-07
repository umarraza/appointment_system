<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Confirmed</title>
</head>
<body>

    <h4>Dear {{ $booking->patient->full_name }}</h4>
    
    <p>
        Appointment confirmed with <b>Dr. {{ $booking->doctor->full_name }}</b> on {{ $booking->date->toFormattedDateString() }} at {{ date('h:i a', strtotime($booking->start_time)) }}. Please find the details below:
        <br>
        <br>
        <h3>Confirmed Time:</h3>
        {{ $booking->date->toFormattedDateString() }} at 
        <br>
        {{ date('h:i a', strtotime($booking->start_time)) }}
        <hr>
        <br>
        <br>
        Dr. {{ $booking->doctor->full_name }},
        <br>
        {{ $booking->doctor->profile->address }},
        <br>
        {{ $booking->doctor->profile->tel }},
        <br>
        <br>
        Online Appoitment System
    </p>
</body>
</html>