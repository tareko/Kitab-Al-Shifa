const mongoose = require('mongoose');
const db = mongoose.connection;

const oncallSchema = mongoose.Schema({
  user_name: { type: String, required: true},
  date: { type: Date, required: true },
  shift_start_time: { type: String, required: true },
  message: { type: String, default: false },
  updated: {type: Date, default: Date.now },
});

module.exports = db.model('Oncall', oncallSchema);
