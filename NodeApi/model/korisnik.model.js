const mongoose = require("mongoose");

var UsersSchema = mongoose.Schema({
  id: {
    type: String,
  },
  username: {
    type: String,
  },
  email: {
    type: String,
  },
  password: {
    type: String,
  },
  is_admin: {
    type: String,
  },
});

module.exports = mongoose.model("Korisnik", UsersSchema);
