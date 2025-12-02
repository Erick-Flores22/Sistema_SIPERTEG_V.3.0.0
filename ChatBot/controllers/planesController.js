const db = require("../db");

module.exports.mostrarPlanes = () => {
    return new Promise((resolve, reject) => {
        db.query("SELECT * FROM planes ORDER BY precio_mensual ASC", (err, rows) => {
            if (err) {
                console.error("Error SQL:", err);
                return resolve("❌ Error al obtener los planes.");
            }

            let msg = "📦 *Planes disponibles*\n\n";

            rows.forEach(p => {
                msg +=
`🏷 *${p.nombre}*
💵 Mensualidad: ${p.precio_mensual} Bs
⚡ Velocidad: ${p.velocidad_megas} Mbps
📺 TV: ${p.dispositivos_tv} dispositivos
💻 PC: ${p.dispositivos_pc} dispositivos
📱 Celular: ${p.dispositivos_celular} dispositivos
🔧 Instalación: ${p.precio_instalacion} Bs

`;
            });

            msg += "Escribe *menu* para volver al inicio.";

            resolve(msg);
        });
    });
};
