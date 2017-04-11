<?php
class academic { //Objeto academico
    var $period; //Atributo periodo 
    var $month;  //Atributo mes
    var $year;   //Atributo día
    
    //Clase academic, la función al llamarse igual que la clase se llama por defecto
    function academic( $period = "Start") { //Start es valor por defecto
        $this->period = $period;
    }
    function setMonth($month) {
        $this->month = $month; 
    } 
    function setYear($year) { 
        $this->year = $year;  
    } 
}
// create an objects
//Observa el valor por defecto
$default = new academic();

echo($default->period);

$inicio = new academic('Inicio');
$inicio->setMonth("abril");
$inicio->setYear(2017);

$final = new academic('Final');
$final->setMonth("septiembre");
$final->setYear(2018);


// show object properties
echo('<ul>');
echo('<li>');
    //print_r($inicio);  //ver todos los objeto creados.
echo('</li>');
echo('<li>');
    echo($inicio->period . ': '. $inicio->month . '/' . $inicio->year);
echo('</li>');
echo('<li>');
    //print_r($final);
echo('</li>');
echo('<li>');
    echo($final->period . ': '. $final->month . '/' . $final->year);
echo('</li>');
echo('<ul>');
?>