<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment Confirmation Mail</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
  <h2>Appointment Confirmation Mail</h2>

  <h4>Hello {{ $appointment->name }}. Thank you for scheduling your appointment with us.  Below are your appointment details:</h4>
  <br>
  <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <tr>
      <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Field</th>
      <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Details</th>
    </tr>
    <tr>
      <td style="border: 1px solid #dddddd; padding: 8px;">Name</td>
      <td style="border: 1px solid #dddddd; padding: 8px;">{{ $appointment->name }}</td>
    </tr>
    <tr>
      <td style="border: 1px solid #dddddd; padding: 8px;">Phone</td>
      <td style="border: 1px solid #dddddd; padding: 8px;">{{ $appointment->phone }}</td>
    </tr>
    <tr>
      <td style="border: 1px solid #dddddd; padding: 8px;">Email</td>
      <td style="border: 1px solid #dddddd; padding: 8px;">{{ $appointment->email }}</td>
    </tr>
    <tr>
      <td style="border: 1px solid #dddddd; padding: 8px;">Time</td>
      <td style="border: 1px solid #dddddd; padding: 8px;">{{ $appointment->day }}</td>
    </tr>
    
    <tr>
      <td style="border: 1px solid #dddddd; padding: 8px;">Fee</td>
      <td style="border: 1px solid #dddddd; padding: 8px;">{{ $appointment->fee }} Taka</td>
    </tr>
    <tr>
      <td style="border: 1px solid #dddddd; padding: 8px;">Location</td>
      <td style="border: 1px solid #dddddd; padding: 8px;">{{ $appointment->chamber }}</td>
    </tr>
    <tr>
      <td style="border: 1px solid #dddddd; padding: 8px;">Created At</td>
      <td style="border: 1px solid #dddddd; padding: 8px;">{{ $appointment->created_at->format('d F Y - h:i A') }}</td>
    </tr>
  </table>
  <p>We kindly request your punctual arrival at the chamber. We will also reach out to you at your provided contact number.</p>
  <p style="margin-bottom: 10px;">Thank you, and we look forward to seeing you.</p>

  <span>Warm Regards,</span>
  <h3>Dr. Gaousul Azam</h3>
  <p>Assistant Professor <br>
  Department of Neurosurgery <br>
  Dhaka Medical College & Hospital</p>
</body>
</html>
