const defaultImage = "Images/Mobile/img1.jpg"
const black = "Images/Mobile/img7.jpg";
const yellow = "Images/Mobile/img6.jpg";
const blue = "Images/Mobile/img8.jpg";
let eventClickChecker = false;
let eventValue = null;
const eventStyle = "1px solid #F57224";
const eventDefaultStyle = "1px solid #C9C9C9";
let eventStyleOrganizer = false;
let eventHoverChecker = 0;

//On-click Events by the Users
function clickBlack() {
	document.getElementById("prod-img").src = black;
	if(eventStyleOrganizer == false) {
		document.getElementById("click-black").style.border = eventStyle;
		eventStyleOrganizer = true;
	} else {
		document.getElementById("click-black").style.border = eventStyle;
		document.getElementById("click-yellow").style.border = eventDefaultStyle;
		document.getElementById("click-blue").style.border = eventDefaultStyle;
	}
	eventClickChecker = true;
	eventValue = black;
	eventHoverChecker = 1;
}

function clickYellow() {
	document.getElementById("prod-img").src = yellow;
	if(eventStyleOrganizer == false) {
		document.getElementById("click-yellow").style.border = eventStyle;
		eventStyleOrganizer = true;
	} else {
		document.getElementById("click-yellow").style.border = eventStyle;
		document.getElementById("click-black").style.border = eventDefaultStyle;
		document.getElementById("click-blue").style.border = eventDefaultStyle;
	}
	eventClickChecker = true;
	eventValue = yellow;
	eventHoverChecker = 2;
}

function clickBlue() {
	document.getElementById("prod-img").src = blue;
	if(eventStyleOrganizer == false) {
		document.getElementById("click-blue").style.border = eventStyle;
		eventStyleOrganizer = true;
	} else {
		document.getElementById("click-blue").style.border = eventStyle;
		document.getElementById("click-black").style.border = eventDefaultStyle;
		document.getElementById("click-yellow").style.border = eventDefaultStyle;
	}
	eventClickChecker = true;
	eventValue = blue;
	eventHoverChecker = 3;
}

//On-eventHoverChecker Events by the Users
function mouseOverBlack() {
	document.getElementById("prod-img").src = black;
	document.getElementById("click-black").style.border = eventStyle;
	document.getElementById("click-black").style.cursor = "pointer";
}
function mouseOverYellow() {
	document.getElementById("prod-img").src = yellow;
	document.getElementById("click-yellow").style.border = eventStyle;
	document.getElementById("click-yellow").style.cursor = "pointer";
}
function mouseOverBlue() {
	document.getElementById("prod-img").src = blue;
	document.getElementById("click-blue").style.border = eventStyle;
	document.getElementById("click-blue").style.cursor = "pointer";
}

//On-mouseout Events by the Users
function mouseOut() {
	if(eventClickChecker == false) {
		document.getElementById("prod-img").src = defaultImage;
		document.getElementById("click-black").style.border = eventDefaultStyle;
		document.getElementById("click-yellow").style.border = eventDefaultStyle;
		document.getElementById("click-blue").style.border = eventDefaultStyle;
	} else {
		document.getElementById("prod-img").src = eventValue;
	}

	if(eventHoverChecker == 1) {
		document.getElementById("click-yellow").style.border = eventDefaultStyle;
		document.getElementById("click-blue").style.border = eventDefaultStyle;
	} else if(eventHoverChecker == 2) {
		document.getElementById("click-black").style.border = eventDefaultStyle;
		document.getElementById("click-blue").style.border = eventDefaultStyle;
	} else if(eventHoverChecker == 3) {
		document.getElementById("click-black").style.border = eventDefaultStyle;
		document.getElementById("click-yellow").style.border = eventDefaultStyle;
	}
}