
(function(){
  
    var seguidores = []

    Livewire.on('mostrarFollower', usuarios => {

           seguidores = usuarios
        
        console.log(usuarios)
        mostrarSeguidores(seguidores, 'Seguidores')
    
       
    })

    Livewire.on('mostrarFollowings', usuarios => {

        seguidores = usuarios    
        
        mostrarSeguidores(seguidores, 'Siguiendo')

 })

    
        function mostrarSeguidores(seguidores, titulo){

          
            const modal = document.createElement('DIV');
            modal.classList.add('modal');
            modal.innerHTML = `
                <div class="seguidores">
                    <div class="seguidores__heading">
                    <p class="font-bold">${titulo}</p>
                    <button class="cerrar-modal font-bold"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  </button>
                    </div>
                    <div>
                        <ul id="nombres">
                        </ul>
                    </div>
                </div> `;
              
            
               
        document.querySelector('body').appendChild(modal);
        const contenedorSeguidores = document.querySelector('#nombres');

        const cerrarModal = document.querySelector('.cerrar-modal');
        cerrarModal.addEventListener('click', ()=>{
            modal.remove()
        })
        if(seguidores.length === 0){

            const contenedorSeguidor = document.createElement('LI');
            contenedorSeguidor.classList.add('noSeguidor')

            if(titulo === "Seguidores"){
                contenedorSeguidor.textContent = `Aun no hay Seguidores`
            }else{
                contenedorSeguidor.textContent = `Esta cuenta aun no sigue a nadie`
            }

            
            contenedorSeguidores.appendChild(contenedorSeguidor)

            exit;

        }else{
            seguidores.forEach(seguidor => {
                const contenedorSeguidor = document.createElement('LI');
                contenedorSeguidor.classList.add('contenedorSeguidor');
    
                const contenedorNombre = document.createElement('DIV');
                contenedorNombre.classList.add('contenedorNombre')
    
                const nombre = document.createElement('P');
                nombre.classList.add('nombreSeguidor')
                const imgSeguidor = document.createElement('IMG');
                imgSeguidor.classList.add('imgSeguidor')
    
                const btnSeguidor = document.createElement('a');
                btnSeguidor.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>
               Perfil`
                btnSeguidor.classList.add('botonSeguidor')
                btnSeguidor.href = 'http://127.0.0.1:8000/' + seguidor.username
    
                imgSeguidor.src = '/perfiles/' + seguidor.imagen
                nombre.textContent = seguidor.username;
    
    
                contenedorNombre.appendChild(imgSeguidor)
                contenedorNombre.appendChild(nombre)
                contenedorSeguidor.appendChild(contenedorNombre);
                contenedorSeguidor.appendChild(btnSeguidor)
                contenedorSeguidores.appendChild(contenedorSeguidor)
            });
             
               
        }
     
      
    
       

     

        
    }
   
    
})()