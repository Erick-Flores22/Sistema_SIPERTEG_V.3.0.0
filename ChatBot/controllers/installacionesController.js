const STATES = require("../flows/states");
const instalacionesService = require("../services/instalacionesService");

module.exports.start = () => ({
    reply: "Perfecto 👍\nPor favor indícame tu *nombre completo*:",
    nextState: STATES.INST_NOMBRE
});

module.exports.guardarNombre = (session, text) => {
    session.data.nombre = text;
    return {
        reply: "Gracias. Ahora envíame tu *número de celular*:",
        nextState: STATES.INST_CELULAR
    };
};

module.exports.guardarCelular = (session, text) => {
    session.data.celular = text;
    return {
        reply: "Perfecto 👍\nAhora indícame la *dirección completa*:",
        nextState: STATES.INST_DIRECCION
    };
};

module.exports.guardarDireccion = async (session, text) => {
    session.data.direccion = text;

    const id = await instalacionesService.registrar(session.data);

    return {
        reply:
`✅ *Solicitud registrada con éxito*  
Tu código de solicitud es: *#${id}*  
Nuestro equipo se comunicará contigo pronto.`,
        end: true
    };
};
