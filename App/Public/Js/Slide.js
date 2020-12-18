class Slide{
	constructor{
		let divSlide = document.getElementById("Slide");
	};
	let BtnLeft = document.getElementById("BtnLeft");
	let BtnPlayPause = document.getElementById("BtnPlay_Pause");
	let BtnRight = document.getElementById("BtnRight");
	
	BtnLeft.addEventListener("click",function(){SlideLeft()});
	BtnPlayPause.addEventListener("click",function(){ChangePlayPause()});
	BtnRight.addEventListener("click",function(){SlideRight()});
	
	/*Bouton switch*/
	SlideLeft(){
		this.ImageActuelle--;
		if (this.ImageActuelle < 0){
			this.ImageActuelle = this.cheminImage.length-1;
		}
		this.Image[0].src = this.cheminImage[this.ImageActuelle];
		this.DiaporamaTxt.innerHTML = "<p>" + this.textSlide[this.ImageActuelle] + "</p>";
	}
	SlideRight(){
		this.ImageActuelle++;
		if (this.ImageActuelle>this.cheminImage.length-1){
			this.ImageActuelle=0;
		}
		this.Image[0].src = this.cheminImage[this.ImageActuelle];
		this.DiaporamaTxt.innerHTML = "<p>" + this.textSlide[this.ImageActuelle] + "</p>";
	}
	
	/*Switch Boutton Play/Pause*/
	ChangePlayPause(){
		if (this.Play){
			this.PlayPause.style.backgroundColor = "RGBa(0,0,0,0.4)";
			this.Play = false;
		}
		else{
			this.PlayPause.style.backgroundColor = "white";
			this.Play = true;
		}
	}
};
let maSlide = new Slide();