document.addEventListener('DOMContentLoaded', function(){
    startApp();
});
function startApp() {
    searchToDate();
}
function searchToDate() {
    const fechaInput=document.querySelector('#fecha');
    const fechaFinal=document.querySelector('#fechaFin');

    let valorFechaInicio = ''
    let valorFechaFinal = ''
    
    fechaInput.addEventListener('input', function(e){
        
        const selectionDate=e.target.value;
        window.location=`?fecha=${selectionDate}`;
        // console.log('valir inicio', valorFechaInicio)
        // valorFechaInicio = e.target.value;
    });

    // fechaFinal.addEventListener('input', function(e){
        
    //     valorFechaFinal = e.target.value;
    //     // const selectionDate=e.target.value;
    //     // window.location=`?fecha=${selectionDate}`;
    // });

    // if(valorFechaInicio !== '') {
    //     window.location=`?fecha=${valorFechaInicio}${valorFechaFinal !== '' ? '&fechaFinal='+valorFechaFinal : ''}`;
    // }

    //botones de estado de cita
}