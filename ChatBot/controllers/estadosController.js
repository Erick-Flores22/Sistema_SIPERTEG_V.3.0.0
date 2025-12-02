const STATES = require("../flows/states");
const instalacionesService = require("../services/instalacionesService");

module.exports.pedirCodigoInstalacion = () => ({
    reply: "Por favor envíame el *código de tu solicitud*:",
    nextState: STATES.CONSULTA_INSTALACION
});

module.exports.buscarInstalacion = async (codigo) => {
    const data = await instalacionesService.buscarPorId(codigo);

    if (!data)
        return "❌ No encontré una solicitud con ese código.";

    return `Estado de tu solicitud: *${data.estado}*\n📝 ${data.observaciones || "Sin observaciones."}`;
};
