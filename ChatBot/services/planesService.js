const db = require("./db");

async function obtenerPlanes() {
  const rows = await db.query("SELECT * FROM planes ORDER BY precio_mensual ASC");
  return rows;
}

module.exports = { obtenerPlanes };
