const accounting = require('@/accountingjs/accounting');

const filters = {
  toUSD (amount) {
    if (amount)
      return accounting.formatMoney(amount);

    return '$0.00';
  },
  localeDate(date) {
    if (date)
      return new Date(date).toLocaleDateString();

    return date;
  }
};

export default filters;