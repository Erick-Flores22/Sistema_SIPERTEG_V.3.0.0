const db = require("../db");   // <-- ESTO ES OBLIGATORIO

module.exports = {

  registrar: (data) => {
    return new Promise((resolve, reject) => {
      db.query(
        "INSERT INTO defectos (nombre, celular, direccion, detalle, observaciones) VALUES (?, ?, ?, ?, ?)",
        [
          data.nombre,
          data.celular,
          data.direccion,
          data.detalle,
          data.observaciones
        ],
        (err, result) => {
          if (err) return reject(err);
          resolve(result.insertId);
        }
      );
    });
  },

  buscarAbonadoPorCI: (ci) => {
    return new Promise((resolve, reject) => {
      db.query(
        "SELECT * FROM abonados WHERE ci = ? LIMIT 1",
        [ci],
        (err, results) => {
          if (err) return reject(err);
          resolve(results[0]);
        }
      );
    });
  }
};
