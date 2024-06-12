$(document).ready(()=>{
  // Navigation
  const href = window.location.pathname;
  const navLinks = document.querySelectorAll(".navigation-link")
  navLinks.forEach( element => { 
    if(href == ($(element).attr("href"))) $(element).addClass("active") 
    else if(href == (`/${$(element).attr("href")}`)) $(element).addClass("active") 
  });
})

// INIT Bootstrap Tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
let formattedTooltipsList = [];
tooltipTriggerList.forEach((tooltip)=>{
  if(
    $(tooltip).attr("class") != "autocomplete-container" && 
    $(tooltip).attr("id") != "searchInputFloatingContainer"
  ) 
    formattedTooltipsList.push(tooltip)
})
const tooltipList = [...formattedTooltipsList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

// Toast
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 2000,
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