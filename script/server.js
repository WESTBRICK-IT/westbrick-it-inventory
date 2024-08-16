const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');

const app = express();
const PORT = 3306;

// Enable CORS
app.use(cors());

// MySQL connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'cbarber',
  password: '!!!Dr0w554p!!!',
  database: 'IT_Inventory_DB'
});

// Connect to MySQL
db.connect((err) => {
  if (err) throw err;
  console.log('Connected to MySQL Database');
});

// API endpoint to get data
app.get('/api/data', (req, res) => {
  db.query('SELECT * FROM links', (err, results) => {
    if (err) throw err;
    res.json(results); // Return results as JSON
  });
});

// Start server
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});