const express = require('express');
const path = require('path');
const PORT = process.env.PORT || 5000;

var exphbs = require ('express-handlebars');

var app = express();

app.engine('handlebars',exphbs({defaultLayout:'main'}));
app.set('view engine','handlebars');

app.get('/',(req,res) => res.render('home'));

var fortune = require('./lib/fortune.js');

app.get('/about',function(req,res){
    res.render('about',{fortune:fortune.getFortune()
    })
})

app.use(express.static(path.join(__dirname,'/public')));

app.listen(PORT, () => console.log(`Listening on ${ PORT }`));



