const STATES = require("../flows/states");
const abonadoService = require("../services/abonadoService");
const fallasService = require("../services/fallasService");

// ==================== INICIO ====================
module.exports.iniciar = () => ({
    reply: "Perfecto 👍\nPara comenzar necesito tu *número de CI*:",
    nextState: STATES.FALLA_PEDIR_CI
});

// ==================== VALIDAR CI ====================
module.exports.validarCI = async (session, ci) => {
    const abonado = await abonadoService.buscarPorCI(ci);

    if (!abonado) {
        return {
            reply: "❌ No encontré un cliente con ese CI.\nRevísalo e inténtalo de nuevo.",
            nextState: STATES.FALLA_PEDIR_CI
        };
    }

    // Guardar abonado
    session.data.abonado = abonado;

    // Registrar pasos realizados
    session.data.hizoReinicio = false;
    session.data.tocoConector = false;
    session.data.revisoWIFI = false;

    return {
        reply:
`Muy bien *${abonado.nombre}* 😊

Vamos a revisar tu router paso a paso.

Dime, ¿qué está pasando?

1️⃣ No aparece mi WiFi  
2️⃣ Tengo WiFi pero *no tengo Internet*  
3️⃣ El Internet está lento  
4️⃣ Hay una *luz roja*  
5️⃣ No sé qué está pasando`,
        nextState: STATES.FALLA_MENU
    };
};

// ==================== MENÚ DE FALLAS ====================
module.exports.menuFallas = (session, opcion) => {

    if (!["1","2","3","4","5"].includes(opcion))
        return { reply: "⚠️ Por favor elige un número del *1 al 5*." };

    switch (opcion) {

        case "4":
            return {
                reply:
`Perfecto 😊

Mira la luz que dice *LOS* (debajo del foquito está el nombre).

¿Esa luz está encendida o parpadeando en **rojo**?

1️⃣ Sí, está en rojo  
2️⃣ No, no está roja`,
                nextState: STATES.FALLA_LUZ_ROJA
            };

        case "1":
            return {
                reply:
`Vamos a revisar tu WiFi 😊

Busca la luz que dice *WiFi*.

¿Esa luz está?

1️⃣ Encendida  
2️⃣ Apagada  
3️⃣ No encuentro esa luz`,
                nextState: STATES.FALLA_WIFI
            };

        case "2":
            return manejarSinInternet(session);

        case "3":
            return {
                reply:
`Vamos a ver si la fibra está llegando bien.

Mira la luz que dice *PON*:

1️⃣ Está prendida normal  
2️⃣ Está parpadeando rápido  
3️⃣ Está apagada  
4️⃣ No encuentro esa luz`,
                nextState: STATES.FALLA_LUZ_PON
            };

        case "5":
            return {
                reply:
`No te preocupes 😊

Vamos a comenzar revisando la luz que dice *LOS*:

1️⃣ Está roja  
2️⃣ No está roja`,
                nextState: STATES.FALLA_LUZ_ROJA
            };
    }
};

// ==================== LUZ ROJA ====================
module.exports.luzRoja = (session, opcion) => {

    if (opcion !== "1" && opcion !== "2")
        return { reply: "⚠️ Responde solo *1* o *2*." };

    if (opcion === "1") {
        return {
            reply:
`La luz *LOS* roja significa que la fibra está desconectada o dañada.

Antes de llamar al técnico, intentemos algo:

👉 Busca el conector *verde* que entra al router  
👉 Empújalo *suavemente* hacia adentro (sin fuerza)  

Dime:

1️⃣ La luz roja se apagó  
2️⃣ Sigue roja`,
            nextState: STATES.FALLA_SOLUCION,
            action: () => session.data.tocoConector = true
        };
    }

    if (opcion === "2") {
        return {
            reply:
`Perfecto 👍  

Ahora revisa la luz *PON*:

1️⃣ Está prendida normal  
2️⃣ Parpadea rápido  
3️⃣ Está apagada  
4️⃣ No encuentro esa luz`,
            nextState: STATES.FALLA_LUZ_PON
        };
    }
};

