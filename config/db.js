const mysql = require('mysql2/promise');
const config = require('./config');

// Step 1: Automatically ensure database exists on MySQL server
(async () => {
  try {
    const tempConn = await mysql.createConnection({
      host: config.db.host,
      user: config.db.user,
      password: config.db.password
    });
    await tempConn.query(`CREATE DATABASE IF NOT EXISTS \`${config.db.database}\`;`);
    await tempConn.end();
  } catch (err) {
    // Suppress if MySQL server isn't running yet
  }
})();

// Step 2: Connection Pool
const pool = mysql.createPool({
  host: config.db.host,
  user: config.db.user,
  password: config.db.password,
  database: config.db.database,
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// Step 3: Automatically ensure all 7 core tables exist
const initTables = async () => {
  try {
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
    console.log('📊 Database tables verified & ready.');
    conn.release();
  } catch (err) {
    console.warn('⚠️ Warning: MySQL database connection could not be established immediately.');
    console.warn('Reason:', err.message);
    console.warn('💡 Tip: Ensure MySQL server is running or update database credentials in .env.');
  }
};

initTables();

module.exports = pool;
