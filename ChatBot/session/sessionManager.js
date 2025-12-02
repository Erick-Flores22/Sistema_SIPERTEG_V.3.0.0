const STATES = require("../flows/states");

const sessions = new Map();

// Devuelve la sesión (crea si no existe)
function getSession(from) {
  if (!sessions.has(from)) {
    sessions.set(from, {
      from,
      state: STATES.MENU,
      data: {},
      errors: 0
    });
  }
  return sessions.get(from);
}

function resetSession(from) {
  sessions.set(from, {
    from,
    state: STATES.MENU,
    data: {},
    errors: 0
  });
}

module.exports = { getSession, resetSession };
