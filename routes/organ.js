const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Add Organ Page
router.get('/organ1', (req, res) => {
  res.render('organ1');
});

// Insert Organ Record
router.post('/organ1', async (req, res) => {
  const { oname, did, dod, od, ddate } = req.body;

  try {
    const [donorCheck] = await db.query('SELECT * FROM donor WHERE DONORID = ?', [did]);
    if (donorCheck.length === 0) {
      return res.render('organ1', { error: 'Associated Donor ID does not exist!' });
    }

    const [doctorCheck] = await db.query('SELECT * FROM doctor WHERE DOCTORID = ?', [dod]);
    if (doctorCheck.length === 0) {
      return res.render('organ1', { error: 'Associated Doctor ID does not exist!' });
    }

    const [existingOrgan] = await db.query('SELECT * FROM organ WHERE ORGANID = ?', [od]);
    if (existingOrgan.length > 0) {
      return res.render('organ1', { error: 'Organ ID already exists!' });
    }

    await db.query(
      'INSERT INTO organ (ORGANNAME, DONORID, DOCTORID, ORGANID, DONATEDDATE) VALUES (?, ?, ?, ?, ?)',
      [oname, did, dod, od, ddate]
    );

    res.render('dash4', { email: req.session.user ? req.session.user.email : 'Doctor', success: 'Organ record added successfully!' });
  } catch (err) {
    console.error('Add Organ Error:', err);
    res.render('organ1', { error: 'Failed to add organ record.' });
  }
});

// Organ Search Page
router.get('/organdata', (req, res) => {
  res.render('organdata', { searched: false, organs: [] });
});

router.post('/organdata', async (req, res) => {
  const { id } = req.body;
  try {
    const [organs] = await db.query('SELECT * FROM organ WHERE ORGANID = ?', [id]);
    res.render('organdata', { searched: true, organs, searchId: id });
  } catch (err) {
    console.error('Organ search error:', err);
    res.render('organdata', { searched: true, organs: [] });
  }
});

// View All Organs
router.get('/organview', async (req, res) => {
  try {
    const [organs] = await db.query('SELECT * FROM organ');
    res.render('organview', { organs });
  } catch (err) {
    console.error('View organs error:', err);
    res.render('organview', { organs: [] });
  }
});

// Update Organ Page
router.get('/organupdate', async (req, res) => {
  const id = req.query.id1;
  try {
    const [rows] = await db.query('SELECT * FROM organ WHERE ORGANID = ?', [id]);
    if (rows.length === 0) {
      return res.redirect('/organdata');
    }
    res.render('organupdate', { organ: rows[0] });
  } catch (err) {
    console.error('Fetch organ update error:', err);
    res.redirect('/organdata');
  }
});

router.post('/organupdate', async (req, res) => {
  const { old_id, oname, did, dod, od, ddate } = req.body;
  try {
    await db.query(
      'UPDATE organ SET ORGANNAME=?, DONORID=?, DOCTORID=?, ORGANID=?, DONATEDDATE=? WHERE ORGANID=?',
      [oname, did, dod, od, ddate, old_id]
    );
    res.redirect('/organdata');
  } catch (err) {
    console.error('Update organ error:', err);
    res.redirect('/organdata');
  }
});

// Delete Organ
router.get('/organdelete', async (req, res) => {
  const id = req.query.id1;
  try {
    await db.query('DELETE FROM organ WHERE ORGANID = ?', [id]);
    res.redirect('/organdata');
  } catch (err) {
    console.error('Delete organ error:', err);
    res.redirect('/organdata');
  }
});

module.exports = router;
