document.addEventListener('DOMContentLoaded', function(){
    startApp();
});
function startApp() {
    searchToDate();
}
function searchToDate() {
    const fechaInput=document.querySelector('#fecha');
    fechaInput.addEventListener('input', function(e){
        const selectionDate=e.target.value;
        window.location=`?fecha=${selectionDate}`;
    });
}