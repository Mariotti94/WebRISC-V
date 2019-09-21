function popup_close() {
    var popup = top.frames[2].document.getElementById('popup');
    if(popup)
        popup.parentElement.removeChild(popup);
};

function popup_open(link,width,height,posX,posY,elemWidth) {
    popup_close();
    var popup = document.createElement('iframe');
    popup.id = 'popup';
    popup.src = link;
    popup.style.cssText = 'display:block; top:0px; left:0px; position:fixed; z-index:1; border: 1px solid;';
    popup.height = height;
    popup.width = width;
    posX = posX - top.frames[2].document.body.scrollLeft;
    if (posX > top.frames[2].document.body.offsetWidth/2)
        posX = posX - width;
    else
        posX = posX + elemWidth;
    popup.style.left = posX;
    posY = posY - top.frames[2].document.body.scrollTop;
    if (posY > top.frames[2].document.body.offsetHeight/2)
        posY = posY - 0.8 * height;
    popup.style.top = posY;
    top.frames[2].document.body.appendChild(popup);
};

function popup_set() {
    top.frames[2].document.querySelectorAll('div>a').forEach(function(element) {
        var link = element.getAttribute('onclick').split('\'')[1];
        var width = element.getAttribute('onclick').split('\'')[5].replace(/=/g,' ').split(' ')[1];
        var height = element.getAttribute('onclick').split('\'')[5].replace(/=/g,' ').split(' ')[3];
        var left = element.parentElement.offsetLeft;
        var top = element.parentElement.offsetTop;
        var parentWidth = parseInt(element.parentElement.style.width.split("p")[0]);
        element.parentElement.setAttribute('onmouseenter',"javascript:window.popup_open('"+link+"',"+width+","+height+","+left+","+top+","+parentWidth+");");  element.parentElement.setAttribute('onmouseleave',"javascript:window.popup_close();");
    });
};

function popup_unset() {
    top.frames[2].document.querySelectorAll('div>a').forEach(function(element) {
        element.parentElement.removeAttribute('onmouseenter');  element.parentElement.removeAttribute('onmouseleave');
    });
};
