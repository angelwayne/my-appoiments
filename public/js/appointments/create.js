let $doctor, $date, $specialty, $hours;
let iRdio;
const noHoursAlert =`<div class="alert alert-warning alert-dismissible fade show" role="alert">
<span class="alert-icon"><i class="ni ni-chat-round"></i></span>
<span class="alert-text"><strong>Atencion!</strong> No se encontraron horas para el medico en el dia seleccionado.</span>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>`
$(function () {
    $specialty =  $('#specialty');
    $doctor=$('#doctor');
    $date = $('#date');
    $hours = $('#hours');

   $specialty.change(() =>{
    const specialtyId = $specialty.val()
    const url = `/specialties/${specialtyId}/doctors`;
    $.getJSON(url, onDoctorsLoaded);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);

});

function onDoctorsLoaded(doctors) {
    let htmlOption='';
       doctors.forEach(doctor => {
           htmlOption += `<option value="${doctor.id}">${doctor.name}</option>`;
       });
$doctor.html(htmlOption)
loadHours();
}

function loadHours() {
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/schedule/hours?date=${selectedDate}&doctor_Id=${doctorId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data) {
    if (!data.morning && !data.afternoon) {
        $hours.html(noHoursAlert);
        return;
    }

    let htmlHours ='';
    iRdio=0;
    if (data.morning) {
        const morning_intervls = data.morning;

        morning_intervls.forEach(interval =>{
           htmlHours +=getRadioIntervalHtml(interval);
        });
    }
    if (data.afternoon) {
        const afternoon_intervls = data.afternoon;

        afternoon_intervls.forEach(interval =>{
            htmlHours +=getRadioIntervalHtml(interval);
        });
    }
    $hours.html(htmlHours)
}

function getRadioIntervalHtml(interval) {

    const text =`${interval.start} - ${interval.end}`;

    return `<div class="custom-control custom-radio mb-3">
    <input type="radio" id="interval${iRdio}" name="interval" class="custom-control-input" value="${text}">
    <label class="custom-control-label" for="interval${iRdio++}">${text}</label>
  </div>`;
}
