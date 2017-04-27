function openModal(e){
	var btnSelect = e.currentTarget;
	var btnID = btnSelect.getAttribute('id');
	var idLen = btnID.length;
	var debtNo = btnID.substr(10, idLen); //debtNo follows the id string 'detailDebt'
	boxID = 'backdrop';
	boxID = boxID.concat(debtNo);
	document.getElementById(boxID).style.display = "block";
	//assign event listener to close button
	var closeID = 'closebox';
	closeID = closeID.concat(debtNo);
	var closeLoc = document.getElementById(closeID);
	closeLoc.addEventListener('click',closeModal, false);
	closeLoc.addEventListener('mouseover', modalHi, false);
	closeLoc.addEventListener('mouseout', modalRet, false);
}

function closeModal(e){
	var closeLoc = e.currentTarget;
	var closeID = closeLoc.getAttribute('id');
	var closeLen = closeID.length;
	var debtNo = closeID.substr(8, closeLen);
	var modalID = 'backdrop';
	modalID = modalID.concat(debtNo);
	var modalLoc = document.getElementById(modalID);
	modalLoc.style.display = "none";
	e.stopPropogation;	
}

function modalHi(e){
	var boxLoc = e.currentTarget;
	boxLoc.setAttribute('class', 'modal_close_hi');
	e.stopPropagation;
}

function modalRet(e){
	var boxLoc = e.currentTarget;
	boxLoc.setAttribute('class', 'modal_close');
	e.stopPropagation;
}


//Add event listeners to the 'view detail' buttons
function activateDetailButton(numDebts){
	for (var i = 1; i <= numDebts; i++){
		var btnID = 'detailDebt';
		var btnID = btnID.concat(i);
		var btnLoc = document.getElementById(btnID);
		btnLoc.addEventListener('click', openModal, false);
	}
}





