//var express = require('express');
//var exphbs = require('express-handlebars');



var http = require('http');

http.createServer(
 function(req, res){
     res.writeHead(200,{'Content-Type':'text plain'});
     res.end('Hello World');
 }     
 ).listen(3000);
console.log("Servidor en el puerto localhost:3000");