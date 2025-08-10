(function(){
    function enable(list){
        var items = list.children;
        for(var i=0;i<items.length;i++){
            items[i].draggable = true;
        }
        list.addEventListener('dragstart', function(e){
            e.target.classList.add('dragging');
        });
        list.addEventListener('dragend', function(e){
            e.target.classList.remove('dragging');
        });
        list.addEventListener('dragover', function(e){
            e.preventDefault();
            var dragging = document.querySelector('.dragging');
            var after = getAfterElement(list, e.clientY);
            if(after==null){
                list.appendChild(dragging);
            }else{
                list.insertBefore(dragging, after);
            }
        });
    }
    function getAfterElement(list, y){
        var els = list.querySelectorAll('.drag-item:not(.dragging)');
        var closest = null;
        var closestOffset = Number.NEGATIVE_INFINITY;
        for(var i=0;i<els.length;i++){
            var box = els[i].getBoundingClientRect();
            var offset = y - box.top - box.height/2;
            if(offset < 0 && offset > closestOffset){
                closestOffset = offset;
                closest = els[i];
            }
        }
        return closest;
    }
    window.enableDragSort = function(className){
        var lists = document.getElementsByClassName(className);
        for(var i=0;i<lists.length;i++){
            enable(lists[i]);
        }
    }
})();
