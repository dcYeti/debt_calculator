function hiButton(e){
	e.currentTarget.style.backgroundColor = '#20B2AA';
}

function retButton(e){
	e.currentTarget.style.backgroundColor = 'rgb(123,104,238)';
}

var butLoc = document.getElementById("button_left");
butLoc.addEventListener('mouseover', hiButton, false);
butLoc.addEventListener('mouseout', retButton, false);
