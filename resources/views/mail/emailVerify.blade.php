<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>

    <h2>This is Test Mail</h2>
    <p>Dear User,</p>
    <p>Click the link below to verify your email address:</p>
    <a href="{{ route('user.verify',[$userId,$token]) }}">Verify Email</a>
    <p>If you did not request this, please ignore this email.</p>

</body>
</html>
