// funciones de respuesta XML para Twilio (escapa XML)
function xmlEscape(text) {
  if (!text) return '';
  return text
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');
}

function sendXml(res, text) {
  const safe = xmlEscape(text);
  res.set('Content-Type', 'text/xml');
  res.send(`<Response><Message>${safe}</Message></Response>`);
}

module.exports = { sendXml };
