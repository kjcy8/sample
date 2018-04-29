<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm your account</title>
</head>
<body>

</body>
    <h1>Thanks for signing up with Laravel</h1>
    <p>
        Please click the link to activate your account:
        <a href="{{ route('confirm_email', $user->activation_token) }}">
            {{ route('confirm_email', $user->activation_token) }}
        </a>
    </p>
    <p>
        You’re receiving this email because you recently created a new Laravel account. If this wasn’t you, please ignore this email.
    </p>
</html>