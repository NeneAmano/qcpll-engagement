var nbi = document.getElementById('nbi-logs');
var police = document.getElementById('police-logs');
var others = document.getElementById('others-logs');
const url = window.location.pathname.split('/');

if(url[4] == 'nbi-logs.php'){
    nbi.classList.add("border");
    nbi.classList.add("border-dark");
    nbi.classList.add("border-2");
    nbi.classList.add("border-opacity-75");
}else if(url[4] == 'police-logs.php'){
    police.classList.add("border");
    police.classList.add("border-dark");
    police.classList.add("border-2");
    police.classList.add("border-opacity-75");
}else if(url[4] == 'others-logs.php'){
    others.classList.add("border");
    others.classList.add("border-dark");
    others.classList.add("border-2");
    others.classList.add("border-opacity-75");
}