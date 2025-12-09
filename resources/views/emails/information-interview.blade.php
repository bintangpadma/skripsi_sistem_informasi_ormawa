<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Interview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 0;
            margin: 0;
        }
        .email-container {
            background: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        .header {
            text-align: center;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #333;
        }
        .content {
            margin-top: 20px;
            line-height: 1.6;
            color: #333;
        }
        .details-box {
            background: #f0f7ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin-top: 15px;
            border-radius: 4px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="email-container">
    
    <div class="header">
        <h2>Pemberitahuan Interview</h2>
    </div>

    <div class="content">
        <p>Halo,</p>
        <p>
            Terima kasih telah mendaftar pada kegiatan kami.  
        </p>

        <div class="details-box">
            <p><strong>📅 Jadwal Interview</strong></p>
            <p>{{ $date }}</p>

            <p><strong>📍 Lokasi Interview</strong></p>
            <p>{{ $location }}</p>
        </div>

        <p>
            Harap hadir tepat waktu dan mempersiapkan diri dengan baik.
            Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi panitia terkait.
        </p>

        <p>Terima kasih,<br>
        <strong>Panitia Rekrutmen</strong></p>
    </div>

    <div class="footer">
        Email ini dikirim otomatis, mohon tidak membalas pesan ini.
    </div>

</div>

</body>
</html>