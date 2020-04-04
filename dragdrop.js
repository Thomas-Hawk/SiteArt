var dragSrcEl = null;
var dragSrcE2 = null;
function handleDragStart(e) {
    // Target (this) element is the source node.
    dragSrcEl = this;
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.outerHTML);

    this.classList.add('dragElem');
}

function handleDragOver(e) {

    if (e.preventDefault) {
        e.preventDefault(); // Necessary. Allows us to drop.
    }
    this.classList.add('over');

    e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

    return false;
}

function handleDragEnter(e) {
    // this / e.target is the current hover target.
}

function handleDragLeave(e) {

    this.classList.remove('over');  // this / e.target is previous target element.
}

function handleDrop(e) {
    // this/e.target is current target element.
    dragSrcE2 =this;
    if (e.stopPropagation) {
        e.stopPropagation(); // Stops some browsers from redirecting.
    }

    // Don't do anything if dropping the same column we're dragging.
    if (dragSrcEl != this) {
        // Set the source column's HTML to the HTML of the column we dropped on.
        //alert(this.outerHTML);
        //dragSrcEl.innerHTML = this.innerHTML;
        //this.innerHTML = e.dataTransfer.getData('text/html');
        this.parentNode.removeChild(dragSrcEl);
        var dropHTML = e.dataTransfer.getData('text/html');
        this.insertAdjacentHTML('beforebegin', dropHTML);
        var dropElem = this.previousSibling;
        addDnDHandlers(dropElem);
    }
    this.classList.remove('over');
    return false;
}

function handleDragEnd(e) {
    var tabone=dragSrcEl.querySelector("th").innerHTML
    var tabtwo=dragSrcE2.querySelector("th").innerHTML
    // console.log('drag1:',dragSrcEl.querySelector("th").innerHTML)
    // console.log('drag1:',dragSrcE2.querySelector("th").innerHTML)

    $.post('mode_creat.php', {tabone,tabtwo},
    
    );
 

    // $.ajax( console.log('test'),{
    //     url : 'query_aja.php',
    //     type : 'POST', // Le type de la requête HTTP, ici devenu POST
    //     data : 'tabone=' + tabone + '&tabtwo=' + tabtwo, // On fait passer nos variables, exactement comme en GET, au script more_com.php
    //     dataType : 'html'
       
    //  });
   

    // this/e.target is the source node.
    this.classList.remove('over');


    /*[].forEach.call(cols, function (col) {
      col.classList.remove('over');
    });*/
}

function swap() {

}


var count = 0;
function addDnDHandlers(elem) {
    // console.log('test',test)
    elem.addEventListener('dragstart', handleDragStart, false);
    elem.addEventListener('dragenter', handleDragEnter, false)
    elem.addEventListener('dragover', handleDragOver, false);
    elem.addEventListener('dragleave', handleDragLeave, false);
    elem.addEventListener('drop', handleDrop, false);
    elem.addEventListener('dragend', handleDragEnd, false);
}

var cols = document.querySelectorAll('#columns .column');
[].forEach.call(cols, addDnDHandlers);

