const mongoose = require("mongoose");

mongoose.connect(
  "mongodb://localhost:27017/KlubKorisnici",
  { useNewUrlParser: true, useUnifiedTopology: true },
  (error) => {
    if (!error) {
      console.log("Success Connected");
    } else {
      console.log("Error");
    }
  }
);

const Users = require("./korisnik.model");
