/** I-73797 test helper */
function formatPercent(value, total) {
  if (!total) return '0%';
  return Math.round((value / total) * 100) + '%';
}

module.exports = { formatPercent };
