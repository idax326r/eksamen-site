<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * This is a new template file that WordPress introduced in
 * version 4.3.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>

<style>
#menu-item-20 .text-wrap{
color:#8A4F49;
}
h2 {
  font-family: jubilat, serif;
  font-weight: 400;
  font-style: normal;
  font-size: 2.5rem;
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
max-width:65ch;
  font-family: open-sans, sans-serif;
  font-weight: 400;
  font-style: normal;
  color: black;
}
.book {
background-color: #6e7d75;
  border-radius: 12px;
  text-transform: uppercase;
  font-size: 1.4rem;
  font-family: jubilat, serif;
  font-weight: 400;
  border: 1px solid #6e7d75;
  color:white;
  padding: 8px 17px 8px 17px;
}
.book:hover {
background-color: #8A4F49;
  border: 1px solid #8A4F49;
}
.illustrationer {
max-width: 100%;
/* aspect-ratio: 1/1; */
object-fit: contain;
}
.grid-container {
display: grid;
grid-template-columns: 0.8fr;
gap:15px;
padding: 25px;
}
.luk {
font-family: jubilat, serif;
color:black;
font-weight: 400;
background-color: white;
border: 1px solid white;
margin-left:25px;
font-size:16px;
}
.luk:hover{
color: #8A4F49;
}
/* web version */
@media (min-width: 750px) {
.grid-container {
display: grid;
grid-template-columns: 0.8fr 1.5fr;
gap:15px;
padding-left: 100px;
padding-right:20px;
}
</style>

<section id="primary">
<main id="site-content">
<section class="ydelser-container"></section>
</main><!-- #site-content -->
<article>
<!-- <section id="overskrift">
<h5></h5>
</section> -->
<button class="luk">Tilbage</button>
	<div class="grid-container">
	<div class="grid-item-1">
	<img class= "illustrationer" src="" alt="">
	</div>
		<div class="grid-item-2">
	<h2></h2>
	<h5></h5>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
	<a href="http://struckmanndesign.dk/kea/10_eksamensprojekt/eksamen-wp/kontakt/"><button class="book">BOOK HER</button></a>
	</div>
</div>
	</article>
	</section>
<script>
let ydelse = [];

document.addEventListener("DOMContentLoaded", getJson);

async function getJson() {
	let response = await fetch(`https://struckmanndesign.dk/kea/10_eksamensprojekt/eksamen-wp/wp-json/wp/v2/ydelse/<?php echo get_the_ID() ?>`);
	ydelse = await response.json();
	visYdelse();
} 
// vis data om ydelse
function visYdelse() {
const single = document.querySelector("article");
single.querySelector("h2").innerHTML = ydelse.title.rendered;
single.querySelector("img").src = ydelse.ydelse_billede.guid;
single.querySelector("h5").innerHTML = ydelse.session;
single.querySelector("p").innerHTML = "Varighed: "+ ydelse.varighed;
single.querySelector("p+p").innerHTML = ydelse.beskrivelse;
single.querySelector("p+p+p").innerHTML = ydelse.note;
single.querySelector("p+p+p+p").innerHTML = "Pris: "+ ydelse.pris;
}
document.querySelector(".luk").addEventListener("click", () => {
	// link tilbage til den foregående side på luk knappen
	history.back();
})
</script>
</section>

<?php get_footer(); ?>
