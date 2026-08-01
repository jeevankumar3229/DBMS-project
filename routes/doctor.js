const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Add Doctor Page
router.get('/doctor1', (req, res) => {
  res.render('doctor1');
});

// Insert Doctor Record
router.post('/doctor1', async (req, res) => {
  const { fname, lname, r1, doctorId, dob, email, location, phone, specialization } = req.body;

  try {
    // Check if Doctor ID or registered account email exists
    const [regDoctor] = await db.query('SELECT * FROM register1 WHERE EMAIL = ?', [email]);
    if (regDoctor.length === 0) {
      return res.render('doctor1', { error: 'Error: Registered email not found in doctor accounts.' });
    }

    const [existingDoc] = await db.query('SELECT * FROM doctor WHERE DOCTORID = ?', [doctorId]);
    if (existingDoc.length > 0) {
      return res.render('doctor1', { error: 'Doctor ID already exists!' });
    }

    await db.query(
      'INSERT INTO doctor (FIRSTNAME, LASTNAME, GENDER, DOCTORID, DOB, EMAIL, LOCATION, PHONE, SPECIALIZATION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
      [fname, lname, r1, doctorId, dob, email, location, phone, specialization]
    );

    res.render('dash4', { email: req.session.user ? req.session.user.email : email, success: 'Doctor details added successfully!' });
  } catch (err) {
    console.error('Add Doctor Error:', err);
    res.render('doctor1', { error: 'Failed to add doctor record.' });
  }
});

// Doctor Data Search Page
router.get('/doctordata', (req, res) => {
  res.render('doctordata', { searched: false, doctors: [] });
});

router.post('/doctordata', async (req, res) => {
  const { id } = req.body;
  try {
    const [doctors] = await db.query('SELECT * FROM doctor WHERE DOCTORID = ?', [id]);
    res.render('doctordata', { searched: true, doctors, searchId: id });
  } catch (err) {
    console.error('Doctor search error:', err);
    res.render('doctordata', { searched: true, doctors: [] });
  }
});

// View All Doctors
router.get('/doctorview', async (req, res) => {
  try {
    const [doctors] = await db.query('SELECT * FROM doctor');
    res.render('doctorview', { doctors });
  } catch (err) {
    console.error('View doctors error:', err);
    res.render('doctorview', { doctors: [] });
  }
});

// Update Doctor Page
router.get('/doctorupdate', async (req, res) => {
  const id = req.query.id1;
  try {
    const [rows] = await db.query('SELECT * FROM doctor WHERE DOCTORID = ?', [id]);
    if (rows.length === 0) {
      return res.redirect('/doctordata');
    }
    res.render('doctorupdate', { doctor: rows[0] });
  } catch (err) {
    console.error('Fetch doctor update error:', err);
    res.redirect('/doctordata');
  }
});

router.post('/doctorupdate', async (req, res) => {
  const { old_id, fname, lname, r1, doctorId, dob, location, phone, specialization } = req.body;
  try {
    await db.query(
      'UPDATE doctor SET FIRSTNAME=?, LASTNAME=?, GENDER=?, DOCTORID=?, DOB=?, LOCATION=?, PHONE=?, SPECIALIZATION=? WHERE DOCTORID=?',
      [fname, lname, r1, doctorId, dob, location, phone, specialization, old_id]
    );
    res.redirect('/doctordata');
  } catch (err) {
    console.error('Update doctor error:', err);
    res.redirect('/doctordata');
  }
});

// Delete Doctor
router.get('/doctordelete', async (req, res) => {
  const id = req.query.id1;
  try {
    await db.query('DELETE FROM doctor WHERE DOCTORID = ?', [id]);
    res.redirect('/doctordata');
  } catch (err) {
    console.error('Delete doctor error:', err);
    res.redirect('/doctordata');
  }
});

module.exports = router;
