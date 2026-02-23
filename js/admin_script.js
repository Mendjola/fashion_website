document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.querySelector('.toggle-btn');
    const sideBarContainer = document.querySelector('.side-bar-container');

    toggleBtn.addEventListener('click', function() {
        sideBarContainer.classList.toggle('hidden'); 
    });

    const userBtn = document.querySelector('#user-btn');
    const profileInfoContainer = document.querySelector('.profile-info-container');

    userBtn.addEventListener('click', function() {
        profileInfoContainer.classList.toggle('active');
    });
});


