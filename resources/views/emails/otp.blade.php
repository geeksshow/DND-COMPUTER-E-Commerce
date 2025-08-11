<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #ffffff; padding: 30px; border: 1px solid #e9ecef; border-radius: 0 0 8px 8px; }
        .otp-box { background: #007bff; color: white; padding: 20px; text-align: center; border-radius: 8px; margin: 20px 0; font-size: 24px; font-weight: bold; letter-spacing: 5px; }
        .footer { text-align: center; margin-top: 20px; color: #6c757d; font-size: 14px; }
        .warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Password Reset Request</h1>
    </div>
    
    <div class="content">
        <p>Hello,</p>
        <p>You have requested to reset your password. Please use the following OTP (One-Time Password) to complete the process:</p>
        
        <div class="otp-box">
            {{ $otp }}
        </div>
        
        <div class="warning">
            <strong>Important:</strong> This OTP will expire in 10 minutes for security reasons.
        </div>
        
        <p>If you did not request this password reset, please ignore this email. Your password will remain unchanged.</p>
        <p>For security reasons, never share this OTP with anyone.</p>
        <p>Best regards,<br>DND Computers Team</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message, please do not reply to this email.</p>
    </div>
</body>
</html> 