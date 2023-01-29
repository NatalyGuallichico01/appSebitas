$('#hora').timepicker({
    timeFormat: 'H:i',
    minTime: '09:00am',
    maxTime: '06:00pm',
    step: 60, // 15 minutes
    disableTimeRanges: [],
    //showDuration: true
});


var updateTimePicker;
$(function ($) {
    updateTimePicker = function (_disabledRanges) {
        $('#hora').timepicker({
            timeFormat: 'H:i',
            minTime: '09:00am',
            maxTime: '06:00pm',
            step: 60, // 15 minutes
            disableTimeRanges: _disabledRanges,
           // showDuration: true
        });
    }
})


const getBlockedHoursByDate = async (date, callback) => {
    const datos = new FormData();
    datos.append('date', date);
    const options = {
        method: "POST",
        body: datos
    };
    const request = await fetch("api/citas/horasBloqueadas", options)
    const requestResponse = await request.json()
    return requestResponse
}


async function blockTimes(e) {
    var dateArr = e.srcElement.value.split('-');
    if (dateArr.length > 1) {
        let strDate = dateArr[0] + '-' + dateArr[1] + '-' + dateArr[2]
        const data = await getBlockedHoursByDate(strDate);
        if (data.length > 0) {
            let disabledRanges = data.map((cita) => {
                let selectedHour = cita.hora.slice(0, 2)
                let selectedMinutes = cita.hora.slice(3, 5)
                let afterHour = parseInt(selectedHour) + 1
                let range = [selectedHour + ":" + selectedMinutes, afterHour + ":" + selectedMinutes]
                console.log('range', range)
                return range
            })
            updateTimePicker(disabledRanges);
        }
    }
}

document.getElementById("fecha").addEventListener("blur", blockTimes)