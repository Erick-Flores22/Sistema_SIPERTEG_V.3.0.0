const express = require("express");
const bodyParser = require("body-parser");
const { getSession, resetSession } = require("./session/sessionManager");
const STATES = require("./flows/states");
const { sendXml } = require("./utils/reply");
const { isCI } = require("./utils/validator");

const menuController = require("./controllers/menuController");
const planesController = require("./controllers/planesController");
const instalacionesController = require("./controllers/installacionesController");
const estadosController = require("./controllers/estadosController");
const fallasController = require("./controllers/fallasController");

const app = express();
app.use(bodyParser.urlencoded({ extended: false }));

app.post("/webhook", async (req, res) => {
  try {
    const from = req.body.From || req.body.from || "unknown";
    const raw = (req.body.Body || req.body.body || "").trim();
    const msg = raw;
    const session = getSession(from);

    // === VOLVER AL MENÚ ===
    if (msg.toLowerCase() === "menu") {
      resetSession(from);
      return sendXml(res, menuController.showMenu().reply);
    }

    // === ESTADO INICIAL ===
    if (session.state === STATES.MENU) {
      // OPCIÓN 1 — PLANES
      if (msg === "1") {
        const text = await planesController.mostrarPlanes();
        sendXml(res, text);
        return resetSession(from);
      }

      // OPCIÓN 2 — INSTALACIÓN
      if (msg === "2") {
        const { reply, nextState } = instalacionesController.start();
        session.state = nextState;
        return sendXml(res, reply);
      }

      // OPCIÓN 3 — CONSULTAR INSTALACIÓN
      if (msg === "3") {
        const obj = estadosController.pedirCodigoInstalacion();
        session.state = obj.nextState;
        return sendXml(res, obj.reply);
      }

      // OPCIÓN 4 — FALLAS
      if (msg === "4") {
        const obj = fallasController.iniciar();
        session.state = obj.nextState;
        return sendXml(res, obj.reply);
      }

      // OPCIÓN 5 — CONSULTAR REPORTE
      if (msg === "5") {
        const obj = estadosController.pedirCodigoReporte();
        session.state = obj.nextState;
        return sendXml(res, obj.reply);
      }

      // Cualquier otra cosa → Reenviar menú
      return sendXml(res, menuController.showMenu().reply);
    }

    // ================= INSTALACIONES =================
    if (session.state === STATES.INST_NOMBRE) {
      const r = instalacionesController.guardarNombre(session, msg);
      session.state = r.nextState;
      return sendXml(res, r.reply);
    }

    if (session.state === STATES.INST_CELULAR) {
      const r = instalacionesController.guardarCelular(session, msg);
      session.state = r.nextState;
      return sendXml(res, r.reply);
    }

    if (session.state === STATES.INST_DIRECCION) {
      const r = await instalacionesController.guardarDireccion(session, msg);
      sendXml(res, r.reply);
      resetSession(from);
      return;
    }

    // ================= CONSULTA DE INSTALACIÓN =================
    if (session.state === STATES.CONSULTA_INSTALACION) {
      const reply = await estadosController.buscarInstalacion(msg);
      sendXml(res, reply);
      resetSession(from);
      return;
    }

    // ================= CONSULTA DE REPORTE =================
    if (session.state === STATES.CONSULTA_REPORTE) {
      const reply = await estadosController.buscarReporte(msg);
      sendXml(res, reply);
      resetSession(from);
      return;
    }

    // ================= FALLAS =================
    if (session.state === STATES.FALLA_PEDIR_CI) {
      if (!isCI(msg)) {
        return sendXml(res, "⚠️ El CI debe tener solo números (6 a 10 dígitos).");
      }
      const r = await fallasController.validarCI(session, msg);
      session.state = r.nextState;
      return sendXml(res, r.reply);
    }

    if (session.state === STATES.FALLA_MENU) {
      const r = fallasController.menuFallas(session, msg);
      if (r.nextState) session.state = r.nextState;
      return sendXml(res, r.reply);
    }

    if (session.state === STATES.FALLA_LUZ_ROJA) {
      const r = fallasController.luzRoja(session, msg);
      if (r.nextState) session.state = r.nextState;
      return sendXml(res, r.reply);
    }

    if (session.state === STATES.FALLA_LUZ_PON) {
      const r = fallasController.luzPON(session, msg);
      if (r.nextState) session.state = r.nextState;
      return sendXml(res, r.reply);
    }

    if (session.state === STATES.FALLA_WIFI) {
      const r = fallasController.luzWiFi(session, msg);
      if (r.nextState) session.state = r.nextState;
      return sendXml(res, r.reply);
    }

    if (session.state === STATES.FALLA_SOLUCION) {
      const r = await fallasController.generarReporte(session, msg);
      if (r.nextState) session.state = r.nextState;
      sendXml(res, r.reply);
      if (session.state === STATES.MENU) resetSession(from);
      return;
    }

    if (session.state === STATES.FALLA_DETALLE) {
      if (msg === "1") {
        const r = await fallasController.generarReporte(session, "2");
        sendXml(res, r.reply);
        resetSession(from);
        return;
      } else {
        sendXml(res, "Entendido. Si necesitas algo más escribe *menu*.");
        resetSession(from);
        return;
      }
    }

    // Cualquier cosa fuera de los estados → Menú
    sendXml(res, menuController.showMenu().reply);
    resetSession(from);

  } catch (err) {
    console.error("ERROR webhook:", err);
    res.set("Content-Type", "text/xml");
    res.send(`<Response><Message>😞 Ocurrió un error inesperado.</Message></Response>`);
  }
});

app.listen(3000, () => {
  console.log("🚀 Bot de SIPERTEG activo en puerto 3000");
});
