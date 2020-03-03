const mongoose = require('mongoose');

const shiftSchema = mongoose.Schema({
  user_id: { type: Number, required: true},
  date: { type: Date, required: true },
  shifts_type_id: { type: Number, required: true },
  marketplace: { type: Boolean, default: false },
  updated: {type: Date, default: Date.now },
});

module.exports = mongoose.model('Shift', shiftSchema);
