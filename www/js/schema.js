/**
 * WebRISC-V
 *
 * @copyright Copyright (c) 2019, Roberto Giorgi and Gianfranco Mariotti, University of Siena, Italy
 * @license   BSD-3-Clause
 */

function popup_close() {
	var root = (top.frames[2]) ? top.frames[2].document : document;
    var popup = root.getElementById('popup');
    if(popup)
        popup.parentElement.removeChild(popup);
};

function popup_open(link,width,height,posX,posY,elemWidth) {
	var root = (top.frames[2]) ? top.frames[2].document : document;
    popup_close();
    var popup = document.createElement('iframe');
    popup.id = 'popup';
    popup.src = link;
    popup.style.cssText = 'display:block; top:0px; left:0px; position:fixed; z-index:1; border: 1px solid;';
    popup.height = height;
    popup.width = width;
    posX = posX - root.body.scrollLeft;
    if ( posX > root.body.scrollWidth/2 )
        posX = posX - width;
    else
        posX = posX + elemWidth;
    popup.style.left = posX;
	if( ( posY + height ) > root.body.scrollHeight )
		posY = root.body.scrollHeight - 1.1 * height;
	posY = posY - root.body.scrollTop;
	posY = ( posY > 0 ) ? posY : 0;
    popup.style.top = posY;
    root.body.appendChild(popup);
};

function popup_set() {
	var root = (top.frames[2]) ? top.frames[2].document : document;
    root.querySelectorAll('div>a').forEach(function(element) {
        var link = element.getAttribute('onclick').split('\'')[1];
        var width = element.getAttribute('onclick').split('\'')[5].replace(/,/g,' ').replace(/=/g,' ').split(' ')[1];
        var height = element.getAttribute('onclick').split('\'')[5].replace(/,/g,' ').replace(/=/g,' ').split(' ')[3];
        var left = element.parentElement.offsetLeft;
        var top = element.parentElement.offsetTop;
        var parentWidth = element.parentElement.offsetWidth;
        element.parentElement.setAttribute('onmouseenter',"javascript:window.popup_open('"+link+"',"+width+","+height+","+left+","+top+","+parentWidth+");");  element.parentElement.setAttribute('onmouseleave',"javascript:window.popup_close();");
    });
};

function popup_unset() {
	var root = (top.frames[2]) ? top.frames[2].document : document;
    root.querySelectorAll('div>a').forEach(function(element) {
        element.parentElement.removeAttribute('onmouseenter');  element.parentElement.removeAttribute('onmouseleave');
    });
};
