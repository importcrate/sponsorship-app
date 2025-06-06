<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Update</title>
</head>
<body>
    <h1>Hello {{ $application->first_name }},</h1>

    <p>Your sponsorship application status has been updated:</p>

    <p><strong>Status:</strong> {{ $application->status }}</p>

    @if ($application->status === 'Approved')
        <p>Congratulations—your sponsorship application has been approved! You’re now part of the Import Crate Mod Squad.</p>

        <p>To activate your sponsorship, you’re required to create an account in the Import Crate Sponsorship Portal. This portal gives you exclusive discounts, the ability to give referrals, earn commissions, and access other perks of the Mod Squad.</p>

        <p>
            👉 <a href="https://importcrate.com/pages/sponsorship-signup">Create your account in the Sponsorship Portal</a>
        </p>

        <p>Your sponsorship isn’t complete until you sign up—once you do, you’ll be fully set as a Mod Squad member!</p>

        <p>If you have any questions, feel free to reach out. We’re excited to have you on board!</p>

        <p>Welcome to the team,<br>  
        The Import Crate Team</p>
    @else
        <p>Unfortunately, your application has been denied.</p>
        @if ($application->denial_reason)
            <p><strong>Reason:</strong> {{ $application->denial_reason }}</p>
        @endif
    @endif

    <p>Thank you!</p>
</body>
</html>
