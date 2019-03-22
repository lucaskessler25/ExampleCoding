const mysql = require('mysql');
const http = require('http');
const fs = require('fs');
const port = 3000;

const requestHandler = (request, response) => {
  console.log(request.url)
  var con = mysql.createConnection({
  host: "127.0.0.1",
  user: "root",
  password: "root",
  database: "draft"
});

con.connect(function(err) {
  if (err) throw err;
  con.query("SELECT * FROM players LIMIT 1", function (err, result, fields) {
    if (err) throw err;
    console.log(result[0].Name);
	fs.writeFile("../test.txt", result[0].Name, function(err) {
    if(err) {
        return console.log(err);
    }
    console.log("The file was saved!");
	}); 
  });
});
}

const server = http.createServer(requestHandler);

server.listen(port, (err) => {
  if (err) {
    return console.log('something bad happened', err);
  }
});

