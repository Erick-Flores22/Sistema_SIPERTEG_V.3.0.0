const STATES = require("../flows/states");

module.exports.showMenu = () => {
    return {
        reply: 
`👋 Hola, soy el asistente técnico de *SIPERTEG* 🛜

1️⃣ Planes de Internet  
2️⃣ Solicitar instalación  
3️⃣ Revisar solicitud de instalación  
4️⃣ Tengo problemas con mi Internet  
5️⃣ Revisar estado de un reporte

Escribe el número de la opción:`,
        nextState: STATES.MENU
    };
};
