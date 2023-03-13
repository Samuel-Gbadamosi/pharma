// created variable for timeout
//time out variables created
var myTimeOut;

 myTimeOut = setTimeout(myGreeting , 2000);

 myTimeOut2 = setTimeout(mysecondsli , 3000);

 //functions to display timeout on each element in slider
 function mysecondsli(){
     document.getElementById('crick').innerHTML = "Explore and feel inspired";
 }
//greeting on webelement
 function myGreeting(){
     document.getElementById("greet").innerHTML = "Enjoy your stay on our Website";
 }
 //stop fucntion to be callled
 function myStopFunction(){
     clearTimeout(myTimeOut);
 }





