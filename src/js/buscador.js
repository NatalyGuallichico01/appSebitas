document.addEventListener('DOMContentLoaded', function(){
    startApp();
});
function startApp() {
    searchToDate();
}
function searchToDate() {
    const fechaInput=document.querySelector('#fechaInicio');
    fechaInput.addEventListener('input', function(e){
        const selectionDate=e.target.value;
        window.location=`?fecha=${selectionDate}`;
    });
    //botones de estado de cita
}

