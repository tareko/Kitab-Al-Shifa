const mongoose = require('mongoose');
const db = mongoose.connection;

const userSchema = mongoose.Schema({
  user_id: { type: Number, required: true},
  name: { type: String, required: true },
  email: { type: Number, required: true },
  tel: { type: Number, default: false },
  pager: { type: Number, default: false },
  communication_prefs: {type: String, default: false },
  updated: {type: Date, default: Date.now },
});

module.exports = db.model('User', userSchema);
