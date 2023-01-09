let paso=1;
const pasoInicial=1;
const pasoFinal=3;

const cita={
    id:'',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function(){
    startApp();
});

function startApp() {
    viewSecction();//muestra y oculta las secciones
    tabs();//Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); //Agrega o quita los botones del paginador
    pagSiguiente();
    pagAnterior();
    checkAPI();//consulta la API
    idClient();
    nameClient();//añade el nombre del cliente al objeto cita
    selectionDate();//añade la fecha de la cita en el objeto
    selectionTime();//añade la hora de la cta en el objeto
    viewResumen();//muestra el resumen de la cita
}

function viewSecction(){
    //ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior= document.querySelector('.mostrar');
    if (seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }
    
    //seleccionar la seccion con el paso
    const pasoSelector=`#paso${paso}`;
    const seccion= document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //Quita la clase de actual al tab anterior
    const tabAnterior= document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab actual
    
    const tab=document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {
    const botones=document.querySelectorAll('.tabs button');
    botones.forEach(boton=>{
        boton.addEventListener('click', function(e){
            e.preventDefault();
            paso= parseInt (e.target.dataset.paso);
            
            viewSecction();
            botonesPaginador();
            

        });
    });
}

function botonesPaginador(){
    const pagSiguiente= document.querySelector('#siguiente');
    const pagAnterior= document.querySelector('#anterior');

    if (paso === 1){
        pagAnterior.classList.add('ocultar');
        pagSiguiente.classList.remove('ocultar');
    }
    else if (paso === 3){
        pagAnterior.classList.remove('ocultar');
        pagSiguiente.classList.add('ocultar');
        viewResumen();
    }
    else{
        pagAnterior.classList.remove('ocultar');
        pagSiguiente.classList.remove('ocultar');
        
    }
    viewSecction();
}

function pagAnterior(){
    const pagAnterior= document.querySelector('#anterior');
    pagAnterior.addEventListener('click', function(){
        if(paso<=pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}

function pagSiguiente (){
    const pagSiguiente= document.querySelector('#siguiente');
    pagSiguiente.addEventListener('click', function(){
        if(paso>=pasoFinal) return;
        paso++;
        botonesPaginador();
    });
}

async function checkAPI(){
    try {
        const url='http://localhost:3000/api/servicios';
        const resultado= await fetch(url);
        const servicios=await resultado.json();

       viewServices(servicios);

    
    } catch (error) {
        console.log(error);
    }
}

function viewServices(servicios){
    servicios.forEach(servicio=>{
        const {id, nombre, precio} = servicio;
        const nombreServicio=document.createElement('P');
        nombreServicio.classList.add('nombreServicio');
        nombreServicio.textContent=nombre;

        const precioServicio=document.createElement('P');
        precioServicio.classList.add('precioServicio');
        precioServicio.textContent=`$ ${precio}`;

        const servicioDiv=document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio=id;
        servicioDiv.onclick= function(){
            selectService(servicio);
        }

        //mostrar en pantalla
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    });
}

function selectService(servicio){
    const{id}=servicio;
    const {servicios}=cita;

    //identificar al elemento al que se esta dando click
    const divServicio=document.querySelector(`[data-id-servicio="${id}"]`);

    //comprobar si un servicio fue agregado
    if(servicios.some(agregado=>agregado.id===id)){

        //ELIMINARLO
        cita.servicios=servicios.filter(agregado=>agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    }
    else{
        //AGREGARLO
        cita.servicios=[...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }

    
    
    
    console.log(cita);

}


function idClient(){
    const id=document.querySelector('#id').value;
    cita.id=id;
}


function nameClient(){
    const nombre= document.querySelector('#nombre').value;
    cita.nombre=nombre;
}

function selectionDate(){
    const inputFecha= document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e){
        const dia=new Date(e.target.value).getUTCDay();
        if([6,0].includes(dia)){
            e.target.value='';
            viewAlert('Los fines de semana no atendemos', 'error', '.formulario');
            console.log('Los fines de semana no atendemos');
        }
        else {
            cita.fecha=e.target.value;
        }
    });
}

function selectionTime(){
    const inputHora= document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){
        
        const horaCita=e.target.value;
        const hora=horaCita.split(":")[0];
        if(hora<10 || hora>18){
            e.target.value='';
            viewAlert('Fuera de horario de trabajo', 'error', '.formulario');
            console.log('Hora no válida1');
        }
        else{
            cita.hora=e.target.value;
            
        }
    })
}

function viewAlert(mensaje, tipo, elemento, desaparece= true){
    //evita q se muestre mas de una alerta
    const alertaPrevia= document.querySelector('.alerta');
    //if (alertaPrevia) return;
    if (alertaPrevia){
          alertaPrevia.remove();
     }

    //script para crear la alerta
    const alerta=document.createElement('DIV');
    alerta.textContent= mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);
    const referencia=document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece){
        //eliminar la alerta
        setTimeout(()=>{
            alerta.remove();
        }, 3000);
     
    }

    
    
}

