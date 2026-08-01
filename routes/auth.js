const express = require('express');
const router = express.Router();
const db = require('../config/db');

// --- Donor Register ---
router.get('/register', (req, res) => {
  res.render('register');
});

router.post('/register', async (req, res) => {
  const { firstname, lastname, email, color, password, confirm_password } = req.body;
  
  if (password !== confirm_password) {
    return res.render('register', { error: 'Passwords do not match!' });
  }

  try {
    const [existing] = await db.query('SELECT EMAIL FROM register WHERE EMAIL = ?', [email]);
    if (existing.length > 0) {
      return res.render('register', { error: 'Email already registered!' });
    }

    await db.query(
      'INSERT INTO register (FIRSTNAME, LASTNAME, EMAIL, COLOR, PASSWORD) VALUES (?, ?, ?, ?, ?)',
      [firstname, lastname, email, color, password]
    );

    res.render('login', { success: 'Successfully Registered! Please login.' });
  } catch (err) {
    console.error('Error in donor registration:', err.message || err);
    res.render('register', { error: `Registration failed: ${err.message || 'Database error'}` });
  }
});

// --- Doctor Register ---
router.get('/register1', (req, res) => {
  res.render('register1');
});

router.post('/register1', async (req, res) => {
  const { firstname, lastname, email, color, password, confirm_password } = req.body;
  
  if (password !== confirm_password) {
    return res.render('register1', { error: 'Passwords do not match!' });
  }

  try {
    const [existing] = await db.query('SELECT EMAIL FROM register1 WHERE EMAIL = ?', [email]);
    if (existing.length > 0) {
      return res.render('register1', { error: 'Doctor email already registered!' });
    }

    await db.query(
      'INSERT INTO register1 (FIRSTNAME, LASTNAME, EMAIL, COLOR, PASSWORD) VALUES (?, ?, ?, ?, ?)',
      [firstname, lastname, email, color, password]
    );

    res.render('login1', { success: 'Successfully Registered Doctor Account! Please login.' });
  } catch (err) {
    console.error('Error in doctor registration:', err.message || err);
    res.render('register1', { error: `Doctor registration failed: ${err.message || 'Database error'}` });
  }
});

// --- Donor Login ---
router.get('/login', (req, res) => {
  res.render('login');
});

router.post('/login', async (req, res) => {
  const { email, password } = req.body;

  try {
    const [rows] = await db.query('SELECT * FROM register WHERE EMAIL = ?', [email]);
    if (rows.length === 0) {
      return res.render('login', { error: 'Invalid Email' });
    }

    const user = rows[0];
    if (user.PASSWORD !== password) {
      return res.render('login', { error: 'Login Failed: Password incorrect' });
    }

    req.session.user = { email: user.EMAIL, role: 'donor' };
    res.redirect('/dash3');
  } catch (err) {
    console.error('Login error:', err);
    res.render('login', { error: 'Database error occurred during login.' });
  }
});

// --- Doctor Login ---
router.get('/login1', (req, res) => {
  res.render('login1');
});

router.post('/login1', async (req, res) => {
  const { email, password } = req.body;

  try {
    const [rows] = await db.query('SELECT * FROM register1 WHERE EMAIL = ?', [email]);
    if (rows.length === 0) {
      return res.render('login1', { error: 'Invalid Doctor Email' });
    }

    const doctor = rows[0];
    if (doctor.PASSWORD !== password) {
      return res.render('login1', { error: 'Login Failed: Password incorrect' });
    }

    req.session.user = { email: doctor.EMAIL, role: 'doctor' };
    res.redirect('/dash4');
  } catch (err) {
    console.error('Doctor login error:', err);
    res.render('login1', { error: 'Database error occurred during login.' });
  }
});

// --- Donor Forgot Password ---
router.get('/forgotpassword', (req, res) => {
  res.render('forgotpassword');
});

router.post('/forgotpassword', async (req, res) => {
  const { email, color, password } = req.body;

  try {
    const [rows] = await db.query('SELECT * FROM register WHERE EMAIL = ? AND COLOR = ?', [email, color]);
    if (rows.length === 0) {
      return res.render('forgotpassword', { error: 'Verification failed. Incorrect email or favorite color.' });
    }

    await db.query('UPDATE register SET PASSWORD = ? WHERE EMAIL = ?', [password, email]);
    res.render('login', { success: 'Password successfully updated! Please login with your new password.' });
  } catch (err) {
    console.error('Forgot password error:', err);
    res.render('forgotpassword', { error: 'Error resetting password.' });
  }
});

// --- Doctor Forgot Password ---
router.get('/forgotpassword1', (req, res) => {
  res.render('forgotpassword1');
});

router.post('/forgotpassword1', async (req, res) => {
  const { email, color, password } = req.body;

  try {
    const [rows] = await db.query('SELECT * FROM register1 WHERE EMAIL = ? AND COLOR = ?', [email, color]);
    if (rows.length === 0) {
      return res.render('forgotpassword1', { error: 'Verification failed. Incorrect email or favorite color.' });
    }

    await db.query('UPDATE register1 SET PASSWORD = ? WHERE EMAIL = ?', [password, email]);
    res.render('login1', { success: 'Doctor Password successfully updated! Please login.' });
  } catch (err) {
    console.error('Doctor forgot password error:', err);
    res.render('forgotpassword1', { error: 'Error resetting password.' });
  }
});

// --- Dashboards ---
router.get('/dash3', (req, res) => {
  const email = req.session.user ? req.session.user.email : 'Donor Guest';
  res.render('dash3', { email });
});

router.get('/dash4', (req, res) => {
  const email = req.session.user ? req.session.user.email : 'Doctor Guest';
  res.render('dash4', { email });
});

// --- Logout ---
router.get('/logout', (req, res) => {
  req.session.destroy(() => {
    res.redirect('/');
  });
});

module.exports = router;
