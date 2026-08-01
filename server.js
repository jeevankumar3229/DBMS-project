const express = require('express');
const path = require('path');
const session = require('express-session');
const { Resend } = require('resend');
const config = require('./config/config');
const db = require('./config/db');

const app = express();

// Set EJS View Engine
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// Middleware
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

// Serve static assets (Images & Public folder)
app.use(express.static(path.join(__dirname, 'public')));
app.use('/images', express.static(path.join(__dirname, 'images')));

// Session Management
app.use(session({
  secret: config.sessionSecret,
  resave: false,
  saveUninitialized: false,
  cookie: { maxAge: 24 * 60 * 60 * 1000 } // 24 hours
}));

// Legacy PHP redirect middleware
app.use((req, res, next) => {
  if (req.path.endsWith('.php')) {
    const cleanPath = req.path.replace(/\.php$/, '');
    const queryString = req.url.includes('?') ? req.url.substring(req.url.indexOf('?')) : '';
    return res.redirect(301, cleanPath + queryString);
  }
  next();
});

// Import Route Handlers
const authRoutes = require('./routes/auth');
const doctorRoutes = require('./routes/doctor');
const donorRoutes = require('./routes/donor');
const organRoutes = require('./routes/organ');
const poaRoutes = require('./routes/poa');

// Main Pages Routes
app.get('/', (req, res) => res.render('home'));
app.get('/about', (req, res) => res.render('about'));

// Route to manually initialize database tables anytime
app.get('/init-db', async (req, res) => {
  try {
    const success = await db.initTables();
    if (success) {
      res.send('<h2>✅ Success: All 7 MySQL database tables created & verified!</h2><p><a href="/register">Go to Register</a></p>');
    } else {
      res.status(500).send('<h2>⚠️ Warning: Table initialization could not complete. Check server logs.</h2>');
    }
  } catch (err) {
    res.status(500).send(`<h2>❌ Error: ${err.message}</h2>`);
  }
});

// Contact Page GET
app.get('/contact', (req, res) => res.render('contact'));

// Contact Page POST (Saves to MySQL database + Sends Email via Resend API)
app.post('/contact', async (req, res) => {
  const { name, phone, email, subject, message } = req.body;

  try {
    // 1. Ensure contact table exists and save submission
    await db.query(
      `CREATE TABLE IF NOT EXISTS contact (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        NAME VARCHAR(100) NOT NULL,
        PHONE VARCHAR(20) NOT NULL,
        EMAIL VARCHAR(150) NOT NULL,
        SUBJECT VARCHAR(250) NOT NULL,
        MESSAGE TEXT NOT NULL,
        CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      );`
    );

    await db.query(
      'INSERT INTO contact (NAME, PHONE, EMAIL, SUBJECT, MESSAGE) VALUES (?, ?, ?, ?, ?)',
      [name, phone, email, subject, message]
    );

    // 2. Dynamic Resend email trigger
    const apiKey = process.env.RESEND_API_KEY || config.resendApiKey;
    if (apiKey) {
      const resendClient = new Resend(apiKey);
      const recipient = process.env.NOTIFICATION_EMAIL || config.notificationEmail || 'jeevankumar3229@gmail.com';
      
      const result = await resendClient.emails.send({
        from: 'Life Donor <onboarding@resend.dev>',
        to: recipient,
        subject: `New Life Donor Inquiry: ${subject}`,
        html: `
          <div style="font-family: Arial, sans-serif; padding: 20px; line-height: 1.6; color: #333;">
            <h2 style="color: #2691d9;">New Inquiry Received - Life Donor</h2>
            <p><strong>Visitor Name:</strong> ${name}</p>
            <p><strong>Phone:</strong> ${phone}</p>
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>Subject:</strong> ${subject}</p>
            <hr style="border: 0; border-top: 1px solid #ccc; margin: 20px 0;" />
            <p><strong>Message Body:</strong></p>
            <blockquote style="background: #f9f9f9; border-left: 4px solid #2691d9; padding: 12px; margin: 0;">
              ${message.replace(/\n/g, '<br>')}
            </blockquote>
          </div>
        `
      });

      if (result.error) {
        console.error('⚠️ Resend Email Delivery Error:', result.error);
      } else {
        console.log(`✉️ Email successfully dispatched to ${recipient}! Resend ID: ${result.data.id}`);
      }
    } else {
      console.log('ℹ️ Contact form submission saved to MySQL database.');
    }

    res.render('contact', { success: 'Thank you! Your message has been sent and saved successfully.' });
  } catch (err) {
    console.error('Contact form error:', err);
    res.render('contact', { success: 'Message received! We will get back to you soon.' });
  }
});

// Mount Feature Routes
app.use('/', authRoutes);
app.use('/', doctorRoutes);
app.use('/', donorRoutes);
app.use('/', organRoutes);
app.use('/', poaRoutes);

// 404 Handler
app.use((req, res) => {
  res.status(404).send('<h2>404 - Page Not Found</h2><p><a href="/">Return to Home</a></p>');
});

// Start Server
app.listen(config.port, () => {
  console.log(`=================================================`);
  console.log(`🚀 Organ Donation System running on Node.js!`);
  console.log(`🌐 Local URL: http://localhost:${config.port}`);
  console.log(`=================================================`);
});
