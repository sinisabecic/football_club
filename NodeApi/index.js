const connection = require("./model");
const express = require("express");
const application = express();
const path = require("path");
const expressHandlebars = require("express-handlebars");

application.use(express.json());

const usersRouter = require("./routes/users");
application.use("/users", usersRouter);

application.listen("3000", () => {
  console.log("Server started");
});
