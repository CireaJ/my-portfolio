# Contact Form & Social Links Setup Guide

This guide will help you set up the working contact form that sends emails to **Charles.Jaeric@gmail.com** and configure dynamic social links.

## ✅ What's Been Implemented

### 1. **Database Changes**
- Added social link fields to `profiles` table:
  - `github_url`
  - `linkedin_url`
  - `twitter_url`
  - `youtube_url`
  - `website_url`
- Created `inquiries` table to store contact form submissions

### 2. **Models & Controllers**
- ✅ Updated `Profile` model with social link fields
- ✅ Created `Inquiry` model for storing contact submissions
- ✅ Created `ContactController` to handle form submissions
- ✅ Created `InquiryReceived` notification for email alerts
- ✅ Created `ContactRequest` for form validation

### 3. **Views**
- ✅ Updated main portfolio view (`app.blade.php`) with:
  - Dynamic social links from database
  - Working contact form with validation
  - Success/error message display
- ✅ Updated admin profile edit form with social link fields

### 4. **Routes**
- ✅ Added `POST /contact` route for form submission

## 🚀 Setup Instructions

### Step 1: Run Database Migrations

Make sure your database is running (start MySQL/Laragon), then run:

```bash
php artisan migrate
```

This will:
- Add social link columns to the `profiles` table
- Create the `inquiries` table

### Step 2: Update Profile Data

Run the seeder to update your profile with the email and social placeholders:

```bash
php artisan db:seed --class=ProfileSeeder
```

Or manually update via the admin panel at `/admin/profile/edit`

### Step 3: Configure Email Settings

#### Option A: Use Gmail (Recommended for Production)

1. **Generate a Gmail App Password:**
   - Go to your Google Account settings
   - Enable 2-Factor Authentication if not already enabled
   - Go to Security → App passwords
   - Generate a new app password for "Mail"
   - Copy the 16-character password

2. **Update your `.env` file:**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=Charles.Jaeric@gmail.com
MAIL_PASSWORD=your-16-character-app-password-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="Charles.Jaeric@gmail.com"
MAIL_FROM_NAME="Portfolio Contact"
```

#### Option B: Use Mailtrap (For Testing)

For testing without sending real emails:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="Charles.Jaeric@gmail.com"
MAIL_FROM_NAME="Portfolio Contact"
```

3. **Clear config cache:**

```bash
php artisan config:clear
php artisan cache:clear
```

### Step 4: Update Social Links

1. Go to `/admin/profile/edit`
2. Scroll to the "Social Links" section
3. Fill in your actual social media URLs:
   - **GitHub:** `https://github.com/yourusername`
   - **LinkedIn:** `https://linkedin.com/in/yourusername`
   - **Twitter/X:** `https://twitter.com/yourusername`
   - **YouTube:** `https://youtube.com/@yourusername`
   - **Website:** `https://yourwebsite.com`
4. Leave any field empty if you don't want it to display
5. Click "Update Profile"

### Step 5: Test the Contact Form

1. Visit your portfolio homepage
2. Scroll to the "Let's Connect" section
3. Fill out and submit the contact form
4. Check your email at **Charles.Jaeric@gmail.com**
5. The inquiry will also be saved in the `inquiries` table

## 📧 Email Notification Details

When someone submits the contact form:
- An email is sent to **Charles.Jaeric@gmail.com**
- The email includes:
  - Sender's name
  - Sender's email
  - Their message
  - Timestamp
- The inquiry is saved to the database
- The sender sees a success message

## 🎨 Frontend Features

### Social Links
- Only configured social links will appear
- Empty URLs won't show any broken links
- Email link uses the profile email from database
- Responsive grid layout

### Contact Form
- Client-side and server-side validation
- Shows error messages for invalid input
- Success message on submission
- Form data persists on error (old input)
- CSRF protection included

## 🔧 Troubleshooting

### Emails Not Sending

1. **Check `.env` configuration:**
   ```bash
   php artisan config:clear
   php artisan tinker
   >>> config('mail')
   ```

2. **Test email manually:**
   ```bash
   php artisan tinker
   >>> Illuminate\Support\Facades\Mail::raw('Test', function($msg) { $msg->to('Charles.Jaeric@gmail.com')->subject('Test'); });
   ```

3. **Check Laravel logs:**
   - Look in `storage/logs/laravel.log` for errors

### Common Issues

**"Too many login attempts"** (Gmail)
- Make sure you're using an App Password, not your regular Gmail password
- Enable "Less secure app access" (not recommended) OR use App Passwords

**"Connection refused"**
- Check your MAIL_HOST and MAIL_PORT settings
- Verify your firewall isn't blocking SMTP

**Validation errors not showing**
- Make sure you've cleared the config cache: `php artisan config:clear`

## 📝 Managing Inquiries

To view all inquiries in the database:

```bash
php artisan tinker
>>> App\Models\Inquiry::all()
```

Or create an admin panel to manage them (optional future enhancement).

## 🎯 Next Steps (Optional)

Consider adding:
- Admin panel to view/manage inquiries
- Email auto-responder to thank people for contacting you
- Rate limiting on contact form (currently unlimited)
- Honeypot field for spam prevention
- Google reCAPTCHA integration

---

**All set!** Your contact form will now send emails to Charles.Jaeric@gmail.com and your social links will be dynamically loaded from the database. 🚀
