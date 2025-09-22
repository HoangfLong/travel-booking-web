<div style="font-family: Arial, sans-serif; font-size: 16px; color: #333;">
    <div style="background-color: #f4f4f4; padding: 20px; text-align: center;">
        <h1 style="color: #4CAF50;">Booking Confirmed!</h1>
    </div>

    <div style="padding: 20px;">
        <p>Hello, <strong>{{ $booking->user->name }}</strong></p>
        
        <p>Thank you for your trust and for booking with us. Your payment has been successfully confirmed!</p>
        
        <div style="background-color: #ffffff; border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
            <h2 style="color: #555; border-bottom: 2px solid #eee; padding-bottom: 10px;">Booking Details</h2>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0;">Booking Code:</td>
                    <td style="padding: 8px 0; text-align: right;"><strong>{{ $booking->id }}</strong></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0;">Tour Name:</td>
                    <td style="padding: 8px 0; text-align: right;">{{ $booking->tour->title }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0;">Start Date:</td>
                    <td style="padding: 8px 0; text-align: right;">{{ $booking->start_date }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0;">Guest Count:</td>
                    <td style="padding: 8px 0; text-align: right;">{{ $booking->guest_count }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0;">Total Amount:</td>
                    <td style="padding: 8px 0; text-align: right;"><strong>{{ number_format($booking->total_price) }} VND</strong></td>
                </tr>
            </table>
        </div>
        
        <p style="text-align: center; margin-top: 20px;">
            We look forward to serving you.
        </p>
    </div>
    
    <div style="background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; color: #888;">
        © {{ date('Y') }} Travel booking. All rights reserved.
    </div>
</div>