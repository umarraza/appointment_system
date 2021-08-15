<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revisit</title>
</head>
<body>

    <h4>Dear Dr. {{ $booking->patient->full_name }}</h4>
    
    <p>
        We haven’t seen you in a while, and we’re wondering how you’re feeling. We hope you’re doing well, but if you’re still experiencing any symptoms, we would love to help you get back to feeling great and doing the activities you love! Simply give us a call at {{ $booking->doctor->profile->tel }} or reply to this email, and we will get your appointment on the books ASAP.
    </p>

    <p>We hope to hear from you.</p>
    <br>
    <b>Online Appoitment System</b>
</body>
</html>