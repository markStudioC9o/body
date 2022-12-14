// var dragTitle = document.getElementById('ad-text-title');

// dragTitle.onmousedown = function(e){
//   var newObj = dragTitle.cloneNode(true);
//   newObj.style.position = 'absolute';
//   moveAt(e);
//   document.body.appendChild(newObj);
//   newObj.style.zIndex = 1000; // показывать мяч над другими элементами

//   // передвинуть мяч под координаты курсора
//   // и сдвинуть на половину ширины/высоты для центрирования
//   function moveAt(e) {
//     newObj.style.left = e.pageX - newObj.offsetWidth / 2 + 'px';
//     newObj.style.top = e.pageY - newObj.offsetHeight / 2 + 'px';
//   }
//   document.onmousemove = function(e) {
//     moveAt(e);
//   }

//   // 4. отследить окончание переноса
//   newObj.onmouseup = function() {
//     document.onmousemove = null;
//     newObj.onmouseup = null;
//     newObj.style.position = 'relative';
//     newObj.remove();
//   }
// }



var DragManager = new function() {
  /**
   * составной объект для хранения информации о переносе:
   * {
   *   elem - элемент, на котором была зажата мышь
   *   avatar - аватар
   *   downX/downY - координаты, на которых был mousedown
   *   shiftX/shiftY - относительный сдвиг курсора от угла элемента
   * }
   */
  var dragObject = {};

  var self = this;

  function onMouseDown(e) {

    if (e.which != 1) return;

    var terget = e.target.closest('.draggable');
    if(!terget) return;
    var elem = terget.cloneNode(true);
    if (!elem) return;

    dragObject.elem = elem;

    // запомним, что элемент нажат на текущих координатах pageX/pageY
    dragObject.downX = e.pageX;
    dragObject.downY = e.pageY;

    return false;
  }

  function onMouseMove(e) {
    if (!dragObject.elem) return; // элемент не зажат

    if (!dragObject.avatar) { // если перенос не начат...
      var moveX = e.pageX - dragObject.downX;
      var moveY = e.pageY - dragObject.downY;

      // если мышь передвинулась в нажатом состоянии недостаточно далеко
      if (Math.abs(moveX) < 3 && Math.abs(moveY) < 3) {
        return;
      }

      // начинаем перенос
      dragObject.avatar = createAvatar(e); // создать аватар
      if (!dragObject.avatar) { // отмена переноса, нельзя "захватить" за эту часть элемента
        dragObject = {};
        return;
      }

      // аватар создан успешно
      // создать вспомогательные свойства shiftX/shiftY
      var coords = getCoords(dragObject.avatar);
      dragObject.shiftX = dragObject.downX - coords.left;
      dragObject.shiftY = dragObject.downY - coords.top;

      startDrag(e); // отобразить начало переноса
    }

    // отобразить перенос объекта при каждом движении мыши
    // dragObject.avatar.style.left = e.pageX - dragObject.shiftX + 'px';
    // dragObject.avatar.style.top = e.pageY - dragObject.shiftY + 'px';
    dragObject.avatar.style.left = e.pageX - 20 + 'px';
    dragObject.avatar.style.top = e.pageY - 20 + 'px';

    return false;
  }

  function onMouseUp(e) {
    if (dragObject.avatar) { // если перенос идет
      finishDrag(e);
    }

    // перенос либо не начинался, либо завершился
    // в любом случае очистим "состояние переноса" dragObject
    dragObject = {};
  }

  function finishDrag(e) {
    var dropElem = findDroppable(e);

    if (!dropElem) {
      self.onDragCancel(dragObject);
    } else {
      self.onDragEnd(dragObject, dropElem);
    }
  }

  function createAvatar(e) {

    // запомнить старые свойства, чтобы вернуться к ним при отмене переноса
    var avatar = dragObject.elem;
    var old = {
      parent: avatar.parentNode,
      nextSibling: avatar.nextSibling,
      position: avatar.position || '',
      left: avatar.left || '',
      top: avatar.top || '',
      zIndex: avatar.zIndex || ''
    };

    // функция для отмены переноса
    // avatar.rollback = function() {
    //   old.parent.insertBefore(avatar, old.nextSibling);
    //   avatar.style.position = old.position;
    //   avatar.style.left = old.left;
    //   avatar.style.top = old.top;
    //   avatar.style.zIndex = old.zIndex
    // };

    return avatar;
  }

  function startDrag(e) {
    var avatar = dragObject.avatar;

    // инициировать начало переноса
    document.body.appendChild(avatar);
    avatar.style.zIndex = 9999;
    avatar.style.position = 'absolute';
    avatar.classList.add('move-dragle');
  }

  function findDroppable(event) {
    // спрячем переносимый элемент
    dragObject.avatar.remove();

    // получить самый вложенный элемент под курсором мыши
    var elem = document.elementFromPoint(event.clientX, event.clientY);

    // показать переносимый элемент обратно
    dragObject.avatar.hidden = false;

    if (elem == null) {
      // такое возможно, если курсор мыши "вылетел" за границу окна
      return null;
    }
    return elem.closest('.content-one-accardion');
  }

  document.onmousemove = onMouseMove;
  document.onmouseup = onMouseUp;
  document.onmousedown = onMouseDown;

  this.onDragEnd = function(dragObject, dropElem) {};
  this.onDragCancel = function(dragObject) {};

};


function getCoords(elem) { // кроме IE8-
  var box = elem.getBoundingClientRect();
  return {
    top: box.top + pageYOffset,
    left: box.left + pageXOffset
  };

}

DragManager.onDragCancel = function(dragObject) {
  // dragObject.avatar.rollback();
};

DragManager.onDragEnd = function(dragObject, dropElem) {
  var  idElem = dragObject.elem.getAttribute('id');
  dragObject.elem.style.display = 'none';
  var atrId = dropElem.getAttribute('data-id');

  if(idElem == 'ad-text-title'){
    $.post("/admin/articles/new-title-block", { data: "h1" }, Success);
    function Success(data) {
      $('.content-one-accardion[data-id="'+atrId+'"]').append(data);
    }
  }
  if(idElem == 'ad-text-block'){
  $.post("/admin/articles/new-text-block", Success);
  function Success(data) {
    $('.content-one-accardion[data-id="'+atrId+'"]').append(data);
  }
}
if(idElem == 'ad-colom-block'){
  $.post("/admin/colum/index", Success);
  function Success(data) {
    $('.content-one-accardion[data-id="'+atrId+'"]').append(data);
  }
}
};