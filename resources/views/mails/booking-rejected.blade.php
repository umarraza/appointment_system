<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Rejected</title>
</head>
<body>

    <h4>Dear {{ $booking->patient->full_name }}</h4>
    <p>Thank you for making an appointment with <b>Dr. {{ $booking->doctor->full_name }}</b> on {{ $booking->date->toFormattedDateString() }} at {{ date('h:i a', strtotime($booking->start_time)) }}.</p>
    <p>We regret to inform you that we cannot be of service to you because of some reasons.</p>
    <p>However, we do recommend that you try booking an appointment for another date.</p>
    <br>
    <p>Sincerely,</p>
    <p> Dr. {{ $booking->doctor->full_name }},<br>
        {{ $booking->doctor->profile->address }},<br>
        {{ $booking->doctor->profile->tel }},
    </p>
    <br>
    Online Appoitment System
</body>
</html>