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
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

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