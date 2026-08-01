const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Add POA Page
router.get('/poa', (req, res) => {
  res.render('poa');
});

// Insert POA Record
router.post('/poa', async (req, res) => {
  const { fname, lname, r1, poa, don, email, dob, location, phone, relation, dead } = req.body;

  try {
    const [donorCheck] = await db.query('SELECT * FROM donor WHERE DONORID = ?', [don]);
    if (donorCheck.length === 0) {
      return res.render('poa', { error: 'Associated Donor ID does not exist!' });
    }

    const [existingPoa] = await db.query('SELECT * FROM poa WHERE POAID = ?', [poa]);
    if (existingPoa.length > 0) {
      return res.render('poa', { error: 'POA ID already exists!' });
    }

    await db.query(
      'INSERT INTO poa (FIRSTNAME, LASTNAME, GENDER, POAID, DONORID, EMAIL, DOB, LOCATION, PHONE, RELATION, DEAD) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
      [fname, lname, r1, poa, don, email, dob, location, phone, relation, dead]
    );

    res.render('dash3', { email: req.session.user ? req.session.user.email : email, success: 'Power of Attorney record added successfully!' });
  } catch (err) {
    console.error('Add POA Error:', err);
    res.render('poa', { error: 'Failed to add POA record.' });
  }
});

// POA Search Page
router.get('/poadata', (req, res) => {
  res.render('poadata', { searched: false, poas: [] });
});

router.post('/poadata', async (req, res) => {
  const { id } = req.body;
  try {
    const [poas] = await db.query('SELECT * FROM poa WHERE POAID = ?', [id]);
    res.render('poadata', { searched: true, poas, searchId: id });
  } catch (err) {
    console.error('POA search error:', err);
    res.render('poadata', { searched: true, poas: [] });
  }
});

// View All POAs
router.get('/poaview', async (req, res) => {
  try {
    const [poas] = await db.query('SELECT * FROM poa');
    res.render('poaview', { poas });
  } catch (err) {
    console.error('View POAs error:', err);
    res.render('poaview', { poas: [] });
  }
});

// Update POA Page
router.get('/poaupdate', async (req, res) => {
  const id = req.query.id1;
  try {
    const [rows] = await db.query('SELECT * FROM poa WHERE POAID = ?', [id]);
    if (rows.length === 0) {
      return res.redirect('/poadata');
    }
    res.render('poaupdate', { poa: rows[0] });
  } catch (err) {
    console.error('Fetch POA update error:', err);
    res.redirect('/poadata');
  }
});

router.post('/poaupdate', async (req, res) => {
  const { old_id, fname, lname, r1, poa, don, email, dob, location, phone, relation, dead } = req.body;
  try {
    await db.query(
      'UPDATE poa SET FIRSTNAME=?, LASTNAME=?, GENDER=?, POAID=?, DONORID=?, EMAIL=?, DOB=?, LOCATION=?, PHONE=?, RELATION=?, DEAD=? WHERE POAID=?',
      [fname, lname, r1, poa, don, email, dob, location, phone, relation, dead, old_id]
    );
    res.redirect('/poadata');
  } catch (err) {
    console.error('Update POA error:', err);
    res.redirect('/poadata');
  }
});

// Delete POA
router.get('/poadelete', async (req, res) => {
  const id = req.query.id1;
  try {
    await db.query('DELETE FROM poa WHERE POAID = ?', [id]);
    res.redirect('/poadata');
  } catch (err) {
    console.error('Delete POA error:', err);
    res.redirect('/poadata');
  }
});

module.exports = router;
