class MeteoJour{
	constructor(NomJour,DateJour,ConditionJour,IconeJour,TempMinJour,TempMaxJour){
		this.NomJour = NomJour;
		this.DateJour = DateJour;
		this.ConditionJour = ConditionJour;
		this.IconeJour = IconeJour;
		this.TempMinJour = TempMinJour;
		this.TempMaxJour = TempMaxJour;
	};
	Affichage(){
		const divMeteo = document.getElementById("Meteo");
		let divDate = document.getElementsByClassName('Date');
		let divCondition = document.getElementsByClassName('Condition');
		let divImg = document.getElementsByClassName('IconeMeteo');
		let divTemp = document.getElementsByClassName('Temp');
		
		for(let i=0;i<this.NomJour.length;i++){
			divDate[i].textContent = this.NomJour[i] + ' ' + this.DateJour[i];
			divCondition[i].textContent = this.ConditionJour[i];
			divImg[i].innerHTML = '<img src="' + this.IconeJour[i] + '" alt="IconeMeteo" />' ;
			divTemp[i].textContent = this.TempMinJour[i] + '°C' + ' / ' + this.TempMaxJour[i] + '°C' ;
		}
	}
};