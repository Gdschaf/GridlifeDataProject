//CSS Filter Calculator https://codepen.io/sosuke/pen/Pjoqqp

const GLTCButtonName = "GLTC-Button";
const TrackBattleButtonName = "TrackBattle-Button";

const IMGClassName = "nav-button";

const GLTCSelectedFilter = "invert(93%) sepia(3%) saturate(2796%) hue-rotate(110deg) brightness(92%) contrast(81%)";
const TrackBattleSelectedFilter = "invert(93%) sepia(3%) saturate(2796%) hue-rotate(110deg) brightness(92%) contrast(81%)";

function gltcPressed() {
    var gltcChild = getImgOfButton(GLTCButtonName);
    gltcChild.style.filter = GLTCSelectedFilter;
    var trackbattleChild = getImgOfButton(TrackBattleButtonName);
    trackbattleChild.style.filter = "";
}

function trackbattlePressed() {
    var trackbattleChild = getImgOfButton(TrackBattleButtonName);
    trackbattleChild.style.filter = TrackBattleSelectedFilter;
    var gltcChild = getImgOfButton(GLTCButtonName);
    gltcChild.style.filter = "";
}

function getImgOfButton(buttonName)
{
    var button = document.getElementById(buttonName);
    var child = button.getElementsByClassName(IMGClassName)[0];
    return child;
}