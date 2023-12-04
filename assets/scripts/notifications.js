 function dragAndDrop(element) {
        let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

        element.onmousedown = function(event) {
            event.preventDefault();
        
            // get mouse position
            pos3 = event.clientX;
            pos4 = event.clientY;
            document.onmouseup = stopDrag;
           
            // when mouse is moving
            document.onmousemove = function(event) {
                event.preventDefault();
               
                
                // calc new position
                pos1 = pos3 - event.clientX;
                pos2 = pos4 - event.clientY;
                pos3 = event.clientX;
                pos4 = event.clientY;

                // move element
                element.style.top = (element.offsetTop - pos2) + "px";
                element.style.left = (element.offsetLeft - pos1) + "px";
            };
        };

        function stopDrag() {
            // when mouse button is not more pressed
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

     
    dragAndDrop(document.querySelector('.draggable'));


   async function showMessage(userMessage) {
        document.querySelector('[data-set="notification"]').textContent = userMessage;
        document.querySelector('.draggable').classList.remove('hidden__notif');

        setTimeout(() => {
            document.querySelector('[data-set="notification"]').textContent = '';
            document.querySelector('.draggable').classList.add('hidden__notif');
          }, 2000);

    }