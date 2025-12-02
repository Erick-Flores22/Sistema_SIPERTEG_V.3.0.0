function isNumeric(str) {
  return /^[0-9]+$/.test(str);
}

// CI típico en Bolivia puede variar, pero aceptamos 6-10 dígitos.
function isCI(str) {
  return isNumeric(str) && str.length >= 6 && str.length <= 10;
}

module.exports = { isNumeric, isCI };
