<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Survey Submission</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 30px;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-label {
            font-weight: 600;
            color: #667eea;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #667eea;
        }

        .suggestions-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #764ba2;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 13px;
            border-top: 1px solid #e1e8ed;
        }

        .timestamp {
            color: #999;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New Anonymous Survey Submission</h1>
        </div>

        <div class="email-body">
            <div class="info-section">
                <div class="info-label">Addressing To:</div>
                <div class="info-content">
                    {{ $surveyData['addressing_to'] }}
                </div>
            </div>

            <div class="info-section">
                <div class="info-label">Subject:</div>
                <div class="info-content">
                    {{ $surveyData['subject'] }}
                </div>
            </div>

            <div class="info-section">
                <div class="info-label">Suggestions:</div>
                <div class="suggestions-content">
                    {{ $surveyData['suggestions'] }}
                </div>
            </div>

            <div class="timestamp">
                Submitted on: {{ date('F j, Y \a\t g:i A') }}
            </div>
        </div>

        <div class="email-footer">
            This is an anonymous survey submission. Please do not reply to this email.
        </div>
    </div>
</body>
</html>
