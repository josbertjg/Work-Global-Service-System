$(document).ready(()=>{
  // Navigation
  const href = window.location.pathname;
  const navLinks = document.querySelectorAll(".navigation-link")
  navLinks.forEach( element => { 
    if(href == ($(element).attr("href"))) $(element).addClass("active") 
    else if(href == (`/${$(element).attr("href")}`)) $(element).addClass("active") 
  });
  initTooltips();
})

// INIT Bootstrap Tooltips
function initTooltips(){
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  $('[tooltip-can-change="true"]').tooltip("hide");
  $('[tooltip-can-change="true"]').tooltip("hide");
  let formattedTooltipsList = [];
  tooltipTriggerList.forEach((tooltip)=>{
    if(
      $(tooltip).attr("class") != "autocomplete-container" && 
      $(tooltip).attr("id") != "searchInputFloatingContainer"
    ) 
      formattedTooltipsList.push(tooltip)
  })
  const tooltipList = [...formattedTooltipsList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
}

// Mostrar alertas
function showAlert(type, title, text){
  Swal.fire({
    icon: type,
    title: title,
    text: text
  });
}

// Toast
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

// Loading
const loading = new bootstrap.Modal(document.getElementById('loading')) 
function toggleLoading(toggle){
  if(toggle) loading.show();
  else{
    setTimeout(() => {
      loading.hide();
    }, 500);
  }
}