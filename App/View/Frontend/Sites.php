<?php ob_start(); ?>
<?php $title = "ASSCVM - Monuments"; ?>
	<section>
		<h2>Météo de Montségur sur lauzon</h2>
		<div id="Meteo">
			<?php for($i=0;$i<=4;$i++){ ?>
				<article class="MeteoJour">
					<p class="Date"></p>
					<p class="Condition"></p>
					<div class="IconeMeteo"></div>
					<p class="Temp"></p>
				</article>
			<?php } ?>
		</div>
	</section>
	<aside id="Paragraphe">
		<h2>Les monuments de Montségur sur lauzon</h2>
		<p>Montségur sur lauzon dispose de plusieurs monuments, riche en histoire.<br/>
		Découvrez ces patrimoines et leurs secrets en cliquant sur leur photo.<br/>
		Ou venez les découvrir sur place.</p>
	</aside>
	<section>
		<div id="flexChapelle">
			<article class="Chapelle">
				<h3>La Chapelle St Félix</h3>
				<figure>
					<img src="App/Public/Image/ChapelleStFelix/_DSC0140.jpg" alt="Chapelle St Félix" />
				</figure>
			</article>
			<article class="Chapelle">
				<h3>La Chapelle des Barquets</h3>
				<figure>
					<img src="App/Public/Image/ChapelleBarquets/barquets_face.jpg" alt="Chapelle des Barquets" />
				</figure>
			</article>
			<article class="Chapelle">
				<h3>La Chapelle St Claude</h3>
				<figure>
					<img src="App/Public/Image/ChapelleStClaude/_DSC0184.jpg" alt="Chapelle St Claude" />
				</figure>
			</article>
			<article class="Chapelle">
				<h3>La Chapelle St Jean</h3>
				<figure>
					<img src="App/Public/Image/ChapelleStJean/_DSC0134.jpg" alt="Chapelle St Jean" />
				</figure>
			</article>
		</div>
		<article id="Paragraphe">
			<p id="NomChapelle">Cliquez sur une chapelle</p>
			<p id="TexteChapelle"></p>
		</article>
	</section>
	<script src="App/Public/Js/Chapelle.js"></script>
	<script src="App/Public/Js/MeteoJour.js"></script>
	<script src="App/Public/Js/Meteo.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
