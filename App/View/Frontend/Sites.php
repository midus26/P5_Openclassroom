<?php ob_start(); ?>
<?php $title = "ASSCVM - Monuments"; ?>
	<h2>Météo de Montségur sur lauzon</h2>
	<div id="Meteo">
		<?php for($i=0;$i<=4;$i++){ ?>
			<div class="MeteoJour">
				<p class="Date"></p>
				<p class="Condition"></p>
				<div class="IconeMeteo"></div>
				<p class="Temp"></p>
			</div>
		<?php } ?>
	</div>
	<h2>Les monuments de Montségur sur lauzon</h2>
	<div id="Paragraphe">
		<p>Montségur sur lauzon dispose de plusieurs monuments, riche en histoire.<br/>
		Découvrez ces patrimoines et leurs secrets en cliquant sur leur photo.<br/>
		Ou venez les découvrir sur place.</p>
	</div>
	<div id="flexChapelle">
		<div class="Chapelle">
			<h3>La Chapelle St Félix</h3>
			<img src="App/Public/Image/ChapelleStFelix/_DSC0140.jpg" alt="Chapelle St Félix" />
		</div>
		<div class="Chapelle">
			<h3>La Chapelle des Barquets</h3>
			<img src="App/Public/Image/ChapelleBarquets/barquets_face.jpg" alt="Chapelle des Barquets" />
		</div>
		<div class="Chapelle">
			<h3>La Chapelle St Claude</h3>
			<img src="App/Public/Image/ChapelleStClaude/_DSC0184.jpg" alt="Chapelle St Claude" />
		</div>
		<div class="Chapelle">
			<h3>La Chapelle St Jean</h3>
			<img src="App/Public/Image/ChapelleStJean/_DSC0134.jpg" alt="Chapelle St Jean" />
		</div>
	</div>
	<div id="Paragraphe">
		<p id="NomChapelle">Cliquez sur une chapelle</p>
		<p id="TexteChapelle"></p>
	</div>
	<script src="App/Public/Js/Chapelle.js"></script>
	<script src="App/Public/Js/MeteoJour.js"></script>
	<script src="App/Public/Js/Meteo.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
