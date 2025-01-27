<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande de contact - Granulés de Bois Picard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .message-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
        .info-section {
            background-color: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .label {
            font-weight: bold;
            color: #2C5530;
        }
        .message-content {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #eeeeee;
            border-radius: 4px;
            margin-top: 15px;
        }
        h1 {
            color: #2C5530;
            font-size: 20px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2C5530;
        }
    </style>
</head>
<body>
<div class="message-container">
    <h1>{{ $mailData['title'] }}</h1>

    <div class="info-section">
        <div class="info-item">
            <span class="label">Date de réception :</span>
            {{ date('d/m/Y H:i') }}
        </div>
        <div class="info-item">
            <span class="label">Nom complet :</span>
            {{ $mailData['full_name'] }}
        </div>
        <div class="info-item">
            <span class="label">Email :</span>
            {{ $mailData['from'] }}
        </div>
    </div>

    <div class="message-content">
        <div class="label">Message du client :</div>
        <p>{{ $mailData['body'] }}</p>
    </div>
</div>
</body>
</html>
