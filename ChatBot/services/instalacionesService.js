const db = require("../db");

module.exports.registrar = (data) => {
    return new Promise((resolve, reject) => {
        const sql = `
            INSERT INTO instalaciones (nombre, celular, direccion)
            VALUES (?, ?, ?)
        `;

        db.query(sql, [data.nombre, data.celular, data.direccion], (err, result) => {
            if (err) {
                console.error("Error SQL:", err);
                return resolve(null);
            }
            resolve(result.insertId);
        });
    });
};

module.exports.buscarPorId = (id) => {
    return new Promise((resolve, reject) => {
        db.query("SELECT * FROM instalaciones WHERE id = ?", [id], (err, rows) => {
            if (err) {
                console.error("Error SQL:", err);
                return resolve(null);
            }
            resolve(rows[0]);
        });
    });
};
















