// Guarda el estado de cada usuario (qué paso está contestando)
const sessions = {};

function getSession(user) {
  if (!sessions[user]) sessions[user] = { step: 0, type: null, data: {} };
  return sessions[user];
}

function resetSession(user) {
  delete sessions[user];
}

module.exports = { getSession, resetSession };
