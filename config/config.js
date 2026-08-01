const dotenv = require('dotenv');

// Load .env file locally
dotenv.config();

// Helper to extract clean hostname, port, and credentials
function getDbConfig() {
  let rawHost = process.env.DB_HOST || process.env.MYSQLHOST || process.env.MYSQL_HOST || 'localhost';
  let port = parseInt(process.env.DB_PORT || process.env.MYSQLPORT || '3306', 10);
  let user = process.env.DB_USER || process.env.MYSQLUSER || 'root';
  let password = process.env.DB_PASSWORD || process.env.MYSQLPASSWORD || '';
  let database = process.env.DB_NAME || process.env.MYSQLDATABASE || 'organdonation';

  // Handle full connection strings like mysql://user:pass@host:port/dbname
  const connUrl = process.env.MYSQL_URL || process.env.DATABASE_URL || (rawHost.startsWith('mysql://') ? rawHost : null);
  if (connUrl && connUrl.startsWith('mysql://')) {
    try {
      const parsed = new URL(connUrl);
      rawHost = parsed.hostname;
      if (parsed.port) port = parseInt(parsed.port, 10);
      if (parsed.username) user = parsed.username;
      if (parsed.password) password = parsed.password;
      if (parsed.pathname && parsed.pathname.length > 1) database = parsed.pathname.substring(1);
    } catch (e) {
      // Fall through if URL parsing fails
    }
  }

  // Clean host (strip protocols like mysql://, http://, https://)
  rawHost = rawHost.replace(/^(mysql|http|https):\/\//, '');

  // Extract port if included in host string (e.g. host.com:3306)
  if (rawHost.includes(':')) {
    const parts = rawHost.split(':');
    rawHost = parts[0];
    if (parts[1] && !isNaN(parts[1])) {
      port = parseInt(parts[1], 10);
    }
  }

  return {
    host: rawHost.trim(),
    port: port,
    user: user,
    password: password,
    database: database
  };
}

const config = {
  port: process.env.PORT || 3000,
  db: getDbConfig(),
  sessionSecret: process.env.SESSION_SECRET || 'organ_donation_secret_key_12345',
  resendApiKey: process.env.RESEND_API_KEY || '',
  notificationEmail: process.env.NOTIFICATION_EMAIL || 'jeevankumar3229@gmail.com'
};

module.exports = config;

