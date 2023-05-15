let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}

toggleBtn.onclick = (e) =>{
   darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
}



let profile = document.querySelector('.header .flex .profile');
let userBtn = document.querySelector('#user-btn');

// Add click event listener to document object
document.addEventListener('click', function(event) {
  // Check if clicked element is inside the profile element
  if (!profile.contains(event.target) && event.target != userBtn) {
    profile.classList.remove('active');
  }
});

// Add click event listener to userBtn element
userBtn.onclick = () =>{
   profile.classList.toggle('active');
}