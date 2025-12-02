const mysql = require("mysql");

const connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "siperteg"
});

connection.connect((err) => {
    if (err) {
        console.error("❌ Error al conectar a MySQL:", err);
    } else {
        console.log("✅ Conectado a MySQL");
    }
});

module.exports = connection;
