const accounting = require('@/accountingjs/accounting');

const filters = {
  toUSD (amount) {
    if (amount)
      return accounting.formatMoney(amount);

    return '$0.00';
  },
};

export default filters;