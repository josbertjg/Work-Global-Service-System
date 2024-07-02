function formatDate(date){
  if(_.isEmpty(date)) return "Fecha no válida";
  const fechaString = date;
  const fecha = new Date(fechaString);
  const fechaFormateada = fecha.toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' });
  return fechaFormateada;
}

function formatTime(time){
  if(_.isEmpty(time)) return "Hora no válida";

  let today = moment().format('YYYY-MM-DD');
  today += ` ${time}`;
  const timeFormatted = moment(today).format('h:mm a');
  return timeFormatted
}

function formatDateTimeAgo(dateTime){
  if(_.isEmpty(dateTime)) return "Fecha Invalida";
  
  const dias  = moment().diff(moment(dateTime), 'days');
  const meses = moment().diff(moment(dateTime), 'months');
  const años  = moment().diff(moment(dateTime), 'years');

  const dateTimeFormatted = 
  años <= 0 ?
    meses <= 0 ? 
      dias > 1 ? dias+" días" : dias+" día"
    :
      meses > 1 ? meses+" meses" : meses+" mes"
  :
    años > 1 ? años+" años" : años+" año"

  return dateTimeFormatted;
}