// ==================== LUZ PON ====================
module.exports.luzPON = (session, opcion) => {

    if (!["1","2","3","4"].includes(opcion))
        return { reply: "⚠️ Responde solo 1, 2, 3 o 4." };

    if (opcion === "2") {
        session.data.tocoConector = true;
        return {
            reply:
`Eso indica que el conector está flojo.

👉 Empuja suavemente el conector verde hacia adentro  
(No uses fuerza)

Dime:

1️⃣ Ya quedó fija  
2️⃣ Sigue parpadeando`,
            nextState: STATES.FALLA_SOLUCION
        };
    }

    if (opcion === "3") {
        return {
            reply:
`La luz *PON apagada* significa que *no llega señal a tu zona*.

¿Quieres generar un reporte para que el técnico revise?

1️⃣ Sí  
2️⃣ No`,
            nextState: STATES.FALLA_DETALLE
        };
    }

    if (opcion === "1") {
        return {
            reply:
`Perfecto 👍  
La señal llega bien.

Ahora revisa la luz *WiFi*:

1️⃣ Encendida  
2️⃣ Apagada  
3️⃣ No encuentro esa luz`,
            nextState: STATES.FALLA_WIFI
        };
    }

    return { reply: "Elige una opción válida." };
};

// ==================== WIFI ====================
module.exports.luzWiFi = (session, opcion) => {

    if (!["1","2","3"].includes(opcion))
        return { reply: "⚠️ Responde solo 1, 2 o 3." };

    if (opcion === "2") {
        session.data.revisoWIFI = true;
        return {
            reply:
`Si la luz WiFi está apagada es porque se presionó el botón *WPS*.

👉 Presiona UNA sola vez el botón WPS  
❗ No mantener presionado  
❗ No tocar el botón RST  

Dime:

1️⃣ Ya aparece mi WiFi  
2️⃣ No aparece`,
            nextState: STATES.FALLA_SOLUCION
        };
    }

    if (opcion === "1") {
        return manejarSinInternet(session);
    }

    return {
        reply: "Revisa bien y responde 1 o 2."
    };
};

// ==================== INTERNET PERO SIN SERVICIO ====================
function manejarSinInternet(session) {
    const abonado = session.data.abonado;

    if (abonado.estado === "inactivo") {
        return {
            reply:
`Tu servicio está *cortado por falta de pago*.

Si deseas saber tu último pago escribe: *ultimo pago*

Para habilitar el servicio comunícate a:  
📞 77259532`,
            nextState: STATES.MENU
        };
    }

    session.data.hizoReinicio = true;

    return {
        reply:
`Vamos a reiniciar tu router 😊

👉 Apágalo  
👉 Espera 10 segundos  
👉 Enciéndelo  

Dime:

1️⃣ Ya tengo Internet  
2️⃣ Sigue igual`,
        nextState: STATES.FALLA_SOLUCION
    };
}

// ==================== GENERAR REPORTE ====================
module.exports.generarReporte = async (session, respuesta) => {

    if (respuesta !== "1" && respuesta !== "2") {
        return {
            reply: "⚠️ Responde solo 1 o 2.",
            nextState: STATES.FALLA_SOLUCION
        };
    }

    if (respuesta === "1") {
        return {
            reply: "🎉 ¡Excelente! Me alegra que ya funcione 😊\nEscribe *menu* si necesitas más ayuda.",
            nextState: STATES.MENU
        };
    }

    // Verificar si hizo pasos previos
    if (
        !session.data.hizoReinicio &&
        !session.data.tocoConector &&
        !session.data.revisoWIFI
    ) {
        return {
            reply:
`⚠️ Aún no realizamos los pasos necesarios.

Por favor vuelve al menú escribiendo *menu* y sigue las instrucciones.`,
            nextState: STATES.MENU
        };
    }

    const a = session.data.abonado;

    const id = await fallasService.registrar({
        nombre: a.nombre,
        celular: a.telefono1,
        direccion: `${a.zona} ${a.calle} ${a.numero_casa}`,
        detalle: "Reporte automático del chatbot",
        observaciones: "Pendiente"
    });

    return {
        reply:
`📄 *Reporte generado correctamente*

Código del reporte: *#${id}*

Un técnico se comunicará contigo pronto.`,
        nextState: STATES.MENU
    };
};