function viewResumen(){
    const resumen=document.querySelector('.contenido-resumen');
    //Limpiar el contenido del resumen
    //resumen.innerHTML='';
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }
    
    if(Object.values(cita).includes('') || cita.servicios.length === 0){
         viewAlert('Faltan datos de Servicios, Fecha u Hora', 'error', '.contenido-resumen', false);
         return;
         //console.log('Hacen falta datos o servicios');
     }
    //formatear el div resumen
    const {nombre, fecha, hora, servicios}=cita;

    

    //heading para  servicios en resumen
    const headingServicios=document.createElement('H3');
    headingServicios.textContent='Resumen de Servicios';
    resumen.appendChild(headingServicios);

    //Iterando y mostrando los servicios
    servicios.forEach(servicio=>{
        const {id, precio, nombre}=servicio;
        const contenedorServicio=document.createElement('DIV');
        contenedorServicio.classList.add('contenedorServicio');

        const textServicio= document.createElement('P');
        textServicio.textContent=nombre;

        const precioServicio=document.createElement('P');
        precioServicio.innerHTML=`<span>Precio: </span>$${precio}`;
        contenedorServicio.appendChild(textServicio);
        contenedorServicio.appendChild(precioServicio);

        //e.target.value='';

        resumen.appendChild(contenedorServicio);

    });


    //heading para  cita en resumen
    const headingCita=document.createElement('H3');
    headingCita.textContent='Resumen de Cita';
    resumen.appendChild(headingCita);

    const  nombreCliente=document.createElement('P');
    nombreCliente.innerHTML=`<span>Nombre: </span>${nombre}`;

    //formatear fecha en español
    const fechaObj=new Date(fecha);
    const mes=fechaObj.getMonth();
    const dia=fechaObj.getDate()+2;
    const year=fechaObj.getFullYear();

    const fechaUTC=new Date(Date.UTC(year, mes, dia));
    const opciones={weekday:'long', year:'numeric', month:'long', day:'numeric'}
    const fechaFormateada=fechaUTC.toLocaleDateString('es-ES', opciones);
    console.log(fechaFormateada);

    const  fechaCita=document.createElement('P');
    fechaCita.innerHTML=`<span>Fecha: </span>${fechaFormateada}`;

    const  horaCita=document.createElement('P');
    horaCita.innerHTML=`<span>Hora: </span>${hora} Horas`;

    const botonReservar=document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent='Reservar Cita';
    botonReservar.onclick= reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonReservar);

}

async function reservarCita(){
    const {nombre, fecha, hora, servicios, id }=cita;

    const idServicios=servicios.map(servicio=>servicio.id);
    //console.log(idServicios);

    const datos=new FormData();
    //agregar datos
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('servicios', idServicios);

    //console.log([...datos]);

    try {
        //PETICION A LA API
    const url='http://localhost:3000/api/citas'
    const respuesta=await fetch(url, {
        method:'POST',
        body: datos
    });

    const resultado=await respuesta.json();
    console.log(resultado.resultado);

    if(resultado.resultado){
        Swal.fire({
            icon: 'success',
            title: 'Cita Creada',
            text: 'Cita Creada Exitosamente',
            button:'Ok'
          }).then(()=>{
            setTimeout(()=>{
                window.location.reload();
            },3000);
            
          })
    }
    
        
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Algo salio mal al guardar la cita'
          })
    }

    
    //console.log([...datos]);
}
