(function(){
    const clientesInput=document.querySelector('#usuarios');
    if(clientesInput){
        let clientes=[];
        let clientesFiltrados=[];

        const listadoClientes=document.querySelector('#listadoCLientes');

        obtenerClientes();

        clientesInput.addEventListener('input', buscarClientes)

        async function obtenerClientes(){
            const url=`/api/clientes`
            const respuesta= await fetch(url);
            const resultado=await respuesta.json()
            //console.log(clientes);
            formatearClientes(resultado);
        }

        function formatearClientes(arrayClientes=[]){
            clientes=arrayClientes.map(cliente=>{
                return{
                    nombre:`${cliente.nombre.trim()} ${cliente.apellido.trim()}`,
                    id: cliente.id
                }
            })
            console.log(clientes);
        }

        function buscarClientes(e){
            const busqueda=e.target.value;
            console.log(busqueda);
            if(busqueda.length>3){
                const expresion=new RegExp(busqueda, "i");
                clientesFiltrados=clientes.filter(cliente=>{
                    if(cliente.nombre.toLowerCase().search(expresion) !=-1){
                        return cliente;
                    }
                })
                //console.log(clientesFiltrados);
                
            }
            else{
                clientesFiltrados=[];
            }
            mostrarClientes();
        }
        function mostrarClientes(){
            while(listadoClientes.firstChild){
                listadoClientes.removeChild(listadoClientes.firstChild);
            }
            //listadoClientes.innerHTML='';

            if(clientesFiltrados.length>0){
                clientesFiltrados.forEach(cliente=>{
                    const clienteHTML=document.createElement('LI');
                    
                    clienteHTML.classList.add('campo')
                    
                    clienteHTML.textContent=cliente.nombre;
                    clienteHTML.dataset.clienteId=cliente.id;
    
                     //AÑADIR AL DOM
                     listadoClientes.appendChild(clienteHTML); 
                 })
            }
            else{
                const noResultados=document.createElement('P');
                noResultados.classList.add('listadoPonentes_no_resultados');
                noResultados.textContent="No se encontro ningun Resultado"

                listadoClientes.appendChild(noResultados);            }
            
         }
    }
})();