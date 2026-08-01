const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Add Donor Page
router.get('/donor5', (req, res) => {
  res.render('donor5');
});

// Insert Donor Record
router.post('/donor5', async (req, res) => {
  const { fname, lname, r1, donorId, dob, r2, email, location, phone } = req.body;

  try {
    const [regUser] = await db.query('SELECT * FROM register WHERE EMAIL = ?', [email]);
    if (regUser.length === 0) {
      return res.render('donor5', { error: 'Error: Registered email not found in donor accounts.' });
    }

    const [existingDonor] = await db.query('SELECT * FROM donor WHERE DONORID = ?', [donorId]);
    if (existingDonor.length > 0) {
      return res.render('donor5', { error: 'Donor ID already exists!' });
    }

    await db.query(
      'INSERT INTO donor (FIRSTNAME, LASTNAME, GENDER, DONORID, DOB, BLOODTYPE, LOCATION, PHONE) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
      [fname, lname, r1, donorId, dob, r2, location, phone]
    );

    res.render('dash3', { email: req.session.user ? req.session.user.email : email, success: 'Donor details added successfully!' });
  } catch (err) {
    console.error('Add Donor Error:', err);
    res.render('donor5', { error: 'Failed to add donor record.' });
  }
});

// Donor Search & Update Page
router.get('/donordata', (req, res) => {
  res.render('donordata', { searched: false, donors: [] });
});

router.post('/donordata', async (req, res) => {
  const { id } = req.body;
  try {
    const [donors] = await db.query('SELECT * FROM donor WHERE DONORID = ?', [id]);
    res.render('donordata', { searched: true, donors, searchId: id });
  } catch (err) {
    console.error('Donor search error:', err);
    res.render('donordata', { searched: true, donors: [] });
  }
});

// View All Donors
router.get('/donorview', async (req, res) => {
  try {
    const [donors] = await db.query('SELECT * FROM donor');
    res.render('donorview', { donors });
  } catch (err) {
    console.error('View donors error:', err);
    res.render('donorview', { donors: [] });
  }
});

// Update Donor Page
router.get('/donorupdate', async (req, res) => {
  const id = req.query.id1;
  try {
    const [rows] = await db.query('SELECT * FROM donor WHERE DONORID = ?', [id]);
    if (rows.length === 0) {
      return res.redirect('/donordata');
    }
    res.render('donorupdate', { donor: rows[0] });
  } catch (err) {
    console.error('Fetch donor update error:', err);
    res.redirect('/donordata');
  }
});

router.post('/donorupdate', async (req, res) => {
  const { old_id, fname, lname, r1, donorId, dob, r2, location, phone } = req.body;
  try {
    await db.query(
      'UPDATE donor SET FIRSTNAME=?, LASTNAME=?, GENDER=?, DONORID=?, DOB=?, BLOODTYPE=?, LOCATION=?, PHONE=? WHERE DONORID=?',
      [fname, lname, r1, donorId, dob, r2, location, phone, old_id]
    );
    res.redirect('/donordata');
  } catch (err) {
    console.error('Update donor error:', err);
    res.redirect('/donordata');
  }
});

// Delete Donor
router.get('/donordelete', async (req, res) => {
  const id = req.query.id1;
  try {
    await db.query('DELETE FROM donor WHERE DONORID = ?', [id]);
    res.redirect('/donordata');
  } catch (err) {
    console.error('Delete donor error:', err);
    res.redirect('/donordata');
  }
});

module.exports = router;
