<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment PDF</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
    line-height: 1.6rem;
  }
  .email-signature {
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .header {
    color: #333;
    font-size: 18px;
    margin-bottom: 10px;
  }
  .contact-info {
    display: flex;
    margin-bottom: 10px;
  }
  .contact-info span {
    font-weight: bold;
    margin-right: 5px;
    width: 80px;
  }
  .contact-info p {
    margin: 0;
    width: calc(100% - 80px);
  }
  .contact-info span::after {
    content: ':';
  }
  .contact-info a {
    color: #007bff;
    text-decoration: none;
  }
  .footer {
    margin-top: 20px;
  }

  .footer p {
    margin: 0;
    line-height: 22px;
  }

  .footer h3 {
    margin: 0;
  }

  .download-button {
    display: block;
    width: 100px;
    margin: 20px auto;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
  }
</style>
</head>
<body>

  @php
    $appointment = $data;
  @endphp

  <div class="email-signature">
    <div class="header">Hello {{ $appointment->name }},</div>
    <p>Thank you for scheduling an appointment online with us.</p>
    <div class="contact-info" style="display: flex">
      <span>Name</span> 
      <p>{{ $appointment->name }}</p>
    </div>
    <div class="contact-info" style="display: flex">
      <span>Phone</span> 
      <p><a href="tel:{{ $appointment->phone }}">{{ $appointment->phone }}</a></p>
    </div>
    <div class="contact-info" style="display: flex">
      <span>Email</span> 
      <p><a href="mailto:{{ $appointment->email }}">{{ $appointment->email }}</a></p>
    </div>
    <div class="contact-info" style="display: flex">
      <span>Time</span> 
      <p>{{ $appointment->day }}</p>
    </div>
    
    <div class="contact-info" style="display: flex">
      <span>Fee</span> 
      <p>{{ $appointment->fee }} Taka</p>
    </div>
    <div class="contact-info">
      <span>Chamber</span> 
      <p>{{ $appointment->chamber }}</p>
    </div>
    <p>We kindly request your punctual arrival at the chamber. We will also reach out to you at your provided contact number.</p>
    <p>Thank you, and we look forward to seeing you.</p>
   
    <div class="footer">

        <p style="margin-bottom: 10px;">Warm Regards,</p>
        <h3>Dr. Gaousul Azam</h3>
        <p>Assistant Professor</p>
        <p>Department of Neurosurgery</p>
        <p>Dhaka Medical College & Hospital</p>
    </div>
  </div>


</body>
</html>
