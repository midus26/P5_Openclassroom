class Chapelle{
	constructor(){
		let NomChapelle = ["Chapelle St Félix","Chapelle des barquets","Chapelle St Claude","Chapelle St Jean"];
		let TexteChapelle = ["La chapelle St Félix culmine à XXXX metre, Il s'agit du point culminant de Montségur sur lauzon",
		"La chapelle des barquets construite en XXXX, etc...",
		"La chapelle St Claude, était un lieu de pelerinnage pour les voyageurs, Ils venaient s'y arrété avant de repartir en direction de St paul 3 Chateaux ou Valréas",
		"La chapelle St Jean. Chaque année à lieu la fête de la St Jean..."];

	let divChapelle = document.getElementsByClassName("Chapelle");
	let divNomChapelle = document.getElementById("NomChapelle");
	let divTexteChapelle = document.getElementById("TexteChapelle");
		
	for (let i=0;i<divChapelle.length;i++){
		divChapelle[i].addEventListener('click', function(){
			divNomChapelle.textContent = NomChapelle[i];
			divTexteChapelle.textContent = TexteChapelle[i];
		});
	}
	};
};
let maChapelle = new Chapelle();