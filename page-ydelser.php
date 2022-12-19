<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>

<style>
h1 {
  font-family: jubilat, serif;
  font-weight: 400;
  font-style: normal;
  font-size: 2.5rem;
  color: black;
}
#overskrift {
margin-left:40px;
margin-top:60px;
}
img {
max-width: 100%;
/* aspect-ratio: 1/1; */
object-fit: contain;
}
#filtrering {
text-align:center;
margin: 40px;
font-size:1.4rem;
}
.filter {
margin-left:10px;
}
button {
background-color: white;
border: 1px solid white;
color: black;
font-family: jubilat, serif;
font-weight: 400;
}
article {
background-color: #E6E3DD;   
cursor: pointer;
position: relative;
/* text-align: center; */
color: white;
grid-area: 1/1;
padding: 20px;
}
.ydelser-container {
display: grid;
grid-template-columns: 1fr;
place-items: center;
gap: 20px;
cursor: pointer;
margin-left:40px;
margin-right:40px;
margin-bottom: 30px;
}
.grid-container {
	display: grid;
	gap:20px;
	grid-template-columns:0.5fr 1fr;

}
.grid-1, .grid-2 {
place-self: center;
}
/* skrifttyper */
h4{
  font-family: jubilat, serif;
  font-weight: 400;
  font-style: normal;
  font-size: 1.8rem;
  color: black;
}
h5{
  font-family: jubilat, serif;
  font-weight: 400;
  font-style: normal;
  font-size: 1.6rem;
  color: black;
}
p {
  font-family: open-sans, sans-serif;
  font-weight: 400;
  font-style: normal;
  color: black;
}

/* ipad version */
@media (min-width: 750px) {
.ydelser-container {
display: grid;
grid-template-columns: repeat(2, 1fr);
place-items: center;
cursor: pointer;
margin-bottom: 50px;
margin-left:80px;
margin-right:80px;
}
#overskrift {
margin-left:80px;
margin-top:60px;
}
article {
cursor: pointer;
position: relative;

color: white;
grid-area: 1/1;
padding: 20px;
}
#filtrering {
margin: 50px;
font-size:1.6rem;
}
}

/* web version */
@media (min-width: 1000px) {
.ydelser-container {
display: grid;
grid-template-columns: repeat(2, 1fr);
place-items: center;
cursor: pointer;
margin-bottom: 50px;
margin-left:200px;
margin-right:200px;
}
#overskrift {
margin-left:200px;
margin-top:60px;
}
article {  
cursor: pointer;
position: relative;
color: white;
grid-area: 1/1;
border:none;
margin: 0px;
}
.article-container {
border:none;
}
.grid-container {
display: grid;
grid-template-columns:0.5fr 1fr;
}
h4{
  font-size: 2.2rem;
}
#filtrering {
margin: 50px;
font-size:1.8rem;
}
}

article:hover{
background-color:#E6E3DD80;
}

button:hover{
color: #8A4F49;
}

</style>

<section id="primary" class="content-area">
<main id="site-content">
<section id="overskrift">
<h1>Ydelser</<h1>
</section>
<nav id="filtrering"><button data-ydelse="alle">Alle ydelser</button></nav>
<section class="ydelser-container"></section>
</main><!-- #site-content -->
<template class="ydelser-template">
	<div class="article-container">
	<article class = "grid-container">
	<div class ="grid-1">
	<img src="" alt="">
	</div>
	<div class ="grid-2">
	<h4></h4>
	<h5></h5>
	</div>
	</article>
	</div>
</template>

<script>
let ydelser = [];
let categories = [];
const liste = document.querySelector(".ydelser-container");
const template = document.querySelector(".ydelser-template");
let filterYdelser = "alle";
document.addEventListener("DOMContentLoaded", start);

function start() {
	getJson();
} 

// find url til json
const url = "https://struckmanndesign.dk/kea/10_eksamensprojekt/eksamen-wp/wp-json/wp/v2/ydelse?per_page=100";
const catUrl = "https://struckmanndesign.dk/kea/10_eksamensprojekt/eksamen-wp/wp-json/wp/v2/categories";

// hent json
async function getJson() {
	let response = await fetch(url);
	let catResponse = await fetch(catUrl);
	// putter dem ind i en variabel -> får det vist som json
	ydelser = await response.json();
	categories = await catResponse.json();
	console.log(categories);
	// kald funktion
	visYdelser();
	opretKnapper();
}

function opretKnapper() {
categories.forEach(cat =>{
document.querySelector("#filtrering").innerHTML += `<button class="filter" data-ydelse="${cat.id}">${cat.name}</button>`
	})
addEventListenersToButtons();
}
function addEventListenersToButtons(){
	document.querySelectorAll("#filtrering button").forEach(elm =>{
		elm.addEventListener("click", filtrering);
	})
}

function filtrering(){
	filterYdelser = this.dataset.ydelse;
	console.log("KNAP EVT",filterYdelser)
	visYdelser();


}

function visYdelser() {
	liste.innerHTML = "";	// HTML indhold tømmes før der fyldes indhold ind i den
	ydelser.forEach(ydelse => { // array'et ydelser løbes igennem og hver ydelse indsætte i HTML
	if (filterYdelser == "alle" || ydelse.categories.includes(parseInt(filterYdelser))){ // parseInt betyder fortolk det her som et tal.
	const klon = template.cloneNode(true).content; 	// HTML template klones og fyldes med indhold 
	klon.querySelector("h4").innerHTML = ydelse.title.rendered;
	klon.querySelector("h5").innerHTML = ydelse.session;
	klon.querySelector("img").src = ydelse.ydelse_billede.guid;
	klon.querySelector("article").addEventListener("click", ()=> {location.href = ydelse.link})
	// klonen tilføjes til DOM'en
	liste.appendChild(klon);
	}
	})
}

</script>
</section>
<?php get_footer(); ?>
