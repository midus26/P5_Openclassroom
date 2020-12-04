class Meteo{
	constructor(){
		var request = new XMLHttpRequest();
		request.onreadystatechange = function(){
			if(this.readyState == XMLHttpRequest.DONE && this.status == 200){
				var reponse = JSON.parse(this.responseText);
				let maMeteoJour = new MeteoJour(
					[reponse.fcst_day_0.day_long,reponse.fcst_day_1.day_long,reponse.fcst_day_2.day_long,reponse.fcst_day_3.day_long,reponse.fcst_day_4.day_long],//Jour en lettre
					[reponse.fcst_day_0.date,reponse.fcst_day_1.date,reponse.fcst_day_2.date,reponse.fcst_day_3.date,reponse.fcst_day_4.date],//Jour format date
					[reponse.fcst_day_0.condition,reponse.fcst_day_1.condition,reponse.fcst_day_2.condition,reponse.fcst_day_3.condition,reponse.fcst_day_4.condition],//Nom de la condition meteo
					[reponse.fcst_day_0.icon,reponse.fcst_day_1.icon,reponse.fcst_day_2.icon,reponse.fcst_day_3.icon,reponse.fcst_day_4.icon],//Icone de la condition meteo
					[reponse.fcst_day_0.tmin,reponse.fcst_day_1.tmin,reponse.fcst_day_2.tmin,reponse.fcst_day_3.tmin,reponse.fcst_day_4.tmin],//Temperature Minimal
					[reponse.fcst_day_0.tmax,reponse.fcst_day_1.tmax,reponse.fcst_day_2.tmax,reponse.fcst_day_3.tmax,reponse.fcst_day_4.tmax]);//Temperature Maximal
					maMeteoJour.Affichage();
			}
		}
		request.open('GET','https://www.prevision-meteo.ch/services/json/montsegur-sur-lauzon');
		request.send();
	};
};
let maMeteo = new Meteo();