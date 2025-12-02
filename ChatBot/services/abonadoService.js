const db = require("../db");

// Normaliza CI → solo números
function normalizeCI(ci) {
  if (!ci) return "";
  return ci.toString().replace(/\D/g, ""); 
}

async function buscarPorCI(ciRaw) {
  const ci = normalizeCI(ciRaw);

  console.log("buscarPorCI() CI recibido:", ciRaw, "→ normalizado:", ci);

  return new Promise((resolve) => {
    // Primer intento: coincidencia exacta
    const sql1 = `
      SELECT *
      FROM abonados
      WHERE REPLACE(REPLACE(\`ci\`, '.', ''), ' ', '') = ?
      LIMIT 1
    `;

    db.query(sql1, [ci], (err, rows) => {
      if (err) {
        console.error("Error SQL exacto:", err);
        return resolve(null);
      }

      if (rows && rows.length > 0) {
        console.log("Encontrado EXACTO:", rows[0]);
        return resolve(rows[0]);
      }

      // Segundo intento: búsqueda flexible
      const sql2 = `
        SELECT *
        FROM abonados
        WHERE \`ci\` LIKE ?
        LIMIT 1
      `;

      db.query(sql2, [`%${ci}%`], (err2, rows2) => {
        if (err2) {
          console.error("Error SQL LIKE:", err2);
          return resolve(null);
        }

        if (rows2 && rows2.length > 0) {
          console.log("Encontrado LIKE:", rows2[0]);
          return resolve(rows2[0]);
        }

        console.log("No se encontró abonado con CI:", ci);
        return resolve(null);
      });
    });
  });
}

module.exports = { buscarPorCI, normalizeCI };
