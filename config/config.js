const dotenv = require('dotenv');

// Load .env file locally
dotenv.config();

const config = {
  port: process.env.PORT || 3000,
  db: {
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || '',
    database: process.env.DB_NAME || 'organdonation',
  },
  sessionSecret: process.env.SESSION_SECRET || 'organ_donation_secret_key_12345',
  resendApiKey: process.env.RESEND_API_KEY || '',
  notificationEmail: process.env.NOTIFICATION_EMAIL || 'jeevankumar3229@gmail.com'
};

module.exports = config;
