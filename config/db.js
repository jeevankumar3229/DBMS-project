const mysql = require('mysql2/promise');
const config = require('./config');

// Connection Pool
const pool = mysql.createPool({
  host: config.db.host,
  port: config.db.port,
  user: config.db.user,
  password: config.db.password,
  database: config.db.database,
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// Automatically ensure database and all 7 core tables exist
const initTables = async () => {
  try {
    // Step 1: Ensure database exists
    try {
      const tempConn = await mysql.createConnection({
        host: config.db.host,
        port: config.db.port,
        user: config.db.user,
        password: config.db.password
      });
      await tempConn.query(`CREATE DATABASE IF NOT EXISTS \`${config.db.database}\`;`);
      await tempConn.end();
    } catch (dbErr) {
      // Ignore if database creation is restricted or already exists
    }

    // Step 2: Ensure Tables exist
    const conn = await pool.getConnection();

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`register\` (
        \`FIRSTNAME\` VARCHAR(100) NOT NULL,
        \`LASTNAME\` VARCHAR(100) NOT NULL,
        \`EMAIL\` VARCHAR(150) PRIMARY KEY,
        \`COLOR\` VARCHAR(100) NOT NULL,
        \`PASSWORD\` VARCHAR(255) NOT NULL
      );
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`register1\` (
        \`FIRSTNAME\` VARCHAR(100) NOT NULL,
        \`LASTNAME\` VARCHAR(100) NOT NULL,
        \`EMAIL\` VARCHAR(150) PRIMARY KEY,
        \`COLOR\` VARCHAR(100) NOT NULL,
        \`PASSWORD\` VARCHAR(255) NOT NULL
      );
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`doctor\` (
        \`DOCTORID\` VARCHAR(50) PRIMARY KEY,
        \`FIRSTNAME\` VARCHAR(100) NOT NULL,
        \`LASTNAME\` VARCHAR(100) NOT NULL,
        \`GENDER\` VARCHAR(20) NOT NULL,
        \`DOB\` DATE NOT NULL,
        \`EMAIL\` VARCHAR(150) NOT NULL,
        \`LOCATION\` VARCHAR(200) NOT NULL,
        \`PHONE\` VARCHAR(20) NOT NULL,
        \`SPECIALIZATION\` VARCHAR(150) NOT NULL
      );
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`donor\` (
        \`DONORID\` VARCHAR(50) PRIMARY KEY,
        \`FIRSTNAME\` VARCHAR(100) NOT NULL,
        \`LASTNAME\` VARCHAR(100) NOT NULL,
        \`GENDER\` VARCHAR(20) NOT NULL,
        \`DOB\` DATE NOT NULL,
        \`BLOODTYPE\` VARCHAR(10) NOT NULL,
        \`LOCATION\` VARCHAR(200) NOT NULL,
        \`PHONE\` VARCHAR(20) NOT NULL
      );
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`organ\` (
        \`ORGANID\` VARCHAR(50) PRIMARY KEY,
        \`ORGANNAME\` VARCHAR(100) NOT NULL,
        \`DONORID\` VARCHAR(50) NOT NULL,
        \`DOCTORID\` VARCHAR(50) NOT NULL,
        \`DONATEDDATE\` DATE NOT NULL
      );
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`poa\` (
        \`POAID\` VARCHAR(50) PRIMARY KEY,
        \`FIRSTNAME\` VARCHAR(100) NOT NULL,
        \`LASTNAME\` VARCHAR(100) NOT NULL,
        \`GENDER\` VARCHAR(20) NOT NULL,
        \`DONORID\` VARCHAR(50) NOT NULL,
        \`EMAIL\` VARCHAR(150) NOT NULL,
        \`DOB\` DATE NOT NULL,
        \`LOCATION\` VARCHAR(200) NOT NULL,
        \`PHONE\` VARCHAR(20) NOT NULL,
        \`RELATION\` VARCHAR(100) NOT NULL,
        \`DEAD\` VARCHAR(10) NOT NULL
      );
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`contact\` (
        \`ID\` INT AUTO_INCREMENT PRIMARY KEY,
        \`NAME\` VARCHAR(100) NOT NULL,
        \`PHONE\` VARCHAR(20) NOT NULL,
        \`EMAIL\` VARCHAR(150) NOT NULL,
        \`SUBJECT\` VARCHAR(250) NOT NULL,
        \`MESSAGE\` TEXT NOT NULL,
        \`CREATED_AT\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      );
    `);

    console.log('✅ Connected successfully to MySQL Database:', config.db.database);
    console.log('📊 All 7 database tables verified & ready.');
    conn.release();
    return { success: true, database: config.db.database };
  } catch (err) {
    console.warn('⚠️ MySQL table creation error:', err.message);
    return { success: false, error: err.message, database: config.db.database };
  }
};

// Initial trigger
initTables();

// Export pool with initTables method attached
pool.initTables = initTables;

module.exports = pool;

