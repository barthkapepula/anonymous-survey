# Anonymous Survey Application - Setup Guide

This Laravel application allows users to submit anonymous surveys that are sent via email to a designated recipient.

## Features

- Anonymous survey submission form with 3 fields:
  - **Addressing To**: Who the survey is directed to
  - **Subject**: What topic is being addressed
  - **Suggestions**: Detailed feedback or suggestions
- Email notification with formatted survey results
- Modern, responsive design
- Form validation
- Success message after submission

## Installation

The project is already set up in your working directory. To get started:

1. **Install dependencies** (if not already installed):
   ```bash
   composer install
   ```

2. **Run the development server**:
   ```bash
   php artisan serve
   ```

3. **Access the application**:
   Open your browser and navigate to `http://localhost:8000`

## Current Email Configuration

By default, the application is configured to **log emails** instead of sending them. This is useful for development and testing.

- Emails are logged to: `storage/logs/laravel.log`
- To view logged emails, check this file after submitting a survey

## Setting Up Real Email Sending

To send actual emails, you need to configure your `.env` file with a mail service. Here are some common options:

### Option 1: Gmail (SMTP)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="Anonymous Survey"

SURVEY_EMAIL="recipient@example.com"
```

**Note**: For Gmail, you need to use an [App Password](https://support.google.com/accounts/answer/185833?hl=en) instead of your regular password.

### Option 2: Mailtrap (Testing)

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="Anonymous Survey"

SURVEY_EMAIL="test@example.com"
```

### Option 3: SendGrid (Production)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="Anonymous Survey"

SURVEY_EMAIL="admin@yourdomain.com"
```

### Option 4: Mailgun

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-mailgun-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-secret
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="Anonymous Survey"

SURVEY_EMAIL="admin@yourdomain.com"
```

## Important Configuration

### Survey Email Recipient

Update the `SURVEY_EMAIL` variable in your `.env` file to specify where survey submissions should be sent:

```env
SURVEY_EMAIL="admin@yourdomain.com"
```

This is the email address that will receive all survey submissions.

## File Structure

```
anonymous-survey/
├── app/
│   ├── Http/Controllers/
│   │   └── SurveyController.php      # Handles form display and submission
│   └── Mail/
│       └── SurveySubmitted.php       # Email template logic
├── resources/views/
│   ├── survey/
│   │   └── form.blade.php            # Survey form UI
│   └── emails/
│       └── survey.blade.php          # Email template
├── routes/
│   └── web.php                       # Application routes
└── .env                              # Environment configuration
```

## Testing the Application

1. Start the server:
   ```bash
   php artisan serve
   ```

2. Open `http://localhost:8000` in your browser

3. Fill out the survey form with test data

4. Submit the form

5. Check for success message on the page

6. View the email in:
   - `storage/logs/laravel.log` (if using log mailer)
   - Your email inbox (if using real SMTP)
   - Your mail testing service (Mailtrap, etc.)

## Troubleshooting

### Emails not sending?

1. Check your `.env` configuration
2. Verify SMTP credentials are correct
3. Check `storage/logs/laravel.log` for error messages
4. Ensure your mail service allows SMTP connections

### Form validation errors?

- All fields are required
- Check field length limits in `SurveyController.php`:
  - addressing_to: max 255 characters
  - subject: max 255 characters
  - suggestions: max 1000 characters

### Permission errors?

Make sure the storage directory is writable:
```bash
chmod -R 775 storage bootstrap/cache
```

## Production Deployment

When deploying to production:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure a real mail service (not log)
4. Run optimization commands:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Security Notes

- The application does not store any personally identifiable information
- Survey submissions are truly anonymous
- Email addresses are only used for sending notifications
- Form data is validated before processing
- CSRF protection is enabled on all forms

## Customization

### Changing field labels or placeholders

Edit: `resources/views/survey/form.blade.php`

### Changing email template design

Edit: `resources/views/emails/survey.blade.php`

### Adding more fields

1. Update the form in `resources/views/survey/form.blade.php`
2. Update validation in `SurveyController.php` (submit method)
3. Update email template in `resources/views/emails/survey.blade.php`

## Support

For Laravel documentation, visit: https://laravel.com/docs
